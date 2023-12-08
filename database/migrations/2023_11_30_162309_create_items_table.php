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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            // Order
            $table->unsignedBigInteger('order_id');

            // Product
            $table->unsignedBigInteger('product_id');
            $table->bigInteger('price');
            $table->integer('qty');

            $table->timestamps();

            // ForeignKey
            $table->foreign('order_id')->on('orders')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
