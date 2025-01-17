<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Support\Facades\Hash;

class WishListController extends Controller
{
    // Method to display a list of wishlist
    public function index()
    {
        // Logic to fetch and display wishlist
        return view('wishlist.index');
    }

    // Method to display a form to create a new user
    public function create()
    {
        // Logic to display the create user form
        return view('wishlist.create');
    }

    // Method to store a newly created user in the database
    public function store(Request $request)
    {
        // Logic to store the user
        $wishlist = new WishList();
        $wishlist->description = $request->description;
        $wishlist->url = $request->url;
        $wishlist->priority = $request->priority;
        $wishlist->series = $request->series;
        $wishlist->oseries = $request->oseries;
        $wishlist->user_id = Auth::id();
        $wishlist->save();

        return redirect()->route('wishlist');
    }

    public function update(Request $request) {
        $wishlist = WishList::where('id', $request->id)->first();
        $wishlist->description = $request->description;
        if($request->url != null) {
            $wishlist->url = $request->url;
        }
        $wishlist->priority = $request->priority;
        $wishlist->series = $request->series;
        $wishlist->oseries = $request->oseries;
        $wishlist->user_id = Auth::id();
        $wishlist->save();

        return redirect()->route('wishlist');
    }

    // Method to display a specific user
    public function show(Request $request, $id)
    {
        $wishitem = WishList::where("id", $id)->first();
        // Logic to display the user
        return view('frontend.account.wishlistedit', compact('wishitem'));
    }

    // Method to display a form to edit a user
    public function edit($id)
    {
        // Logic to display the edit user form
        return view('wishlist.edit', compact('id'));
    }

    // Method to delete a user from the database
    public function destroy($id)
    {
        // Logic to delete the user
        $wishlist = WishList::where("id", $id);
        $wishlist->delete();
        return response()->json(['message' => 'wishlist deleted successfully', 'success' => true], 200);
    }

}
