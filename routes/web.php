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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('admin.dashboard');


//Route::get('/ea', function(){
  //run cmd
  //$process = new Process('python as.py');
  //$process->run();
  //sampe sini
//});

Route::prefix('admin')->group(function(){
  Route::get('/tambahStaff', 'AdminController@view')->name('tambahStaff.view');
  Route::post('/tambahStaff', 'AdminController@create')->name('tambahStaff.create');

  Route::get('/lihatStaff', 'AdminController@readAll')->name('lihatStaff.readAll');
  Route::delete('/lihatStaff/{id}/delete', 'AdminController@destroy')->name('lihatStaff.destroy');

  Route::get('/profil', 'AdminController@profilAdmin')->name('profilAdmin');
  Route::post('/profil', 'UserController@gantiPassword')->name('ganti.password');

  Route::get('/home/{id_cabang}', 'AdminController@viewCabang')->name('lihat.agam');

  Route::get('/home/tambahCabang', 'AdminController@tambahCabang')->name('tambah.cabang');
});

Route::get('/pdf', 'PDFController@getPDF');

Route::get('/ea', function(){
$mysqli = new mysqli("localhost", "root", "", "siaplapan");

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

  $process = new Process('python D:/Coba/htdocs/siapLapan/routes/as.py');
  $process->run();

  if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
	}

  $output = $process->getOutput();
  $myarray = array();
  $output = str_replace('[', '', $output);
  $output = str_replace('"', '', $output);
  $output = str_replace(']]', ']', $output);
  $output = str_replace('],', ']', $output);
  $myarray = explode(']', $output);

  $daerah = explode(', ', $myarray[0]);
  array_splice($myarray,0,1);

  $fail = array();

  for($i=0;$i<count($myarray);$i++) {
	   $fail[$i] = explode(', ', $myarray[$i]);
	}

  for($i=0;$i<count($myarray);$i++) {
	   $fail[$i][0] = substr($fail[$i][0], 1);
  }

  for($i=0;$i<count($daerah);$i++) {
  	if($daerah[$i] == 'Biak') {
  		$id_daerah = 1;
  	}
  	else if($daerah[$i] == 'Pontianak') {
  		$id_daerah = 2;
  	}
  	else if($daerah[$i] == 'Sumedang') {
  		$id_daerah = 3;
  	}
  	else if($daerah[$i] == 'Garut') {
  		$id_daerah = 4;
  	}
  	else if($daerah[$i] == 'Pasuruan') {
  		$id_daerah = 5;
  	}
  	else if($daerah[$i] == 'Kupang') {
  		$id_daerah = 6;
  	}
  	else if($daerah[$i] == 'Manado') {
  		$id_daerah = 7;
  	}
  	else if($daerah[$i] == 'Agam') {
  		$id_daerah = 8;
  	}
  	for($j=0;$j<count($fail[$i]);$j++) {
  		if(strpos($fail[$i][$j], 'MD4') !== false) {
  			$id_alat = 1;
  		}
  		else if(strpos($fail[$i][$j], 'BIK') !== false) {
  			$id_alat = 2;
  		}
  		else if(strpos($fail[$i][$j], 'PTK') !== false) {
  			$id_alat = 3;
  		}

  		$str = $fail[$i][$j];
  		$sql = "INSERT INTO file (id_cabang, id_alat, nama_file) VALUES ('$id_daerah', '$id_alat', '$str')";
  		$mysqli->query($sql) === true;
  	}
  }

if($mysqli->query($sql) === true) {
    echo "Records inserted successfully.";
}

else {
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

$mysqli->close();
});
