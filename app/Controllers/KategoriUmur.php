<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\KategoriUmur as ServicesKategoriUmur;
use App\Validation\KategoriUmur as ValidationKategoriUmur;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriUmur extends BaseController
{
    protected $kategoriUmurService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->kategoriUmurService = new ServicesKategoriUmur();
        $this->ruleValidation = new ValidationKategoriUmur();
    }

    public function index()
    {
        $dataKategoriUmur = $this->kategoriUmurService->getData();
        $kategoriUmur = $dataKategoriUmur['success'] ? $dataKategoriUmur['data'] : [];
        $data = [
            'page'          => 'kategori-umur',
            'title'         => 'SwimUp - Kategori Umur',
            'table_name'    => 'Data Kategori Umur',
            'kategori_umur' => $kategoriUmur,
        ];
        return view('kategori-umur/index', $data);
    }

    public function create()
    {
        $data = [
            'page'        => 'kategori-umur',
            'title'       => 'SwimUp - Kategori Umur',
            'form_name'   => 'Form tambah data kategori umur'
        ];
        return view('kategori-umur/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name' => $this->request->getPost('kategori_umur'),
        ];

        $result = $this->kategoriUmurService->creteData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/kategori-umur')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->kategoriUmurService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/master-data/kategori-umur')->with('error', $result['message']);
        }
        $data = [
            'page'          => 'kategori-umur',
            'title'         => 'SwimUp - Kategori Umur',
            'form_name'     => 'Form tambah data kategori umur',
            'kategori_umur' => $result['data'],
        ];
        return view('kategori-umur/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'name' => $this->request->getPost('kategori_umur'),
        ];

        $result = $this->kategoriUmurService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/kategori-umur')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->kategoriUmurService->deleteData($id);
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
