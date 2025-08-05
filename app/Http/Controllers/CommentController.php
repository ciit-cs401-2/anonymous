<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment_content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->comment_content = $request->comment_content;
        $comment->comment_date = now();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id(); // Set the current authenticated user

        $comment->reviewer_name = Auth::user()->name;
        $comment->reviewer_email = Auth::user()->email;

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
