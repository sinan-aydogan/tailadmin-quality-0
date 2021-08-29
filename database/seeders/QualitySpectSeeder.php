<?php

namespace Database\Seeders;

use App\Models\QualitySpect;
use Illuminate\Database\Seeder;

class QualitySpectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Density*/
        QualitySpect::create([
            'name'=>'Density',
            'unit' =>'gr/ml',
            'spect_type'=>[1,2],
            'department_id'=>2,
            'standard_id'=>1,
            'creator_id' =>1
        ]);

        /*Mold*/
        QualitySpect::create([
            'name'=>'Mold',
            'unit' =>'',
            'spect_type'=>[1,2],
            'department_id'=>2,
            'standard_id'=>1,
            'creator_id' =>1
        ]);

        /*Acidity*/
        QualitySpect::create([
            'name'=>'Acidity',
            'unit' =>'pH',
            'spect_type'=>[1,2],
            'department_id'=>2,
            'standard_id'=>1,
            'creator_id' =>1
        ]);
    }
}
