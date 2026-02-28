<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->unsignedSmallInteger('total_score')->default(0);
            $table->timestamp('submitted_at');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('value');
            $table->timestamps();
            $table->unique(['attempt_id', 'question_id']);
        });

        Schema::create('gift_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained()->cascadeOnDelete();
            $table->foreignId('gift_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('raw_score');
            $table->unsignedTinyInteger('final_score');
            $table->timestamps();
            $table->unique(['attempt_id', 'gift_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_scores');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('attempts');
    }
};
