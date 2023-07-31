<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a newly created comment in the database
    public function store(Request $request, $postId)
    {
        // Validate the input from the form
        $request->validate([
            'body' => 'required|string',
        ]);

        // Find the associated post
        $post = Post::findOrFail($postId);

        // Create the comment
        $comment = new Comment([
            'body' => $request->input('body'),
        ]);

        // Associate the comment with the post and the authenticated user
        $comment->post()->associate($post);
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully!');
    }

    // Remove the specified comment from the database
    public function destroy($postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = Comment::findOrFail($commentId);
        if (auth()->check()) {
            // Check if the authenticated user is the owner of the comment or an admin
            if ($comment->user_id === auth()->user()->id || auth()->user()->role === 'admin') {
                // Authorized to delete the comment, perform the deletion here
                $comment->delete();

                return redirect()->route('posts.show', $post->id)->with('success', 'Comment deleted successfully.');
            }
        }

        // If the user is not authenticated or not authorized, redirect back with an error message
        return redirect()->route('posts.show', $post->id)->with('error', 'You are not authorized to delete this comment.');
    }
}
