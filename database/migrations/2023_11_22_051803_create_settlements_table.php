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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->string('name')->nullable(false);
            $table->string('payment_method')->nullable(false);
            $table->bigInteger('cash_in')->nullable(false)->default(0);
            $table->bigInteger('cash_out')->nullable()->default(NULL);
            $table->text('cash_note')->nullable();
            $table->boolean('status')->nullable();
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->timestamps();

            $table->foreign('sales_id')->on('users')->references('id');
            $table->foreign('checker_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
