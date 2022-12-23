<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Post extends Model
{
    use HasFactory;

    // protected $fillable = ['author_id', 'title', 'slug', 'excerpt', 'content'];
    // protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
