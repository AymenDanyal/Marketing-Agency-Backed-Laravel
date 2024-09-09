<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactQueryController;
use App\Http\Controllers\ProductCatController;
use App\Http\Controllers\ProductController;

// API routes
Route::prefix('/product-cats')->group(function () {
    Route::get('/', [ProductCatController::class, 'index']);     // List all product categories
    Route::post('/', [ProductCatController::class, 'store']);    // Store a new product category
    Route::get('{id}', [ProductCatController::class, 'show']);   // Show a specific product category
    Route::put('{id}', [ProductCatController::class, 'update']); // Update a specific product category
    Route::delete('{id}', [ProductCatController::class, 'destroy']); // Delete a specific product category
});

// API routes
Route::prefix('/products')->group(function () {
    Route::get('/get-products', [ProductController::class, 'getProducts']);     // List all products
    Route::get('/get-products/{slug}', [ProductController::class, 'getProductBySlug']); 
    Route::get('/get-cat-pro/{slug}', [ProductController::class, 'getProductByCatSlug']); 
    Route::post('/', [ProductController::class, 'store']);    // Store a new product
    Route::get('{id}', [ProductController::class, 'show']);   // Show a specific product
    Route::put('{id}', [ProductController::class, 'update']); // Update a specific product
    Route::delete('{id}', [ProductController::class, 'destroy']); // Delete a specific product
});

Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index']);     // List all admins
    Route::post('/', [AdminController::class, 'store']);    // Store a new admin
    Route::get('{id}', [AdminController::class, 'show']);   // Show a specific admin
    Route::put('{id}', [AdminController::class, 'update']); // Update a specific admin
    Route::delete('{id}', [AdminController::class, 'destroy']); // Delete a specific admin
});

// API routes
Route::prefix('/blogs')->group(function () {
    Route::get('/getAllBlogs', [BlogController::class, 'getAllBlogs']);     // List all blogs
    Route::get('/getBlogBySlug/{slug}', [BlogController::class, 'getBlogBySlug']);
    Route::post('/', [BlogController::class, 'store']);    // Store a new blog
    Route::get('{id}', [BlogController::class, 'show']);   // Show a specific blog
    Route::put('{id}', [BlogController::class, 'update']); // Update a specific blog
    Route::delete('{id}', [BlogController::class, 'destroy']); // Delete a specific blog
});

Route::prefix('/banners')->group(function () {
    Route::get('/', [BannerController::class, 'index']);     // List all banners
    Route::post('/', [BannerController::class, 'store']);    // Store a new banner
    Route::get('{id}', [BannerController::class, 'show']);   // Show a specific banner
    Route::put('{id}', [BannerController::class, 'update']); // Update a specific banner
    Route::delete('{id}', [BannerController::class, 'destroy']); // Delete a specific banner
});

// API routes
Route::prefix('/contact-queries')->group(function () {
    Route::get('/', [ContactQueryController::class, 'index']);     // List all contact queries
    Route::post('/', [ContactQueryController::class, 'store']);    // Store a new contact query
    Route::get('{id}', [ContactQueryController::class, 'show']);   // Show a specific contact query
    Route::put('{id}', [ContactQueryController::class, 'update']); // Update a specific contact query
    Route::delete('{id}', [ContactQueryController::class, 'destroy']); // Delete a specific contact query
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
