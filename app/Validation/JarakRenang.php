<?php

namespace App\Validation;

class JarakRenang
{
    public function ruleStore()
    {
        return [
            'jarak_renang' => [
                'rules' => 'required|min_length[3]|is_unique[tbl_jarak_renang.name]',
                'errors' => [
                    'required' => 'Field jarak renang wajib tidak boleh kosong',
                    'min_length' => 'Field jarak renang minimal 3 karakter',
                    'is_unique' => 'Jarak renang sudah digunakan'
                ]
            ]
        ];
    }

    public function ruleUpdate($id)
    {
        return [
            'jarak_renang' => [
                'rules' => 'required|min_length[3]|is_unique[tbl_jarak_renang.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Field jarak renang wajib tidak boleh kosong',
                    'min_length' => 'Field jarak renang minimal 3 karakter',
                    'is_unique' => 'Jarak renang sudah digunakan'
                ]
            ]
        ];
    }
}
