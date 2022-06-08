<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pendidikan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField(array(
            'id_pendidikan' => array(
                    'type' => 'INT',
                    'constraint' => 255,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'tipe_pendidikan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'nama_pendidikan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'tempat_pendidikan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'waktu_pendidikan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
            ),
            'id_mahasiswa' => array(
                'type' => 'INT',
                'constraint' => 255,
            ),
        ));
        
        $this->forge->addKey('id_pendidikan', TRUE);
        $this->forge->createTable('pendidikan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('pendidikan');

    }
}
