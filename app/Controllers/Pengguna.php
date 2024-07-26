<?php

namespace App\Controllers;

use App\Models\Posisi;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use SebastianBergmann\Type\TrueType;

class Pengguna extends BaseController
{
    protected $role;
    protected $token;
    protected $members;

    public function __construct()
    {
        // Set Token
        $this->role = session()->get('userRole');
        $this->token = session()->get('userToken');
    }
    public function index(): string
    {
        $pengguna_list = $this->get_pengguna_list();
        $divisi_list = $this->get_divisi_list();
        $posisi_list = $this->get_posisi_list();
        $data = [
            'title' => 'Pengguna | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'members' => $pengguna_list,
            'divisions' => $divisi_list,
            'roles' => $posisi_list,
            'token' => $this->token,
        ];

        return view('pengguna/index', $data);
    }
    // POSISI
    public function get_posisi_list(): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/role/list',
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
    public function tambah_posisi(): string
    {
        $data = [
            'title' => 'Tambah Posisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'validation' => \Config\Services::validation()
        ];
        return view('pengguna/tambah_posisi', $data);
    }
    public function save()
    {
        // validasi input . kalau tidak tervalidasi
        if (!$this->validate([
            'nama-posisi' => [
                'rules' => 'required|is_unique[posisi.nama]'
            ]
        ])) {
            $validation = \Config\Services::validation(); //Pesan Kesalahan
            return redirect()->to('/pengguna/tambah-posisi')->withInput()->with('validation', $validation);
        }

        // $slug = url_title($this->request->getVar('nama-posisi'), '-', true);
        // $this->PosisiModel->save([
        //     'nama' => $this->request->getVar('nama-posisi'),
        //     'slug' => $slug
        // ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/pengguna');
    }
    public function detail_posisi($slug): string
    {
        $data = [
            'title' => 'Detail Posisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            // 'posisi' => $this->PosisiModel->getPosisi($slug)
        ];
        return view('pengguna/detail_posisi', $data);
    }
    public function update_posisi($slug): string
    {
        $data = [
            'title' => 'Update Posisi | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            // 'posisi' => $this->PosisiModel->getPosisi($slug)
        ];
        return view('pengguna/update_posisi', $data);
    }
    // DIVISI
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
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/division/create',
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
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/division/update/' . $id,
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
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/division/delete/' . $id,
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
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/create',
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
    public function detail_pengguna($id): string
    {
        $userDetails = $this->get_detail_pengguna($id);

        $data = [
            'title' => 'Detail Pengguna | Admin',
            'menu' => 'pengguna',
            'role' => $this->role,
            'details' => $userDetails,
            'idmembers' => $id
        ];
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
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/createRole',
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
    }
    public function save_update_pengguna($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $role_user = $this->get_detail_pengguna($id);
        // Ambil data dari form
        $nama = $this->request->getPost('namaPengguna');
        $email = $this->request->getPost('emailPengguna');
        $sex = $this->request->getPost('sexPengguna');
        $birth = $this->request->getPost('birthPengguna');
        $foto = $this->request->getPost('fotoPengguna');
        // Ambil roles dan divisions dari form
        $roles = $this->request->getPost('roles');
        $divisions = $this->request->getPost('divisions');

        // Buat array roleDivisionPairs
        if (is_array($roles) && is_array($divisions)) {
            for ($i = 0; $i < count($roles); $i++) {
                $roleExists = false;
                foreach ($role_user['role'] as $existingRole) {
                    if ($roles[$i] === $existingRole['role'] && $divisions[$i] === $existingRole['divisionId']) {
                        $roleExists = True;
                        $this->save_role_divisi($email, $roles[$i], $divisions[$i]);
                        break;
                    }
                }
                if (!$roleExists) {
                    $this->save_role_divisi($email, $roles[$i], $divisions[$i]);
                }
            }
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/update/' . $id,
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

        return redirect()->to('/pengguna/update-pengguna/' . $id);
    }
    public function delete_user(): \CodeIgniter\HTTP\RedirectResponse
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form

        // Menggunakan CURL untuk memanggil API eksternal
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/delete/' . $id,
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
            CURLOPT_URL => 'https://api.hanasta.co.id/globalbakery2/user/deleteRole/' . $id,
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
