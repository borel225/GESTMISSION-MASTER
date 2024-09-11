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
        Schema::table('agents', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('categorie_agent_id')->nullable()->after('superieur_id');
             $table->foreign('categorie_agent_id')->references('id')->on('categorie_agent')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            //
            $table->dropForeign(['categorie_agent_id']);

            $table->dropColumn('categorie_agent_id');
        });
    }
};
