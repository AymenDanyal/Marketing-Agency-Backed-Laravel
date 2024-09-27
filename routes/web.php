<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCatController;
use App\Http\Controllers\ContactQueryController;
use App\Http\Controllers\JobQueryController;
use App\Http\Controllers\BriefQueryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaseCategoryController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Mail;


Route::get('/send-test-email', function () {
    $details = [
        'subject' => 'Test Email',
        'body' => 'This is a test email sent from Laravel using SMTP.'
    ];

    Mail::raw($details['body'], function ($message) use ($details) {
        $message->to('basit56700@gmail.com')
                ->subject($details['subject']);
    });

    return 'Test email has been sent!';
});




Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    
    Route::get('/media-manager', function () {
        return view('pages.lfm.index');
    })->name('media-manager');
    
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });


    // Case Study Categories Routes
    Route::group(['prefix' => 'case-categories'], function () {
        Route::get('/', [CaseCategoryController::class, 'index'])->name('case-categories.index');
        Route::get('create', [CaseCategoryController::class, 'create'])->name('case-categories.create');
        Route::post('/', [CaseCategoryController::class, 'store'])->name('case-categories.store');
        Route::get('{id}', [CaseCategoryController::class, 'show'])->name('case-categories.show');
        Route::get('{id}/edit', [CaseCategoryController::class, 'edit'])->name('case-categories.edit');
        Route::put('{id}', [CaseCategoryController::class, 'update'])->name('case-categories.update');
        Route::delete('{id}', [CaseCategoryController::class, 'destroy'])->name('case-categories.destroy');
    });

    // Case Studies Routes
    Route::group(['prefix' => 'case-studies'], function () {
        Route::get('/', [CaseStudyController::class, 'index'])->name('case-studies.index');
        Route::get('create', [CaseStudyController::class, 'create'])->name('case-studies.create');
        Route::post('/', [CaseStudyController::class, 'store'])->name('case-studies.store');
        Route::get('{id}', [CaseStudyController::class, 'show'])->name('case-studies.show');
        Route::get('{id}/edit', [CaseStudyController::class, 'edit'])->name('case-studies.edit');
        Route::put('{id}', [CaseStudyController::class, 'update'])->name('case-studies.update');
        Route::delete('{id}', [CaseStudyController::class, 'destroy'])->name('case-studies.destroy');
    });

    // Pages Routes
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PageController::class, 'index'])->name('pages.index');
        Route::get('create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/', [PageController::class, 'store'])->name('pages.store');
        Route::get('{id}', [PageController::class, 'show'])->name('pages.show');
        Route::get('{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('{id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('{id}', [PageController::class, 'destroy'])->name('pages.destroy');
    });

    // Videos Routes
    Route::group(['prefix' => 'videos'], function () {
        Route::get('/', [VideoController::class, 'index'])->name('videos.index');
        Route::get('create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('/', [VideoController::class, 'store'])->name('videos.store');
        Route::get('{id}', [VideoController::class, 'show'])->name('videos.show');
        Route::get('{id}/edit', [VideoController::class, 'edit'])->name('videos.edit');
        Route::put('{id}', [VideoController::class, 'update'])->name('videos.update');
        Route::delete('{id}', [VideoController::class, 'destroy'])->name('videos.destroy');
    });

    // Tags Routes
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->name('tags.index');
        Route::get('create', [TagController::class, 'create'])->name('tags.create');
        Route::post('/', [TagController::class, 'store'])->name('tags.store');
        Route::get('{id}', [TagController::class, 'show'])->name('tags.show');
        Route::get('{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
        Route::put('{id}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('{id}', [TagController::class, 'destroy'])->name('tags.destroy');
    });

    // Jobs Routes
    Route::group(['prefix' => 'jobs'], function () {
        Route::get('/', [JobController::class, 'index'])->name('jobs.index');
        Route::get('create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/', [JobController::class, 'store'])->name('jobs.store');
        Route::get('{id}', [JobController::class, 'show'])->name('jobs.show');
        Route::get('{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('{id}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
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
    Route::prefix('brief-queries')->group(function () {
        Route::get('/', [BriefQueryController::class, 'index'])->name('brief-queries.index');  // List all contact queries
        Route::get('create', [BriefQueryController::class, 'create'])->name('brief-queries.create'); // Show form to create a new contact query
        Route::post('/', [BriefQueryController::class, 'store'])->name('brief-queries.store');   // Store a new contact query
        Route::get('{id}', [BriefQueryController::class, 'show'])->name('brief-queries.show');       // Show a specific contact query
        Route::get('{id}/edit', [BriefQueryController::class, 'edit'])->name('brief-queries.edit');   // Show form to edit a specific contact query
        Route::put('{id}', [BriefQueryController::class, 'update'])->name('brief-queries.update');    // Update a specific contact query
        Route::delete('{id}', [BriefQueryController::class, 'destroy'])->name('brief-queries.destroy'); // Delete a specific contact query
    });
    Route::prefix('job-queries')->group(function () {
        Route::get('/', [JobQueryController::class, 'index'])->name('job-queries.index');  // List all contact queries
        Route::get('create', [JobQueryController::class, 'create'])->name('job-queries.create'); // Show form to create a new contact query
        Route::post('/', [JobQueryController::class, 'store'])->name('job-queries.store');   // Store a new contact query
        Route::get('{id}', [JobQueryController::class, 'show'])->name('job-queries.show');       // Show a specific contact query
        Route::get('{id}/edit', [JobQueryController::class, 'edit'])->name('job-queries.edit');   // Show form to edit a specific contact query
        Route::put('{id}', [JobQueryController::class, 'update'])->name('job-queries.update');    // Update a specific contact query
        Route::delete('{id}', [JobQueryController::class, 'destroy'])->name('job-queries.destroy'); // Delete a specific contact query
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
});

Route::get('/', function () {
    return view('.layouts.master');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

    // Route to handle login submission
    Route::post('/', [AuthController::class, 'login'])->name('login.submit');

});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
