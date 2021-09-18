<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Package Types*/
        /*Palette*/
        Property::create([
            'name' => 'Palette',
            'property_type_id' => 1,
            'creator_id' => 1
        ]);
        /*Craft Bag*/
        Property::create([
            'name' => 'Craft Bag',
            'property_type_id' => 1,
            'creator_id' => 1
        ]);
        /*Barrel*/
        Property::create([
            'name' => 'Barrel',
            'property_type_id' => 1,
            'creator_id' => 1
        ]);

        /*Storage Conditions*/
        /*Dry and Indoor*/
        Property::create([
            'name' => 'Dry and Indoor',
            'property_type_id' => 2,
            'creator_id' => 1
        ]);
        /*Outside*/
        Property::create([
            'name' => 'Outside',
            'property_type_id' => 2,
            'creator_id' => 1
        ]);
        /*Far away from Reactive Materials*/
        Property::create([
            'name' => 'Far away from Reactive Materials',
            'property_type_id' => 2,
            'creator_id' => 1
        ]);
        /*Protected from Heat*/
        Property::create([
            'name' => 'Protected from Heat',
            'property_type_id' => 2,
            'creator_id' => 1
        ]);


        /*Recipe Amount: gram*/
        Property::create([
            'name' => 'gram',
            'property_type_id' => 3,
            'creator_id' => 1
        ]);

        /*Recipe Amount: liter*/
        Property::create([
            'name' => 'liter',
            'property_type_id' => 3,
            'creator_id' => 1
        ]);

        /*Recipe Amount: kg*/
        Property::create([
            'name' => 'kg',
            'property_type_id' => 3,
            'creator_id' => 1
        ]);
    }
}
