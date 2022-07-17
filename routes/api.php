<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
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


//Chalet API
Route::get('chalet/chalets','ApiController@indexchalets');
//http://localhost:8000/api/chalet/chalets
Route::post('chalet/chaletdetails','ApiController@chaletdetails');
//http://localhost:8000/api/chalet/chaletdetails
Route::post('chalet/store','ApiController@storechalet');
//http://localhost:8000/api/chalet/store
Route::post('chalet/update','ApiController@updatechalet');
//http://localhost:8000/api/chalet/update
Route::post('chalet/delete', 'ApiController@destroychalet');
//http://localhost:8000/api/chalet/delete
Route::post('chalet/storeservices', 'ApiController@storeservices');
//http://localhost:8000/api/chalet/storeservices
Route::get('chalet/getchalets','ApiController@getchalets');
//http://localhost:8000/api/chalet/getchalets
Route::post('chalet/getchaletdetails','ApiController@getchaletdetails');
//http://localhost:8000/api/chalet/getchaletdetails
Route::post('chalet/getownerchalets','ApiController@getownerchalets');
//http://localhost:8000/api/chalet/getownerchalets
Route::post('chalet/getownerchaletsreservation','ApiController@getownerchaletsreservation');
//http://localhost:8000/api/chalet/getownerchaletsreservation

//Image API
Route::post('image','ApiController@indeximages');
//http://localhost:8000/api/image
Route::post('image/store', 'ApiController@storeimage');
//http://localhost:8000/api/image/store



Route::get('user','Auth\RegisterController@index');
//http://localhost:8000/api/user
Route::get('addnewmember','ApiController@addnewmember');
//http://localhost:8000/api/addnewmember

Route::post('user/store', 'ApiController@storeuser');
//http://localhost:8000/api/user/store



Route::post('reservation/store', 'ApiController@storereservation');
//http://localhost:8000/api/reservation/store
Route::post('reservation/getuserreservations', 'ApiController@getuserreservations');
//http://localhost:8000/api/reservation/getuserreservations
Route::post('reservation/getsreservationdetails', 'ApiController@getsreservationdetails');
//http://localhost:8000/api/reservation/getsreservationdetails



Route::post('chalet/getownerchalets', 'ApiController@getownerchalets');
//http://localhost:8000/api/chalet/getownerchalets

Route::post('getreservationchalet', 'ApiController@getreservationchalet');
//http://localhost:8000/api/getreservationchalet



//Service API
Route::post('service/addnewservice', 'ApiController@addnewservice');
//http://localhost:8000/api/service/addnewservice
Route::get('service/getservices', 'ApiController@getservices');
//http://localhost:8000/api/service/getservices



//Detail API
Route::post('detail/addnewdetail', 'ApiController@addnewdetail');
//http://localhost:8000/api/detail/addnewdetail
Route::get('detail/getdetails', 'ApiController@getdetails');
//http://localhost:8000/api/detail/getdetails
Route::post('chalet/storedetails', 'ApiController@storedetails');
//http://localhost:8000/api/chalet/storedetails



//Comment API
Route::post('comment/store', 'ApiController@storecomment');
//http://localhost:8000/api/comment/store
Route::get('comments','ApiController@indexcomments');
//http://localhost:8000/api/comments
Route::post('comment/edit','ApiController@editcomment');
//http://localhost:8000/api/comment/edit
Route::post('comment/update','ApiController@updatecomment');
//http://localhost:8000/api/comment/update
Route::post('comment/delete', 'ApiController@destroycomment');
//http://localhost:8000/api/comment/delete



//Rate API
Route::post('rate/store', 'ApiController@storerate');
//http://localhost:8000/api/rate/store
Route::get('rates','ApiController@indexrates');
//http://localhost:8000/api/rates
Route::post('rate/edit','ApiController@editrate');
//http://localhost:8000/api/rate/edit
Route::post('rate/update','ApiController@updaterate');
//http://localhost:8000/api/rate/update
Route::post('rate/delete', 'ApiController@destroyrate');
//http://localhost:8000/api/rate/delete
Route::post('rate/getuserrates','ApiController@getuserrates');
//http://localhost:8000/api/rate/getuserrates
Route::post('rate/getchaletrates','ApiController@getchaletrates');
//http://localhost:8000/api/rate/getchaletrates



//FavoriteChalets API
Route::post('favoritechalet/storefavoritechalet', 'ApiController@storefavoritechalet');
//http://localhost:8000/api/favoritechalet/storefavoritechalet
Route::post('favoritechalet/getfavoritechalets','ApiController@getfavoritechalets');
//http://localhost:8000/api/favoritechalet/getfavoritechalets
Route::post('favoritechalet/deletefavoritechalet','ApiController@deletefavoritechalet');
//http://localhost:8000/api/favoritechalet/deletefavoritechalet

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});