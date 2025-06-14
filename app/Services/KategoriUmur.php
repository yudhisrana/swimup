<?php

namespace App\Services;

use App\Models\KategoriUmur as ModelsKategoriUmur;

class KategoriUmur
{
    protected $kategoriUmurModel;
    public function __construct()
    {
        $this->kategoriUmurModel = new ModelsKategoriUmur();
    }

    public function getData()
    {
        try {
            $data = $this->kategoriUmurModel->findAllData();
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

    public function creteData($data)
    {
        $newData = [
            'name' => ucwords(strtolower($data['name'])),
        ];

        try {
            if (!$this->kategoriUmurModel->saveData($newData)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal menyimpan data kategori umur'
                ];
            }

            return [
                'success' => true,
                'code'    => 201,
                'message' => 'Berhasil menyimpan data kategori umur'
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'code'    => 500,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }

    public function updateData($id, $data)
    {
        $existing = $this->kategoriUmurModel->findById($id);
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $newData = [
            'name' => ucwords(strtolower($data['name'])),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        try {
            if (!$this->kategoriUmurModel->updateData($id, $newData)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal update data gaya renang'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil update data gaya renang'
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'code'    => 500,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }

    public function deleteData($id)
    {
        $existing = $this->kategoriUmurModel->findById($id);
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->kategoriUmurModel->deleteData($id)) {
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
