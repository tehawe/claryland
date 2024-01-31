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
            $table->string('ticket_code', 8)->unique("ticket_code_unique")->nullable()->default(NULL);
            $table->string('name', 255)->nullable()->default(NULL);
            $table->integer('age')->nullable()->default(NULL);
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('order_id')->on('orders')->references('id');
            $table->foreign('item_id')->on('items')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
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
