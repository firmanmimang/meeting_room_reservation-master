<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class employeeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Afif test',
                'email' => 'afif@test.com',
                'password' => password_hash('test', PASSWORD_DEFAULT),
                'phone_number' => '085374366432',
                'avatar' => 'headset.png',
            ],[
                'name' => 'Zhafari',
                'email' => 'Zhafari@test.com',
                'password' => password_hash('test', PASSWORD_DEFAULT),
                'phone_number' => '083548348575',
                'avatar' => 'VGA.png',
            ]
        ];
        $this->db->table('employees')->insertBatch($data);

    }
}
