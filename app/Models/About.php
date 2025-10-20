<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'background_shape',
        'val1', 'val1_label',
        'val2', 'val2_label',
        'val3', 'val3_label',
        'val4', 'val4_label',
    ];
}
