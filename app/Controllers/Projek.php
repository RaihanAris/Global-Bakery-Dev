<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Projek extends BaseController
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
        foreach ($responseData['data'] as $project) {
            if ($project['category'] === 'project') {
                $list_project[] = $project;
            }
        }

        return ($list_project);
    }
    public function index(): string
    {
        $projects = $this->get_plan_list();

        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role,
            'projects' => $projects
        ];
        return view('projek/index', $data);
    }
    public function detail($id): string
    {
        $users = $this->get_pengguna_list();
        $projects = $this->get_plan_list();
        foreach ($projects as $project) {
            if ($project['id'] === $id) {
                $details = $project;
            }
        }
        foreach ($users as $user) {
            if ($user['id'] === $details['created_by']) {
                $creator = $user['name'];
            }
        }
        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role,
            'details' => $details,
            'creator' => $creator,
        ];
        // dd($data['details']);
        return view('projek/detail', $data);
    }
    public function tambah(): string
    {
        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role
        ];
        return view('projek/tambah', $data);
    }
    public function create_project()
    {
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $progress = $this->request->getPost('progress');
        $category = $this->request->getPost('category');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/plan/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "title" => $name,
                "description" => $description,
                "progress" => $progress,
                "category" => $category
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

        return redirect()->to('/projek');
    }
    public function update(): string
    {
        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role
        ];
        return view('projek/update', $data);
    }
}
