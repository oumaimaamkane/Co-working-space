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
        Schema::create('espace-equipement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('espace_id');
            $table->unsignedBigInteger('equipement_id');
            $table->integer('quantity');
            $table->timestamps();
        
            $table->foreign('espace_id')->references('id')->on('espaces');
            $table->foreign('equipement_id')->references('id')->on('equipements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
