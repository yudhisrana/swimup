<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendaftaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'event_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'nama_peserta' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'tanggal_lahir' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'address' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pending', 'Disetujui', 'Ditolak'],
                'null'       => false,
                'default'    => 'Pending',
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
        $this->forge->addUniqueKey('email');
        $this->forge->addForeignKey('event_id', 'tbl_event', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_pendaftaran');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_pendaftaran');
    }
}
