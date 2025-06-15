<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\KategoriUmur as ServicesKategoriUmur;
use App\Validation\KategoriUmur as ValidationKategoriUmur;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class KategoriUmur extends BaseController
{
    protected $kategoriUmurService;
    protected $ruleValidation;
    protected $validation;
    public function __construct()
    {
        $this->kategoriUmurService = new ServicesKategoriUmur;
        $this->ruleValidation = new ValidationKategoriUmur;
        $this->validation = Services::validation();
    }

    public function index()
    {
        $dataKategoriUmur = $this->kategoriUmurService->getData();
        $kategoriUmur = $dataKategoriUmur['success'] ? $dataKategoriUmur['data'] : [];
        $data = [
            'page'          => 'kategori-umur',
            'title'         => 'SwimUp - KategoriUmur',
            'table_name'    => 'Data Kategori Umur',
            'kategori_umur' => $kategoriUmur,
        ];
        return view('kategori-umur', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'errors'  => $this->validation->getErrors()
                ]);
        }

        $data = [
            'name' => $this->request->getPost('kategori_umur'),
        ];

        $result = $this->kategoriUmurService->creteData($data);
        if (!$result['success']) {
            return $this->response
                ->setStatusCode($result['code'])
                ->setJSON($result);
        }

        return $this->response
            ->setStatusCode($result['code'])
            ->setJSON($result);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'errors'  => $this->validation->getErrors()
                ]);
        }

        $data = [
            'name' => $this->request->getPost('kategori_umur'),
        ];

        $result = $this->kategoriUmurService->updateData($id, $data);
        if (!$result['success']) {
            return $this->response
                ->setStatusCode($result['code'])
                ->setJSON($result);
        }

        return $this->response
            ->setStatusCode($result['code'])
            ->setJSON($result);
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
