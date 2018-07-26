<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function readAll()
    {
        $readUser = User::orderBy('id')->get();

        return view('/lihatStaff', compact('readUser'));
    }

    public function view($id)
    {
        $user   = User::find($id);
        return view('lihatAnggota', compact('user'));
    }

    public function count()
    {
      $count = Count::count();
      return View::make('count')->with('count', $count);
    }

    public function view_home()
    {
        return view('kapus/home');
    }

    public function view_profile()
    {
        return view('kapus/profile');
    }

    public function view_agam()
    {
        return view('kapus/agam');
    }

    public function view_biak()
    {
        return view('kapus/biak');
    }

    public function view_garut()
    {
        return view('kapus/garut');
    }

    public function view_kupang()
    {
        return view('kapus/kupang');
    }

    public function view_manado()
    {
        return view('kapus/manado');
    }

    public function view_pasuruan()
    {
        return view('kapus/pasuruan');
    }

    public function view_pontianak()
    {
        return view('kapus/pontianak');
    }

    public function view_sumedang()
    {
        return view('kapus/sumedang');
    }

    public function view_yogyakarta()
    {
        return view('kapus/yogyakarta');
    }

    public function destroy($id)
    {
        $user   = User::find($id);
        $user->delete();
        session()->flash('deleteNotif', 'Delete Succesful!');
        return redirect()->route('lihatStaff.readAll');
    }

    public function edit($id)
    {
        $user   = User::find($id);

        return view('/editAnggota', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name'          => 'required|max:100',
            'firm'          => 'required',
            'description'   => 'required',
            'gda'           => 'required|min:1.75|max:4|numeric',
            'semesters'     => 'required',
            'deadline'      => 'required',
            'faculties'     => 'required',
            'programs'      => 'required',
            'image'         => 'mimes:jpeg,jpg,png,gif|max:10000'

        ));

        $faculty    = implode(",", $request->faculties);
        $program    = implode(";", $request->programs);
        $semester   = implode(",", $request->semesters);
        $tanggal    = $request->deadline;
        $date       = date("Y-m-d", strtotime($tanggal));


        $updateScholarship = scholarship::find($id);
        if($request->file('image') != null){
            Storage::delete($updateScholarship->image);
            $image  = $request->file('image')->store('beasiswa');
        } else{
            $image  = $updateScholarship->image;
        }
        $updateScholarship->update([
            'name'          => $request->input('name'),
            'firm'          => $request->input('firm'),
            'description'   => $request->input('description'),
            'applyOnline'   => 1,
            'image'         => $image,
        ]);
        $updateScholarship->requirement->update([
            'gda'        => $request->input('gda'),
            'semester'   => $semester,
            'deadline'   => $date,
            'faculty'    => $faculty,
            'program'    => $program
        ]);
        if (isset($request->tags)) {
            $updateScholarship->tags()->sync($request->tags);
        } else {
            $updateScholarship->tags()->sync(array());
        }
        session()->flash('notif', 'Edit Succesful!');
        return redirect()->route('scholarship.view', compact('id'));
    }
}
