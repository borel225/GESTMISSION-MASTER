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
        Schema::create('ordre_missions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mission_id');
            $table->unsignedBigInteger('agent_id');
            $table->decimal('perdiem', 10, 2)->nullable();
            $table->boolean('validation_agent')->default(false);
            $table->boolean('validation_sup_hier')->default(false);
            $table->boolean('validation_da')->default(false);
            $table->boolean('validation_dd')->default(false);
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordre_missions');
    }
};
