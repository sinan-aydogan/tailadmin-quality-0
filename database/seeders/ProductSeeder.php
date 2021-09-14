<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Tomato Paste 2,5 KG Bottle*/
        Product::create([
            'name' => 'Tomato Paste 2,5 KG Bottle',
            'code' => 'TP-X125-01',
            'department_id' => Department::where('name','Canned Food Production')->first()->id,
            'product_type_id' => ProductType::where('name','Tomato Paste')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Tomato Paste 0,5KG Jar*/
        Product::create([
            'name' => 'Tomato Paste 0,5KG Jar',
            'code' => 'TP-X005-01',
            'department_id' => Department::where('name','Canned Food Production')->first()->id,
            'product_type_id' => ProductType::where('name','Tomato Paste')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Pepper Paste 2,5 KG Bottle*/
        Product::create([
            'name' => 'Pepper Paste 2,5 KG Bottle',
            'code' => 'PP-X125-01',
            'department_id' => Department::where('name','Canned Food Production')->first()->id,
            'product_type_id' => ProductType::where('name','Pepper Paste')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Pepper Paste 0,5KG Jar*/
        Product::create([
            'name' => 'Pepper Paste 0,5KG Jar',
            'code' => 'PP-X005-01',
            'department_id' => Department::where('name','Canned Food Production')->first()->id,
            'product_type_id' => ProductType::where('name','Pepper Paste')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Ketchup 0,33 Bottle*/
        Product::create([
            'name' => 'Ketchup 0,33 Bottle',
            'code' => 'KT-X033-01',
            'department_id' => Department::where('name','Sauces Production')->first()->id,
            'product_type_id' => ProductType::where('name','Ketchup')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Ketchup Hot Chilli 0,33 Bottle*/
        Product::create([
            'name' => 'Ketchup Hot Chilli 0,33 Bottle*',
            'code' => 'KT-X033-02',
            'department_id' => Department::where('name','Sauces Production')->first()->id,
            'product_type_id' => ProductType::where('name','Ketchup')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Mayonnaise 0,33 Bottle*/
        Product::create([
            'name' => 'Ketchup 0,33 Bottle',
            'code' => 'MY-X033-01',
            'department_id' => Department::where('name','Sauces Production')->first()->id,
            'product_type_id' => ProductType::where('name','Mayonnaise')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);

        /*Mayonnaise 0,50 Jar*/
        Product::create([
            'name' => 'Ketchup Hot Chilli 0,33 Bottle*',
            'code' => 'MY-X050-01',
            'department_id' => Department::where('name','Sauces Production')->first()->id,
            'product_type_id' => ProductType::where('name','Mayonnaise')->first()->id,
            'standard_id' => 1,
            'is_certified' => 4,
            'creator_id' => 1,
        ]);
    }
}
