<?php

// app/Http/Controllers/TagController.php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('pages.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('pages.tags.create');
    }

    public function store(Request $request)
    {
        Tag::create($request->all());
        return redirect()->route('tags.index');
    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('pages.tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('pages.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return redirect()->route('tags.index');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
