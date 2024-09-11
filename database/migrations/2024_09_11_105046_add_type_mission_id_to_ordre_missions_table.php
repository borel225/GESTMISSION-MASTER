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
            $table->unsignedBigInteger('type_mission_id')->nullable();
            $table->foreign('type_mission_id')->references('id')->on('type_de_missions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordre_missions', function (Blueprint $table) {
            //
            $table->dropForeign(['type_mission_id']);

            $table->dropColumn('type_missiion_id');
        });
    }
};
