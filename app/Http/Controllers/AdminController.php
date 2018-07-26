<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Userinfo;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Session;

session()->regenerate();
error_reporting(0);

class AdminController extends Controller
{
    public function index()
  {
   // $id             = Auth::user()->id;
   // $admins         = Admin::find($id);
   return view('admin');
  }

    public function view()
  {
    return view('/tambahStaff');
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
    $info->notify(new SendPassword());
    session()->put('nama', $request->input('name'));
    session()->put('password', $pswd);

    session()->flash('success', 'Tambah Anggota Berhasil!');
    return redirect()->back();
    //echo 'aaa';
  }

}
