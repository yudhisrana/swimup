<?php

namespace App\Validation;

class GayaRenang
{
    public function ruleStore()
    {
        return [
            'gaya_renang' => [
                'rules' => 'required|min_length[4]|is_unique[tbl_gaya_renang.name]',
                'errors' => [
                    'required' => 'Field gaya renang wajib tidak boleh kosong',
                    'min_length' => 'Field gaya renang minimal 4 karakter',
                    'is_unique' => 'Nama gaya renang sudah digunakan'
                ]
            ]
        ];
    }

    public function ruleUpdate($id)
    {
        return [
            'gaya_renang' => [
                'rules' => 'required|min_length[4]|is_unique[tbl_gaya_renang.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Field gaya renang wajib tidak boleh kosong',
                    'min_length' => 'Field gaya renang minimal 4 karakter',
                    'is_unique' => 'Nama gaya renang sudah digunakan'
                ]
            ]
        ];
    }
}
