<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Todo;

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

Route::get('todo', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Todo::all();
});

Route::get('todo/{id}', function($id) {
    return Todo::find($id);
});

Route::post('todo', function(Request $request) {
    return Todo::create($request->all);
});

Route::put('todo/{id}', function(Request $request, $id) {
    $todo = Todo::findOrFail($id);
    $todo->update($request->all());

    return $todo;
});

Route::delete('todo/{id}', function($id) {
    Todo::find($id)->delete();

    return 204;
});

Route::get('todo', 'HomeController@index');
Route::get('todo/{id}', 'HomeController@show');
Route::post('todo', 'HomeController@store');
Route::put('todo/{id}', 'HomeController@update');
Route::delete('todo/{id}', 'HomeController@delete');
