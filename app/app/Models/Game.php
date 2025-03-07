<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
