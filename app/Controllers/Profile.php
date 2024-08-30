<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $role;
    protected $token;
    protected $name;
    protected $email;
    protected $sex;
    protected $birth;
    protected $picture;

    public function __construct()
    {
        if (session()->get('userRole')) {
            $this->role = session()->get('userRole');
            $this->token = session()->get('userToken');
            $this->name = session()->get('userName');
            $this->email = session()->get('userEmail');
            $this->sex = session()->get('userSex');
            $this->birth = session()->get('userBirth');
            $this->picture = session()->get('userPicture');
        }
    }
    public function index()
    {
        $data = [
            'title' => 'Profile | Admin',
            'menu' => '',
            'role' => $this->role,
            'name' => $this->name,
            'email' => $this->email,
            'sex' => $this->sex,
            'birth' => $this->birth,
        ];
        return view('profile/profile', $data);
    }
    public function changePass()
    {
        $data = [
            'title' => 'Profile | Admin',
            'menu' => '',
            'role' => $this->role
        ];
        return view('profile/ganti-password', $data);
    }
    public function resetPass()
    {
        $data = [
            'title' => 'Profile | Admin',
            'menu' => '',
            'role' => $this->role
        ];
        return view('profile/reset-password', $data);
    }
    public function sendCode()
    {
        $data = [
            'title' => 'Profile | Admin',
            'menu' => '',
            'role' => $this->role
        ];
        return view('profile/kode', $data);
    }

    public function newPass()
    {
        $data = [
            'title' => 'Profile | Admin',
            'menu' => '',
            'role' => $this->role
        ];
        return view('profile/new-password', $data);
    }
    public  function logout()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'auth/logout',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);

        if ($responseData['status'] === true) {
            return redirect()->to('/');
        } else {
            return redirect()->to('/profile');
        }
    }

    public function change_pass($id) {}
}
