<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // READ (ambil semua data)
    public function index()
    {
        return response()->json(Mahasiswa::all());
    }

    // CREATE (tambah data)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'jurusan' => 'required'
        ]);

        $mhs = Mahasiswa::create($request->all());

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $mhs
        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        $mhs->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $mhs
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}