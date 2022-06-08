<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'=>'Small',
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'images'=>'1649968406_01023fb4cff55420ff5f.jpg'
            ],
            [
                'name'=>'Medium',
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'images'=>'1649968429_62a49e1edf506cec8785.jpg'
            ],
            [
                'name'=>'Large',
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'images'=>'1649968435_2432c01f2d9a7b385f3d.jpg'
            ]
        ];

        $this->db->table('room_categories')->insertBatch($data);
    }
}
