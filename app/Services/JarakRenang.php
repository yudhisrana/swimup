<?php

namespace App\Services;

use App\Models\JarakRenang as ModelsJarakRenang;

class JarakRenang
{
    protected $jarakRenangModel;
    public function __construct()
    {
        $this->jarakRenangModel = new ModelsJarakRenang();
    }

    public function getData()
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
            $data = $this->jarakRenangModel->where('id', $id)->first();
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
        $newData = [
            'name' => ucwords(strtolower($data['name'])),
        ];

        try {
            if (!$this->jarakRenangModel->insert($newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan data jarak renang'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil menyimpan data jarak renang'
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
        $existing = $this->jarakRenangModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $newData = [
            'name' => ucwords(strtolower($data['name'])),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        try {
            if (!$this->jarakRenangModel->update($id, $newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal update data jarak renang'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil update data jarak renang'
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
        $existing = $this->jarakRenangModel->where('id', $id);
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->jarakRenangModel->delete($id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data jarak renang'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil hapus data jarak renang'
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'code'    => 500,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }
}
