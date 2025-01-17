<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Facades\Hash;

class NewsController extends Controller
{
    // Method to display a list of news
    public function index()
    {
        // Logic to fetch and display news
        return view('news.index');
    }

    // Method to display a form to create a new user
    public function create()
    {
        // Logic to display the create user form
        return view('news.create');
    }

    public function upgradenews(Request $request, $newsId) {
        $news = News::find($newsId);
        return view('frontend.account.updatenews', compact('news'));
    }

    // Method to store a newly created user in the database
    public function store(Request $request)
    {
        // Logic to store the user
        $request->validate([
            'content' => 'required',
        ]);

        $news = new News();
        $news->content = $request->content;
        $news->user_id = Auth::id();
        $news->save();

        return redirect()->route('news');
    }

    // Method to display a specific user
    public function show($id)
    {
        // Logic to display the user
        return view('news.show', compact('id'));
    }

    // Method to display a form to edit a user
    public function edit($id)
    {
        // Logic to display the edit user form
        return view('news.edit', compact('id'));
    }

    // Method to update a user in the database
    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $news = News::find($request->id);
        $news->content = $request->content;
        $news->save();

        return redirect()->route('news');
    }

    // Method to delete a user from the database
    public function destroy($id)
    {
        // Logic to delete the user
        $news = News::where("id", $id);
        $news->delete();
        return response()->json(['message' => 'News deleted successfully', 'success' => true], 200);
    }

    public function updateNewsPassword(Request $request) {
        $user = User::find(Auth::id());
        $user->news_password = Hash::make($request->password);
        $user->save();
        return response()->json(['msg' => 'Password has been changed.', 'success' => true ]);
    }
}
