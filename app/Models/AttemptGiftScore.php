<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttemptGiftScore extends Model
{
    protected $table = 'attempt_gift_scores';

    protected $fillable = ['attempt_id', 'gift_id', 'suma', 'total'];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }

    public function gift(): BelongsTo
    {
        return $this->belongsTo(Gift::class);
    }
}
