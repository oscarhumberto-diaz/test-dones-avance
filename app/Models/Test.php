<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    protected $table = 'tests';

    protected $fillable = ['nombre', 'instrucciones', 'escala_min', 'escala_max'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }
}
