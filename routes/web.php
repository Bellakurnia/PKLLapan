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
Route::get('/agam', function () {
    return view('Peneliti/agam');
});
Route::get('/biak', function () {
    return view('Peneliti/biak');
});
Route::get('/garut', function () {
    return view('Peneliti/garut');
});
Route::get('/kupang', function () {
    return view('Peneliti/kupang');
});
Route::get('/manado', function () {
    return view('Peneliti/manado');
});
Route::get('/pontianak', function () {
    return view('Peneliti/pontianak');
});
Route::get('/sumedang', function () {
    return view('Peneliti/sumedang');
});

Route::get('/pasuruan', function () {
    return view('Peneliti/pasuruan');
});

Route::get('/yogyakarta', function () {
    return view('Peneliti/yogyakarta');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('admin.dashboard');
Route::get('/home', 'UserController@viewHome')->name('Peneliti.dashboard');
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
