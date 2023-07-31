<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    // Display a list of blog posts
    public function index(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $posts = Post::where('title', 'LIKE', "%{$query}%")
                ->orWhere('body', 'LIKE', "%{$query}%")
                ->latest()
                ->paginate();
        } else {
            $posts = Post::latest()->paginate();
        }

        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new blog post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created blog post in the database
    public function store(Request $request)
    {
        // Validate the input from the form
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload and get the file path
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        // Create a new post using the authenticated user's ID
        $post = $request->user()->posts()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'image' => $imageUrl,
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Post created successfully!');
    }

    // Display the specified blog post
    public function show($id)
    {
        $post = Post::findOrFail($id)->load('comments');
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified blog post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        // Check if the authenticated user is the author of the post
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }
        return view('posts.edit', compact('post'));
    }

    // Update the specified blog post in the database
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        // Check if the authenticated user is the author of the post
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }

        // Validate the input from the form
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow the image to be nullable
        ]);


        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];

        if ($request->hasFile('image')) {
            // Handle the image upload and get the file path
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $post->image = $imageUrl;
        }

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully!');
    }

    // Remove the specified blog post from the database
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // Check if the authenticated user is the author of the post
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
