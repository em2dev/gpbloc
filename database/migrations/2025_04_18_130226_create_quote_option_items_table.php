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
        Schema::create('quote_option_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_option_id')->nullable();
            $table->foreign('quote_option_id')->references('id')->on('quote_option')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_option_items');
    }
};
