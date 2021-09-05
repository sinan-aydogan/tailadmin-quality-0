<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id');
            $table->tinyInteger('action_type')->default(0);
            $table->string('comment',750);
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
        Schema::dropIfExists('complaint_actions');
    }
}
