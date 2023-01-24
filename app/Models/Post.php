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

    public function scopeWherePublished($query)
    {
        $query->whereNotNull('published_at');
    }

    public function scopeFilterBySearchTerm($query)
    {
        $request = request();

        if ($request->has('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', "%{$request->get('search')}%")
                    ->orWhere('content', 'LIKE', "%{$request->get('search')}%")
                    ->orWhereIn('author_id', function ($query) use ($request) {
                        $query->select('id')
                            ->from('users')
                            ->where('name', 'LIKE', "%{$request->get('search')}%");
                    });
            });
        }
    }
}
