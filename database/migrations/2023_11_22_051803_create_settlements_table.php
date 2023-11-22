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
            $table->string('name')->nullable(false);
            $table->bigInteger('cash_in')->nullable(false);
            $table->bigInteger('cash_out')->nullable(false);
            $table->boolean('status');
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('checker_id');
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
