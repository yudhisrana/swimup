<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Pendaftaran;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $eventModel;
    protected $pendaftaranModel;
    public function __construct()
    {
        $this->eventModel = new Event();
        $this->pendaftaranModel = new Pendaftaran();
    }

    public function index()
    {
        $countEventProgress = $this->eventModel->countEventProgress();
        $countEventDone = $this->eventModel->countEventDone();
        $countEventRejected = $this->eventModel->countEventRejected();
        $countAllRegister = $this->pendaftaranModel->countAllRegister();

        $data = [
            'page'               => 'dashboard',
            'title'              => 'Dashboard',
            'countEventProgress' => $countEventProgress,
            'countEventDone'     => $countEventDone,
            'countEventRejected' => $countEventRejected,
            'countAllRegister'   => $countAllRegister,
        ];
        return view('dashboard', $data);
    }
}
