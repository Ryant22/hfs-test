<?php

// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add the 'user_id' field to the fillable attributes
        'title',
        'body',
        'image', // Add the 'image_url' field to the fillable attributes
        'email_sent', // If needed, add the 'email_sent' field to the fillable attributes
    ];

    // Define the relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
