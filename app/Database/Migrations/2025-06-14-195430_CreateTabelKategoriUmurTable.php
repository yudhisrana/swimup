<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelKategoriUmurTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('tbl_kategori_umur');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kategori_umur');
    }
}
