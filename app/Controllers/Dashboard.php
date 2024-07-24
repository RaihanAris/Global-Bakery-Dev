<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->get('userRole')) {
            $role = session()->get('userRole');
        }
        $data = [
            'title' => 'Dashboard | Admin',
            'menu' => 'dashboard',
            'role' => $role
        ];

        return view('dashboard/dashboard', $data);
    }
}
