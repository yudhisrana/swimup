<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Event as ServicesEvent;
use App\Validation\Event as ValidationEvent;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class Event extends BaseController
{
    protected $eventService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->eventService = new ServicesEvent();
        $this->ruleValidation = new ValidationEvent();
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

    public function show($id)
    {
        $result = $this->eventService->getById($id);
        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        $dataEvent = $result['data'];
        $creator = $this->eventService->getUserById($dataEvent->created_by);

        if (!empty($dataEvent->updated_by)) {
            $editor = $this->eventService->getUserById($dataEvent->updated_by);
        } else {
            $editor = [
                'data' => (object)[
                    'name' => ''
                ]
            ];
        }

        $data = [
            'page'          => 'event',
            'title'         => 'SwimUp - Event',
            'card_name'     => 'Data Event',
            'event'         => $result['data'],
            'creator'       => $creator['data'],
            'editor'        => $editor['data']
        ];
        return view('event/view', $data);
    }

    public function create()
    {
        $dataKategoriUmur = $this->eventService->getDataKategoriUmur();
        $kategoriUmur = $dataKategoriUmur['success'] ? $dataKategoriUmur['data'] : [];

        $dataGayaRenang = $this->eventService->getDataGayaRenang();
        $gayaRenang = $dataGayaRenang['success'] ? $dataGayaRenang['data'] : [];

        $dataJarakRenang = $this->eventService->getDataJarakRenang();
        $jarakRenang = $dataJarakRenang['success'] ? $dataJarakRenang['data'] : [];

        $data = [
            'page'          => 'event',
            'title'         => 'SwimUp - Event',
            'form_name'     => 'Form tambah data event',
            'kategori_umur' => $kategoriUmur,
            'gaya_renang'   => $gayaRenang,
            'jarak_renang'  => $jarakRenang,
        ];
        return view('event/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $date = DateTime::createFromFormat('m/d/Y h:i A', $this->request->getPost('tanggal_event'));
        $evenDate = $date ? $date->format('Y-m-d H:i:s') : null;

        $data = [
            'event_name'     => $this->request->getPost('event_name'),
            'kategori_umur'  => $this->request->getPost('kategori_umur'),
            'gaya_renang'    => $this->request->getPost('gaya_renang'),
            'jarak_renang'   => $this->request->getPost('jarak_renang'),
            'jumlah_peserta' => $this->request->getPost('jumlah_peserta'),
            'tanggal_event'  => $evenDate,
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ];

        $result = $this->eventService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/menu/event')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->eventService->getById($id);
        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        $dataKategoriUmur = $this->eventService->getDataKategoriUmur();
        $kategoriUmur = $dataKategoriUmur['success'] ? $dataKategoriUmur['data'] : [];

        $dataGayaRenang = $this->eventService->getDataGayaRenang();
        $gayaRenang = $dataGayaRenang['success'] ? $dataGayaRenang['data'] : [];

        $dataJarakRenang = $this->eventService->getDataJarakRenang();
        $jarakRenang = $dataJarakRenang['success'] ? $dataJarakRenang['data'] : [];

        $data = [
            'page'          => 'event',
            'title'         => 'SwimUp - Event',
            'form_name'     => 'Form edit data event',
            'event'         => $result['data'],
            'kategori_umur' => $kategoriUmur,
            'gaya_renang'   => $gayaRenang,
            'jarak_renang'  => $jarakRenang,
        ];
        return view('event/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'event_name'     => $this->request->getPost('event_name'),
            'kategori_umur'  => $this->request->getPost('kategori_umur'),
            'gaya_renang'    => $this->request->getPost('gaya_renang'),
            'jarak_renang'   => $this->request->getPost('jarak_renang'),
            'jumlah_peserta' => $this->request->getPost('jumlah_peserta'),
            'tanggal_event'  => $this->request->getPost('tanggal_event'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'status'         => $this->request->getPost('status'),
        ];

        $result = $this->eventService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/menu/event/show/' . $id)->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->eventService->deleteData($id);
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
