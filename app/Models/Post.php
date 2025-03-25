<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention)
    protected $table = 'posts';

    // Mass assignable attributes
    protected $fillable = ['title', 'content', 'image', 'user_id'];

    // Relationship with User model (a post belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
