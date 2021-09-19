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
        /*TS 1466*/
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

        Standard::create(
            [
                'code' => 'TS 7896',
                'name' => 'Paprika Paste',
                'standard_type' => 1,
                'department_id' => 2,
                'scope' => 'This standard applies to paprika paste.',
                'status' => 1,
                'creator_id' => 1
            ]
        );
    }
}
