<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Eliminar cualquier índice único existente en el campo 'identification'
            $table->dropUnique('customers_identification_unique');

            // Añadir el campo 'identification' como único y no nulo
            $table->string('identification')->unique()->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique(['identification']);
            $table->string('identification')->nullable()->change();
        });
    }
};
