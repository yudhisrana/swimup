<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\GayaRenang as ServicesGayaRenang;
use App\Validation\GayaRenang as ValidationGayaRenang;
use Config\Services;

class GayaRenang extends BaseController
{
    protected $gayaRenangService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->gayaRenangService = new ServicesGayaRenang;
        $this->ruleValidation = new ValidationGayaRenang;
    }

    public function index()
    {
        $dataGayaRenang = $this->gayaRenangService->getData();
        $gayaRenang = $dataGayaRenang['success'] ? $dataGayaRenang['data'] : [];
        $data = [
            'page'        => 'gaya-renang',
            'title'       => 'SwimUp - Gaya Renang',
            'table_name'  => 'Data Gaya Renang',
            'gaya_renang' => $gayaRenang,
        ];
        return view('gaya-renang/index', $data);
    }

    public function create()
    {
        $data = [
            'page'        => 'gaya-renang',
            'title'       => 'SwimUp - Gaya Renang',
            'form_name'   => 'Form tambah data gaya renang'
        ];
        return view('gaya-renang/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name' => $this->request->getPost('gaya_renang'),
        ];

        $result = $this->gayaRenangService->creteData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/gaya-renang')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->gayaRenangService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/master-data/gaya-renang')->with('error', $result['message']);
        }
        $data = [
            'page'        => 'gaya-renang',
            'title'       => 'SwimUp - Gaya Renang',
            'form_name'   => 'Form edit data gaya renang',
            'gaya_renang' => $result['data'],
        ];
        return view('gaya-renang/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name' => $this->request->getPost('gaya_renang'),
        ];

        $result = $this->gayaRenangService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/gaya-renang')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->gayaRenangService->deleteData($id);
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
