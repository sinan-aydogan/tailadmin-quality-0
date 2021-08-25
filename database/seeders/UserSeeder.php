<?php

namespace Database\Seeders;

use App\Models\JobDescription;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Admin*/
        tap(User::create([
            'name' => 'Super Admin',
            'title' => 'Hero',
            'email' => 'admin@laraquality.dev',
            'password' => bcrypt('admin'),
            'department_id' => 1,
            'job_description_id' => 1,
            'collar_type'=>1,
            'manager_id'=>null,
            'citizen_id'=>'999987654320',
            'status'=>1,
            'starting_date'=>'2017-02-14 09:36:46',
            'birthday_date'=>'1987-09-03 23:45:00',
            'blood_group' => 2,
        ]), function (User $user) {
            (new CreateNewUser())->createTeam($user);
        });
    }
}
