<?php

use App\Http\Controllers\Controller;
use App\Notifications\SendPassword;
use App\Userinfo;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use vendor\laravel\framework\src\Illuminate\Contracts\Support\Htmlable;
session()->regenerate();
error_reporting(0);

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
Route::get('/profile', function () {
    return view('kapus/profile');
});
Route::get('/agam', function () {
    return view('kapus/agam');
});
Route::get('/biak', function () {
    return view('kapus/biak');
});
Route::get('/garut', function () {
    return view('kapus/garut');
});
Route::get('/kupang', function () {
    return view('kapus/kupang');
});
Route::get('/manado', function () {
    return view('kapus/manado');
});
Route::get('/pasuruan', function () {
    return view('kapus/pasuruan');
});
Route::get('/pontianak', function () {
    return view('kapus/pontianak');
});
Route::get('/sumedang', function () {
    return view('kapus/sumedang');
});
Route::get('/yogyakarta', function () {
    return view('kapus/yogyakarta');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('admin.dashboard');
// Route::get('/home', 'UserController@view_home')->name('kapus.dashboard');
//Route::get('/ea', function(){
  //run cmd
  //$process = new Process('python as.py');
  //$process->run();
  //sampe sini
//});

Route::prefix('admin')->group(function(){
  Route::get('/tambahStaff', 'AdminController@view')->name('tambahStaff.view');
  Route::post('/tambahStaff', 'AdminController@create')->name('tambahStaff.create');

  Route::get('/lihatStaff', 'UserController@readAll')->name('lihatStaff.readAll');
  Route::delete('/lihatStaff/{id}/delete', 'UserController@destroy')->name('lihatStaff.destroy');
});
