<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Define the table name if different from the default
    protected $table = 'comments';

    // Fillable attributes
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];

    // Relationship with the post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
