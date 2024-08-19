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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meals_id');
            $table->foreign('meals_id')->references('id')->on('meals')->onDelete('cascade');
            $table->unsignedBigInteger('details_id');
            $table->foreign('details_id')->references('id')->on('details')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price_all', 8, 2);
            $table->unsignedBigInteger('orders_id');
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
