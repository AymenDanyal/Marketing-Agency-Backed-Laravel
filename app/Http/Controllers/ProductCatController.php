<?php

namespace App\Http\Controllers;

use App\Models\ProductCat;
use Illuminate\Http\Request;

class ProductCatController extends Controller
{
    public function index()
    {       
        $cats = ProductCat::get(); 
        return view('pages.productCat.index',compact('cats'));
    }
    
    public function create()
    {
        $cats = ProductCat::get();
        return view('pages.productCat.create',compact('cats'));
    }
    
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'category' => 'required|string|max:255', 
            'description' => 'required|string|max:255', 
            'image' => 'required|integer', 
            'meta_description' => 'required|string|max:2000', 
            'meta_title' => 'nullable|string|max:2000', 
            'meta_footer' => 'nullable|string|max:2000', 
            'parent_id' => 'required|integer', 
            'sort_by' => 'nullable|integer', 
            'slug' => 'nullable|string|max:255', 
            'created_at' => 'nullable|date',
        ]);
        
        // Create a new product category using mass assignment
        $product = ProductCat::create([
            'category' => $request->category,  // Corrected from 'title' to 'category'
            'slug' => $request->slug,
            'cat_id' => $request->cat_id, // 'cat_id' likely needs to map to 'parent_id' (assuming it's a parent category ID)
            'description' => $request->description,
            'meta_footer' => $request->meta_footer,
            'image' => $request->image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'sort_by' => $request->sort_by, // Added this to align with validation and input data
            'created_at' => $request->created_at, // Added to explicitly set 'created_at' if needed
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    
    public function show($id)
    {
        $product = ProductCat::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
   
    public function edit($id)
    {
        $product = ProductCat::where('id',$id)->first();
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        $cats = ProductCat::get();
        
        return view('pages.productCat.edit', compact('product', 'cats'));
    }
    
    
    public function update(Request $request, $id)
    {  
        $validatedData =  $request->validate([
            'category' => 'required|string|max:255', 
            'description' => 'required|string|max:255', 
            'image' => 'required|integer', 
            'meta_description' => 'required|string|max:2000', 
            'meta_title' => 'nullable|string|max:2000', 
            'meta_footer' => 'nullable|string|max:2000', 
            'parent_id' => 'required|integer', 
            'sort_by' => 'nullable|integer', 
            'slug' => 'nullable|string|max:255', 
            'created_at' => 'nullable|date',
        ]);

        $product = ProductCat::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $updateResult = $product->update($validatedData);

        if (!$updateResult) {
            return response()->json(['message' => 'Failed to update the product.'], 500);
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = ProductCat::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return redirect()->rogdsfgfdute('products.index')->with('success', 'Product delete successfully.');
    }
}
