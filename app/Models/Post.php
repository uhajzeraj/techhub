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
        // Laravel uses the relationship method name to define the forein key column name
        // In this case, it's going to be "author_id"
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
