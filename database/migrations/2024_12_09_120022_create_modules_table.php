<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('modules', function (Blueprint $table) {
        $table->id();
        $table->string('code', 10)->unique();
        $table->string('name', 100);
        $table->integer('hours');
        $table->tinyInteger('course');
        $table->unsignedBigInteger('cycle_id');
        $table->unsignedBigInteger('user_id')->nullable();
        $table->timestamps();

        $table->foreign('cycle_id')->references('id')->on('cycles')->onUpdate('cascade')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
