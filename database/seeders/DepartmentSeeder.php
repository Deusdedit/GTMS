<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Geology', 'name_abbreviation' => 'GEO'],
            ['id' => 2, 'name' => 'Database', 'name_abbreviation' => 'DB'],
            ['id' => 3, 'name' => 'CEO', 'name_abbreviation' => 'CEO',],
            
        ];

        foreach ($items as $item) {
            Department::create($item);
        }
    }
}
