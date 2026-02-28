<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->string('nombre_persona', 200);
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('attempts')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->unsignedTinyInteger('valor');
            $table->timestamps();

            $table->unique(['attempt_id', 'question_id']);
        });

        Schema::create('attempt_gift_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('attempts')->cascadeOnDelete();
            $table->foreignId('gift_id')->constrained('gifts')->cascadeOnDelete();
            $table->unsignedTinyInteger('suma');
            $table->unsignedSmallInteger('total');
            $table->timestamps();

            $table->unique(['attempt_id', 'gift_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attempt_gift_scores');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('attempts');
    }
};
