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


Route::get('/',  [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('home.about');

Route::get('/blog',  [App\Http\Controllers\HomeController::class, 'blog'])->name('home.blog');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('home.contact');

Route::get('/blog/category/{slug}', [App\Http\Controllers\HomeController::class, 'category'])->name('home.category');

Route::get('/blog/tag/{slug}', [App\Http\Controllers\HomeController::class, 'tag'])->name('home.tag');

//Route::get('/contact', [App\Http\Controllers\HomeController::class,  'contact'])->name('home.contact');
//Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contact_us_submit'])->name('home.contact');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

	Route::get('/dashboard',  [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('categories','App\Http\Controllers\admin\CategoryController');
    Route::resource('tags','App\Http\Controllers\admin\TagController');
    Route::resource('posts','App\Http\Controllers\admin\PostController');

    Route::get('/getSlug', function(Request $request){
        $slug ='';
        if(!empty($request->title)){
            $slug = Str::slug($request->title);
        }
        return response()->json([
            'status' => true,
            'slug'   => $slug
        ]);
    })->name('getSlug');


});