<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            'id_mahasiswa' => array(
                    'type' => 'INT',
                    'constraint' => 255,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'tempat_lahir' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'tanggal_lahir' => array(
                    'type' => 'DATE',
            ),
            'agama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'jenis_kelamin' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'alamat' => array(
                    'type' => 'TEXT',
            ),
            'no_hp' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
        ));
        $this->forge->addKey('id_mahasiswa', TRUE);
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
