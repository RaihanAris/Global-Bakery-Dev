<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

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
        // foreach ($responseData['data'] as $project) {
        //     if ($project['category'] === 'project') {
        //         $list_project[] = $project;
        //     }
        // }
        // dd($responseData);
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

        // dd($responseData);
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
    public function get_activity_graph()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'activity/summary/graph',
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
        $responseData = json_decode($response, true);
        curl_close($curl);

        return ($responseData['data']);
    }

    public function index()
    {
        $users = $this->get_pengguna_list();
        $user_plans = $this->get_plan_list();
        $anggota = $this->jumlah_anggota();
        $plan_category = $this->get_plan_category();
        $activity_list = $this->get_activity_list();
        $activity_graph = $this->get_activity_graph();

        // mengumpulkan data activity graph
        $graphDate = [];
        $graphCount = [];
        foreach ($activity_graph as $graph_data) {
            $graphDate[] = $graph_data['date'];
            $graphCount[] = $graph_data['count'];
        }
        // dd($graphDate, $graphCount);

        $plans_by_user = [];
        $user_plan_list = [];
        $aktivitas = 0;
        $project = 0;

        // Kelompokkan rencana berdasarkan created_by
        foreach ($user_plans as $user_plan) {
            $created_by = $user_plan['created_by'];
            if (!isset($plans_by_user[$created_by])) {
                $plans_by_user[$created_by] = [];
            }
            $plans_by_user[$created_by][] = $user_plan;
            $aktivitas++;
            if ($user_plan['category'] === 'project') {
                $project++;
            }
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
            'menu' => 'dashboard',
            'role' => $this->role,
            'user_plan_list' => $user_plan_list,
            'anggota' => $anggota,
            'aktivitas' => $aktivitas,
            'project' => $project,
            'plan_category' => $plan_category,
            'activity_list' => $activity_list,
            'graphCount' => $graphCount,
            'graphDate' => $graphDate,

        ];

        return view('dashboard/dashboard', $data);
    }

    public function update_status_plan()
    {
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'plan/update/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                "status" => $status
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if ($responseData['status'] === true) {
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }

        return redirect()->to('/dashboard');
    }
}
