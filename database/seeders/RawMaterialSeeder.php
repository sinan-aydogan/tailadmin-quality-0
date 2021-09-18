<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\RawMaterial;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Sodium Nitrate*/
        $sodiumNitrat = RawMaterial::create([
           'code'=> 'RM-S-001',
           'name' => 'Sodium Nitrate',
            'model' => 'SNX015',
            'manufacturer'=>'Chemical Company',
            'description' => 'Dummy content',
            'raw_material_type_id' => 1,
            'department_id' => Department::where('name','Canned Food Production')->first(['id'])->id,
            'creator_id' =>1
        ]);
        $sodiumNitrat->suppliers()->attach(Supplier::all()->random()->first()->id);

        /*Distilled Water*/
        $distilledWater = RawMaterial::create([
            'code'=> 'RM-L-001',
            'name' => 'Distilled Water',
            'model' => 'W-847',
            'manufacturer'=>'Water Company',
            'description' => 'Dummy content',
            'raw_material_type_id' => 2,
            'department_id' => Department::where('name','Canned Food Production')->first(['id'])->id,
            'creator_id' =>1
        ]);
        $distilledWater->suppliers()->attach(Supplier::all()->random()->first()->id);
    }
}
