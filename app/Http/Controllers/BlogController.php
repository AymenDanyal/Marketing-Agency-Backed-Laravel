<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all blogs with their related category
        $blogs = Blog::with('category')->get();


        // Pass blogs to view
        return view('pages.blogs.index', compact('blogs'));
    }


    /**
     * Show the form for creating a new blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats=Blogcat::get();
        return view('pages.blogs.create',compact('cats'));
    }

    /**
     * Store a newly created blog in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'slug' => 'required|string|max:260',
        'title' => 'required|string|max:260',
        'cat_id' => 'required|integer',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'desktop_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'mob_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'content' => 'required|string',
        'summary' => 'required|string',
    ]);

    $thumbnailPath = $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('uploads', 'public') : null;
    $desktopBannerPath = $request->hasFile('desktop_banner') ? $request->file('desktop_banner')->store('uploads', 'public') : null;
    $mobBannerPath = $request->hasFile('mob_banner') ? $request->file('mob_banner')->store('uploads', 'public') : null;

    $blog = Blog::create([
        'slug' => $request->slug,
        'title' => $request->title,
        'cat_id' => $request->cat_id,
        'thumbnail' => $thumbnailPath,
        'desktop_banner' => $desktopBannerPath,
        'mob_banner' => $mobBannerPath,
        'content' => $request->content,
        'summary' => $request->summary,
        'date_created' => $request->date_created,
    ]);

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
}


    /**
     * Display the specified blog.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    /**
     * Show the form for editing the specified blog.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $cats = Blogcat::get();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Return view to edit blog (if using web views)
        return view('pages.blogs.edit', compact('blog','cats'));
    }

    /**
     * Update the specified blog in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'slug' => 'sometimes|string|max:260|unique:blogs,slug,' . $id,
        'title' => 'sometimes|string|max:260',
        'cat_id' => 'sometimes|integer',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'desktop_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'mob_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'content' => 'sometimes|string',
        'summary' => 'sometimes|string',
    ]);

    $blog = Blog::find($id);

    if (!$blog) {
        return response()->json(['message' => 'Blog not found'], 404);
    }

    if ($request->hasFile('thumbnail')) {
        // Delete old file if it exists
        if ($blog->thumbnail) {
            Storage::disk('public')->delete($blog->thumbnail);
        }
        $blog->thumbnail = $request->file('thumbnail')->store('uploads', 'public');
    }

    if ($request->hasFile('desktop_banner')) {
        // Delete old file if it exists
        if ($blog->desktop_banner) {
            Storage::disk('public')->delete($blog->desktop_banner);
        }
        $blog->desktop_banner = $request->file('desktop_banner')->store('uploads', 'public');
    }

    if ($request->hasFile('mob_banner')) {
        // Delete old file if it exists
        if ($blog->mob_banner) {
            Storage::disk('public')->delete($blog->mob_banner);
        }
        $blog->mob_banner = $request->file('mob_banner')->store('uploads', 'public');
    }

    $blog->update($request->only([
        'slug', 'title', 'cat_id', 'content', 'summary', 'date_created'
    ]));

    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
}


    /**
     * Remove the specified blog from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $blog = Blog::find($id);

    if (!$blog) {
        return response()->json(['message' => 'Blog not found'], 404);
    }

    // Delete files if they exist
    if ($blog->thumbnail) {
        Storage::disk('public')->delete($blog->thumbnail);
    }

    if ($blog->desktop_banner) {
        Storage::disk('public')->delete($blog->desktop_banner);
    }

    if ($blog->mob_banner) {
        Storage::disk('public')->delete($blog->mob_banner);
    }

    $blog->delete();

    return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
}

 


    //api section
    public function getAllBlogs()
    {
        // Retrieve all blogs from the Blog table
        $blogs = Blog::all();

        // Prepare the response
        $response = [
            'blogs' => $blogs->map(function($blog) {

                return [
                    'id' => $blog->id,
                    'slug' => $blog->slug,
                    'title' => $blog->title,
                    'cat_id' => $blog->cat_id,
                    'thumbnail' => $blog->thumbnail,
                    'desktop_banner' => $blog->desktop_banner,
                    'mob_banner' => $blog->mob_banner,
                    'content' => $blog->content,
                    'summary' => $blog->summary,
                    'date_created' => $blog->date_created,
                    'category' =>  'Blog',
                    'blog_id' => $blog->id, // Assuming 'blog_id' is the same as 'id'
                    'blog_slug' => $blog->slug, // Assuming 'blog_slug' is the same as 'slug'
                ];
                
            }),
        ];

        // Return the JSON response
        return response()->json($response);
    }
    public function getBlogBySlug($slug)
    {
        try {
            // Fetch the blog by slug
            $blog = Blog::where('slug', $slug)->firstOrFail();

            // // Fetch the last 5 recent blogs
            // $recentBlogs = Blog::orderBy('date_created', 'desc')->take(5)->get();

            // Prepare the response
            return response()->json([
                'status' => 'success',
                'blog' => [
                    'id' => $blog->id,
                    'slug' => 'blog',
                    'title' => $blog->title,
                    'cat_id' => $blog->cat_id,
                    'thumbnail' => $blog->thumbnail,
                    'desktop_banner' => $blog->desktop_banner,
                    'mob_banner' => $blog->mob_banner,
                    'content' => $blog->content,
                    'summary' => $blog->summary,
                    'date_created' => $blog->date_created->format('Y-m-d H:i:s'),
                    'category' => 'Blog', // assuming there's a relationship with the Category model
                    'blog_id' => $blog->id,
                    'blog_slug' => $blog->slug,
                ],
                // 'recent' => $recentBlogs->map(function ($recentBlog) {
                //     return [
                //         'id' => $recentBlog->id,
                //         'slug' => 'blog',
                //         'title' => $recentBlog->title,
                //         'cat_id' => $recentBlog->cat_id,
                //         'thumbnail' => $recentBlog->thumbnail,
                //         'desktop_banner' => $recentBlog->desktop_banner,
                //         'mob_banner' => $recentBlog->mob_banner,
                //         'content' => $recentBlog->content,
                //         'summary' => $recentBlog->summary,
                //         'date_created' => $recentBlog->date_created->format('Y-m-d H:i:s'),
                //         'blog_id' => $recentBlog->id,
                //     'blog_slug' => $recentBlog->slug,
                //     ];
                // }),
            ], 200); // HTTP 200 OK
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Blog not found
            return response()->json([
                'status' => 'error',
                'message' => 'Blog not found',
            ], 404); // HTTP 404 Not Found
        } catch (\Exception $e) {
            // General error
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500); // HTTP 500 Internal Server Error
        }
    }
}
