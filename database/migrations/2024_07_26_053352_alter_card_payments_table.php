<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCardPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('card_payments', function (Blueprint $table) {
            $table->string('card_number_encrypted', 1000)->change();
            $table->string('cvv_encrypted', 1000)->change();
        });
    }

    public function down()
    {
        Schema::table('card_payments', function (Blueprint $table) {
            $table->string('card_number_encrypted', 255)->change();
            $table->string('cvv_encrypted', 255)->change();
        });
    }
}
