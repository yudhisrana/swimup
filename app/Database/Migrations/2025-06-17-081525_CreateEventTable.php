<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEventTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'kategori_umur_id' => [
                'type'       => 'int',
                'unsigned'   => true,
                'null'       => false,
            ],
            'gaya_renang_id' => [
                'type'       => 'int',
                'unsigned'   => true,
                'null'       => false,
            ],
            'jarak_renang_id' => [
                'type'       => 'int',
                'unsigned'   => true,
                'null'       => false,
            ],
            'max_participant' => [
                'type'       => 'int',
                'unsigned'   => true,
                'null'       => false,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'event_date' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'status' => [
                'type'       => 'BOOLEAN',
                'null'       => false,
                'default'    => true,
            ],
            'created_by' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'updated_by' => [
                'type'       => 'CHAR',
                'constraint' => 36,
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
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('kategori_umur_id', 'tbl_kategori_umur', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('gaya_renang_id', 'tbl_gaya_renang', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('jarak_renang_id', 'tbl_jarak_renang', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_event');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_event');
    }
}
