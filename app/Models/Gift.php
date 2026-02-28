<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gift extends Model
{
    protected $fillable = ['name', 'slug'];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'gift_question');
    }
}
