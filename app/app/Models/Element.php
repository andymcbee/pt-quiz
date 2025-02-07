<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{

    protected $fillable = [
        'name',
        'symbol',
        'atomic_number',
        'atomic_mass',
    ];
}
