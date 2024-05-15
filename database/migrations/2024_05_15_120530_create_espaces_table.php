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
        Schema::create('espaces', function (Blueprint $table) {
            $table->id();
            $table->integer('floor');
            $table->text('description');
            $table->enum('status', ['valable', 'reserver'])->default('valable'); 
            $table->decimal('price', 8, 2);
            $table->integer('capacity');
            $table->enum('client_categorie', ['freelencer', 'start-up', 'entreprise']); 
            $table->string('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espaces');
    }
};
