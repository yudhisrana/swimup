<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GayaRenangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'         => 1,
                'name'       => 'Bebas',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'         => 2,
                'name'       => 'Dada',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'         => 3,
                'name'       => 'Kupu - Kupu',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'         => 4,
                'name'       => 'Punggung',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('tbl_gaya_renang')->insertBatch($data);
    }
}
