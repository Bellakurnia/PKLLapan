<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Userinfo;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Session;
use App\sidebar;

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
        // $side   = sidebar::where('id_cabang', '=', $id)->get();
        $side = sidebar::orderBy('id_cabang')->get();
        return view('Agam', compact('side'));
    }

    public function tambahCabang()
    {
      return view('tambahCabang');
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
}
