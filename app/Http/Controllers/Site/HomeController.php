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
use App\Models\Link;
use App\Models\WishList;
use App\Models\News;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Gallery::with(['user', 'artworks' => function($q) {
            $q->orderBy('created_at', 'desc')->take(5);
        }])->orderBy('updated_at', 'desc');
        
        $updategly = $query->take(8)->get();

        $poptags = Tag::query()->orderBy('updated_at', 'desc')->take(12)->get();

        return view('frontend.index', compact('updategly', 'poptags'));
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
        $background = array(
            '0' => 'None',
            '1' => 'Original Matching',
            '2' => 'Original Unmatching',
            '3' => 'Copy Matching',
            '4' => 'Copy Unmatching'
        );
        $stype = array(
            '1' => 'Normal Production',
            '2' => 'Opening Credit',
            '3' => 'Eyecatch',
            '4' => 'Ending Credit'
        );

        $section = array(
            "" => '',
            '0' => '[ Create New Section ]',
        );
        $info = array(
            '0' => 'Side',
            '1' => 'Bottom',
        );
        $visibility = array(
            '0' => 'Visible to Public',
            '1' => 'Requires Gallery Password',
            '2' => 'Hidden from Public',
        );
        $condition = array(
            '1' => 'Excellent',
            '2' => 'Good',
            '3' => 'Fair',
            '4' => 'Poor',
        );

        // Get the next gallery ID
        $nextArtwork = ArtWork::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $nextArtworkId = $nextArtwork ? $nextArtwork->id : null;

        // Get the previous gallery ID
        $prevArtwork = ArtWork::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $prevArtworkId = $prevArtwork ? $prevArtwork->id : null;

        return view('frontend.artwork', compact('condition', 'visibility', 'info', 'section', 'artwork', 'stype', 'background', 'nextArtworkId', 'prevArtworkId', 'sources'));
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
    
    public function member(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $count = Gallery::where('user_id', $user->id)->count();
        $followingCount = 0;
        $followerCount = 0;
        $thread = Thread::where('user_id', $user->id)->count();
        $links = Link::where('user_id', $user->id)->get();
        $whishlists = WishList::where('user_id', $user->id)->get();
        $news = News::where('user_id', $user->id)->get();

        $query = Gallery::where('user_id', $user->id)->orderBy('updated_at', 'desc');

        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('gallery_name', 'like', '%' . $keyword . '%')
                ->where('description', 'like', '%' . $keyword . '%');
        }
        
        $search = $query->paginate(24);
        $user_private = false;
        if ($request->input('password-input')) {
            if (Hash::check($request->input('password-input'), $user->private_password)) {
                return redirect()->back()->with('user_private', $user->private_content);
            } else {
                Toastr::error('Password is incorrect');
                return redirect()->back();
            }
        }
        return view('frontend.member', compact('user', 'count', 'followingCount', 'followerCount', 'thread', 'search', 'links', 'whishlists', 'news'));
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
