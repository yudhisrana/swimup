<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\GayaRenang as ServicesGayaRenang;
use App\Validation\GayaRenang as ValidationGayaRenang;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class GayaRenang extends BaseController
{
    protected $gayaRenangService;
    protected $ruleValidation;
    protected $validation;
    public function __construct()
    {
        $this->gayaRenangService = new ServicesGayaRenang;
        $this->ruleValidation = new ValidationGayaRenang;
        $this->validation = Services::validation();
    }

    public function index()
    {
        $dataGayaRenang = $this->gayaRenangService->getData();
        $gayaRenang = $dataGayaRenang['success'] ? $dataGayaRenang['data'] : [];
        $data = [
            'title'       => 'SwimUp - Gaya Renang',
            'table_name'  => 'Data Gaya Renang',
            'gaya_renang' => $gayaRenang,
        ];
        return view('gaya-renang', $data);
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
            'name' => $this->request->getPost('gaya_renang'),
        ];

        $result = $this->gayaRenangService->creteData($data);
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
            'name' => $this->request->getPost('gaya_renang'),
        ];

        $result = $this->gayaRenangService->updateData($id, $data);
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
