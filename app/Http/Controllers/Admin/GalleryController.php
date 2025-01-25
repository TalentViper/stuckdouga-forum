<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Gallery;
use App\Models\ArtWork;
use App\Models\ServiceOption;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class GalleryController extends Controller
{
    public function index()
    {
        // $search = Gallery::all();
        $search = Gallery::orderBy('updated_at', 'desc');
        $search = $search->paginate(10);
        return view('admin.gallery.index')->with([
            'search' => $search
        ]);
    }

    public function show($id) {
        return view('admin.gallery.index');
    }

    public function remove($id) {
        return view('admin.gallery.index');
    }

    public function store(Request $request) {
        $gallery = new Gallery();
        $gallery->gallery_name = $request->title;
        $gallery->gallery_url = $request->url;
        $gallery->description = $request->description;
        $gallery->series = $request->series;
        $gallery->type = $request->type;
        $gallery->tags = $request->tags;
        $gallery->user_id = Auth::id();
        $gallery->save();
        return response()->json(['success' => 'Gallery created successfully!']);
    }

    public function destroy($id)
    {
        $gallery = Gallery::where("id", $id);
        $gallery->delete();
        return response()->json(['message' => 'Gallery deleted successfully', 'success' => true], 200);
    }

    public function create() {
        return view('admin.gallery.create');
    }

    public function edit(Gallery $gallery)
    {
        if(Auth::id() == 1) {
            $items = ArtWork::where("gallery_id", $gallery->id)->get();
            return view('admin.gallery.edit', compact('gallery', 'items'));
        } else {
            return view('frontend.account.editgallery', compact('gallery'));
        }
    }

    public function update(Request $request, Gallery $gallery)
    {
        // Handle updating the gallery
        $gallery->gallery_name = $request->title;
        $gallery->gallery_url = $request->url;
        $gallery->description = $request->description;
        $gallery->series = $request->series;
        $gallery->type = $request->type;
        $gallery->tags = $request->tags;
        $gallery->update();

        return response()->json(['message' => 'Gallery updated successfully']);
    }

    public function search(Request $request, $keyword = null)
    {
        session()->forget('mainPageUrl');

        $routeName = $request->route()->getName();
        $query = Gallery::with(['user', 'artworks' => function($q) {
            $q->orderBy('created_at', 'desc')->take(5);
        }])->orderBy('updated_at', 'desc');

        if ($keyword) {
            $query->where('gallery_name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
        }

        // Apply additional filters based on the route name
        if ($routeName == 'latest') {
            $query->orderBy('id', 'asc'); // Assuming you have a 'views' column to determine popularity
            $search = $query->paginate(25);
            return view('frontend.latest')->with([
                'search' => $search
            ]);
        } else if($routeName == 'popular') {
            $search = $query->paginate(25);
            return view('frontend.popular')->with([
                'search' => $search
            ]);
        } else if($routeName == 'update') {
            $search = $query->paginate(25);
            return view('frontend.update')->with([
                'search' => $search
            ]);
        } else if($routeName == 'populartag') {
            $query = Tag::query()->orderBy('updated_at', 'desc');

            if ($keyword) {
                $query->where('name', 'like', $keyword . '%');
            }

            $search = $query->paginate(25);
            return view('frontend.populartag')->with([
                'search' => $search
            ]);
        }
    }

    public function galleryByUser(Request $request, $id, $galleryId) {
        $user = User::find($id);
        $query = Gallery::with(['user', 'artworks' => function($q) {
            $q->orderBy('created_at', 'desc')->take(5);
        }])->orderBy('updated_at', 'desc');
        $query->where('user_id', $id);
        $search = $query->paginate(25);
        return view('frontend.gallery.galleryview')->with([
            'gallery' => $search,
            'galleryId' => $galleryId,
            'user' => $user,
        ]);
    }

    public function gallery($id)
    {
        // Store the referrer URL in the session
        if (session()->has('mainPageUrl') === false && request()->route()->named('gallery')) {
            session(['mainPageUrl' => url()->previous()]);
        }
        $gallery = Gallery::where("id", $id)->first();
        $gallery->views++;
        $gallery->save();

        // Get the next gallery ID
        $nextGallery = Gallery::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $nextGalleryId = $nextGallery ? $nextGallery->id : null;

        // Get the previous gallery ID
        $prevGallery = Gallery::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $prevGalleryId = $prevGallery ? $prevGallery->id : null;

        $query = ArtWork::query()->where('gallery_id', $id)->orderBy('updated_at', 'desc');
        $search = $query->paginate(25);

        return view('frontend.gallery', compact('search', 'gallery', 'nextGalleryId', 'prevGalleryId'));
    }

    public function goBack()
    {
        // Get the stored URL from the session
        $mainPageUrl = session('mainPageUrl', url()->previous());

        // Clear the session
        session()->forget('mainPageUrl');

        if (!$mainPageUrl) $mainPageUrl = redirect()->back()->getTargetUrl(); 
        // Redirect to the stored URL
        return redirect($mainPageUrl);
    }

    public function like(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
                
        if ($gallery->isLikedByUser()) {
            $gallery->usersWhoLiked()->detach(Auth::id());
            $gallery->likes -= 1;
        } else {
            $gallery->usersWhoLiked()->attach(Auth::id());
            $gallery->likes += 1;
        }

        $gallery->save();

        return response()->json(['success' => true, 'likes' => $gallery->likes]);
    }

    public function profile(Request $request, $id, $galleryId)
    {
        $user = User::find($id);
        return view('frontend.gallery.profileview')->with([
            'banner' => $user->my_banner,
            'side' => $user->my_side,
            'layout' => $user->layout,
            'content' => $user->my_content,
            'user' => $user,
            'galleryId' => $galleryId
        ]);
    }

    public function private(Request $request, $id, $galleryId)
    {
        $user = User::find($id);
        return view('frontend.gallery.privateview', compact('user', 'galleryId'));
    }
}
