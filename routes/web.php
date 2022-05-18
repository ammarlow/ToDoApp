<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('verified');
Route::post('/saveUser', 'AdminController@store');
Route::post('deleteUser/{id}', 'AdminController@destroy');
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/save', 'HomeController@store');
Route::post('/updateCompletion/{id}', 'HomeController@edit');
Route::post('delete/{id}', 'HomeController@destroy');
Route::get('/editTask', 'EditTaskController@index')->name('editTask');
Route::post('/update/{id}', 'EditTaskController@edit');
Route::get('/editUser', 'EditUserController@index')->name('editUser');
Route::post('/updateUser/{id}', 'EditUserController@edit');

//For adding an image
Route::get('/add-image',[App\Http\Controllers\ImageUploadController::class,'addImage'])->name('images.add');

//For storing an image
Route::post('/store-image',[App\Http\Controllers\ImageUploadController::class,'storeImage'])
->name('images.store');

//For showing an image
Route::get('/viewImage',[App\Http\Controllers\ImageUploadController::class,'viewImage'])->name('viewImage');

Route::view('/apiTodo', 'apiTodo');

