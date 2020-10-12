<?php

use Illuminate\Http\Request;

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

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});
Route::get('last-santri', 'SantriController@index');
Route::get('santri', 'SantriController@get_santri');
Route::post('santri', 'SantriController@store');
Route::get('alumni', 'SantriController@get_alumni');
Route::get('get-provinsi', 'ReferensiController@get_provinsi');
Route::get('get-kabupaten', 'ReferensiController@get_kabupaten');
Route::get('get-kecamatan', 'ReferensiController@get_kecamatan');
Route::get('get-desa', 'ReferensiController@get_desa');
Route::get('get-pekerjaan', 'ReferensiController@get_pekerjaan');
Route::get('get-pendidikan', 'ReferensiController@get_pendidikan');
Route::get('get-asrama', 'ReferensiController@get_asrama');

Route::get('profile', 'API\V1\ProfileController@profile');
Route::put('profile', 'API\V1\ProfileController@updateProfile');
Route::post('change-password', 'API\V1\ProfileController@changePassword');
Route::get('tag/list', 'API\V1\TagController@list');
Route::get('category/list', 'API\V1\CategoryController@list');
Route::post('product/upload', 'API\V1\ProductController@upload');

Route::apiResources([
    'user' => 'API\V1\UserController',
    'product' => 'API\V1\ProductController',
    'category' => 'API\V1\CategoryController',
    'tag' => 'API\V1\TagController',
]);
