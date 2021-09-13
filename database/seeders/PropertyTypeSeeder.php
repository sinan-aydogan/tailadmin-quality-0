<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Packaging Type*/
        PropertyType::create([
            'name' => 'Packaging Type',
            'module_id' => 2,
            'creator_id' => 1
        ]);

        /*Stocking Rules*/
        PropertyType::create([
            'name' => 'Stocking Type',
            'module_id' => 2,
            'creator_id' => 1
        ]);
    }
}
