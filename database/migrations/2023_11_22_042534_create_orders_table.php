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
            // Customer Detail
            $table->string('customer_name', 255)->nullable(false);
            $table->string('customer_contact', 15)->nullable(false);
            $table->string('customer_email', 255)->nullable(false);
            // Transactions
            $table->bigInteger('total');
            $table->string('payment_method', 1)->nullable(false);
            $table->bigInteger('payment')->nullable(false);

            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('package_id')->nullable(false);

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
