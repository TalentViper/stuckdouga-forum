<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index()
    {
        
    }

    public function create(Request $request)
    {
        
    }

    public function edit(Request $request, $id)
    {
        $link = Link::find($id);
        return view('frontend.account.linkedit', compact('link'));
    }

    public function store(Request $request)
    {
        $link = new Link();
        $link->name = $request->name;
        $link->url = $request->url;
        $link->desc = $request->desc;
        $link->user_id = Auth::id();
        $link->save();
        
        return redirect()->back()->with('success', 'Link created successfully!');
    }

    public function update(Request $request)
    {
        $link = Link::find($request->id);
        $link->name = $request->name;
        $link->url = $request->url;
        $link->desc = $request->desc;
        $link->save();

        return redirect()->route('link');
    }

    public function destroy($id)
    {
        // Logic to delete the user
        $link = Link::where("id", $id);
        $link->delete();
        return response()->json(['message' => 'Link deleted successfully', 'success' => true], 200);
    }
}
