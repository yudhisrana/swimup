<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\JarakRenang as ServicesJarakRenang;
use App\Validation\JarakRenang as ValidationJarakRenang;
use CodeIgniter\HTTP\ResponseInterface;

class JarakRenang extends BaseController
{
    protected $jarakRenangService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->jarakRenangService = new ServicesJarakRenang();
        $this->ruleValidation = new ValidationJarakRenang();
    }

    public function index()
    {
        $dataKategoriUmur = $this->jarakRenangService->getData();
        $jarakRenang = $dataKategoriUmur['success'] ? $dataKategoriUmur['data'] : [];
        $data = [
            'page'         => 'jarak-renang',
            'title'        => 'SwimUp - Jarak Renang',
            'table_name'   => 'Data jarak renang',
            'jarak_renang' => $jarakRenang,
        ];
        return view('jarak-renang/index', $data);
    }

    public function create()
    {
        $data = [
            'page'        => 'jarak-renang',
            'title'       => 'SwimUp - Jarak Renang',
            'form_name'   => 'Form tambah data jarak renang'
        ];
        return view('jarak-renang/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name' => $this->request->getPost('jarak_renang'),
        ];

        $result = $this->jarakRenangService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/jarak-renang')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->jarakRenangService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/master-data/jarak-renang')->with('error', $result['message']);
        }
        $data = [
            'page'         => 'jarak-renang',
            'title'        => 'SwimUp - Jarak Renang',
            'form_name'    => 'Form edit data jarak renang',
            'jarak_renang' => $result['data'],
        ];
        return view('jarak-renang/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name' => $this->request->getPost('jarak_renang'),
        ];

        $result = $this->jarakRenangService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/jarak-renang')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->jarakRenangService->deleteData($id);
        if (!$result['success']) {
            return $this->response
                ->setStatusCode($result['code'])
                ->setJSON($result);
        }

        return $this->response
            ->setStatusCode($result['code'])
            ->setJSON($result);
    }
}
