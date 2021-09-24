<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_firms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('notified_body_number',25);
            $table->json('local_accreditation_numbers');
            $table->unsignedTinyInteger('audit_firm_type_id');
            $table->string('phone',25)->nullable();
            $table->string('email',75)->nullable();
            $table->string('address',250)->nullable();
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
        Schema::dropIfExists('audit_firms');
    }
}
