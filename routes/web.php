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
    return view('auth.login');
});

Route::view('places', 'places.main')->name('places.main');
Route::view('places/new', 'places.new')->name('places.new');
Route::view('dashboard', 'home')->name('dashboard');
Route::view('login', 'auth.login')->name('login');
Route::view('dev', 'dev')->name('dev');
Route::view('endpoints', 'endpoints.main')->name('endpoints.main');

Route::view('reviews', 'reviews.main')->name('reviews.main');


Route::namespace('App\Http\Controllers\Auth')->group(function () {
    Route::post('login/autenticate','LoginController@autenticate')->name('login_auth');
    Route::get('logout','LoginController@logout')->name('logout');
});



Route::namespace('App\Http\Controllers')->group(function () {

    Route::get('places', 'PlacesController@index')->name('places.main');
    Route::get('places/new', 'PlacesController@fetchState')->name('places.new');
    Route::post('places/fetch-cities','PlacesController@fetchCity');
    Route::post('places/new','PlacesController@store')->name('new_place');
    Route::get('places/edit/{id}', 'PlacesController@show');
    Route::post('places/edit/{id}','PlacesController@update')->name('update_place');
    Route::get('places/delete/{id}','PlacesController@delete');

    Route::get('endpoints', 'EndpointsController@index')->name('endpoints.main');

    Route::post('places/gallery/new','GalleriesController@store')->name('new_image_gallery');
    Route::get('gallery/delete/{place_id}/{id}','GalleriesController@delete');

    Route::get('reviews', 'ReviewsController@index')->name('reviews.main');
    Route::get('reviews/setapproved/{id}', 'ReviewsController@setapproved');
    Route::get('reviews/setdisapproved/{id}', 'ReviewsController@setdisapproved');


});


