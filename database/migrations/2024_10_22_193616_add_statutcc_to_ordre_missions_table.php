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
        Schema::table('ordre_missions', function (Blueprint $table) {
            //
            $table->string('statutcc')->nullable();
            $table->string('statutdfc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordre_missions', function (Blueprint $table) {
            //
            $table->dropColumn('statutcc');
            $table->dropColumn('statutdfc');
        });
    }
};
