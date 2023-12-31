<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeCategoryController;
use App\Http\Controllers\HomeBookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthorController::class)->group(function () {
	Route::get('admin/author/status_active', 'status_active')->name('author.status.active');
	Route::get('admin/author/status_deactive', 'status_deactive')->name('author.status.deactive');
    Route::get('admin/author/delete_all', 'delete_all')->name('author.delete.all');
	Route::get('admin/author', 'index')->name('author.index');
	Route::get('admin/author/create', 'create')->name('author.create');
	Route::post('admin/author/store', 'store')->name('author.store');
	Route::get('admin/author/{id}/edit', 'edit')->name('author.edit');
	Route::put('admin/author/update/{id}', 'update')->name('author.update');
	Route::get('admin/author/delete/{id}', 'delete')->name('author.delete');
	Route::get('admin/author/{id}/status', 'status')->name('author.status');
	});
Route::controller(CategoryController::class)->group(function (){
 	Route::get('admin/category/status_active', 'status_active')->name('category.status.active');
    Route::get('admin/category/status_deactive', 'status_deactive')->name('category.status.deactive');
    Route::get('admin/category/delete_all', 'delete_all')->name('category.delete.all');
	Route::get('admin/category', 'index')->name('category.index');
	Route::get('admin/category/create', 'create')->name('category.create');
	Route::post('admin/category/store', 'store')->name('category.store');
	Route::get('admin/category/{id}/edit', 'edit')->name('category.edit');
	Route::put('admin/category/update/{id}', 'update')->name('category.update');
	Route::get('/admin/category/delete/{id}', 'delete')->name('category.delete');
	Route::get('/admin/category/{id}/status', 'status')->name('category.status');
	});
Route::controller(TeamController::class)->group(function (){
 	Route::get('admin/status_active', 'status_active')->name('team.status.active');
    Route::get('admin/status_deactive', 'status_deactive')->name('team.status.deactive');
    Route::get('admin/delete_all', 'delete_all')->name('team.delete.all');
	Route::get('/admin/team', 'index')->name('team.index');
	Route::get('/admin/team/create', 'create')->name('team.create');
	Route::post('admin/team/store', 'store')->name('team.store');
	Route::get('/admin/team/{id}/edit', 'edit')->name('team.edit');
	Route::put('admin/team/update/{id}', 'update')->name('team.update');
	Route::get('/admin/team/delete/{id}', 'delete')->name('team.delete');
	Route::get('/admin/team/{id}/status', 'status')->name('team.status');
	});
Route::controller(MediaController::class)->group(function (){
 	Route::get('admin/status_active', 'status_active')->name('media.status.active');
    Route::get('admin/status_deactive', 'status_deactive')->name('media.status.deactive');
    Route::get('admin/delete_all', 'delete_all')->name('media.delete.all');
	Route::get('/admin/media', 'index')->name('media.index');
	Route::get('/admin/media/create', 'create')->name('media.create');
	Route::post('admin/media/store', 'store')->name('media.store');
	Route::get('/admin/media/{id}/edit', 'edit')->name('media.edit');
	Route::put('admin/media/update/{id}', 'update')->name('media.update');
	Route::get('/admin/media/delete/{id}', 'delete')->name('media.delete');
	Route::get('/admin/media/{id}/status', 'status')->name('media.status');
	});
Route::controller(BookController::class)->group(function (){
 	Route::get('admin/status_active', 'status_active')->name('book.status.active');
    Route::get('admin/status_deactive', 'status_deactive')->name('book.status.deactive');
    Route::get('admin/delete_all', 'delete_all')->name('book.delete.all');
	Route::get('/admin/book', 'index')->name('book.index');
	Route::get('/admin/book/create', 'create')->name('book.create');
	Route::post('admin/book/store', 'store')->name('book.store');
	Route::get('/admin/book/{id}/edit', 'edit')->name('book.edit');
	Route::put('admin/book/update/{id}', 'update')->name('book.update');
	Route::get('/admin/book/delete/{id}', 'delete')->name('book.delete');
	Route::get('/admin/book/{id}/status', 'status')->name('book.status');
	});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
		Route::get('/admin/profile', [HomeController::class, 'profile'])->name('profile');
		Route::put('/admin/profile/update', [HomeController::class, 'profile_update'])->name('profile_update');
		Route::post('.admin/update_password',[HomeController::class, 'update_password'])->name('update_password');		

		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	});

require __DIR__.'/auth.php';

		Route::get('/category/{slug}', [HomeCategoryController::class,'show'])->name('category.show');
		Route::get('/book/{slug}', [HomeBookController::class,'show'])->name('book.show');

		Route::get('/about', [MainController::class, 'about'])->name('about');
		Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');
		Route::get('/author', [MainController::class, 'author'])->name('author');
		Route::get('/author_detail/{slug}', [MainController::class, 'author_detail'])->name('author_detail');
		Route::get('/contact', [MainController::class, 'contact'])->name('contact');
		Route::get('/', [MainController::class, 'index'])->name('home');
