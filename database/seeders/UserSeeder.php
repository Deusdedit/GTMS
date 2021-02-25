<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'first_name' => 'Joshua', 'middle_name' => 'Frank', 'last_name' => 'Njau', 'email' => 'josh@gmail.com', 'password' => bcrypt('dddd1111'), 'status' => '1', 'role_id' => '1', 'section_id' => '2'],

            ['id' => 2, 'first_name' => 'Tumaini', 'middle_name' => 'Octavian', 'last_name' => 'Timo', 'email' => 'timo@gmail.com', 'password' => bcrypt('dddd1111'), 'status' => '0', 'role_id' => '2', 'section_id' => '1'],

            ['id' => 3, 'first_name' => 'Deusdedit', 'middle_name' => 'Mwesiga', 'last_name' => 'Byaba', 'email' => 'db@gmail.com', 'password' => bcrypt('dddd1111'), 'status' => '1', 'role_id' => '3', 'section_id' => '3'],

            ['id' => 4, 'first_name' => 'Mathayo', 'middle_name' => 'M', 'last_name' => 'Mat surname', 'email' => 'mat@gmail.com', 'password' => bcrypt('dddd1111'), 'status' => '0', 'role_id' => '3', 'section_id' => '1'],
        ];

        foreach ($items as $item) {
            User::create($item);
        }
    }
}
