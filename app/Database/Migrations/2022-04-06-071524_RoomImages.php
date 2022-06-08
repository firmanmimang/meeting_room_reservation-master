<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomImages extends Migration
{
    public function up()
    {
        $fields = [
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'room_id'   => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'image_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ];
        $this->forge->addField($fields);
        //primary key
        $this->forge->addKey('id', TRUE);
        //nama tabel
        $this->forge->createTable('room_images');
    }

    public function down()
    {
        $this->forge->dropTable('room_images');
    }
}
