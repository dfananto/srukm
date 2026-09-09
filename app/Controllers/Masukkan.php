<?php

namespace App\Controllers;

use App\Models\MasukkanModel;
use App\Models\KriteriaModel;

class Masukkan extends BaseController
{
    protected $masukkanModel;
    protected $kriteriaModel;

    public function __construct()
    {
        $this->masukkanModel = new MasukkanModel();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function create()
    {
        $idKriteria = explode(
            ',',
            $this->request->getGet('kriteria')
        );

        $dataKriteria = $this->kriteriaModel
            ->whereIn('idKriteria', $idKriteria)
            ->findAll();

        $listKriteria = [];

        foreach ($dataKriteria as $k) {

            $listKriteria[] = $k['kriteria'];

        }

        $data = [
            'nama' => $this->request->getGet('nama'),
            'nim' => $this->request->getGet('nim'),

            // untuk ditampilkan
            'kriteriaTampil' => implode('<br>', $listKriteria),

            // untuk disimpan
            'kriteriaSimpan' => implode('<br>', $listKriteria)
        ];

        return view('masukkan', $data);
    }

    public function simpan()
    {
        $this->masukkanModel->save([

            'nama' => $this->request->getPost('nama'),

            'nim' => $this->request->getPost('nim'),

            'kriteriaTerpilih' => $this->request->getPost('kriteriaTerpilih'),

            'masukkan' => $this->request->getPost('masukkan'),

            'tanggal' => date('Y-m-d')

        ]);

        return redirect()
            ->to('/rekomendasi')
            ->with(
                'success',
                'Masukan berhasil dikirim.'
            );
    }

         public function index()
    {
        $data = [
            'title'   => 'Masukkan',
            'masukkan' => $this->masukkanModel
                                ->orderBy('tanggal', 'DESC')
                                ->findAll()
        ];

        return view('kelolamasukkan', $data);
    }

    public function delete($id)
    {
        $masukkan = $this->masukkanModel->find($id);

        if (!$masukkan) {
            return redirect()->to('/kelolamasukkan')
                ->with('error', 'Data tidak ditemukan.');
        }

        $this->masukkanModel->delete($id);

        return redirect()->to('/kelolamasukkan')
            ->with('success', 'Berhasil menghapus masukan');
    }

            public function kritik(): string
    {
        return view('masukkanKritik');
    }
}