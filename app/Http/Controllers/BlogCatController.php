<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCat;

class BlogCatController extends Controller
{
    public function index()
    {
        $blogCat = BlogCat::get();
        return view('pages.blogCat.index', compact('blogCat'));
    }

    public function create()
    {
        return view('pages.blogCat.create');
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'cat_name' => 'required|string|max:260',
            'cat_slug' => 'required|string',

        ]);

        $blog = BlogCat::create([
            'category' => $request->cat_name,
            'slug' => $request->cat_slug
        ]);

        return redirect()->route('blogCat.index')->with('success', 'Blog category created successfully.');
    }
    public function destroy($id)
    {
        
        $blog = BlogCat::find($id); 

        if (!$blog) {
        
            return redirect()->route('blogCat.index')->with('error', 'Blog not found.');
        }

        $blog->delete();

        return redirect()->route('blogCat.index')->with('success', 'Blog deleted successfully.');
    }
    public function edit($id)
    {
        $cat = BlogCat::find($id);

        if (!$cat) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Return view to edit blog (if using web views)
        return view('pages.blogCat.edit', compact('cat'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'cat_name' => 'required|string|max:260',
            'cat_slug' => 'required|string', // You can add 'unique:blog_cats,cat_slug,' . $id if slugs need to be unique
        ]);
    
        // Find the blog category by ID
        $blog = BlogCat::find($id);
    
        // Check if the blog category exists
        if (!$blog) {
            return redirect()->route('blogCat.index')->with('error', 'Blog category not found.');
        }
    
        // Update the blog category fields
        $blog->category = $request->cat_name;
        $blog->slug = $request->cat_slug;
    
        // Save the updated blog category
        $blog->save();
    
        // Redirect back with a success message
        return redirect()->route('blogCat.index')->with('success', 'Blog category updated successfully.');
    }
    

}
