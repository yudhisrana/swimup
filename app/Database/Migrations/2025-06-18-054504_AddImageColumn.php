<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageColumn extends Migration
{
    public function up()
    {
        $image = [
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'after'      => 'address',
            ]
        ];

        $this->forge->addColumn('tbl_pendaftaran', $image);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_pendaftaran', 'image');
    }
}
