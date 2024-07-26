<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $token;
    protected $role;

    public function __construct()
    {
        // Set Token
        $this->role = session()->get('userRole');
        $this->token = session()->get('userToken');
    }
    public function get_pengguna_list()
    {
        // inisialisasi User list
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/list?offset=0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);
        if (isset($responseData['data'])) {
            $members = $responseData['data'];
        } else {
            $members = [];
        }

        return $members;
    }
    public function get_detail_pengguna($id): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/detail/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);
        return $responseData['data'];
    }
    public function get_plan_list()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/plan/list/all?limit=10&offset=0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);
        // foreach ($responseData['data'] as $project) {
        //     if ($project['category'] === 'project') {
        //         $list_project[] = $project;
        //     }
        // }

        return ($responseData['data']);
    }
    public function jumlah_anggota()
    {
        $users = $this->get_pengguna_list();

        $staff = 0;
        $manager = 0;
        $total = 0;
        foreach ($users as $user) {
            $detail = $this->get_detail_pengguna($user['id']);
            $total++;
            foreach ($detail['role'] as $role) {
                if ($role['role'] === 'staff') {
                    $staff++;
                } elseif ($role['role'] === 'manager') {
                    $manager++;
                }
            }
        }
        $jumlah = [
            'staff' => $staff,
            'manager' => $manager,
            'total' => $total,
        ];
        // dd($jumlah);
        return ($jumlah);
    }

    public function index()
    {
        $users = $this->get_pengguna_list();
        $user_plans = $this->get_plan_list();
        $anggota = $this->jumlah_anggota();

        $aktivitas = 0;
        $project = 0;
        foreach ($users as $user) {
            foreach ($user_plans as $user_plan) {
                if ($user_plan['created_by'] === $user['id']) {
                    $aktivitas++;
                    $detail = $this->get_detail_pengguna($user['id']);
                    $combined_plan = array_merge($user_plan, [
                        'user_name' => $user['name'],
                        'user_id' => $user['id'],
                        'role' => $detail['role']
                    ]);
                    $user_plan_list[] = $combined_plan;
                    if ($user_plan['category'] === 'project') {
                        $project++;
                    }
                }
            }
        }



        $data = [
            'title' => 'Dashboard | Admin',
            'menu' => 'dashboard',
            'role' => $this->role,
            'user_plan_list' => $user_plan_list,
            'anggota' => $anggota,
            'aktivitas' => $aktivitas,
            'project' => $project
        ];

        return view('dashboard/dashboard', $data);
    }
}
