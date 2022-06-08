<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengalaman extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            'id_pengalaman' => array(
                    'type' => 'INT',
                    'constraint' => 255,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'pengalaman' => array(
                    'constraint' => 255,
                    'type' => 'VARCHAR',
            ),
            'id_mahasiswa' => array(
                'type' => 'INT',
                'constraint' => 255,
            ),
        ));
        $this->forge->addKey('id_pengalaman', TRUE);
        $this->forge->createTable('pengalaman');
    
    }

    public function down()
    {
        //
        $this->forge->dropTable('pengalaman');
    }
}
