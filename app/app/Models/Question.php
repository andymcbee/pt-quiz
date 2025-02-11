<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{


    protected $fillable = [
        'status',
        'user_response',
    ];

    public function game(): belongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function element(): belongsTo
    {
        return $this->belongsTo(Element::class);
    }
}
