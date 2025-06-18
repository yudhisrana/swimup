<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Pendaftaran as ServicesPendaftaran;
use App\Validation\Pendaftaran as ValidationPendaftaran;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class Pendaftaran extends BaseController
{
    protected $pendaftaranService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->pendaftaranService = new ServicesPendaftaran();
        $this->ruleValidation = new ValidationPendaftaran();
    }

    public function index()
    {
        //
    }

    public function showRegistrationPublic($slug)
    {
        $result = $this->pendaftaranService->getBySlug($slug);
        if (!$result['success']) {
            throw PageNotFoundException::forPageNotFound();
        }

        $dataEvent = $result['data'];
        $count = $this->pendaftaranService->approvedCount($dataEvent->id);

        $data = [
            'title'          => 'SwimUp - Event Pendaftaran',
            'event'          => $dataEvent,
            'approved_count' => $count,
            'join_event'     => $dataEvent->status == 'Berjalan' && $count < $dataEvent->max_participant,
        ];

        return view('pendaftaran/publik/event', $data);
    }

    public function storePublic($evenId)
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $date = DateTime::createFromFormat('d/m/Y', $this->request->getPost('tanggal_lahir'));
        $birthDay = $date ? $date->format('Y-m-d') : null;

        $dataImage = $this->request->getFile('image');
        if (!empty($dataImage) && $dataImage->isValid()) {
            $imageName = $dataImage->getRandomName();
            $dataImage->move(FCPATH . 'assets/img/registration/', $imageName);
        }

        $data = [
            'event_id'      => $evenId,
            'nama_peserta'  => $this->request->getPost('nama_peserta'),
            'tanggal_lahir' => $birthDay,
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'image'         => $imageName,
            'address'       => $this->request->getPost('address'),
        ];

        $result = $this->pendaftaranService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
