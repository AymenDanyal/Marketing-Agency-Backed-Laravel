<?php

namespace App\Http\Controllers;


use App\Models\TestimonialTag;
use App\Models\Testimonial;
use App\Models\Tag;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('tags')->get();
        return view('pages.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('pages.testimonials.create', compact('tags'));
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'person' => 'required|string|max:255',
        'image' => 'required|string|max:255',
        'comment' => 'required|string|max:255',
        'logo' => 'required|string|max:255',
        'tags' => 'required|array', 
        'tags.*' => 'exists:tags,id', 
    ]);

    $testimonial = Testimonial::create([
        'person' => $request->person,
        'image' => $request->image,
        'comment' => $request->comment,
        'logo' => $request->logo,
    ]);

    foreach ($request->tags as $tagId) {
        TestimonialTag::create([
            'testimonial_id' => $testimonial->id,
            'tag_id' => $tagId,
        ]);
    }

    // Redirect to the pages index after successful creation
    return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully!');
}


    public function show($id)
    {
        $testimonial = testimonial::findOrFail($id);
        return view('pages.testimonials.show', compact('testimonial'));
    }
    public function edit($id)
    {
        $testimonial = Testimonial::with('tags')->findOrFail($id);
        $tags = Tag::all();
        $selectedTags = $testimonial->tags->pluck('id')->toArray();
        return view('pages.testimonials.edit', compact('testimonial', 'tags', 'selectedTags'));
    }


    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->only('name', 'slug'));
        if ($request->has('tags')) {
            $testimonial->tags()->sync($request->input('tags'));
        } else {
            $testimonial->tags()->detach();
        }
        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully');
    }


    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('pages.index');
    }
}
