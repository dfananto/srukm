<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    protected $kriteriaModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
    }

    public function index()
    {
        $data = [
            'kriteria' => $this->kriteriaModel
                ->orderBy('idKriteria', 'ASC')
                ->findAll()
        ];

        return view('kriteria', $data);
    }

    public function store()
    {
        $idKriteria = 'K' . trim($this->request->getPost('idKriteria'));

        $cekidKriteria = $this->kriteriaModel
            ->where('idKriteria', $idKriteria)
            ->first();

        if ($cekidKriteria) {
            return redirect()->back()
                ->with('error', 'ID Kriteria sudah digunakan');
        }

        $data = [
            'idKriteria' => $idKriteria,
            'kriteria'   => $this->request->getPost('kriteria'),
            'deskripsi'  => $this->request->getPost('deskripsi')
        ];

        $this->kriteriaModel->insert($data);

        return redirect()->back()
            ->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $data = $this->kriteriaModel->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data kriteria tidak ditemukan.');
        }

        $this->kriteriaModel->delete($id);

        return redirect()->back()
            ->with('success', 'Kriteria berhasil dihapus.');
    }

    public function getById($id)
{
    $data = $this->kriteriaModel
        ->where('idKriteria', $id)
        ->first();

    return $this->response->setJSON($data);
}

public function update()
{
    $id = $this->request->getPost('idKriteria');

    $this->kriteriaModel->update($id, [
        'kriteria'  => $this->request->getPost('kriteria'),
        'deskripsi' => $this->request->getPost('deskripsi')
    ]);

    return $this->response->setJSON([
        'status'  => 'success',
        'message' => 'Kriteria berhasil diperbarui.'
    ]);
}
}
