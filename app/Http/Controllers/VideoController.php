<?php
// app/Http/Controllers/VideoController.php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('pages.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('pages.videos.create');
    }

    public function store(Request $request)
    {
        Video::create($request->all());
        return redirect()->route('videos.index');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('pages.videos.show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('pages.videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->update($request->all());
        return redirect()->route('videos.index');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('videos.index');
    }
}
