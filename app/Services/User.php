<?php

namespace App\Services;

use App\Models\User as ModelsUser;
use Ramsey\Uuid\Uuid;

class User
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new ModelsUser();
    }

    public function getData()
    {
        try {
            $data = $this->userModel->findAllDataWithRelation();
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

    public function createData($data)
    {
        $id = Uuid::uuid4()->toString();
        $hasPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $newData = [
            'id'       => $id,
            'name'     => ucwords(strtolower($data['name'])),
            'username' => $data['username'],
            'password' => $hasPassword,
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'image'    => $data['image'],
            'role_id'  => $data['role'],
        ];

        try {
            if (!$this->userModel->insert($newData)) {
                if ($data['image'] !== 'default-profile.png' && file_exists(FCPATH . 'assets/img/user/' . $data['image'])) {
                    unlink(FCPATH . 'assets/img/user/' . $data['image']);
                }
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan data user'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil menyimpan data user'
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
        $existing = $this->userModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $newData = [
            'name'     => ucwords(strtolower($data['name'])),
            'username' => $data['username'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'image'    => $data['image'],
            'role_id'  => $data['role'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!empty($data['password'])) {
            $newData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($newData['password']);
        }

        try {
            if (!$this->userModel->update($id, $newData)) {
                if ($data['image'] !== 'default-profile.png' && file_exists(FCPATH . 'assets/img/user/' . $data['image'])) {
                    unlink(FCPATH . 'assets/img/user/' . $data['image']);
                }
                return [
                    'success' => false,
                    'message' => 'Gagal update data user',
                ];
            }

            if ($data['old_img'] !== 'default-profile.png') {
                unlink(FCPATH . 'assets/img/user/' . $data['old_img']);
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
        $existing = $this->userModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->userModel->delete($id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data kategori umur'
                ];
            }

            if ($existing->image !== 'default-profile.png' && file_exists(FCPATH . 'assets/img/user/' . $existing->image)) {
                unlink(FCPATH . 'assets/img/user/' . $existing->image);
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
