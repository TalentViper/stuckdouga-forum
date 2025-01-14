<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Tag;
use App\Models\Gallery;
use App\Models\ArtWork;
use App\Models\Thread;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontend.index');
    }

    /**
     * Gallery page
     *
     * @return \Illuminate\Http\Response
     */    
    public function account(Request $request)
    {
        //super
        $user = auth()->user();
        
        return view('frontend.account')->with([
            'user' => $user,
            'gallery_count' => Gallery::where('user_id', $user->id)->count(),
        ]);
    }
    public function artwork($id)
    {
        $artwork = ArtWork::with('gallery')->findOrFail($id);
        $artwork->views++;
        $artwork->save();
        return view('frontend.artwork', compact('artwork'));
    }
    public function contact()
    {
        //
        return view('frontend.contact');
    }
    public function tags()
    {
        //
        $search = Tag::get();
        return view('frontend.tags', compact('search'));
    }
    public function member($id)
    {
        $user = User::findOrFail($id);
        $count = Gallery::where('user_id', $user->id)->count();
        $followingCount = $user->follows()->count();
        $followerCount = $user->followers()->count();
        $thread = Thread::where('user_id', $user->id)->count();
        $search = Gallery::where('user_id', $user->id)->paginate(20);
        return view('frontend.member', compact('user', 'count', 'followingCount', 'followerCount', 'thread', 'search'));
    }
    public function latest()
    {
        //
        return view('frontend.latest');
    }
    public function update()
    {
        //
        return view('frontend.update');
    }
    public function popular()
    {
        //
        return view('frontend.popular');
    }

    public function populartag()
    {
        //
        return view('frontend.populartag');
    }

    public function comingsoon()
    {
        //
        return view('frontend.coming');
    }

    public function coming()
    {
        //
        return view('frontend.pagecoming');
    }

    public function about()
    {
        //
        return view('frontend.about');
    }

    public function resource() {
        return view('frontend.resource');
    }
}
