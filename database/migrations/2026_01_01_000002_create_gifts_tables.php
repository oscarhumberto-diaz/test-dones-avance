<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        Schema::create('gift_question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_id')->constrained('gifts')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->unique(['gift_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_question');
        Schema::dropIfExists('gifts');
    }
};
