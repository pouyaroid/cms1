<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'content', 'image'
    ];

    // هنگام ایجاد خودکار اسلاگ
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }
}
