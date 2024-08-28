<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCatController;
use App\Http\Controllers\ContactQueryController;
use App\Http\Controllers\ProductCatController;
use App\Http\Controllers\ProductController;

// Web routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');  // List all products
    Route::get('create', [ProductController::class, 'create'])->name('products.create'); // Show form to create a new product
    Route::post('/', [ProductController::class, 'store'])->name('products.store');   // Store a new product
    Route::get('{id}', [ProductController::class, 'show'])->name('products.show');       // Show a specific product
    Route::get('{id}/edit', [ProductController::class, 'edit'])->name('products.edit');   // Show form to edit a specific product
    Route::put('{id}', [ProductController::class, 'update'])->name('products.update');    // Update a specific product
    Route::delete('{id}', [ProductController::class, 'destroy'])->name('products.delete'); // Delete a specific product
});


Route::prefix('product-cats')->group(function () {
    Route::get('/', [ProductCatController::class, 'index'])->name('product-cats.index');  // List all product categories
    Route::get('create', [ProductCatController::class, 'create'])->name('product-cats.create'); // Show form to create a new product category
    Route::post('/', [ProductCatController::class, 'store'])->name('product-cats.store');   // Store a new product category
    Route::get('{id}', [ProductCatController::class, 'show'])->name('product-cats.show');       // Show a specific product category
    Route::get('{id}/edit', [ProductCatController::class, 'edit'])->name('product-cats.edit');   // Show form to edit a specific product category
    Route::put('{id}', [ProductCatController::class, 'update'])->name('product-cats.update');    // Update a specific product category
    Route::delete('{id}', [ProductCatController::class, 'destroy'])->name('product-cats.destroy'); // Delete a specific product category
});
// Web routes
Route::prefix('contact-queries')->group(function () {
    Route::get('/', [ContactQueryController::class, 'index'])->name('contact-queries.index');  // List all contact queries
    Route::get('create', [ContactQueryController::class, 'create'])->name('contact-queries.create'); // Show form to create a new contact query
    Route::post('/', [ContactQueryController::class, 'store'])->name('contact-queries.store');   // Store a new contact query
    Route::get('{id}', [ContactQueryController::class, 'show'])->name('contact-queries.show');       // Show a specific contact query
    Route::get('{id}/edit', [ContactQueryController::class, 'edit'])->name('contact-queries.edit');   // Show form to edit a specific contact query
    Route::put('{id}', [ContactQueryController::class, 'update'])->name('contact-queries.update');    // Update a specific contact query
    Route::delete('{id}', [ContactQueryController::class, 'destroy'])->name('contact-queries.destroy'); // Delete a specific contact query
});

Route::prefix('blogs')->group(function () {
    Route::get('/index', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/create', [BlogController::class, 'create'])->name('blogs.create'); 
    Route::post('/store', [BlogController::class, 'store'])->name('blogs.store');   
    Route::get('/show/{id}', [BlogController::class, 'show'])->name('blogs.show');       
    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');   
    Route::put('/update/{id}', [BlogController::class, 'update'])->name('blogs.update');    
    Route::delete('/destroy/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

Route::prefix('blog-cat')->group(function () {
    Route::get('/', [BlogCatController::class, 'index'])->name('blogCat.index');
    Route::get('create', [BlogCatController::class, 'create'])->name('blogCat.create');   
    Route::post('/', [BlogCatController::class, 'store'])->name('blogCat.store');   
    Route::get('{id}/edit', [BlogCatController::class, 'edit'])->name('blogCat.edit');   
    Route::put('{id}', [BlogCatController::class, 'update'])->name('blogCat.update');
    Route::delete('{id}', [BlogCatController::class, 'destroy'])->name('blogCat.destroy');
});

Route::prefix('banners')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('banners.index');  // List all banners
    Route::get('create', [BannerController::class, 'create'])->name('banners.create'); // Show form to create a new banner
    Route::post('/', [BannerController::class, 'store'])->name('banners.store');   // Store a new banner
    Route::get('{id}', [BannerController::class, 'show'])->name('banners.show');       // Show a specific banner
    Route::get('{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');   // Show form to edit a specific banner
    Route::put('{id}', [BannerController::class, 'update'])->name('banners.update');    // Update a specific banner
    Route::delete('{id}', [BannerController::class, 'destroy'])->name('banners.destroy'); // Delete a specific banner
});

Route::prefix('admin')->group(function () {
    Route::get('index', [AdminController::class, 'index'])->name('admin.index');  // List all admins
    Route::get('create', [AdminController::class, 'create'])->name('admin.create'); // Show form to create a new admin
    Route::post('store', [AdminController::class, 'store'])->name('admin.store');   // Store a new admin
    Route::get('{id}', [AdminController::class, 'show'])->name('admin.show');       // Show a specific admin
    Route::get('{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');   // Show form to edit a specific admin
    Route::put('{id}', [AdminController::class, 'update'])->name('admin.update');    // Update a specific admin
    Route::delete('{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Delete a specific admin
});


Route::get('/', function () {
    return view('.layouts.master');
});
