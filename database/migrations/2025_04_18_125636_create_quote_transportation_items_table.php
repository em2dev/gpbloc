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
        Schema::create('quote_transportation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_transportation_id')->nullable();
            $table->foreign('quote_transportation_id')->references('id')->on('quote_transportation')->onDelete('cascade');
            $table->string('carrier')->nullable();
            $table->integer('capacity_without_lift')->nullable();
            $table->integer('capacity_with_lift')->nullable();
            $table->integer('number_of_trips')->nullable();
            $table->integer('number_of_goings')->nullable();
            $table->integer('number_of_comings')->nullable();
            $table->float('price_per_round_trips')->nullable();
            $table->float('price_per_trip')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_transportation_items');
    }
};
