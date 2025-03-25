<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Define the table name if different from the default
    protected $table = 'tags';

    // Fillable attributes
    protected $fillable = [
        'name',
        'slug',
    ];

    // Many-to-many relationship with posts (if applicable)
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
