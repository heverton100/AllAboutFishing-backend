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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers')->group(function () {
    
    Route::post('users/new','UsersController@store');
    Route::get('users/verifyemail/{token}','UsersController@verifyemail');
    Route::post('users/login','UsersController@login');

    Route::post('users/sendresetlink','UsersController@sendresetlink');
    Route::get('users/resetpassword/{token}','UsersController@resetpassword');
    Route::post('users/resetpassword/{id}','UsersController@changepassword')->name('changepassword');
    Route::post('users/uploadimageprofile','UsersController@uploadimageprofile');
    Route::post('users/update','UsersController@update');

    Route::get('places/all','PlacesController@allplaces');
    Route::get('places/place/{id}','PlacesController@place');
    Route::get('places/allcoordinates','PlacesController@allcoordinates');

    Route::get('endpoints/weather/{vCity}/{vState}','EndpointsController@weather');

    Route::get('galleries/all','GalleriesController@getall');
    Route::get('galleries/getallplace/{place_id}','GalleriesController@getallplace');

    Route::post('reviews/new','ReviewsController@store');
    Route::get('reviews/all','ReviewsController@returnreviews');
    Route::post('reviews/update','ReviewsController@update');
    Route::get('reviews/delete/{id}','ReviewsController@delete');
    Route::get('reviews/place/{user_id}/{place_id}','ReviewsController@returnreviewsplace');
    Route::get('reviews/check/{user_id}/{place_id}','ReviewsController@check');

});