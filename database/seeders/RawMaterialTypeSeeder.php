<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\RawMaterialType;
use Illuminate\Database\Seeder;

class RawMaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Solid Additive*/
        RawMaterialType::create([
            'name' => 'Solid Additive',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'description' => 'Solid additives for production',
            'creator_id' => 1,
        ]);
        /*Liquid Additive*/
        RawMaterialType::create([
            'name' => 'Liquid Additive',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'description' => 'Liquid additives for production',
            'creator_id' => 1,
        ]);
    }
}
