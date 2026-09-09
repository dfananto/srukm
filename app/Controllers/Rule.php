<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RuleModel;
use App\Models\KriteriaModel;
use App\Models\UkmModel;

class Rule extends BaseController
{
    protected $ruleModel;
    protected $kriteriaModel;
    protected $ukmModel;

    public function __construct()
    {
        $this->ruleModel = new RuleModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->ukmModel = new UkmModel();
    }

   public function index()
{
    $data['rule'] = $this->ruleModel
        ->select('
            rule.*,
            ukm.nama as namaUkm,
            opsi.nama as namaOpsi
        ')
        ->join('tb_ukm ukm', 'ukm.idUkm = rule.idUkm')
        ->join('tb_ukm opsi', 'opsi.idUkm = rule.opsi', 'left')
        ->findAll();

    return view('rule', $data);
}

    public function getKriteria()
    {
        return $this->response->setJSON(
            $this->kriteriaModel->findAll()
        );
    }

    public function getUkm()
    {
        return $this->response->setJSON(
            $this->ukmModel->findAll()
        );
    }

    public function store()
    {
        $idRule = $this->request->getPost('idRule');
        $idUkm = $this->request->getPost('idUkm');
        $opsi = $this->request->getPost('opsi');
        $alasan = $this->request->getPost('alasan');
        $alasanOpsi = $this->request->getPost('alasanOpsi');

        $kriteriaTerpilih = explode(
            ',',
            $this->request->getPost('kriteriaTerpilih')
        );

        $kriteriaTerpilih = array_map('trim', $kriteriaTerpilih);
        $kriteriaTerpilih = array_unique($kriteriaTerpilih);

        sort($kriteriaTerpilih);

        if (count($kriteriaTerpilih) < 3 || count($kriteriaTerpilih) > 5) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pilih 3 sampai 5 kriteria.'
            ]);
        }

        $kriteriaString = implode(',', $kriteriaTerpilih);

        if (!str_starts_with($idRule, 'R')) {
            $idRule = 'R' . $idRule;
        }

        // cek id rule
        if ($this->ruleModel->find($idRule)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID Rule sudah digunakan.'
            ]);
        }

        // cek kombinasi kriteria
        $rules = $this->ruleModel->findAll();

        foreach ($rules as $rule) {

            $db = explode(',', $rule['kriteriaTerpilih']);

            sort($db);

            if (implode(',', $db) == $kriteriaString) {

                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Kombinasi kriteria sudah ada.'
                ]);
            }
        }
        $this->ruleModel->insert([
            'idRule' => $idRule,
            'kriteriaTerpilih' => $kriteriaString,
            'idUkm' => $idUkm,
            'alasan' => $alasan,
            'opsi' => $opsi ?: null,
            'alasanOpsi' => $alasanOpsi
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Rule berhasil ditambahkan.'
        ]);
    }

        public function delete($id)
    {
        $data = $this->ruleModel->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data rule tidak ditemukan.');
        }

        $this->ruleModel->delete($id);

        return redirect()->back()
            ->with('success', 'Rule berhasil dihapus.');
    }
}
