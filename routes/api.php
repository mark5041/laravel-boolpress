
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/products', 'Api\ComicController@index');
Route::get('v1/products/random', 'Api\ComicController@inRandomOrder');
Route::get('v1/products/search', 'Api\ComicController@search');
Route::get('v1/products/{id}', 'Api\ComicController@show');

