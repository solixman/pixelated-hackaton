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
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->integer('hackatone_id');
            $table->foreignId('hackatone_id')->references('id')->on('hackatones');
            $table->timestamps();
        });
        Schema::create('members', function (Blueprint $table) {
            $table->id();  
            // $table->integer('equipes_id');
            $table->foreignId('equipes_id')->references('id')->on('equipes');
            // $table->integer('membre_id');
            $table->foreignId('membre_id')->references('id')->on('equipes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};
