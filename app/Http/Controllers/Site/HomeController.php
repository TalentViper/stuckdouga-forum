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
use App\Models\Contact;
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
        // Store the referrer URL in the session
        if (session()->has('mainPageUrlForArtwork') === false && request()->route()->named('artwork')) {
            session(['mainPageUrlForArtwork' => url()->previous()]);
        }

        $artwork = ArtWork::with('gallery')->findOrFail($id);
        $artwork->views++;
        $artwork->save();

        $sources = array(
            '1' => 'TV',
            '2' => 'OVA',
            '3' => 'Movie',
            '4' => 'Hanken',
            '5' => 'Manga/Comic',
            '6' => 'Game',
            '7' => 'Other',
            '8' => 'Unknown',
        );

        // Get the next gallery ID
        $nextArtwork = ArtWork::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $nextArtworkId = $nextArtwork ? $nextArtwork->id : null;

        // Get the previous gallery ID
        $prevArtwork = ArtWork::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $prevArtworkId = $prevArtwork ? $prevArtwork->id : null;

        return view('frontend.artwork', compact('artwork', 'nextArtworkId', 'prevArtworkId', 'sources'));
    }

    public function contact()
    {
        //
        return view('frontend.contact');
    }

    public function contact_store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->location = $request->location;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        try {
            Mail::to("info@eliteproviders.uk")->send(new ContactMail($contact));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['success' => 'ArtWork updated successfully!']);
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
