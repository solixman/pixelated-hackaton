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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->integer('score');
            // $table->integer('evaluateur_id');
            $table->foreignId('evaluateur_id')->references('id')->on('users');
            // $table->integer('projet_id');
            $table->foreignId('projet_id')->references('id')->on('projets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
