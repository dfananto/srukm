<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UkmModel;

class Ukm extends BaseController
{
    protected $ukmModel;

    public function __construct()
    {
        $this->ukmModel = new UkmModel();
    }
    
    public function index()
    {
        $data = [
            'ukm' => $this->ukmModel
                ->orderBy('idUkm', 'ASC')
                ->findAll()
        ];

        return view('ukm', $data);
    }

    public function store()
    {
        $idUkm = 'UKM' . trim($this->request->getPost('idUkm'));

        $cekidUkm = $this->ukmModel
            ->where('idUkm', $idUkm)
            ->first();

        if ($cekidUkm) {
            return redirect()->back()
                ->with('error', 'ID UKM sudah digunakan');
        }

        $data = [
            'idUkm' => $idUkm,
            'nama'   => $this->request->getPost('nama'),
            'deskripsi'  => $this->request->getPost('deskripsi')
        ];

        $this->ukmModel->insert($data);

        return redirect()->back()
            ->with('success', 'UKM berhasil ditambahkan.');
    }

   public function delete($id)
{
    try {

        $this->ukmModel->delete($id);

        return redirect()->back()
            ->with('success', 'Data berhasil dihapus.');

    } catch (\Throwable $e) {

        if (str_contains($e->getMessage(), 'foreign key constraint')) {

            return redirect()->back()
                ->with('error', 'Data tidak dapat dihapus karena masih digunakan.');

        }

        throw $e;
    }
}

    public function getById($id)
{
    $data = $this->ukmModel
        ->where('idUkm', $id)
        ->first();

    return $this->response->setJSON($data);
}

public function update()
{
    $id = $this->request->getPost('idUkm');

    $this->ukmModel->update($id, [
        'nama'  => $this->request->getPost('nama'),
        'deskripsi' => $this->request->getPost('deskripsi')
    ]);

    return $this->response->setJSON([
        'status'  => 'success',
        'message' => 'UKM berhasil diperbarui.'
    ]);
}
}
