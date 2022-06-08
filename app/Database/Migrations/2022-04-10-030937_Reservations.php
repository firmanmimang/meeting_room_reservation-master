<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservations extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'room_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'time_start' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'time_end' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'booked'],
                'default'        => 'pending',
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
        $this->forge->createTable('reservations');  //
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}
