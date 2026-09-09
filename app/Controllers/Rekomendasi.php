<?php

namespace App\Controllers;

use App\Models\RuleModel;
use App\Models\UkmModel;
use App\Models\RiwayatModel;
use App\Models\KriteriaModel;

class Rekomendasi extends BaseController
{
    protected $ruleModel;
    protected $ukmModel;
    protected $riwayatModel;
    protected $kriteriaModel;

    public function __construct()
    {
        $this->ruleModel = new RuleModel();
        $this->ukmModel = new UkmModel();
        $this->riwayatModel = new RiwayatModel();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function index()
    {
        $data['kriteria'] = $this->kriteriaModel
            ->orderBy('idKriteria', 'ASC')
            ->findAll();

        return view('rekomendasi', $data);
    }

    public function proses()
    {
        $nama = trim($this->request->getPost('nama'));
        $nim = trim($this->request->getPost('nim'));
        if (!is_numeric($nim)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'NIM harus berupa angka.'
            ]);
        }
        $kriteria = $this->request->getPost('kriteria');

        // Validasi input
        if (empty($nama) || empty($nim)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Nama dan NIM wajib diisi.'
            ]);
        }

        if (!$kriteria || count($kriteria) < 3 || count($kriteria) > 5) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pilih 3 sampai 5 kriteria.'
            ]);
        }

        // Urutkan agar cocok dengan rule di database
        sort($kriteria);
        $kriteriaString = implode(',', $kriteria);
        $rule = $this->ruleModel
            ->where('kriteriaTerpilih', $kriteriaString)
            ->first();

        if (!$rule) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Sistem tidak menemukan rekomendasi yang sesuai.',
                'kriteria' => $kriteriaString
            ]);
        }

        // Ambil UKM utama
        $ukmUtama = $this->ukmModel->find($rule['idUkm']);

        if (!$ukmUtama) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data UKM utama tidak ditemukan.'
            ]);
        }

        // Ambil UKM opsi jika ada
        $ukmOpsi = null;

        if (!empty($rule['opsi'])) {
            $ukmOpsi = $this->ukmModel->find($rule['opsi']);
        }

        // Simpan rekomendasi ke riwayat
        $rekomendasi = $ukmUtama['nama'];

        if ($ukmOpsi) {
            $rekomendasi .= ', ' . $ukmOpsi['nama'];
        }

        if (!$this->riwayatModel->insert([
            'nim' => $nim,
            'nama' => $nama,
            'kriteriaTerpilih' => $kriteriaString,
            'rekomendasi' => $rekomendasi,
            'tanggal' => date('Y-m-d H:i:s')
        ])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan riwayat.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'ukmUtama' => [
                'nama' => $ukmUtama['nama'],
                'deskripsi' => $ukmUtama['deskripsi']
            ],
            'ukmOpsi' => $ukmOpsi ? [
                'nama' => $ukmOpsi['nama'],
                'deskripsi' => $ukmOpsi['deskripsi']
            ] : null,
            'alasan' => $rule['alasan'],
            'alasanOpsi' => $rule['alasanOpsi']
        ]);
    }
}
