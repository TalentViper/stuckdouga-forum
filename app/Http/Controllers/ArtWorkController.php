<?php

namespace App\Http\Controllers;

use App\Models\ArtWork;
use App\Models\Gallery;
use App\Models\ArtWorkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ArtWorkController extends Controller
{
    public function index()
    {
        
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request) {
        $artwork = new ArtWork();
        $artwork->img_main = $request->input('mainfile');
        $artwork->thumbnail = $request->input('thumbnail');
        $artwork->title = $request->input('title');
        $artwork->desc = $request->input('desc');
        $artwork->type = $request->input('type');
        $artwork->section = $request->input('section');
        $artwork->info = $request->input('info');
        $artwork->visibility = $request->input('visibility');
        $artwork->layers = $request->input('layers');
        $artwork->sketch = $request->input('sketch');
        $artwork->snb = $request->input('snb');
        $artwork->condition = $request->input('condition');
        $artwork->oversize = $request->input('oversize');
        $artwork->source = $request->input('source');
        $artwork->background = $request->input('background');
        $artwork->stype = $request->input('stype');
        $artwork->keyart = $request->input('keyart');
        $artwork->bookart = $request->input('bookart');
        $artwork->endart = $request->input('endart');
        $artwork->pdesc = $request->input('pdesc');
        $artwork->players = $request->input('players');
        $artwork->psketch = $request->input('psketch');
        $artwork->psnb = $request->input('psnb');
        $artwork->gallery_id = $request->input('gallery_id');
        $artwork->img2 = $request->input('img2');
        $artwork->img3 = $request->input('img3');
        $artwork->img4 = $request->input('img4');
        $artwork->img5 = $request->input('img5');
        $artwork->img6 = $request->input('img6');
        $artwork->img7 = $request->input('img7');
        $artwork->save();
        $gallery = Gallery::where('id', $artwork->gallery_id)->first();
        $gallery->artwork_count = $gallery->artwork_count + 1;
        $gallery->save();
        Toastr::success(__('ArtWork created successfully!'));
        return redirect()->route('artworkupload', ['galleryId' => $artwork->gallery_id]);
    }

    public function update(Request $request, $id)
    {
        $artwork = ArtWork::where('id', $id)->first();

        if (!$artwork) {
            Toastr::error(__('Invalid data, please try again!'));
            return redirect()->back();
            
        }

        $artwork->img_main = $request->input('mainfile');
        $artwork->thumbnail = $request->input('thumbnail');
        $artwork->title = $request->input('title');
        $artwork->desc = $request->input('desc');
        $artwork->type = $request->input('type');
        $artwork->section = $request->input('section');
        $artwork->info = $request->input('info');
        $artwork->visibility = $request->input('visibility');
        $artwork->layers = $request->input('layers');
        $artwork->sketch = $request->input('sketch');
        $artwork->snb = $request->input('snb');
        $artwork->condition = $request->input('condition');
        $artwork->oversize = $request->input('oversize');
        $artwork->source = $request->input('source');
        $artwork->background = $request->input('background');
        $artwork->stype = $request->input('stype');
        $artwork->keyart = $request->input('keyart');
        $artwork->bookart = $request->input('bookart');
        $artwork->endart = $request->input('endart');
        $artwork->pdesc = $request->input('pdesc');
        $artwork->players = $request->input('players');
        $artwork->psketch = $request->input('psketch');
        $artwork->psnb = $request->input('psnb');
        $artwork->img2 = $request->input('img2');
        $artwork->img3 = $request->input('img3');
        $artwork->img4 = $request->input('img4');
        $artwork->img5 = $request->input('img5');
        $artwork->img6 = $request->input('img6');
        $artwork->img7 = $request->input('img7');
        $artwork->save();
        Toastr::success(__('ArtWork updated successfully!'));
        return redirect()->route('artworkupload', ['galleryId' => $artwork->gallery_id]);
    }

    public function edit(ArtWork $artwork)
    {
        if(Auth::id() == 1) {
            $gallery = Gallery::where('id', $artwork->gallery_id)->first();
            return view('admin.gallery.editartwork')->with([
                'artwork' => $artwork,
                'title' => $gallery->gallery_name
            ]);
        } else {
            $gallery = Gallery::where('id', $artwork->gallery_id)->first();
            return view('frontend.account.editartwork')->with([
                'artwork' => $artwork,
                'title' => $gallery->gallery_name
            ]);
        }
    }

    public function change_visible(Request $request) {
        
        $artwork = ArtWork::findOrFail($request->input('id'));
        
        if ($artwork) {
            $artwork->visibility = $request->input('visibility');
        }
        $artwork->save();
        return response()->json(['success' => 'Action changed!']);
    }

    public function like(Request $request, $id)
    {
        $artwork = ArtWork::findOrFail($id);
                
        if ($artwork->isLikedByUser()) {
            $artwork->usersWhoLiked()->detach(Auth::id());
            $artwork->likes -= 1;
        } else {
            $artwork->usersWhoLiked()->attach(Auth::id());
            $artwork->likes += 1;
        }

        $artwork->save();

        return response()->json(['success' => true, 'likes' => $artwork->likes]);
    }

    public function destroy($id)
    {
        $artwork = ArtWork::find($id);
        $artwork->delete();
        return response()->json(['message' => 'ArtWork deleted successfully', 'success' => true], 200);
    }
}
