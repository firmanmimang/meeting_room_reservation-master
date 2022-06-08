<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCoverColumnToRoomCategoriesTable extends Migration
{
    public function up()
    {
        $fields = [
            'images' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('room_categories', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('room_categories', 'images');
    }
}
