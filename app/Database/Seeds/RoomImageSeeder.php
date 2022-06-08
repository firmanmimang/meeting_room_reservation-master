<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'room_id'=>1,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649973864_d28ea603576c0ce055d4.jpg'
            ],
            [
                'room_id'=>1,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649976527_b2fe89b017264e18590f.jpg'
            ],
            [
                'room_id'=>1,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649976527_f791a882f0316f1506f9.jpg'
            ],
            [
                'room_id'=>2,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649974082_4b64985c4273d3a1183e.jpg'
            ],
            [
                'room_id'=>2,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649976609_b806a2b472387ac9dac3.jpg'
            ],
            [
                'room_id'=>2,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649976609_05ff2af0459d02b489e0.jpg'
            ],
            [
                'room_id'=>3,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649978562_bd640a1f218c8b7bd14c.jpg'
            ],
            [
                'room_id'=>3,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649978562_7c7a1adef7960ef3fd39.jpg'
            ],
            [
                'room_id'=>3,
                'created_at'=>'2022-04-12 13:24:04',
                'updated_at'=>'2022-04-12 13:24:04',
                'image_name'=>'1649978562_def0b30c8cbb3ff911c2.jpg'
            ]
        ];

        $this->db->table('room_images')->insertBatch($data);
    }
}
