<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

use App\Models\User;

Route::get('/test-role', function () {
    $user = User::find(1);
    if ($user) {
        return "User found: " . $user->name . " has role admin : " . $user->hasRole('admin');
    }
    return "User not found!";
});


// // user admin role assign
// Route::get('/test-role', function () {
//     $user = User::find(1);
//     if ($user) {
//         $user->assignRole('admin');
//         return "Role assigned!";
//     }
//     return "User not found!";
// });



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Welcome Admin";
    });
    Route::post('/api/posts', [PostController::class, 'store']);  // Create Post
    // Route::get('/api/posts', [PostController::class, 'index']);   // Get all Posts
    // Route::get('/api/posts/{id}', [PostController::class, 'show']); // Get a specific Post
    Route::put('/api/posts/{id}', [PostController::class, 'update']); // Update Post
    Route::delete('/api/posts/{id}', [PostController::class, 'destroy']); // Delete Post


    Route::get('/admin/post/handle', function () {
        return view('blog.post');
    });
});



// routes for CRUD blog
// // Route::middleware('auth:sanctum')->group(function() {
Route::middleware('auth')->group(function() {
    
   // Route::post('/api/posts', [PostController::class, 'store']);  // Create Post
    Route::get('/api/posts', [PostController::class, 'index']);   // Get all Posts
    Route::get('/api/posts/{id}', [PostController::class, 'show']); // Get a specific Post
//     Route::put('/api/posts/{id}', [PostController::class, 'update']); // Update Post
//     Route::delete('/api/posts/{id}', [PostController::class, 'destroy']); // Delete Post
 });


Route::middleware('auth')->group(function() {

    // Route::get('/post', function () {
    //     return view('blog.post');
    // });


    Route::get('/home', function () {
        return view('blog.home');
    });

    Route::get('/blog/{id}', function ($id) {
        return view('blog.single_blog', compact('id'));
    });

});






// Route::get('/home', function () {
//     return view('blog.home');
// });

// Route::get('/post', function () {
//     return view('blog.post');
// });


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
