<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\JobDescription;
use Illuminate\Database\Seeder;

class JobDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Manager*/
        JobDescription::create([
            'name' => 'Manager',
            'collar_type' => 1,
            'department_id' => Department::all()->random()->id,
            'creator_id' => 1
        ]);

        /*Engineer*/
        JobDescription::create([
            'name' => 'Engineer',
            'collar_type' => 1,
            'department_id' => Department::all()->random()->id,
            'creator_id' => 1
        ]);

        /*Control Staff*/
        JobDescription::create([
            'name' => 'Control Staff',
            'collar_type' => 2,
            'department_id' => Department::all()->random()->id,
            'creator_id' => 1
        ]);

    }
}
