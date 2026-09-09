<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $idUserAktif = session()->get('idUser');
        $role = session()->get('role');

        if ($role == 'admin' && $idUserAktif == 14) {
            $users = $userModel->findAll();
        } else {
            $users = $userModel
                ->where('role', 'user')
                ->findAll();
        }
        return view('user', [
            'title' => 'Kelola Data Pengguna',
            'users' => $users,
            'idUserAktif' => $idUserAktif
        ]);
    }

    public function store()
    {
        $userModel = new UserModel();

        $nama = $this->request->getPost('nama');

        $cekNama = $userModel
            ->where('nama', $nama)
            ->first();

        if ($cekNama) {
            return redirect()->back()
                ->with('error', 'Nama sudah digunakan');
        }

        $userModel->save([
            'nama'          => $nama,
            'nim'           => $this->request->getPost('nim'),
            'umur'          => $this->request->getPost('umur'),
            'jenisKelamin'  => $this->request->getPost('jenisKelamin'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'kelas'         => $this->request->getPost('kelas'),
            'nohp'          => $this->request->getPost('nohp'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'          => $this->request->getPost('role') ?? 'user'
        ]);

        return redirect()->back()
            ->with('success', 'Data pengguna berhasil ditambahkan');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Data pengguna tidak ditemukan');
        }

        $userModel->delete($id);

        return redirect()->back()
            ->with('success', 'Data pengguna berhasil dihapus');
    }

    public function profile($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {

            return redirect()->to('/')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }

        $data = [
            'user' => $user
        ];

        return view('/profile', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'email'         => $this->request->getPost('email'),
            'nim'           => $this->request->getPost('nim'),
            'umur'          => $this->request->getPost('umur'),
            'jenisKelamin'  => $this->request->getPost('jenisKelamin'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'kelas'         => $this->request->getPost('kelas'),
            'nohp'          => $this->request->getPost('nohp')
        ];

        // Hanya Super Admin (idUser = 14) yang boleh ubah role
        if (
            session()->get('idUser') == 14 &&
            $user['idUser'] != 14
        ) {
            $data['role'] = $this->request->getPost('role');
        }

        // Update password jika diisi
        $password         = $this->request->getPost('password');
        $confirmPassword  = $this->request->getPost('confirm_password');

        if (!empty($password)) {

            if ($password !== $confirmPassword) {
                return redirect()->back()->withInput()->with(
                    'error',
                    'Konfirmasi password tidak sesuai.'
                );
            }

            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $userModel->update($id, $data);

        return redirect()->to('user')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function profil()
{
    $idUser = session()->get('idUser');

    if (!$idUser) {
        return redirect()->to('/')
            ->with('error', 'Silahkan login terlebih dahulu.');
    }
    $userModel = new UserModel();
    $user = $userModel->find($idUser);

    if (!$user) {
        return redirect()->back()
            ->with('error', 'Data pengguna tidak ditemukan.');
    }

    return view('profile', [
        'user' => $user
    ]);
}
}
