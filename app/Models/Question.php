<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    protected $fillable = ['test_id', 'numero', 'texto'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function gifts(): BelongsToMany
    {
        return $this->belongsToMany(Gift::class, 'gift_question');
    }
}
