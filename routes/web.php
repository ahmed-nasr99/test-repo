<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

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

/* Laravel Breez Routes */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
/* Laravel Breez Routes */


Route::group([
    'middleware' => 'auth:web',
    'prefix' => 'posts',
    'as' => 'posts.'
],
 function() {
    Route::get('/' , [ PostController::class , 'index'])->name('index');

    Route::get('/create', [ PostController::class , 'create'])->name('create');

    Route::post('/', [ PostController::class , 'store'])->name('store');

    Route::delete('/{post}', [ PostController::class , 'destroy']);

    Route::get('/{post}/edit', [ PostController::class , 'edit']);

    Route::put('/{post}', [ PostController::class , 'update']);

    Route::get('/{id}/restore', [ PostController::class , 'restore']);

    Route::get('/archived', [ PostController::class , 'archived']);
});

// Route::group([
//     'middleware' => 'auth:web',

// ],function(){
// });

Route::get('products/archived' ,[ProductController::class , 'archive'])->name('products.archived')->middleware('auth:web');
Route::get('products/{id}/restore' ,[ProductController::class , 'restore'])->name('products.restore')->middleware('auth:web');
Route::resource('products' , ProductController::class)->middleware('auth:web');
