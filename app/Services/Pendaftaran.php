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

    public function getData()
    {
        try {
            $data = $this->pendaftaranModel->findAllDataWithRelation();
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
            $data = $this->pendaftaranModel->findDataWithRelationById($id);
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

    public function updateData($id, $data)
    {
        $existing = $this->pendaftaranModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $newData = [
            'status'     => $data['status'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        unset($newData['event_id']);
        unset($newData['nama_peserta']);
        unset($newData['tanggal_lahir']);
        unset($newData['gender']);
        unset($newData['email']);
        unset($newData['phone']);
        unset($newData['address']);
        unset($newData['image']);

        try {
            if (!$this->pendaftaranModel->update($id, $data)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal update data peserta'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil update data peserta'
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

    public function deleteData($id)
    {
        $existing = $this->pendaftaranModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->pendaftaranModel->delete($id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data peserta'
                ];
            }

            if (!empty($existing->image)) {
                $imgPath = FCPATH . 'assets/img/registration/' . $existing->image;
                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil hapus data peserta'
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
