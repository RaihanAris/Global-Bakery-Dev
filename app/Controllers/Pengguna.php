<?php

namespace App\Controllers;

use App\Models\Posisi;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use SebastianBergmann\Type\TrueType;
use App\Models\UserModel;
use App\Models\DivisiModel;
use DateTime;

class Pengguna extends BaseController
{
    protected $role;
    protected $token;
    protected $members;
    protected $userModel;
    protected $divisiModel;

    public function __construct()
    {
        // Set Token
        $this->role = session()->get('userRole');
        $this->token = session()->get('userToken');
        $this->userModel = new UserModel();
        $this->divisiModel = new DivisiModel();
    }
    public function index(): string
    {
        $pengguna_list = $this->userModel->where("deleted_at", null)->paginate(10, 'pengguna');
        $divisi_list = $this->divisiModel->where("deleted_at", null)->paginate(10, 'divisi');
        $posisi_list = $this->get_posisi_list();

        foreach ($pengguna_list as &$pengguna) {
            $detail_pengguna = $this->get_detail_pengguna($pengguna['id']);
            $pengguna['role'] = $detail_pengguna['role'];
        }
        // dd($pengguna_list);

        $data = [
            'title' => 'Pengguna | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'members' => $pengguna_list,
            'roles' => $posisi_list,
            'token' => $this->token,
            'totalPengguna' => $this->userModel->where("deleted_at", null)->countAllResults(),
            'divisiList' => $divisi_list,
            'totalDivisi' => $this->divisiModel->where("deleted_at", null)->countAllResults(),
            'currentPagePengguna' => $this->userModel->pager->getCurrentPage('pengguna'),
            'currentPageDivisi' => $this->divisiModel->pager->getCurrentPage('divisi'),
            'userPager' => $this->userModel->pager,
            'divisiPager' => $this->divisiModel->pager,
        ];
        // dd(count($data['members']));
        return view('pengguna/index', $data);
    }
    // POSISI
    public function get_posisi_list(): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'role/list',
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
    public function detail_posisi($id): string
    {
        $pengguna_list = $this->get_pengguna_list();
        $posisi_list = $this->get_posisi_list();

        // cek posisi
        foreach ($posisi_list as $posisi) {
            if ($posisi['id'] === $id) {
                $posisi_name = $posisi['name'];
            }
        }
        // membuat array yang berisi posisi khusus
        foreach ($pengguna_list as $pengguna) {
            $detail_pengguna = $this->get_detail_pengguna($pengguna['id']);
            foreach ($detail_pengguna['role'] as $pengguna_role) {
                if ($pengguna_role['roleId'] === $id) {
                    $specific_role = array_merge($pengguna, [
                        'role' => $pengguna_role
                    ]);
                    $posisi_pengguna[] = $specific_role;
                }
            }
        }
        // dd($posisi_pengguna, $posisi_name);

        $data = [
            'title' => 'Detail Posisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'members' => $posisi_pengguna,
            'posisi' => $posisi_name,

        ];
        return view('pengguna/detail_posisi', $data);
    }
    // DIVISI
    public function get_divisi_list(): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'division/list?limit=20&offset=0&search=',
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

    public function tambah_divisi(): string
    {
        $data = [
            'title' => 'Tambah Divisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,

        ];
        return view('pengguna/tambah_divisi', $data);
    }

    public function save_divisi(): \CodeIgniter\HTTP\RedirectResponse
    {
        $name_division = $this->request->getPost('nama-divisi');
        $desc_division = $this->request->getPost('deskripsi-divisi');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'division/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "name" => $name_division,
                "description" => $desc_division
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

        if ($responseData['status'] === false) {
            session()->setFlashdata('error', $responseData['message']);
        } else {
            session()->setFlashdata('success', $responseData['message']);
        }
        return redirect()->to('/pengguna');
    }
    public function get_divisi_detail($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'division/user?limit=10&offset=0&divisionId=' . $id,
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

    public function detail_divisi($id): string
    {
        $divisi_list = $this->get_divisi_list();
        $divisi_detail = $this->get_divisi_detail($id);

        $data = [
            'title' => 'Detail Divisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'divisi_list' => $divisi_list,
            'divisi_detail' => $divisi_detail
        ];

        return view('pengguna/detail_divisi', $data);
    }
    public function update_divisi($id): string
    {
        $divisi_list = $this->get_divisi_list();
        foreach ($divisi_list as $detail) :
            if ($detail['id'] === $id) {
                $detail_divisi = $detail;
            }
        endforeach;

        $data = [
            'title' => 'Update Divisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'id' => $id,
            'nama' => $detail_divisi['name'],
            'deskripsi' => $detail_divisi['description']
        ];
        return view('pengguna/update_divisi', $data);
    }

    public function save_update_divisi($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $nama = $this->request->getPost('update-nama');
        $desk = $this->request->getPost('update-deskripsi');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'division/update/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                'name' => $nama,
                'description' => $desk
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
        if ($responseData['status'] === false) {
            session()->setFlashdata('error', $responseData['message']);
        } else {
            session()->setFlashdata('success', $responseData['message']);
        }

        return redirect()->to('/pengguna');
    }
    public function delete_divisi(): \CodeIgniter\HTTP\RedirectResponse
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'division/delete/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
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
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }

        return redirect()->to('/pengguna');
    }

    // PENGGUNA
    public function get_pengguna_list(): array
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
            session()->set('members', $responseData['data']);
        } else {
            $members = [];
        }
        return $members;
    }
    public function tambah_pengguna(): string
    {
        $data = [
            'title' => 'Tambah Pengguna | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
        ];
        return view('pengguna/tambah_pengguna', $data);
    }
    public function save_pengguna(): \CodeIgniter\HTTP\RedirectResponse
    {
        $nama = $this->request->getPost('nama-pengguna');
        $gender = $this->request->getPost('gender-pengguna');
        $email = $this->request->getPost('email-pengguna');
        $pass = $this->request->getPost('pass-pengguna');
        $birth = $this->request->getPost('lahir-pengguna');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'user/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                'email' => $email,
                'name' => $nama,
                'birthday' => $birth,
                'sex' => $gender,
                'password' => $pass,
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

        if ($responseData['status'] === false) {
            session()->setFlashdata('error', $responseData['message']);
        } else {
            session()->setFlashdata('success', $responseData['message']);
        }
        return redirect()->to('/pengguna');
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
    public function get_plan_list($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'plan/list/?limit=20&offset=0&user=' . $id,
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
        return ($responseData['data']);
    }
    public function get_activity_list($PlanId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'activity/list?limit=10&offset=0&planId=' . $PlanId,
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
    public function get_evaluation_user($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'evaluation/summary/' . $id . '?days=30',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
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

        return ($responseData['data']);
    }
    public function get_user_plan($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'history/detail?user=' . $id . '&start_date=2024-07-14&end_date=2024-08-14',
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

        dd($responseData['data']['detail']);
        return ($responseData['data']['detail']);
    }
    public function get_plan_detail($plan_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'plan/detail/' . $plan_id,
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
    public function detail_pengguna($id): string
    {
        $userDetails = $this->get_detail_pengguna($id);
        $userPlans = $this->get_user_plan($id);
        $workHours = $this->get_plan_category();
        $dailyValues = $this->get_evaluation_user($id);

        $planList = [];
        $rencana = [];
        $i = 0;
        // Mendapatkan User Plan List
        foreach ($userPlans as $plan) {
            $detailPlan = $this->get_plan_detail($plan['planId']);
            $rencana[] = $plan['planId'];
            // Mengonversi created_at ke objek DateTime dan mendapatkan format tanggalnya
            $date = new DateTime($detailPlan['created_at']);
            $formattedCreatedDate = $date->format('Y-m-d');

            foreach ($detailPlan['division'] as $planDivision) {
                foreach ($planDivision['user'] as $planUser) {
                    $details = [
                        'id' => $detailPlan['id'],
                        'created_at' => $formattedCreatedDate,
                        'title' => $detailPlan['title'],
                        'description' => $detailPlan['description'],
                        'progress' => $detailPlan['progress'],
                        'status' => $detailPlan['status'],
                        'category' => $detailPlan['category'],
                        'updated_at' => $detailPlan['updated_at'],
                        'divisionName' => $planDivision['divisionName'],
                        'userRole' => $planUser['userRole'],
                    ];
                }
            }

            // Memasukkan data Plan
            // Menambahkan detail ke $planList dengan format kunci yang sesuai
            $formattedDate = (new DateTime($detailPlan['created_at']))->format('Y-m-d');
            if (!isset($planList[$formattedDate])) {
                $planList[$formattedDate] = [];
            }
            $planList[$formattedDate][$i] = $details;

            // Mendapatkan Activitynya
            foreach ($plan['activity_detail'] as $activity) {
                $activities = [
                    'title' => $activity['title'],
                    'description' => $activity['description'],
                    'status' => $activity['status'],
                    'planTitle' => $activity['planTitle'],
                    'created_at' => $activity['created_at'],
                    'updated_at' => $activity['updated_at'],
                    'categoryId' => $activity['categoryId']
                ];
                // Memasukkan data Aktivitas
                $planList[$formattedDate][$i]['activities'][] = $activities;
            }
            $i++;
        }

        // dd($planList);

        $dailyValue = [];
        $date = [];

        // Mengambil data untuk Evaluasi user
        foreach ($dailyValues as $values) {
            $dailyValue[] = $values['value'];
            $date[] = $values['date'];
        }

        $data = [
            'title' => 'Detail Pengguna | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'details' => $userDetails,
            'userPlans' => $userPlans,
            'idmembers' => $id,
            'workHours' => $workHours,
            'dailyValues' => $dailyValue,
            'date' => $date,
            'graphWidth' => count($dailyValue) * 100,
            'planList' => $planList
        ];
        // dd($data['graphWidth']);
        return view('pengguna/detail_pengguna', $data);
    }
    public function update_pengguna($id): string
    {
        // Ambil data dari session
        $userDetails = $this->get_detail_pengguna($id);
        $division_list = $this->get_divisi_list();
        $posisi_list = $this->get_posisi_list();

        if (!$userDetails) {
            session()->setFlashdata('error', 'Tidak ada data pengguna yang ditemukan.');
            return redirect()->to('/pengguna');
        }

        $data = [
            'title' => 'Update Pengguna | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'details' => $userDetails,
            'user_roles' => $userDetails['role'],
            'idmembers' => $id,
            'divisions' => $division_list,
            'roles' => $posisi_list
        ];

        // dd($data['role'], $data['details'], $data['user_role'],);
        return view('pengguna/update_pengguna', $data);
    }
    public function save_role_divisi($email, $roles, $divisions)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'user/createRole',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "user" => $email,
                "role" => $roles,
                "division" => $divisions
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

        if ($responseData['status'] === false) {
            session()->setFlashdata('errorUpdate', $responseData['message']);
        } else {
            session()->setFlashdata('successUpdate', $responseData['message']);
        }
    }
    public function update_user_picture($foto)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . '/upload',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                'file' => $foto
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

        dd($responseData, "123");
    }
    public function save_update_pengguna($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $role_user = $this->get_detail_pengguna($id);
        // Ambil data dari form
        $nama = $this->request->getPost('namaPengguna');
        $email = $this->request->getPost('emailPengguna');
        $sex = $this->request->getPost('sexPengguna');
        $birth = $this->request->getPost('birthPengguna');
        $foto = $this->request->getFile('fotoPengguna');

        // Ambil roles dan divisions dari form
        $roles = $this->request->getPost('roles');
        $divisions = $this->request->getPost('divisions');

        // Masukkan Ke API update_user_picture
        if ($foto->getName() != null) {
            $this->update_user_picture($foto->getTempName());
        }

        // Masukkan ke API Update user
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'user/update/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                'name' => $nama,
                'sex' => $sex,
                'birthday' => $birth,
                'picture' => $foto,
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

        if ($responseData['status'] === false) {
            session()->setFlashdata('error', $responseData['message']);
        } else {
            session()->setFlashdata('success', $responseData['message']);
        }

        // Buat array roleDivisionPairs
        if (is_array($roles) && is_array($divisions)) {
            for ($i = 0; $i < count($roles); $i++) {
                $roleExists = false;
                foreach ($role_user['role'] as $existingRole) {
                    if ($roles[$i] === $existingRole['role'] && $divisions[$i] === $existingRole['divisionId']) {
                        $roleExists = True;
                        session()->setFlashdata('errorInfo', "Role " . $existingRole['role'] . " dan Divisi " . $existingRole['division'] . " sudah ada pada User");
                        break;
                    }
                }
                if (!$roleExists) {
                    $this->save_role_divisi($email, $roles[$i], $divisions[$i]);
                }
            }
        }

        return redirect()->to('/pengguna');
    }
    public function delete_user(): \CodeIgniter\HTTP\RedirectResponse
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form

        // Menggunakan CURL untuk memanggil API eksternal
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'user/delete/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
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
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }

        return redirect()->to('/pengguna');
    }

    public function delete_user_role()
    {
        $id = $this->request->getPost('id');
        $idUser = $this->request->getPost('idUser');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('API_URL') . 'user/deleteRole/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
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
            session()->setFlashdata('success', $responseData['message']);
        } else {
            session()->setFlashdata('error', $responseData['message']);
        }

        return redirect()->to('/pengguna/update-pengguna/' . $idUser);
    }
}
