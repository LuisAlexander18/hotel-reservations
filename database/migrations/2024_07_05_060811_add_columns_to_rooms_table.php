<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Agregar columnas nuevas si no existen
            if (!Schema::hasColumn('rooms', 'name')) {
                $table->string('name')->nullable();
            }
            if (!Schema::hasColumn('rooms', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('rooms', 'price')) {
                $table->integer('price')->nullable();
            }
            if (!Schema::hasColumn('rooms', 'capacity')) {
                $table->integer('capacity')->nullable();
            }
            if (!Schema::hasColumn('rooms', 'room_number')) {
                $table->integer('room_number')->default(0);
            }
            if (!Schema::hasColumn('rooms', 'type')) {
                $table->string('type')->default('standard');
            }
            if (!Schema::hasColumn('rooms', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('rooms', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('rooms', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('rooms', 'capacity')) {
                $table->dropColumn('capacity');
            }
            if (Schema::hasColumn('rooms', 'room_number')) {
                $table->dropColumn('room_number');
            }
            if (Schema::hasColumn('rooms', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('rooms', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
}
