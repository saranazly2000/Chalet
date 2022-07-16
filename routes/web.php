<?php

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

/*Route::get('/', function () {
    return view('createuser');
});*/

/*Route::get('/', function () {
    return view('home2');
});*/
Route::get('createchalet', 'FirstController@createchalet');
Route::get('create', 'Auth\RegisterController@create');
Route::post('chalet/store', 'FirstController@store2');

//Route::post('upload', 'FirstController@upload')->name('upload');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
/*Route::get('createuser', function () {
    return view('auth.register');
});*/







Route::post('commentchalet/{id}', 'FirstController@storecomment');
Route::post('storerate/{id}', 'FirstController@storerate');
Route::get('chalet/edit/{id}', 'FirstController@edit');
Route::post('chalet/update/{id}', 'FirstController@update');
Route::get('chaletdetails/{chalet_id}', 'FirstController@chaletdetails');
Route::get('chalet', 'FirstController@index4');
Route::get('chalets', 'FirstController@index5');
Route::post('chalet/delete/{id}', 'FirstController@destroy');
//Route::get('chalet', 'FirstController@indexcomments');




Route::get('members', 'FirstController@indexmember');
Route::get('createmember', 'FirstController@createmember');
Route::post('member/store', 'FirstController@storemember');
Route::get('member/edit/{id}', 'FirstController@editemember');
Route::post('member/update/{id}', 'FirstController@updatemember');
Route::post('member/delete/{id}', 'FirstController@destroymember');


Route::get('prices', 'FirstController@indexprices');
Route::get('price/edit/{id}', 'FirstController@editprice');
Route::post('price/update/{id}', 'FirstController@updateprice');
Route::post('price/delete/{id}', 'FirstController@destroyprice');



Route::get('reservations', 'FirstController@indexreservations');
Route::get('createreservation', 'FirstController@createreservation');
Route::post('reservation/store', 'FirstController@storereservation');
Route::get('reservation/edit/{id}', 'FirstController@editreservation');
Route::post('reservation/update/{id}/{chalet_id}', 'FirstController@updatereservation');
Route::post('reservation/delete/{id}', 'FirstController@destroyreservation');
Route::get('chalet/reservation/{id}', 'FirstController@chaletreservation');

Route::get('comments', 'FirstController@indexcomments');
Route::get('comment/edit/{id}', 'FirstController@editcomment');
Route::post('comment/update/{id}', 'FirstController@updatecomment');
Route::post('comment/delete/{id}', 'FirstController@destroycomment');
Route::get('commentsearch','FirstController@commentsearch');

Route::get('rates', 'FirstController@indexrates');
Route::get('rate/edit/{id}', 'FirstController@editrate');
Route::post('rate/update/{id}', 'FirstController@updaterate');
Route::post('rate/delete/{id}', 'FirstController@destroyrate');


Route::get('search','FirstController@search');
Route::get('reservationsearch','FirstController@reservationsearch');


Route::get('creatrservices', 'FirstController@creatrservices');
Route::post('service/store', 'FirstController@addnewservice');
Route::get('services', 'FirstController@services');
Route::get('service/edit/{id}', 'FirstController@editservice');
Route::post('service/update/{id}', 'FirstController@updateservice');
Route::post('service/delete/{id}', 'FirstController@destroyservice');

Route::get('creatrdetail', 'FirstController@creatrdetail');
Route::post('detail/store', 'FirstController@addnewdetail');
Route::get('details', 'FirstController@details');
Route::get('detail/edit/{id}', 'FirstController@editdetail');
Route::post('detail/update/{id}', 'FirstController@updatedetail');
Route::post('detail/delete/{id}', 'FirstController@destroydetail');