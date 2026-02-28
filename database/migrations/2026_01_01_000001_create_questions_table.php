<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('instrucciones');
            $table->unsignedTinyInteger('escala_min');
            $table->unsignedTinyInteger('escala_max');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->unsignedSmallInteger('numero');
            $table->text('texto');
            $table->timestamps();

            $table->unique(['test_id', 'numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('tests');
    }
};
