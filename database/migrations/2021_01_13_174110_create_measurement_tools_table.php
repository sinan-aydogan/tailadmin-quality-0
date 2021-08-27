<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_tools', function (Blueprint $table) {
            $table->id();
            $table->string('code',100);
            $table->string('serial_no',100);
            $table->foreignId('measurement_tool_type_id')->nullable();
            $table->string('model',100)->nullable();
            $table->string('manufacturer',100)->nullable();
            $table->date('manufactured_date')->nullable();
            $table->json('purchase_price')->nullable();
            $table->date('purchase_date')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('department_id');
            $table->foreignId('operator_id')->nullable();
            $table->foreignId('action_manager_id');
            $table->tinyInteger('status')->default(1);
            $table->string('description',750)->nullable();
            $table->foreignId('creator_id');
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
        Schema::dropIfExists('measurement_tools');
    }
}
