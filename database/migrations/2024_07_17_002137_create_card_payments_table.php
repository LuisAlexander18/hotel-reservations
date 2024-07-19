<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('payment_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('admin_id')->nullable()->constrained();
            $table->foreignId('inventory_id')->nullable()->constrained();
            $table->foreignId('inventory_assignment_id')->nullable()->constrained();
            $table->foreignId('reservation_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('room_number');
            $table->decimal('amount', 10, 2);
            $table->string('card_number_encrypted');
            $table->string('cvv_encrypted');
            $table->string('customer_email');
            $table->string('additional_email');
            $table->string('status')->default('pending'); // Estado del pago (pending, approved, rejected)
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
        Schema::dropIfExists('card_payments');
    }
}
