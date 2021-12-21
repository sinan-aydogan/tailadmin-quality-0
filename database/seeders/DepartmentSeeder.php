<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Production Planning*/
        $mainProduction = Department::create([
            'name' => 'Production Planning',
            'manager_id' => 1,
            'is_complaint' => 1,
            'is_production' => 1,
            'department_type' => 1,
            'department_id' => null,
            'description' => 'Production planning department for all of them',
            'creator_id' => 1,
        ]);

        /*Canned Food Production*/
        Department::create([
            'name' => 'Canned Food Production',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 1,
            'is_production' => 1,
            'department_type' => 0,
            'department_id' => $mainProduction->id,
            'description' => 'Canned vegetables production department',
            'creator_id' => 1,
        ]);

        /*Sauces Production*/
        Department::create([
            'name' => 'Sauces Production',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 1,
            'is_production' => 1,
            'department_type' => 0,
            'department_id' => $mainProduction->id,
            'description' => 'Sauce production department',
            'creator_id' => 1,
        ]);

        /*Quality*/
        $mainQuality = Department::create([
            'name' => 'Quality',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 0,
            'is_production' => 0,
            'department_type' => 1,
            'department_id' => null,
            'description' => 'General quality management department',
            'creator_id' => 1,
        ]);

        /*Quality Assurance*/
        Department::create([
            'name' => 'Quality Assurance',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 0,
            'is_production' => 0,
            'department_type' => 0,
            'department_id' => $mainQuality->id,
            'description' => 'Finished products quality control department',
            'creator_id' => 1,
        ]);

        /*Finished Product Quality*/
        Department::create([
            'name' => 'Finished Product Quality',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 0,
            'is_production' => 0,
            'department_type' => 0,
            'department_id' => $mainQuality->id,
            'description' => 'Finished products quality control department',
            'creator_id' => 1,
        ]);

        /*Raw Material Quality*/
        Department::create([
            'name' => 'Raw Material Quality',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 0,
            'is_production' => 0,
            'department_type' => 0,
            'department_id' => $mainQuality->id,
            'description' => 'Raw material quality control department',
            'creator_id' => 1,
        ]);

        /*Process Quality*/
        Department::create([
            'name' => 'Process Quality',
            'manager_id' => User::where('status',1)->get()->random()->id,
            'is_complaint' => 0,
            'is_production' => 0,
            'department_type' => 0,
            'department_id' => $mainQuality->id,
            'description' => 'Process quality control department at product line',
            'creator_id' => 1,
        ]);


    }
}
