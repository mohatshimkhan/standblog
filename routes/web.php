<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Auth::routes();




//FRONTEND

Route::get('/',  [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('home.about');

Route::get('/blog',  [App\Http\Controllers\HomeController::class, 'blog'])->name('home.blog');

Route::get('/blog/category/{slug}', [App\Http\Controllers\HomeController::class, 'posts_by_category'])->name('home.posts_by_category');

Route::get('/blog/tag/{slug}', [App\Http\Controllers\HomeController::class, 'posts_by_tag'])->name('home.posts_by_tag');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('home.contact');

Route::get('/search',  [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');

Route::get('/blog/{blog}', [App\Http\Controllers\HomeController::class, 'show'])->name('home.show');

Route::post('blog/{blog}/comment', [App\Http\Controllers\HomeController::class, 'comment'])->name('post.comment');

///////////////////////////////////////////////////////////////////////////////////////////////////////


//BACKEND

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
  	
  	Route::get('/dashboard',  [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');


    Route::resource('categories','App\Http\Controllers\Admin\CategoryController');
    Route::resource('tags',		 'App\Http\Controllers\Admin\TagController');
    Route::resource('posts',	 'App\Http\Controllers\Admin\PostController');
    Route::resource('sitesettings',	 'App\Http\Controllers\Admin\SiteSettingController');

    Route::get('/getSlug', function(Request $request){
		
		$slug='';
		if(!empty($request->title)){
			$slug = Str::slug($request->title);
		}
		return response()->json([
			'status' => true,
			'slug'   => $slug,
		]);
	})->name('getSlug');


	Route::post('/logout',  [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
	
});




//////////////////////////////////////////////////////////////////////////////////////////////////////