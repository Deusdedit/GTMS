<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Procurement Unit', 'name_abbreviation' => 'PMU', 'department_id' => '3'],
            ['id' => 2, 'name' => 'ICT', 'name_abbreviation' => 'IT', 'department_id' => '3'],
            ['id' => 3, 'name' => 'Geology', 'name_abbreviation' => 'GE', 'department_id' => '1'],
            
        ];

        foreach ($items as $item) {
            Section::create($item);
        }
    }
}
