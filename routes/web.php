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
Auth::routes();
Route::group(['middleware' => 'guest'],function(){
    Route::get('/', function()
    {
        return view('auth.login');
    });

});

Route::group(['middleware' => 'auth'],function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    ####################### start Clients #################################
        Route::group(['namespace' => 'App\Http\Controllers\Client'],function(){

            Route::resource('client', 'ClientController');

        });
    ####################### End Clients ###################################

    ####################### start Projects #################################
    Route::group(['namespace' => 'App\Http\Controllers\Project'],function(){

        Route::resource('project', 'ProjectController');
    });

    ####################### End Projects ###################################

    ####################### start Tasks #################################
    Route::group(['namespace' => 'App\Http\Controllers\tasks'],function(){

        Route::resource('task', 'TaskController');
    });

    ####################### End Tasks ###################################

    Route::group(['namespace' => 'App\Http\Controllers\User'],function(){

        Route::resource('user', 'UserController');


    });




});

