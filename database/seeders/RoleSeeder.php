<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Administrator', 'name_abbreviation' => 'Admin'],
            ['id' => 2, 'name' => 'Manager', 'name_abbreviation' => 'MA'],
            ['id' => 3, 'name' => 'Employee', 'name_abbreviation' => 'EP',],
            
        ];

        foreach ($items as $item) {
            Role::create($item);
        }
    }
}
