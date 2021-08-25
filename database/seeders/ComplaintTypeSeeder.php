<?php

namespace Database\Seeders;

use App\Models\ComplaintType;
use App\Models\Department;
use Illuminate\Database\Seeder;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Moldy*/
        ComplaintType::create([
            'name' => 'Moldy',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'critical_level' => 2,
            'source' => 'Mold needs four things in order to grow: water, food, suitable air quality and temperature. Food that contains any kind of water or fluid is susceptible to mold growth. In addition, mold can only grow if it has food readily available to feed itself and grow.',
            'advice' => 'You should check all of them – mold can spread very quickly and infest an entire package of food',
            'creator_id' => 1,
        ]);

        /*Rusty Package*/
        ComplaintType::create([
            'name' => 'Rusty Package',
            'department_id' => Department::where('name','like','Canned Food Production')->get()->first()->id,
            'critical_level' => 3,
            'source' => 'Sales problems',
            'advice' => 'Return',
            'creator_id' => 1,
        ]);

        /*Expiry Date */
        ComplaintType::create([
            'name' => 'Expiry Date',
            'department_id' => Department::where('name','like','Sauces Production')->get()->first()->id,
            'critical_level' => 3,
            'source' => 'Sales problems',
            'advice' => 'Return',
            'creator_id' => 1,
        ]);
    }
}
