<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display the user's profile page with their posts.
     */
    public function index()
    {
        $userPosts = Post::with(['categories', 'tags'])
                        ->where('user_id', Auth::id())
                        ->orderBy('last_modified_date', 'desc')
                        ->get();

        $categories = Category::all();
        $tags = Tag::all();

        return view('profile.index', compact('userPosts', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the user's published posts (public view).
     */
    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $posts = Post::with(['categories', 'tags'])
                    ->where('user_id', $userId)
                    ->where('status', 'P')
                    ->whereNotNull('publication_date')
                    ->orderBy('publication_date', 'desc')
                    ->paginate(10);

        return view('profile.show', compact('user', 'posts'));
    }
}