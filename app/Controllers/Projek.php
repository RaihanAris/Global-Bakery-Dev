<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Projek extends BaseController
{
    public function __construct()
    {
        if (session()->get('userRole')) {
            $this->role = session()->get('userRole');
        }
    }
    public function index(): string
    {
        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role
        ];
        return view('projek/index', $data);
    }
    public function detail(): string
    {
        $data = [
            'title' => 'Projek | Admin',
            'menu' => 'projek',
            'role' => $this->role
        ];
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
