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
            // Verificar y eliminar columnas existentes
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

            // Agregar columnas nuevas
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('room_number')->default(0);
            $table->string('type')->default('standard');
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
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('price');
            $table->dropColumn('capacity');
            $table->dropColumn('room_number');
            $table->dropColumn('type');
        });
    }
}
