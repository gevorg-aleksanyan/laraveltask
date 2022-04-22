<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();
//star user
Route::get('/user-dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user-dashboard');

Route::get('/all-posts', [App\Http\Controllers\UserController::class, 'all_post'])->name('user-all_post');

Route::get('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');

//end user


//start admin
Route::get('/admin-dashborad', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_dashboard');

Route::get('/add-post', [App\Http\Controllers\AdminController::class, 'create_post_page'])->name('create_post_page');

Route::post('/add', [App\Http\Controllers\AdminController::class, 'create_post'])->name('create_post');

Route::get('/see-post/{id}', [App\Http\Controllers\AdminController::class, 'see_post'])->name('see');

Route::get('/edit-post/{id}', [App\Http\Controllers\AdminController::class, 'edit_post_page'])->name('edit');

Route::post('/edit-post', [App\Http\Controllers\AdminController::class, 'edit_post'])->name('edit_post');

Route::get('/delete-post/{id}', [App\Http\Controllers\AdminController::class, 'delete_post'])->name('delete');


//end admin
