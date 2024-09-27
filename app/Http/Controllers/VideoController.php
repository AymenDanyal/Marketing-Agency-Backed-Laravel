<?php
// app/Http/Controllers/VideoController.php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('tags')->get();
        return view('pages.videos.index', compact('videos'));
    }

    public function create()
    {
        
        $tags = Tag::all();
        return view('pages.videos.create', compact('tags'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'media_type' => 'required|string|max:255',
            'tags' => 'required|array', // Ensures tags are an array
            'tags.*' => 'exists:tags,id', // Ensures each tag exists in the tags table
        ]);

        $video = Video::create([
            'title' => $request->title,
            'media_type' => $request->media_type,
            // Add any other fields if necessary
        ]);
         // Store the tags associated with the page
         foreach ($request->tags as $tagId) {
            VideoTag::create([
                'video_id' => $video->id,
                'tag_id' => $tagId,
            ]);
        }
        return redirect()->route('videos.index')->with('success', 'Page created successfully!');

    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('pages.videos.show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::with('tags')->findOrFail($id);
         // Fetch all available tags
         $tags = Tag::all();
          // Get the IDs of the tags that are already associated with the page
        $selectedTags = $video->tags->pluck('id')->toArray();
        return view('pages.videos.edit', compact('video', 'tags', 'selectedTags'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        // Update the page details (excluding tags initially)
        $video->update($request->only('name', 'slug'));

        // Sync the selected tags (if any tags are selected)
        if ($request->has('tags')) {
            $video->tags()->sync($request->input('tags'));
        } else {
            // If no tags are selected, detach all tags
            $video->tags()->detach();
        }

        return redirect()->route('videos.index')->with('success', 'Page updated successfully');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('videos.index');
    }
}
