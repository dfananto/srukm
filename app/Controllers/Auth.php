<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function login()
    {
        $nama = $this->request->getPost('nama');
        $password = $this->request->getPost('password');
        $userModel = new UserModel();

        $user = $userModel->where('nama', $nama)->first();
        // Nama tidak ditemukan
        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Pengguna tidak ditemukan.');
        }
        // Password salah
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }
        // Login berhasil
        session()->set([
            'idUser' => $user['idUser'],
            'nama'   => $user['nama'],
            'role'   => $user['role'],
            'login'  => true
        ]);
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/')
            ->with('success', 'Berhasil logout.');
    }

        public function tentang(): string
    {
        return view('tentang');
    }
}
