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
         Schema::table('quote_transportation', function (Blueprint $table) {
            $table->text('client_notes')->nullable()->after('shipping_contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote_transportation', function (Blueprint $table) {
            $table->dropColumn('client_notes');
        });
    }
};
