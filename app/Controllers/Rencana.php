<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rencana extends BaseController
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
            'title' => 'Pengguna | Admin',
            'menu' => 'rencana',
            'role' => $this->role,
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
