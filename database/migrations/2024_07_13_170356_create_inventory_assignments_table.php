<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_inventory_assignments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventory_id');
            $table->morphs('assignable');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_assignments');
    }
}
