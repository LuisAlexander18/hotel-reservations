<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_administrative_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativeUsersTable extends Migration
{
    public function up()
    {
        Schema::create('administrative_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('identification')->unique();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrative_users');
    }
}
