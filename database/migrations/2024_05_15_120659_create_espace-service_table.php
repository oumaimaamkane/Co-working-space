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
        Schema::create('espace-service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('espace_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();
            $table->foreign('espace_id')->references('id')->on('espaces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
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
