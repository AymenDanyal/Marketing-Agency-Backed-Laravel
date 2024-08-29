<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCat;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index()
    {
       
        $products = Product::with('category')->get();
        
        return view('pages.products.index',compact('products'));
    }
    
    public function create()
    {
        $cats = ProductCat::get();
        return view('pages.products.create',compact('cats'));
    }
    
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'cat_id' => 'required|integer',
            'description' => 'required|string',
            'meta_footer' => 'nullable|string',
            'image' => 'nullable|string',
            'file' => 'nullable|string',
            'summary' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'cat_id' => $request->cat_id,
            'description' => $request->description,
            'meta_footer' => $request->meta_footer,
            'image' => $request->image,
            'file' => $request->file,
            'summary' => $request->summary,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
   
    public function edit($id)
    {
        $product = Product::where('id',$id)->first();
        
        // Check if product is found
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        // Now safely access the category relationship
        $cats = ProductCat::get();
        
        return view('pages.products.edit', compact('product', 'cats'));
    }
    
    
    public function update(Request $request, $id)
    {  
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:products,slug,' . $id,
            'cat_id' => 'sometimes|integer',
            'description' => 'sometimes|string',
            'meta_footer' => 'nullable|string',
            'image' => 'nullable|string',
            'file' => 'nullable|string',
            'summary' => 'sometimes|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $updateResult = $product->update($validatedData);

        if (!$updateResult) {
            return response()->json(['message' => 'Failed to update the product.'], 500);
        }

        // Redirect to the products index page after successful update
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product delete successfully.');
    }
    //Api section
    public function getProducts()
    {
        $categories = ProductCat::where('is_parent', 1)->get();
        $products = Product::get();
        $subcategories = ProductCat::whereNotNull('parent_id')->get();

        $categoryData = [];

        foreach ($categories as $category) {
            // Filter products for the current category
            $categoryProducts = $products->filter(function ($product) use ($category) {
                return $product->cat_id == $category->id;
            })->values(); // Convert collection to an array

            // Filter subcategories for the current category
            $categorySubcategories = $subcategories->filter(function ($subcategory) use ($category) {
                return $subcategory->parent_id == $category->id;
            })->values();

            // Prepare subcategories data
            $subcategoryData = [];
            foreach ($categorySubcategories as $subcategory) {
                // Filter products for the current subcategory
                $subcategoryProducts = $products->filter(function ($product) use ($subcategory) {
                    return $product->cat_id == $subcategory->id;
                })->values(); // Convert collection to an array

                $subcategoryData[] = [
                    'id' => $subcategory->id,
                    'category' => $subcategory->category,
                    'description' => $subcategory->description,
                    'is_parent' => $subcategory->is_parent,
                    'parent_id' => $subcategory->parent_id,
                    'slug' => $subcategory->slug,
                    'created_at' => $subcategory->created_at,
                    'products' => $subcategoryProducts->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'title' => $product->title,
                            'slug' => $product->slug,
                            'cat_id' => $product->cat_id,
                            'description' => $product->description,
                            'meta_footer' => $product->meta_footer,
                            'image' => $product->image,
                            'file' => $product->file,
                            'summary' => $product->summary,
                            'created_at' => $product->created_at,
                            'meta_title' => $product->meta_title,
                            'meta_description' => $product->meta_description,
                            'product_id' => $product->product_id,
                            'product_slug' => $product->product_slug,
                            'category' => $product->category,
                        ];
                    })->toArray(),
                ];
            }

            // Prepare category data
            $categoryData[] = [
                'id' => $category->id,
                'category' => $category->category,
                'description' => $category->description,
                'image' => $category->image,
                'meta_title' => $category->meta_footer,
                'meta_description' => $category->meta_description,
                'meta_footer' => $category->meta_footer,
                'image' => $category->image,
                'is_parent' => $category->is_parent,
                'parent_id' => $category->parent_id,
                'slug' => $category->slug,
                'created_at' => $category->created_at,
                'products' => $categoryProducts->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'slug' => $product->slug,
                        'cat_id' => $product->cat_id,
                        'description' => $product->description,
                        'meta_footer' => $product->meta_footer,
                        'image' => $product->image,
                        'file' => $product->file,
                        'summary' => $product->summary,
                        'created_at' => $product->created_at,
                        'meta_title' => $product->meta_title,
                        'meta_description' => $product->meta_description,
                        'product_id' => $product->product_id,
                        'product_slug' => $product->product_slug,
                        'category' => $product->category,
                    ];
                })->toArray(),
                'subcategories' => $subcategoryData
            ];
        }

        // Prepare final JSON structure
        $response = [
            'cats' => $categoryData
        ];

        // Return the JSON response
        return response()->json($response);
    }
    public function getProductBySlug($slug)
    {
        // Find the product by slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Retrieve the category by cat_id
        $category = ProductCat::find($product->cat_id);

        // Prepare the response
        $response = [
            'product' => [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'cat_id' => $product->cat_id,
                'description' => $product->description,
                'meta_footer' => $product->meta_footer,
                'image' => $product->image,
                'file' => $product->file,
                'summary' => $product->summary,
                'created_at' => $product->created_at,
                'meta_title' => $product->meta_title,
                'meta_description' => $product->meta_description,
                'product_id' => $product->id,
                'product_slug' => $product->slug,
                'category' => $category ? $category->category : 'Unknown', // Use the category name or default to 'Unknown'
            ],
            'related' => [], // Assuming you will populate this with related products if needed
        ];

        // Return the JSON response
        return response()->json($response);
    }
    
}
