<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RiwayatModel;
use App\Models\RuleModel;
use App\Models\UserModel;

class Riwayat extends BaseController
{
     protected $riwayatModel;

    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();
    }

    public function index()
    {
        $riwayatModel = new RiwayatModel();
        $ruleModel = new RuleModel();

        // Total diagnosis keseluruhan
        $totalDiagnosis = $riwayatModel->countAllResults();

        // Total diagnosis hari ini
        $diagnosisHariIni = $riwayatModel
            ->where('DATE(tanggal)', date('Y-m-d'))
            ->countAllResults();

        // Total rule
        $totalRule = $ruleModel->countAllResults();

        $data = [
            'totalDiagnosis'   => $totalDiagnosis,
            'diagnosisHariIni' => $diagnosisHariIni,
            'totalRule'        => $totalRule,
        ];

        return view('/dashboard', $data);
    }

     public function riwayat()
    {
        $data = [
            'title'   => 'Laporan',
            'riwayat' => $this->riwayatModel
                                ->orderBy('tanggal', 'DESC')
                                ->findAll()
        ];

        return view('laporan', $data);
    }

    public function delete($id)
    {
        $riwayat = $this->riwayatModel->find($id);

        if (!$riwayat) {
            return redirect()->to('/laporan')
                ->with('error', 'Data tidak ditemukan.');
        }

        $this->riwayatModel->delete($id);

        return redirect()->to('/laporan')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
