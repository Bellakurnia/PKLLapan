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

    public function count1 ()
    {
      $count1 = Count1::count1();
      return View::make('count1')->with('count1', $count1);
    }
    
    public function viewHome()
    {
        return view('Peneliti/home');
    }

    public function viewAgam()
    {
        return view('Peneliti/agam');
    }

    public function viewBiak()
    {
        return view('Peneliti/biak');
    }

    public function viewGarut()
    {
        return view('Peneliti/garut');
    }

    public function viewKupang()
    {
        return view('Peneliti/kupang');
    }

    public function viewManado()
    {
        return view('Peneliti/manado');
    }

    public function viewPontianak()
    {
        return view('Peneliti/pontianak');
    }

    public function viewSumedang()
    {
        return view('Peneliti/sumedang');
    }

    public function viewPasuruan()
    {
        return view('Peneliti/pasuruan');
    }

    public function viewYogyakarta()
    {
        return view('Peneliti/yogyakarta');
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
