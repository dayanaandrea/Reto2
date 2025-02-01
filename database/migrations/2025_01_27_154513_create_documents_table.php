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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('extension', 10);
            $table->string('route', 100);
            $table->unsignedBigInteger('module_id');
            $table->timestamps();

            $table->foreign('module_id')-> references('id')->on('modules')-> onUpdate('cascade')-> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
