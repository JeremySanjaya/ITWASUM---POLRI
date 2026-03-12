<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;

class PresensiController extends Controller
{
    // --- HALAMAN USER ---
    public function index()
    {
        return view('presensi.halaman_1');
    }

    public function signature(Request $request)
    {
        $request->session()->put('data_step1', $request->all());
        return view('presensi.halaman_2');
    }

    public function store(Request $request)
    {
        $dataStep1 = session()->get('data_step1');

        if (!$dataStep1) {
            return redirect()->route('presensi.index');
        }

        Presensi::create([
            'nama_lengkap'       => $dataStep1['nama_lengkap'],
            'pangkat_nrp'        => $dataStep1['pangkat_nrp'],
            'jabatan_struktural' => $dataStep1['jabatan_struktural'],
            'jabatan_panitia'    => $dataStep1['jabatan_panitia'],
            'satker'             => $dataStep1['satker'],
            'pelaksanaan'        => $dataStep1['pelaksanaan'],
            'tanda_tangan'       => $request->tanda_tangan,
        ]);

        session()->forget('data_step1');
        return redirect()->route('presensi.success');
    }

    public function success()
    {
        return view('presensi.halaman_3');
    }

    // --- HALAMAN ADMIN (TANPA PROTEKSI) ---
    public function dashboard()
    {
        // Langsung ambil data tanpa tanya login
        $data = Presensi::orderBy('created_at', 'DESC')->get();
        return view('presensi.dashboard', compact('data'));
    }
}