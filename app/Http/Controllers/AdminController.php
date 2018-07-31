<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Userinfo;
use App\File;
use App\Alat;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Session;
use App\sidebar;
use Chart;

session()->regenerate();
error_reporting(0);

class AdminController extends UserController
{
    public function index()
    {
     return view('admin');
    }

    public function view()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('/tambahStaff', compact('side'));
    }

    public function create(Request $request)
    {
      $pswd = Session::get('password');
      $this->validate($request, array(
              'name'          => 'required|max:100',
              'email'         => 'required|unique:users,email,',
  //            'password'      => 'required|max:100',
              'identitas'     => 'required',
              'jabatan'        => 'required',
              //'avatar'        => 'mimes:jpeg,jpg,png,gif|max:10000'
          ));

      $user   = User::create([
              'name'           => $request->input('name'),
              'email'          => $request->input('email'),
              'password'       => Hash::make($pswd),
              'identitas'      => $request->input('identitas'),
              'isAdmin'        => $request->input('jabatan'),
          ]);

      $info = Userinfo::latest()->first($info);
      session()->put('nama', $request->input('name'));
      session()->put('password', $pswd);
      $info->notify(new SendPassword());

      session()->flash('success', 'Tambah Anggota Berhasil!');
      return redirect()->back();
      //echo 'aaa';
    }

    public function viewCabang($id)
    {
        $side   = sidebar::orderBy('id_cabang')->get();
        $file = File::orderBy('id_file')->get();
        $alat = Alat::orderBy('id_alat')->get();
        session()->put('file', $file);
        session()->put('id', $id);
        session()->put('alat', $alat);
        // dd((integer)$id);
        return view('Agam', compact('side'));

    }

    public function readAll()
    {
        $readUser = User::orderBy('id')->get();
        $side   = sidebar::orderBy('id_cabang')->get();
        return view('/lihatStaff', compact('readUser'), compact('side'));
    }

    public function destroy($id)
    {
        $user   = User::find($id);
        $user->delete();
        session()->flash('deleteNotif', 'Delete Succesful!');
        return redirect()->route('lihatStaff.readAll');
    }

    public function profilAdmin()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('profil', compact('side'));
    }

    public function tambahCabang()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('tambahCabang', compact('side'));
    }

    public function createCabang(Request $request)
    {
      $this->validate($request, array(
              'name'          => 'required|max:100',
              'ip_server'      => 'required',
          ));

          $process = new Process('python ../routes/cabang.py');
          $process->run();

          if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
          }

          $output = $process->getOutput();
          $myarray = array();
          $myarray = preg_split('/\r\n/', $output);
          unset($myarray[2]);

          // dd($myarray);

      $user   = Cabang::create([
              'nama_cabang'   => $request->input('name'),
              'ip_server'     => $request->input('ip_server'),
              'longitude'     => $myarray[1],
              'latitude'      => $myarray[0],
          ]);

      session()->flash('success', 'Cabang Berhasil Ditambahkan');
      return redirect()->back();
    }
}
