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
            'default' => true,
            'module_id' => 2,
            'creator_id' => 1
        ]);

        /*Stocking Rules*/
        PropertyType::create([
            'name' => 'Stocking Type',
            'default' => true,
            'module_id' => 2,
            'creator_id' => 1
        ]);

        /*Recipe Amounts*/
        PropertyType::create([
            'name' => 'Recipe Amounts',
            'default' => true,
            'module_id' => 4,
            'creator_id' => 1
        ]);
    }
}
