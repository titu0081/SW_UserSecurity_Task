<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación que proporciona Laravel UI login,register,loout
Auth::routes();

Route::get('/home', function(){
    return redirect()->route('task.index');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('task', TaskController::class);
});

Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:read users')
        ->name('users.index');
        
Route::put('/users/{user}/role', [UserController::class, 'assignRole'])->name('users.assign-role');

//
//Route::get('posts/create', [PostController::class, 'create'])
//->middleware(['auth', 'permission:create posts']);


// Test de CRUD posts
//Route::get('/',function(){
//    return redirect()->route('posts.index');
//});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');