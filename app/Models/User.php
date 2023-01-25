<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allPosts()
    {
        // Laravel uses the model name to define the forein key column name
        // In this case, it's going to be "user_id", that's why we need to override it
        return $this->hasMany(Post::class, 'author_id');
    }

    public function posts()
    {
        return $this->allPosts()->whereNotNull('published_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function receivedComments()
    {
        return $this->morphMany(Comment::class, 'target');
    }
}
