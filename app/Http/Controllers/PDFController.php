<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Userinfo;
use App\Cabanginfo;
use App\Alatinfo;
use PDF;

class PDFController extends Controller
{
  public function getPDF() {
    //$Users = Userinfo::orderBy('id')->get();
    //$pdf = PDF::loadView('anggota', compact('Users'));
    //return $pdf->stream('Laporan Anggota Sistem siapLapan.pdf');

    // $cabang = Cabanginfo::orderBy('id_cabang')->get();
    // $pdf = PDF::loadView('cabang', compact('cabang'));
    // return $pdf->stream('Laporan Cabang Sistem siapLapan.pdf');

    // $alat = Alatinfo::orderBy('id_alat')->get();
    // $pdf = PDF::loadView('alat', compact('alat'));
    // return $pdf->stream('Laporan Alat Sistem siapLapan.pdf');

    $pdf = PDF::loadView('cuba');
    return $pdf->stream('Kop Surat siapLapan.pdf');
  }
}
