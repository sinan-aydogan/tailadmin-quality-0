<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Vegetable Crushing Machine*/
        Machine::create([
            'code'=> 'XR-125',
            'name' => 'Vegetable Crushing Machine',
            'department_id' => '1',
            'model' => 'Hammer 89X',
            'manufacturer' => 'Sample Machine Company',
            'machine_type_id' => 1,
            'creator_id' => 1
        ]);

        /*Crushing Hammer Unit*/
        Machine::create([
            'code'=> 'KX-125',
            'name' => 'Crushing Hammer Unit',
            'department_id' => '1',
            'model' => 'Hammer KK 125',
            'manufacturer' => 'Sample Machine Company',
            'machine_type_id' => 1,
            'machine_id'=> 1,
            'creator_id' => 1
        ]);
    }
}
