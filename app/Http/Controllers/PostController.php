<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with(['categories', 'tags', 'user'])
                    ->orderBy('publication_date', 'desc')
                    ->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'featured_image_url' => 'nullable|url',
            'status' => 'required|in:D,P,I',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($request->title);
        $post->featured_image_url = $request->featured_image_url;
        $post->status = $request->status;
        $post->views_count = 0;
        $post->user_id = Auth::id();

        // Set publication date if status is Published
        if ($request->status === 'P') {
            $post->publication_date = now();
        }

        $post->last_modified_date = now();
        $post->save();

        // Attach categories and tags
        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }
        
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::with(['categories', 'tags', 'user', 'comments', 'media'])
                   ->findOrFail($id);
        
        // Increment views count
        $post->increment('views_count');

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = Post::with(['categories', 'tags'])->findOrFail($id);
        
        // Check if user can edit this post (only author or admin)
        $userRoles = Auth::user()->roles->pluck('role_name');
        if ($post->user_id !== Auth::id() && !$userRoles->contains('A')) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user can edit this post
        $userRoles = Auth::user()->roles->pluck('role_name');
        if ($post->user_id !== Auth::id() && !$userRoles->contains('A')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'featured_image_url' => 'nullable|url',
            'status' => 'required|in:D,P,I',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($request->title);
        $post->featured_image_url = $request->featured_image_url;
        $post->status = $request->status;

        // Set publication date if status changed to Published and wasn't published before
        if ($request->status === 'P' && $post->publication_date === null) {
            $post->publication_date = now();
        }

        $post->last_modified_date = now();
        $post->save();

        // Sync categories and tags
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->detach();
        }
        
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('post.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Check if user can delete this post
        $userRoles = Auth::user()->roles->pluck('role_name');
        if ($post->user_id !== Auth::id() && !$userRoles->contains('A')) {
            abort(403, 'Unauthorized action.');
        }

        // Detach relationships
        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Display published posts for public viewing.
     */
    public function published()
    {
        $posts = Post::with(['categories', 'tags', 'user'])
                    ->where('status', 'P')
                    ->whereNotNull('publication_date')
                    ->orderBy('publication_date', 'desc')
                    ->paginate(10);
        
        return view('post.published', compact('posts'));
    }
}