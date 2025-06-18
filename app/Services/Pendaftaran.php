<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Pendaftaran as ModelsPendaftaran;
use Ramsey\Uuid\Uuid;

class Pendaftaran
{
    protected $pendaftaranModel;
    protected $eventModel;
    public function __construct()
    {
        $this->pendaftaranModel = new ModelsPendaftaran();
        $this->eventModel = new Event();
    }

    public function getBySlug($slug)
    {
        try {
            $data = $this->eventModel->where('slug', $slug)->first();
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

    public function approvedCount($evenId)
    {
        try {
            return $this->pendaftaranModel->countApprovedByEvent($evenId);
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return 0;
        }
    }

    public function createData($data)
    {
        $id = Uuid::uuid4()->toString();

        $newData = [
            'id'            => $id,
            'event_id'      => $data['event_id'],
            'nama_peserta'  => ucwords(strtolower($data['nama_peserta'])),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'gender'        => $data['jenis_kelamin'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'image'         => $data['image'],
            'address'       => $data['address'],
        ];

        try {
            if (!$this->pendaftaranModel->insert($newData)) {
                if (file_exists(FCPATH . 'assets/img/registration/' . $data['image'])) {
                    unlink(FCPATH . 'assets/img/registration/' . $data['image']);
                }
                return [
                    'success' => false,
                    'message' => 'Pendaftaran gagal silahkan coba lagi nnti'
                ];
            }

            return [
                'success' => true,
                'message' => 'Pendaftaran berhasil, terima kasih sudah mendaftar'
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }
}
