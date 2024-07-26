<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;

class Login extends BaseController
{
    protected $token;

    public function __construct()
    {
        // Set Token
        $this->token = session()->get('userToken');
    }
    public function login()
    {
        return view('login/login');
    }
    public function authentication()
    {
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                'email' => $email,
                'password' => $pass,
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);

        if (isset($responseData['token'])) {
            $token = $responseData['token'];

            $decode = JWT::decode($token, new Key('f4dIvVKDEuox03miVMr3us42lNCoA3XXg8xqFoEMTEFzVlWOMSbmGApyRXtN5x0B', 'HS256'));

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/profile',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $token
                ),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $responseData = json_decode($response, true);

            if (isset($responseData['data'])) {
                $profileData = $responseData['data'];
            } else {
                $profileData = [];
            }

            $isAdmin = false;
            foreach ($decode->role as $role) {
                if ($role->role === 'administrator') {
                    $isAdmin = true;
                    $session = session();
                    $session->set([
                        'decodeToken' => $decode,
                        'userToken' => $token,
                        'userEmail' => $decode->email,
                        'userId' => $role->id,
                        'userDivision' => $role->division,
                        'userRole' => $role->role,
                        'userName' => $profileData['name'],
                        'userEmail' => $profileData['email'],
                        'userSex' => $profileData['sex'],
                        'userBirth' => $profileData['birthday'],
                    ]);
                    return redirect()->to('/dashboard');
                    break;
                }
            }

            if (!$isAdmin) {
                return redirect()->back()->with('error', 'Gagal Login, Anda Tidak Memiliki Akses.');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal Login, Silahkan Coba Lagi.');
        }
    }

    public function forgot()
    {
        return view('login/forgot');
    }
    public function resetPass()
    {
        return view('login/resetPass');
    }
}
