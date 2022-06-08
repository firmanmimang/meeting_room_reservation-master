<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'=>'Room Meeting 1',
                'description'=>"This room is one of the most frequently booked rooms, because this room has a capacity of many people, complete meeting support facilities.",
                'num_person'=>5,
                'room_category_id'=>1,
                'slug'=>'room-meeting-1',
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04'
            ],
            [
                'name'=>'Room Meeting 2',
                'description'=>"This room is one of the most frequently booked rooms, because this room has a capacity of many people, complete meeting support facilities.",
                'num_person'=>15,
                'room_category_id'=>2,
                'slug'=>'room-meeting-2',
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04'
            ],
            [
                'name'=>'Room Meeting 3',
                'description'=>"This room is one of the most frequently booked rooms, because this room has a capacity of many people, complete meeting support facilities.",
                'num_person'=>20,
                'room_category_id'=>3,
                'slug'=>'room-meeting-3',
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04'
            ]
        ];

        $this->db->table('rooms')->insertBatch($data);
    }
}
