<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gift extends Model
{
    protected $fillable = ['test_id', 'nombre'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(SpiritualTest::class, 'test_id');
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'gift_question');
    }
}
