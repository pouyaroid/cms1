<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'highlight_text',
        'primary_button_text',
        'primary_button_link',
        'secondary_button_text',
        'secondary_button_link',
        'main_image',
        'shape_image',
    ];
}
