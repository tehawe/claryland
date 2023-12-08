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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice', 15)->unique()->nullable(false);
            // Customer Detail
            $table->string('customer_name', 255)->nullable();
            $table->string('customer_contact', 15)->nullable();
            $table->string('customer_email', 255)->nullable();
            // Transactions
            $table->bigInteger('total')->nullable();
            $table->string('payment_method', 5)->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('card_number', 19)->nullable();

            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('package_id')->nullable();
            $table->boolean('status')->nullable(false)->default(0);

            $table->timestamps();

            // ForeignKey
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('package_id')->on('packages')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
