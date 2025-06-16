<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 2,
                'name' => 'Admin',
            ],
            [
                'id' => 3,
                'name' => 'Panitia',
            ],
        ];

        $this->db->table('tbl_role')->insertBatch($data);
    }
}
