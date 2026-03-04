<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gift extends Model
{
    protected $fillable = ['test_id', 'nombre'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'gift_question');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(AttemptGiftScore::class);
    }
}
