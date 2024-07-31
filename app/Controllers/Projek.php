<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Expr\Assign;

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
    public function get_detail_projek($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/plan/detail/' . $id,
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
        // dd($responseData['data']);

        return $responseData['data'];
    }
    public function detail($id): string
    {
        $users = $this->get_pengguna_list();
        $details = $this->get_detail_projek($id);

        foreach ($users as $user) {
            if ($user['id'] === $details['created_by']) {
                $creator = $user['name'];
            }
        }

        foreach ($details['division'] as $divisionProject) {
            $assignedDivision[] = $divisionProject;
            foreach ($divisionProject['user'] as $users) {
                $assignedUser[] = $users;
            }
        }
        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role,
            'details' => $details,
            'creator' => $creator,
            // 'divisions' => $assignedDivision,
            // 'users' => $assignedUser,
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
    public function update_plan($id)
    {
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $status = $this->request->getPost('status');
        $progress = $this->request->getPost('progress');
        $category = $this->request->getPost('category');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/plan/update/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                "title" => $title,
                "description" => $description,
                "status" => $status,
                "progress" => $progress,
                "category" => $category,
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
        // dd($responseData);
        if ($responseData['status'] === true) {
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }

        return redirect()->to('/projek');
    }
    public function get_divisi_list(): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/division/list?limit=10&offset=0&search=',
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
    public function get_divisi_detail($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/division/user?limit=10&offset=0&divisionId=' . $id,
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
    public function update($id): string
    {
        $details = $this->get_detail_projek($id);
        $divisionList = $this->get_divisi_list();
        $userList = $this->get_pengguna_list();

        foreach ($details['division'] as $divisionProject) {
            $assignedDivision[] = $divisionProject;
            $divisionDetail = $this->get_divisi_detail($divisionProject['divisionId']);
            foreach ($divisionProject['user'] as $users) {
                $assignedUser[] = $users;
            }
        }
        dd($details, $assignedDivision,  $divisionDetail, $assignedUser, $divisionList, $userList);

        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role,
            'details' => $details,
            'assignedDivision' => $assignedDivision,
            'divisionDetail' => $divisionDetail,
            'assignedUser' => $assignedUser,
            'divisionList' => $divisionList,
            'userList' => $userList
        ];
        return view('projek/update', $data);
    }
    public function save_update_projek($id)
    {
        $planId = $id;
        $divisionId = $this->request->getPost('divisionId');
        $userId = $this->request->getPost('userId');

        // if (is_array($divisionId) && is_array($userId)) {
        //     for ($i = 0; $i < count($divisionId); $i++) {
        //         $updateExists = false;
        //         foreach ($role_user['role'] as $existingRole) {
        //             if ($roles[$i] === $existingRole['role'] && $divisions[$i] === $existingRole['divisionId']) {
        //                 $updateExists = True;
        //                 $this->save_role_divisi($email, $roles[$i], $divisions[$i]);
        //                 break;
        //             }
        //         }
        //         if (!$updateExists) {
        //             $this->save_role_divisi($email, $roles[$i], $divisions[$i]);
        //         }
        //     }
        // }
    }
    public function tambah_divisi_projek($planId, $divisionId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/plan/assignDivision',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "planId" => $planId,
                "divisionId" => $divisionId
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
        // dd($responseData);
        if ($responseData['status'] === true) {
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }
    }
    public function tambah_user_projek($planId, $userId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/plan/assignUser',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "planId" => $planId,
                "userId" => $userId
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
        // dd($responseData);
        if ($responseData['status'] === true) {
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }
    }
}
