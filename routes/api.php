<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiLoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/test' , function(){

    $data = ['message' => 'Hello From Apis Session'];

    return response()->json($data, 404);

});

Route::post('/auth/login' , [ApiLoginController::class, 'login']);


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'posts',
    'as' => 'posts.'
],
 function() {
    Route::get('/' , [ApiPostController::class , 'index']);
    Route::get('/{id}' , [ApiPostController::class , 'show']);
    Route::delete('/{id}' , [ApiPostController::class , 'destroy']);
    Route::post('' , [ApiPostController::class , 'store']);
    Route::put('/{id}' , [ApiPostController::class , 'update']);
});
