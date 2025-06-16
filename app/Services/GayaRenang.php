<?php

namespace App\Services;

use App\Models\GayaRenang as ModelsGayaRenang;

class GayaRenang
{
    protected $gayaRenangModel;
    public function __construct()
    {
        $this->gayaRenangModel = new ModelsGayaRenang();
    }

    public function getData()
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

    public function getById($id)
    {
        try {
            $data = $this->gayaRenangModel->where('id', $id)->first();
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
            if (!$this->gayaRenangModel->insert($newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan data gaya renang'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil menyimpan data gaya renang'
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
        $existing = $this->gayaRenangModel->where('id', $id)->first();
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
            if (!$this->gayaRenangModel->update($id, $newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal update data gaya renang'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil update data gaya renang'
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
        $existing = $this->gayaRenangModel->where('id', $id);
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->gayaRenangModel->delete($id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data gaya renang'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil hapus data gaya renang'
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
