<?php

namespace App\Http\Controllers;

use App\Models\ArtWorkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtWorkItemController extends Controller
{
    public function index()
    {
        
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function destroy($id)
    {
        $artworkitem = ArtWorkItem::find($id);
        $artworkitem->delete();
        return response()->json(['message' => 'ArtWork deleted successfully'], 200);
    }
    
    // public function destroy(ArtWorkItem $artworkitem)
    // {
    //     $artworkitem->delete();
    //     return response()->json(['message' => 'ArtWork deleted successfully'], 200);
    // }
    // public function destroy(ArtWorkItem $artwork)
    // {
    //     $artwork->delete();
    //     return response()->json(['message' => 'ArtWork deleted successfully'], 200);
    // }
}
