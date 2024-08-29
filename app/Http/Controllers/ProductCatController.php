<?php 
namespace App\Http\Controllers;

use App\Models\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCatController extends Controller
{
    public function index()
    {       
        $cats = ProductCat::get(); 
        return view('pages.productCat.index', compact('cats'));
    }
    
    public function create()
    {
        $cats = ProductCat::get();
        return view('pages.productCat.create', compact('cats'));
    }
    
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'category' => 'required|string|max:255', 
            'description' => 'required|string|max:255', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Changed validation to handle file uploads
            'meta_description' => 'required|string|max:2000', 
            'meta_title' => 'nullable|string|max:2000', 
            'meta_footer' => 'nullable|string|max:2000', 
            'parent_id' => 'required|integer', 
            'sort_by' => 'nullable|integer', 
            'slug' => 'nullable|string|max:255', 
            'created_at' => 'nullable|date',
        ]);
        
        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_cats', 'public'); // Store in public disk
        }

        // Create a new product category using mass assignment
        $product = ProductCat::create([
            'category' => $request->category,
            'slug' => $request->slug,
            'cat_id' => $request->cat_id,
            'description' => $request->description,
            'meta_footer' => $request->meta_footer,
            'image' => $imagePath ?? null, // Save the image path if it was uploaded
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'sort_by' => $request->sort_by,
            'created_at' => $request->created_at,
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
        $cat = ProductCat::where('id', $id)->first();
        
        if (!$cat) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        $parent_cats = ProductCat::whereNotNull('is_parent')->get();
        
        return view('pages.productCat.edit', compact('cat', 'parent_cats'));
    }
    
    
    public function update(Request $request, $id)
    {  
        $validatedData = $request->validate([
            'category' => 'required|string|max:255', 
            'description' => 'required|string|max:255', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Changed validation to handle file uploads
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

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('product_cats', 'public'); // Store in public disk
            $validatedData['image'] = $imagePath; // Update the path in validated data
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

        // Delete image file if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
