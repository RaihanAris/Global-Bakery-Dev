<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rencana extends BaseController
{
    protected $role;
    protected $token;

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
            CURLOPT_URL => getenv('API_URL') . 'user/list?offset=0',
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
            CURLOPT_URL => getenv('API_URL') . 'user/detail/' . $id,
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
            CURLOPT_URL => getenv('API_URL') . 'plan/list/?limit=20&offset=0',
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
        return ($responseData['data']);
    }
    public function get_plan_category()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'activity/category/list?limit=10&offset=0',
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

        return ($responseData['data']);
    }
    public function get_activity_list()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'activity/list?limit=10&offset=0',
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

        return ($responseData['data']);
    }
    public function index()
    {
        $users = $this->get_pengguna_list();
        $user_plans = $this->get_plan_list();
        $plan_category = $this->get_plan_category();
        $activity_list = $this->get_activity_list();

        $plans_by_user = [];
        $user_plan_list = [];

        // Kelompokkan rencana berdasarkan created_by
        foreach ($user_plans as $user_plan) {
            $created_by = $user_plan['created_by'];
            if (!isset($plans_by_user[$created_by])) {
                $plans_by_user[$created_by] = [];
            }
            $plans_by_user[$created_by][] = $user_plan;
        }

        // Gabungkan data pengguna dengan rencana
        foreach ($users as $user) {
            $user_id = $user['id'];
            if (isset($plans_by_user[$user_id])) {
                $detail = $this->get_detail_pengguna($user_id);
                $user_data = [
                    'user_name' => $user['name'],
                    'user_id' => $user_id,
                    'role' => $detail['role'],
                    'plans' => $plans_by_user[$user_id]
                ];
                $user_plan_list[] = $user_data;
            }
        }

        $data = [
            'title' => 'Dashboard | Admin',
            'menu' => 'rencana',
            'role' => $this->role,
            'user_plan_list' => $user_plan_list,
            'plan_category' => $plan_category,
            'activity_list' => $activity_list,

        ];

        return view('rencana/index', $data);
    }

    public function history(): string
    {
        $data = [
            'title' => 'Pengguna | Admin',
            'menu' => 'rencana',
            'role' => $this->role
        ];
        return view('rencana/history', $data);
    }
    public function detail(): string
    {
        $data = [
            'title' => 'Pengguna | Admin',
            'menu' => 'rencana',
            'role' => $this->role
        ];
        return view('rencana/detail', $data);
    }
}
