<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Comment extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->morphTo();
    }
}
