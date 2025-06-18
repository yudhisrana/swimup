<?php

namespace App\Validation;

class Pendaftaran
{
    public function ruleStore()
    {
        return [
            'nama_peserta' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Field nama peserta wajib diisi',
                    'min_length' => 'Field nama peserta minimal 3 karakter',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required|valid_date[d/m/Y]',
                'errors' => [
                    'required' => 'Field tanggal lahir wajib diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field jenis kelamin wajib dipilih',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => 'Field email wajib diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah digunakan',
                ]
            ],
            'phone' => [
                'rules' => 'required|regex_match[/^(\\+62|62|08)[0-9]{8,13}$/]',
                'errors' => [
                    'required' => 'Field no telepon wajib diisi',
                    'regex_match' => 'Format nomor telepon tidak valid',
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,1024]',
                'errors' => [
                    'uploaded' => 'Wajib mengupload foto',
                    'is_image' => 'File yang diunggah bukan gambar',
                    'mime_in' => 'Format gambar hanya boleh JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran gambar maksimal 1 MB'
                ]
            ],
            'address' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Field alamat wajib diisi',
                    'min_length' => 'Field alamat minimal 10 karakter',
                ]
            ],
        ];
    }

    public function ruleUpdate($id)
    {
        return [
            'nama_peserta' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Field nama peserta wajib diisi',
                    'min_length' => 'Field nama peserta minimal 3 karakter',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required|valid_date[d/m/Y]',
                'errors' => [
                    'required' => 'Field tanggal lahir wajib diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field jenis kelamin wajib dipilih',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.email,id,' . $id . ']',
                'errors' => [
                    'required' => 'Field email wajib diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah digunakan',
                ]
            ],
            'phone' => [
                'rules' => 'required|regex_match[/^(\\+62|62|08)[0-9]{8,13}$/]',
                'errors' => [
                    'required' => 'Field no telepon wajib diisi',
                    'regex_match' => 'Format nomor telepon tidak valid',
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,1024]',
                'errors' => [
                    'uploaded' => 'Wajib mengupload foto',
                    'is_image' => 'File yang diunggah bukan gambar',
                    'mime_in' => 'Format gambar hanya boleh JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran gambar maksimal 1 MB'
                ]
            ],
            'address' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Field alamat wajib diisi',
                    'min_length' => 'Field alamat minimal 10 karakter',
                ]
            ],
        ];
    }
}
