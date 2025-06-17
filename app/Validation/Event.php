<?php

namespace App\Validation;

class Event
{
    public function ruleStore()
    {
        return [
            'event_name' => [
                'rules' => 'required|min_length[10]|is_unique[tbl_event.name]',
                'errors' => [
                    'required' => 'Field nama event wajib diisi',
                    'min_length' => 'Field nama event minimal 10 karakter',
                    'is_unique' => 'Nama event sudah digunakan'
                ]
            ],
            'kategori_umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field kategori umur wajib dipilih',
                ]
            ],
            'gaya_renang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field gaya renang wajib dipilih',
                ]
            ],
            'jarak_renang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field jarak renang wajib dipilih',
                ]
            ],
            'jumlah_peserta' => [
                'rules' => 'required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required'    => 'Field jumlah peserta wajib diisi',
                    'regex_match' => 'Field jumlah peserta harus berupa angka',
                ]
            ],
            'tanggal_event' => [
                'rules' => 'required|valid_date[m/d/Y h:i A]',
                'errors' => [
                    'required' => 'Field tanggal event wajib diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Field deskripsi wajib diisi',
                    'min_length' => 'Field deskripsi minimal 10 karakter',
                ]
            ],
        ];
    }

    public function ruleUpdate($id)
    {
        return [
            'event_name' => [
                'rules' => 'required|min_length[10]|is_unique[tbl_event.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Field nama event wajib diisi',
                    'min_length' => 'Field nama event minimal 10 karakter',
                    'is_unique' => 'Nama event sudah digunakan'
                ]
            ],
            'kategori_umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field kategori umur wajib dipilih',
                ]
            ],
            'gaya_renang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field gaya renang wajib dipilih',
                ]
            ],
            'jarak_renang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field jarak renang wajib dipilih',
                ]
            ],
            'jumlah_peserta' => [
                'rules' => 'required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required'    => 'Field jumlah peserta wajib diisi',
                    'regex_match' => 'Field jumlah peserta harus berupa angka',
                ]
            ],
            'tanggal_event' => [
                'rules' => 'required|valid_date[m/d/Y h:i A]',
                'errors' => [
                    'required' => 'Field tanggal event wajib diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Field deskripsi wajib diisi',
                    'min_length' => 'Field deskripsi minimal 10 karakter',
                ]
            ],
        ];
    }
}
