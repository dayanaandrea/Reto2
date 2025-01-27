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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['aceptada', 'rechazada', 'pendiente'])->default('pendiente');
            $table->unique(array('meeting_id', 'user_id'));
            $table->timestamps();

            $table->foreign('meeting_id')-> references('id')->on('meetings')-> onUpdate('cascade')-> onDelete('cascade');
            $table->foreign('user_id')-> references('id')->on('users')-> onUpdate('cascade')-> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
