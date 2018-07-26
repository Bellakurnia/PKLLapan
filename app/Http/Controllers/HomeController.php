<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Storage;
use App\sidebar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $side   = sidebar::orderBy('id_cabang')->get();
        if(auth()->user()->isAdmin==1) {
          $id             = Auth::user()->id;
          $admins         = User::find($id);
          return view('homeAdmin', compact('side'));
        }
        else {
          return view('home', compact('side'));
        }

    }

    public function admin()
    {
        return view('admin');
    }

}
