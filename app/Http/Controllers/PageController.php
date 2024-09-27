<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Tag;
use App\Models\PageTag;
use App\Models\Video;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('tags')->get();
        return view('pages.page.index', compact('pages'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('pages.page.create', compact('tags'));
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:pages,slug',
        'tags' => 'required|array', // Ensures tags are an array
        'tags.*' => 'exists:tags,id', // Ensures each tag exists in the tags table
    ]);

    // Create a new Page
    $page = Page::create([
        'name' => $request->name,
        'slug' => $request->slug,
        // Add any other fields if necessary
    ]);

    // Store the tags associated with the page
    foreach ($request->tags as $tagId) {
        PageTag::create([
            'page_id' => $page->id,
            'tag_id' => $tagId,
        ]);
    }

    // Redirect to the pages index after successful creation
    return redirect()->route('pages.index')->with('success', 'Page created successfully!');
}


    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('pages.page.show', compact('page'));
    }
    public function edit($id)
    {
        // Fetch the page with its associated tags
        $page = Page::with('tags')->findOrFail($id);
    
        // Fetch all available tags
        $tags = Tag::all();
    
        // Get the IDs of the tags that are already associated with the page
        $selectedTags = $page->tags->pluck('id')->toArray();
    
        // Pass the data to the view
        return view('pages.page.edit', compact('page', 'tags', 'selectedTags'));
    }


    public function update(Request $request, $id)
    {
        // Find the page by ID, or fail if not found
        $page = Page::findOrFail($id);

        // Update the page details (excluding tags initially)
        $page->update($request->only('name', 'slug'));

        // Sync the selected tags (if any tags are selected)
        if ($request->has('tags')) {
            $page->tags()->sync($request->input('tags'));
        } else {
            // If no tags are selected, detach all tags
            $page->tags()->detach();
        }

        // Redirect to the pages index after the update
        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }


    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('pages.index');
    }

    public function getVideosByTags($slug)
    {
        // Find the page by slug
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        // Get the tags applied to the page
        $tags = $page->tags()->pluck('id');

        if ($tags->isEmpty()) {
            return response()->json(['message' => 'No tags applied to this page'], 200);
        }

        // Get the videos that have those tags, ordered by the latest
        $videos = Video::whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('tags.id', $tags)
            
            ;
        })
     // Assuming you have a `created_at` field in the `videos` table
        ->get();

        return response()->json($videos);
    }









}
