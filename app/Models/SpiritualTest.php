<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpiritualTest extends Model
{
    protected $table = 'tests';

    protected $fillable = ['nombre', 'instrucciones', 'escala_min', 'escala_max'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'test_id');
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class, 'test_id');
    }
}
