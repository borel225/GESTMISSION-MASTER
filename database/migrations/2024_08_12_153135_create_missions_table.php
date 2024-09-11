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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('objectif');
            $table->string('interet');
            $table->string('tdr')->nullable();
            $table->date('date_depart');
            $table->date('date_retour');
            $table->string('observation')->nullable();
            $table->unsignedBigInteger('destination_arrivee_id');
            $table->unsignedBigInteger('destination_depart_id');
            $table->foreign('destination_arrivee_id')->references('id')->on('lieus')->onDelete('cascade');
            $table->foreign('destination_depart_id')->references('id')->on('lieus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
