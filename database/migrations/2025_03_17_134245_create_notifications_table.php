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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('contenu');
            $table->date('date');
            $table->timestamps();
        });
        Schema::create('userNotifications', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id');
            $table->foreignId('user_id')->references('id')->on('users');
            // $table->integer('notification_id');
            $table->foreignId('notification_id')->references('id')->on('notifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userNotifications');
        Schema::dropIfExists('notifications');
    }
};
