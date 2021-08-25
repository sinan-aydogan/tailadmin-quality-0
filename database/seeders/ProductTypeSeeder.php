<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Tomato Paste*/
        ProductType::create([
            'name' => 'Tomato Paste',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'description' => 'Paste from tomato (Canned, Bottled and Grated)',
            'creator_id' => 1,
        ]);

        /*Pepper Paste*/
        ProductType::create([
            'name' => 'Pepper Paste',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'description' => 'Paste from pepper or (Canned, Bottled)',
            'creator_id' => 1,
        ]);

        /*Pepper & Tomato Mixed Paste*/
        ProductType::create([
            'name' => 'Pepper&Tomato Mixed Paste',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'description' => 'Mix paste from tomato and pepper or (Canned, Bottled)',
            'creator_id' => 1,
        ]);

        /*Canned Vegetables*/
        ProductType::create([
            'name' => 'Canned Vegetables',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'description' => 'Canned vegetables (Peas, bean, corn and etc)',
            'creator_id' => 1,
        ]);


        /*Ketchup*/
        ProductType::create([
            'name' => 'Ketchup',
            'department_id' => Department::where('name','like','Sauces Production')->get()->first()->id,
            'description' => 'Ketchup',
            'creator_id' => 1,
        ]);

        /*Mayonnaise*/
        ProductType::create([
            'name' => 'Mayonnaise',
            'department_id' => Department::where('name','like','Sauces Production')->get()->first()->id,
            'description' => 'Mayonnaise',
            'creator_id' => 1,
        ]);


    }
}
