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
        Schema::create('parametre_perdiems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_mission_id');
            $table->unsignedBigInteger('categorie_agent_id');
            $table->decimal('montant',8,2);
            $table->foreign('type_mission_id')->references('id')->on('type_de_missions')->onDelete('cascade');
            $table->foreign('categorie_agent_id')->references('id')->on('categorie_agents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_perdiems');
    }
};
