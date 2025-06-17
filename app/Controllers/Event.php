<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Event as ServicesEvent;
use CodeIgniter\HTTP\ResponseInterface;

class Event extends BaseController
{
    protected $eventService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->eventService = new ServicesEvent();
        // $this->ruleValidation = new ValidationUser();
    }

    public function index()
    {
        $dataEvent = $this->eventService->getData();
        $event = $dataEvent['success'] ? $dataEvent['data'] : [];
        $data = [
            'page'          => 'event',
            'title'         => 'SwimUp - Event',
            'table_name'    => 'Data Event',
            'event'          => $event,
        ];
        return view('event/index', $data);
    }

    // public function create()
    // {
    //     $data = [
    //         'page'        => 'user',
    //         'title'       => 'SwimUp - User',
    //         'form_name'   => 'Form tambah data User'
    //     ];
    //     return view('user/create', $data);
    // }

    // public function store()
    // {
    //     $rules = $this->ruleValidation->ruleStore();
    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
    //     }

    //     $imageName = 'default-profile.png';
    //     $dataImage = $this->request->getFile('image');
    //     if (!empty($dataImage) && $dataImage->isValid()) {
    //         $imageName = $dataImage->getRandomName();
    //         $dataImage->move(FCPATH . 'assets/img/user/', $imageName);
    //     }

    //     $data = [
    //         'name'     => $this->request->getPost('name'),
    //         'role'     => $this->request->getPost('role'),
    //         'username' => $this->request->getPost('username'),
    //         'password' => $this->request->getPost('password'),
    //         'email'    => $this->request->getPost('email'),
    //         'phone'    => $this->request->getPost('phone'),
    //         'address'  => $this->request->getPost('address'),
    //         'image'    => $imageName,
    //     ];

    //     $result = $this->userService->createData($data);
    //     if (!$result['success']) {
    //         return redirect()->back()->withInput()->with('error', $result['message']);
    //     }

    //     return redirect()->to('/setting/user')->with('success', $result['message']);
    // }

    // public function edit($id)
    // {
    //     $result = $this->userService->getById($id);
    //     if (!$result['success']) {
    //         return redirect()->to('/setting/user')->with('error', $result['message']);
    //     }
    //     $data = [
    //         'page'      => 'user',
    //         'title'     => 'SwimUp - User',
    //         'form_name' => 'Form tambah data User',
    //         'user'      => $result['data'],
    //     ];
    //     return view('user/edit', $data);
    // }

    // public function update($id)
    // {
    //     $rules = $this->ruleValidation->ruleUpdate($id);
    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
    //     }

    //     $imageName = 'default-profile.png';
    //     $dataImage = $this->request->getFile('image');
    //     if (!empty($dataImage) && $dataImage->isValid()) {
    //         $imageName = $dataImage->getRandomName();
    //         $dataImage->move(FCPATH . 'assets/img/user/', $imageName);
    //     }

    //     $data = [
    //         'name'     => $this->request->getPost('name'),
    //         'role'     => $this->request->getPost('role'),
    //         'username' => $this->request->getPost('username'),
    //         'password' => $this->request->getPost('password'),
    //         'email'    => $this->request->getPost('email'),
    //         'phone'    => $this->request->getPost('phone'),
    //         'address'  => $this->request->getPost('address'),
    //         'old_img'  => $this->request->getPost('old-img'),
    //         'image'    => $imageName,
    //     ];

    //     $result = $this->userService->updateData($id, $data);
    //     if (!$result['success']) {
    //         return redirect()->back()->withInput()->with('error', $result['message']);
    //     }

    //     return redirect()->to('/setting/user')->with('success', $result['message']);
    // }

    // public function destroy($id)
    // {
    //     $result = $this->userService->deleteData($id);
    //     if (!$result['success']) {
    //         return $this->response
    //             ->setStatusCode($result['code'])
    //             ->setJSON($result);
    //     }

    //     return $this->response
    //         ->setStatusCode($result['code'])
    //         ->setJSON($result);
    // }
}
