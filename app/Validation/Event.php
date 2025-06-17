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
            ]
        ];
    }
}
