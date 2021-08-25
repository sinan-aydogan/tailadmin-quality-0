<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('code',255);
            $table->string('name',255);
            $table->string('model',255)->nullable();
            $table->string('manufacturer',255)->nullable();
            $table->string('description',750)->nullable();
            $table->foreignId('supplier_id');
            $table->foreignId('department_id');
            $table->foreignId('raw_material_type_id');
            $table->json('package_type')->nullable();
            $table->json('stock_rules')->nullable();
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
        Schema::dropIfExists('raw_materials');
    }
}
