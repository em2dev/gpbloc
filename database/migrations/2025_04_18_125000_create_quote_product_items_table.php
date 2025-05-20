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
        Schema::create('quote_product_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_product_id')->nullable();
            $table->foreign('quote_product_id')->references('id')->on('quote_product')->onDelete('cascade');
            $table->string('code');
            $table->string('description');
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('lenght')->nullable();
            $table->float('weight')->nullable();
            $table->float('price')->nullable();
            $table->float('rental_price_per_day')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('rental_days')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_product_items');
    }
};
