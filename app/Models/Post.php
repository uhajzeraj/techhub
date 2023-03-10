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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'target');
    }

    public function scopeWherePublished($query)
    {
        $query->whereNotNull('published_at');
    }

    public function scopeFilterBySearchTerm($query, ?string $searchTerm)
    {
        if ($searchTerm === null) {
            return;
        }

        $query->where(fn ($query) => $query->where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('content', 'LIKE', "%{$searchTerm}%")
            ->orWhereHas('author', fn ($query) => $query
                ->where('name', 'LIKE', "%{$searchTerm}%")));
    }

    public function scopeFilterByCategory($query, ?string $categoryId)
    {
        $query->when(
            $categoryId !== null,
            fn ($query) => $query->where('category_id', $categoryId)
        );
    }
}
