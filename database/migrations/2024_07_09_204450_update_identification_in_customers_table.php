<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Elimina la clave única existente, si existe
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique('customers_identification_unique');
        });

        // Ahora agrega la columna con la restricción única
        Schema::table('customers', function (Blueprint $table) {
            $table->string('identification')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique(['identification']);
            $table->string('identification')->nullable()->change();
        });
    }
};
