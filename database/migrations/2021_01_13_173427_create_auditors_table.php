<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditors', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('title',100)->nullable();
            $table->foreignId('audit_firm_id');
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('notes',750)->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->foreignId('creator_id');
            $table->foreignId('updater_id')->nullable();
            $table->foreignId('deleter_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('auditors');
    }
}
