<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'subtitle',
        'price',
        'period',
        'button_text',
        'is_popular',
        'features',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'features' => 'array', 
    ];
}
