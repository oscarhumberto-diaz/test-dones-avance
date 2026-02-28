<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = ['test_id', 'numero', 'texto'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(SpiritualTest::class, 'test_id');
    }
}
