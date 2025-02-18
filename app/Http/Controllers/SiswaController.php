<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('home', compact('siswa'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
        ]);


        $siswa = Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Siswa berhasil ditambahkan!',
                'data' => $siswa
            ]);
        }

        return redirect()->route('home')->with('success', 'Siswa berhasil ditambahkan!');
    }
}
