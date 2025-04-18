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
        Schema::create('hackatones', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('theme');
            $table->text('regles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hackatones');
    }
};
