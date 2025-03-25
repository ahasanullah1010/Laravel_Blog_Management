<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the table name if different from the default
    protected $table = 'categories';

    // Fillable attributes
    protected $fillable = [
        'name',
        'slug',
    ];

    // One-to-many relationship with posts (if applicable)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
