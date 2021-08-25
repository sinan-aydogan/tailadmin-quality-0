<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->foreignId('job_description_id')->nullable();
            $table->tinyInteger('collar_type')->nullable();
            $table->foreignId('manager_id')->nullable();
            $table->json('directed_staff')->nullable();
            $table->string('citizen_id',50)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('starting_date')->default(\Carbon\Carbon::now());
            $table->date('birthday_date')->nullable();
            $table->date('leaving_date')->nullable();
            $table->string('leaving_reason',255)->nullable();
            $table->string('blood_group',5)->nullable();
            $table->json('phone')->nullable();
            $table->string('address',750)->nullable();
            $table->json('emergency_contact')->nullable();
            $table->json('education_info')->nullable();
            $table->json('skill_info')->nullable();
            $table->json('additional_task')->nullable();
            $table->foreignId('creator_id')->nullable();
            $table->foreignId('updater_id')->nullable();
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
