<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateForeignKeysOnCardPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_payments', function (Blueprint $table) {
            // Eliminar las restricciones de claves foráneas existentes solo si existen
            $foreignKeys = DB::select('SELECT CONSTRAINT_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = "card_payments" AND CONSTRAINT_SCHEMA = DATABASE() AND REFERENCED_TABLE_NAME IS NOT NULL');

            foreach ($foreignKeys as $foreignKey) {
                $table->dropForeign($foreignKey->CONSTRAINT_NAME);
            }

            // Agregar nuevas restricciones de claves foráneas con onDelete('cascade') y onUpdate('cascade')
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inventory_assignment_id')->references('id')->on('inventory_assignments')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->nullable()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_payments', function (Blueprint $table) {
            // Eliminar las nuevas restricciones de claves foráneas
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['room_id']);
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['inventory_id']);
            $table->dropForeign(['inventory_assignment_id']);
            $table->dropForeign(['reservation_id']);
            $table->dropForeign(['user_id']);

            // Agregar las restricciones de claves foráneas originales
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('admin_id')->nullable()->constrained();
            $table->foreign('inventory_id')->nullable()->constrained();
            $table->foreign('inventory_assignment_id')->nullable()->constrained();
            $table->foreign('reservation_id')->nullable()->constrained();
            $table->foreign('user_id')->nullable()->constrained();
        });
    }
}
