<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number', 8)->unique("ticket_number_unique");
            $table->string('name', 255)->nullable(false);
            $table->integer('age')->nullable(false);
            $table->timestamp('check_in')->nullable(false);
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("item_id");
            $table->timestamps();

            $table->foreign('order_id')->on('orders')->references('id');
            $table->foreign('item_id')->on('items')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
