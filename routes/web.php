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
    return view('index');
});

Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('index');

Auth::routes();
//star user
Route::group(['middleware' => 'user','auth'], function () {
Route::get('/user-dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user_dashboard');

Route::get('/all-posts', [App\Http\Controllers\UserController::class, 'allPost'])->name('user_all_post');

Route::get('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');

Route::get('/post-singl-page/{id}', [App\Http\Controllers\UserController::class, 'postSingl'])->name('post_singl');


});
//end user


//start admin

Route::group(['middleware' => 'admin','auth'], function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_dashboard');


Route::get('/add-post', [App\Http\Controllers\AdminController::class, 'createPostPage'])->name('create_post_page');

Route::post('/add', [App\Http\Controllers\AdminController::class, 'createPost'])->name('create_post');

Route::get('/see-post/{id}', [App\Http\Controllers\AdminController::class, 'seePost'])->name('see');

Route::get('/edit-post/{id}', [App\Http\Controllers\AdminController::class, 'editPostPage'])->name('edit');

Route::post('/edit-post/{id}', [App\Http\Controllers\AdminController::class, 'editPost'])->name('edit_post');

Route::get('/delete-post/{id}', [App\Http\Controllers\AdminController::class, 'deletePost'])->name('delete');

Route::get('/delete_img/{id}', [App\Http\Controllers\AdminController::class, 'deleteImg'])->name('delete_img');

Route::post('/img_edit', [App\Http\Controllers\AdminController::class, 'imgEdit'])->name('img_edit');


});

//end admin
