<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class WebsiteController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.website.index')
                ->with([
                    'pages' => $pages
                ]);
    }

    public function show($id)
    {
        $page = Page::find($id);
        return view('admin.website.edit')
                ->with([
                    'page' => $page
                ]);
    }

    public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'is_active' => 'required'
            // Add other validation rules as needed
        ]);

        // Find the team record by its ID
        $page = Page::findOrFail($request->id);

        // Update the page record with the validated data
        $page->title = $validatedData['title'];
        $page->content = $validatedData['content'];
        $page->is_active = $validatedData['is_active'];
        if($request->hasFile('image')){
            $image = $request->file('image');
            // $page->image = $request->input['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $page->image = 'images/' . $imageName;
        }
        
        // Set other attributes as needed

        // Save the updated page to the database
        $page->save();

        return redirect()->back()->with('success', 'Page updated successfully');
    }
    public function uploadImage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        // Handle the image upload and save it to the storage disk (e.g., 'public')
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads'), $imageName);
            $imageUrl = static_asset('images/uploads/' . $imageName);

            // Return the URL to TinyMCE
            return response()->json(['location' => $imageUrl]);
        }

        // Return an error response if the file was not uploaded
        return response()->json(['error' => 'File upload failed.'], 400);
    }
}
