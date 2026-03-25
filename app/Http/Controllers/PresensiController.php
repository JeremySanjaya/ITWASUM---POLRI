<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\MasterOption;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function index()
    {
        $struktural = MasterOption::where('kategori', 'struktural')
            ->orderByRaw("CASE 
                WHEN nama_opsi LIKE '% IV' THEN 4
                WHEN nama_opsi LIKE '% III' THEN 3
                WHEN nama_opsi LIKE '% II' THEN 2
                WHEN nama_opsi LIKE '% I' THEN 1
                ELSE 99 END ASC")
            ->get();

        $panitia = MasterOption::where('kategori', 'panitia')->orderBy('nama_opsi')->get();
        $satker  = MasterOption::where('kategori', 'satker')->orderBy('nama_opsi')->get();

        return view('presensi.halaman_1', compact('struktural', 'panitia', 'satker'));
    }

    public function signature(Request $request)
    {
        session(['data_input' => $request->all()]);
        return view('presensi.halaman_2');
    }

    public function store(Request $request)
    {
        $dataInput = session('data_input');
        Presensi::create([
            'nama_lengkap'       => trim($dataInput['nama_lengkap'] ?? '-'),
            'pangkat_nrp'        => trim($dataInput['pangkat_nrp'] ?? '-'),
            'jabatan_struktural' => trim($dataInput['jabatan_struktural'] ?? '-'),
            'jabatan_panitia'    => trim($dataInput['jabatan_panitia'] ?? '-'),
            'satker'             => trim($dataInput['satker'] ?? '-'),
            'pelaksanaan'        => trim($dataInput['pelaksanaan'] ?? '-'),
            'tanda_tangan'       => $request->tanda_tangan,
        ]);
        session()->forget('data_input');
        return redirect()->route('presensi.success');
    }

    // FIX: Arahkan ke file halaman_3.blade.php
    public function success()
    {
        return view('presensi.halaman_3');
    }

    /**
     * DASHBOARD ADMIN - FIX FILTER IRWIL II & III
     */
    public function dashboard(Request $request)
    {
        $query = Presensi::query();

        if ($request->filled('search_nama')) {
            $query->where('nama_lengkap', 'like', '%' . trim($request->search_nama) . '%');
        }

        // Filter Struktural - Pakai Exact Match biar Irwil II gak bocor ke III
        if ($request->filled('search_struktural')) {
            $val = trim($request->search_struktural);
            $query->whereRaw("TRIM(jabatan_struktural) = ?", [$val]);
        }

        if ($request->filled('search_satker')) {
            $query->where('satker', 'like', '%' . trim($request->search_satker) . '%');
        }

        if ($request->filled('search_pelaksanaan')) {
            $query->where('pelaksanaan', $request->search_pelaksanaan);
        }

        if ($request->filled('tgl_mulai') && $request->filled('tgl_akhir')) {
            $query->whereDate('created_at', '>=', $request->tgl_mulai)
                  ->whereDate('created_at', '<=', $request->tgl_akhir);
        }

        $data = $query->orderBy('created_at', 'DESC')->get();

        $opt_struktural = MasterOption::where('kategori', 'struktural')
            ->orderByRaw("CASE 
                WHEN nama_opsi LIKE '% IV' THEN 4
                WHEN nama_opsi LIKE '% III' THEN 3
                WHEN nama_opsi LIKE '% II' THEN 2
                WHEN nama_opsi LIKE '% I' THEN 1
                ELSE 99 END ASC")
            ->get();

        $opt_panitia = MasterOption::where('kategori', 'panitia')->orderBy('nama_opsi')->get();
        $opt_satker  = MasterOption::where('kategori', 'satker')->orderBy('nama_opsi')->get();
        $options     = MasterOption::orderBy('kategori')->get();

        return view('presensi.dashboard', compact('data', 'options', 'opt_struktural', 'opt_panitia', 'opt_satker'));
    }

    public function addOption(Request $request)
    {
        MasterOption::create(['kategori' => $request->kategori, 'nama_opsi' => trim($request->nama_opsi)]);
        return back()->with('success', 'Berhasil!');
    }

    public function deleteOption($id)
    {
        MasterOption::findOrFail($id)->delete();
        return back()->with('success', 'Berhasil!');
    }
}