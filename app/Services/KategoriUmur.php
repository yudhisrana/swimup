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

    public function getById($id)
    {
        try {
            $data = $this->kategoriUmurModel->where('id', $id)->first();
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

    public function creteData($data)
    {
        $newData = [
            'name' => ucwords(strtolower($data['name'])),
        ];

        try {
            if (!$this->kategoriUmurModel->insert($newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan data kategori umur'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil menyimpan data kategori umur'
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
        $existing = $this->kategoriUmurModel->where('id', $id)->first();
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
            if (!$this->kategoriUmurModel->update($id, $newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal update data kategori umur',
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil update data kategori umur',
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
        $existing = $this->kategoriUmurModel->where('id', $id);
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->kategoriUmurModel->delete($id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data kategori umur'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil hapus data kategori umur'
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
