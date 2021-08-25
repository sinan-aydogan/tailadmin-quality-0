<?php

namespace Database\Seeders;

use App\Models\MachineType;
use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    /* Engine */
    MachineType::create([
        'name' => 'Engine',
        'description' => 'Engines are useable at everywhere',
        'creator_id' => 1,
    ]);

    /* Dryer */
    MachineType::create([
        'name' => 'Dryer',
        'description' => 'Dryers are useable at everywhere',
        'creator_id' => 1,
    ]);
    }
}
