<?php

namespace App\Services;

use App\Helpers\GenerateSlug;
use App\Models\Event as ModelsEvent;
use App\Models\GayaRenang;
use App\Models\JarakRenang;
use App\Models\KategoriUmur;
use App\Models\User;
use DateTime;
use Ramsey\Uuid\Uuid;

class Event
{
    protected $userModel;
    protected $eventModel;
    protected $kategoriUmurModel;
    protected $gayaRenangModel;
    protected $jarakRenangModel;
    protected $slug;
    public function __construct()
    {
        $this->userModel = new User();
        $this->eventModel = new ModelsEvent();
        $this->kategoriUmurModel = new KategoriUmur();
        $this->gayaRenangModel = new GayaRenang();
        $this->jarakRenangModel = new JarakRenang();
        $this->slug = new GenerateSlug();
    }

    public function getData()
    {
        try {
            $data = $this->eventModel->findAllDataWithRelation();
            if (empty($data)) {
                return [
                    'success' => true,
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'data'    => [],
            ];
        }
    }

    public function getUserById($id)
    {
        try {
            $data = $this->userModel->where('id', $id)->first();
            if (!$data) {
                return [
                    'success' => false,
                    'message' => 'Data tidak ditemukan',
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'message' => 'Data ditemukan',
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
                'data'    => [],
            ];
        }
    }

    public function getDataKategoriUmur()
    {
        try {
            $data = $this->kategoriUmurModel->findAll();
            if (empty($data)) {
                return [
                    'success' => true,
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'data'    => [],
            ];
        }
    }

    public function getDataGayaRenang()
    {
        try {
            $data = $this->gayaRenangModel->findAll();
            if (empty($data)) {
                return [
                    'success' => true,
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'data'    => [],
            ];
        }
    }

    public function getDataJarakRenang()
    {
        try {
            $data = $this->jarakRenangModel->findAll();
            if (empty($data)) {
                return [
                    'success' => true,
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'data'    => [],
            ];
        }
    }

    public function getById($id)
    {
        try {
            $data = $this->eventModel->findDataWithRelationById($id);
            if (!$data) {
                return [
                    'success' => false,
                    'message' => 'Data tidak ditemukan',
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'message' => 'Data ditemukan',
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
                'data'    => [],
            ];
        }
    }

    public function createData($data)
    {
        $id = Uuid::uuid4()->toString();
        $slug = $this->slug->generateSlug($data['event_name']);

        $newData = [
            'id'               => $id,
            'name'             => ucwords(strtolower($data['event_name'])),
            'slug'             => $slug,
            'kategori_umur_id' => $data['kategori_umur'],
            'gaya_renang_id'   => $data['gaya_renang'],
            'jarak_renang_id'  => $data['jarak_renang'],
            'max_participant'  => $data['jumlah_peserta'],
            'event_date'       => $data['tanggal_event'],
            'description'      => $data['deskripsi'],
            'status'           => 'Berjalan',
            'created_by'       => session()->get('user_id'),
        ];

        try {
            if (!$this->eventModel->insert($newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan data event'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil menyimpan data event'
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }

    public function updateData($id, $data)
    {
        $existing = $this->eventModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $newData = [
            'name'             => ucwords(strtolower($data['event_name'])),
            'kategori_umur_id' => $data['kategori_umur'],
            'gaya_renang_id'   => $data['gaya_renang'],
            'jarak_renang_id'  => $data['jarak_renang'],
            'max_participant'  => $data['jumlah_peserta'],
            'description'      => $data['deskripsi'],
            'status'           => $data['status'],
            'updated_by'       => session()->get('user_id'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if ($existing->name != $data['event_name']) {
            $slug = $this->slug->generateSlug($data['event_name']);
            $newData['slug'] = $slug;
        } else {
            unset($newData['slug']);
        }

        $date = DateTime::createFromFormat('m/d/Y h:i A', $data['tanggal_event']);
        $evenDate = $date ? $date->format('Y-m-d H:i:s') : null;
        if ($evenDate != $existing->event_date) {
            $newData['event_date'] = $evenDate;
        } else {
            unset($newData['event_date']);
        }

        try {
            if (!$this->eventModel->update($id, $newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal update data user',
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil update data user',
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }

    public function deleteData($id)
    {
        $existing = $this->eventModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->eventModel->delete($id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data event'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil hapus data event'
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'code'    => 500,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }
}
