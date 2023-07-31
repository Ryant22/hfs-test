<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add the 'user_id' field to the fillable attributes
        'post_id', // Add the 'post_id' field to the fillable attributes
        'body',
    ];

    // Define the relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
