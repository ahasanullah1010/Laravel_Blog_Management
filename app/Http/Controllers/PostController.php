<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    // Create a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();
        return response()->json($post, 201); // Return the created post
    }

    // Get all posts
    public function index()
    {
        $posts = Post::latest()->paginate(9); // Pagination with 10 posts per page
        // return response()->json($posts);
        return response()->json([
            'posts' => $posts->items(), // শুধুমাত্র পোস্ট ডাটা
            'current_page' => $posts->currentPage(), // বর্তমান পেজ নম্বর
            'last_page' => $posts->lastPage(), // সর্বশেষ পেজ নম্বর
            'next_page_url' => $posts->nextPageUrl(), // পরবর্তী পেজ লিংক
            'prev_page_url' => $posts->previousPageUrl(), // পূর্ববর্তী পেজ লিংক
        ]);
    }

    // Get a specific post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();
        return response()->json($post);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // Delete the associated image
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
