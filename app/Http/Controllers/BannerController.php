<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all(); // Retrieve all banners
        return response()->json($banners);
    }

    /**
     * Show the form for creating a new banner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view to create a banner (if using web views)
        return view('banners.create');
    }

    /**
     * Store a newly created banner in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'page' => 'required|string|max:60',
            'dekstop_img' => 'required|string|max:260',
            'mob_img' => 'required|string|max:260',
        ]);

        $banner = Banner::create([
            'name' => $request->name,
            'page' => $request->page,
            'dekstop_img' => $request->dekstop_img,
            'mob_img' => $request->mob_img,
        ]);

        return response()->json($banner, 201); // Return created banner with 201 status
    }

    /**
     * Display the specified banner.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }

        return response()->json($banner);
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }

        // Return view to edit banner (if using web views)
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:60',
            'page' => 'sometimes|string|max:60',
            'dekstop_img' => 'sometimes|string|max:260',
            'mob_img' => 'sometimes|string|max:260',
        ]);

        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }

        $banner->update($request->only(['name', 'page', 'dekstop_img', 'mob_img']));

        return response()->json($banner);
    }

    /**
     * Remove the specified banner from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }

        $banner->delete();

        return response()->json(['message' => 'Banner deleted successfully']);
    }
}
