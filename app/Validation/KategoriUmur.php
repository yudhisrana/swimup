<?php

namespace App\Validation;

class KategoriUmur
{
    public function ruleStore()
    {
        return [
            'kategori_umur' => [
                'rules' => 'required|min_length[4]|is_unique[tbl_kategori_umur.name]',
                'errors' => [
                    'required' => 'Field kategori umur wajib tidak boleh kosong',
                    'min_length' => 'Field kategori umur minimal 4 karakter',
                    'is_unique' => 'Nama kategori umur sudah digunakan'
                ]
            ]
        ];
    }

    public function ruleUpdate($id)
    {
        return [
            'kategori_umur' => [
                'rules' => 'required|min_length[4]|is_unique[tbl_kategori_umur.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Field kategori umur wajib tidak boleh kosong',
                    'min_length' => 'Field kategori umur minimal 4 karakter',
                    'is_unique' => 'Nama kategori umur sudah digunakan'
                ]
            ]
        ];
    }
}
