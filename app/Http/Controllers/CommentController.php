<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $thread)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'body' => $request->body,
            'thread_id' => $thread,
            'user_id' => auth()->id(), // Associate thread with the logged-in user
        ]);

        return redirect()->route('threads.index');
    }

    public function like(Comment $comment)
    {
        $comment->likes()->firstOrCreate(['user_id' => auth()->id()]);
        return back();
    }

    public function unlike(Comment $comment)
    {
        $comment->likes()->where('user_id', auth()->id())->delete();
        return back();
    }
}
