<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kemampuan extends Migration
{
    public function up()
    {
        //
        
        $this->forge->addField(array(
            'id_kemampuan' => array(
                    'type' => 'INT',
                    'constraint' => 255,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'kategori_kemampuan' => array(
                    'constraint' => 255,
                    'type' => 'VARCHAR',
            ),
            'sub_kategori_kemampuan' => array(
                    'constraint' => 255,
                    'type' => 'VARCHAR',
            ),
            'id_mahasiswa' => array(
                'type' => 'INT',
                'constraint' => 255,
            ),
        ));
        
        $this->forge->addKey('id_kemampuan', TRUE);
        $this->forge->createTable('kemampuan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('kemampuan');
    }
}
