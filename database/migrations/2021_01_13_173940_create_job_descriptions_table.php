<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('summary',500)->nullable();
            $table->tinyInteger('collar_type')->nullable();
            $table->foreignId('department_id')->nullable()->references('id')->on('departments');
            $table->json('job_responsibility')->nullable();
            $table->json('job_requirement')->nullable();
            $table->json('report_to')->nullable();
            $table->json('working_together')->nullable();
            $table->json('working_conditions')->nullable();
            $table->json('working_equipments')->nullable();
            $table->json('kpi')->nullable();
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->foreignId('updater_id')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_descriptions');
    }
}
