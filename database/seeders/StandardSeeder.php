<?php

namespace Database\Seeders;

use App\Models\Standard;
use Illuminate\Database\Seeder;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Standard::create(
            [
                'code' => 'TS 1466',
                'name' => 'Tomato Paste and puree',
                'standard_type' => 1,
                'department_id' => 2,
                'scope' => 'This standard covers tomato paste and tomato puree.',
                'status' => 1,
                'creator_id' => 1
                ]
        );
    }
}
