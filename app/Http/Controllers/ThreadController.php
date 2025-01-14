<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index()
    {
        if(Auth::id() == 1) {
            $threads = Thread::with('user')->get();
            return view('admin.threads.index', compact('threads'));
        } else{
            $search = Thread::with('comments')->get();
            return view('frontend.threads.index', compact('search'));
        }
    }

    public function create()
    {
        if(Auth::id() == 1) {
            return view('admin.threads.create');
        } else
            return view('frontend.threads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        Thread::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(), // Associate thread with the logged-in user
        ]);

        
        if(Auth::id() == 1) {
            return redirect()->route('admin.threads.index');
        }
        else {
           return redirect()->route('threads.index');
        }
    }

    public function edit(Thread $thread)
    {
        return view('admin.threads.edit', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $thread->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.threads.index')->with('success', 'Thread updated successfully.');
    }

    public function show(Thread $thread)
    {
        return view('frontend.threads.show', compact('thread'));
    }

    public function like(Thread $thread)
    {
        $thread->likes()->firstOrCreate(['user_id' => auth()->id()]);
        return back();
    }

    public function unlike(Thread $thread)
    {
        $thread->likes()->where('user_id', auth()->id())->delete();
        return back();
    }

    public function destroy($id)
    {
        $thread = Thread::where("id", $id);
        $thread->delete();
        return response()->json(['message' => 'Thread deleted successfully', 'success' => true], 200);
    }
}
