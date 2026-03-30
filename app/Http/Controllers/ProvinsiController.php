<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $provinsi = Provinsi::all();
        return view('admin.provinsi.index', compact('provinsi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|unique:provinsis,provinsi'
        ]);

        Provinsi::create([
            'provinsi' => $request->provinsi
        ]);

        return redirect()->route('admin.provinsi.index')->with('success', 'Data Provinsi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'provinsi' => 'required|unique:provinsis,provinsi,' . $id
        ]);

        $prov = Provinsi::findOrFail($id);
        $prov->update([
            'provinsi' => $request->provinsi
        ]);

        return redirect()->route('admin.provinsi.index')->with('success', 'Data Provinsi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $prov = Provinsi::findOrFail($id);

        // Proteksi: Cek apakah provinsi ini memiliki data kota
        if ($prov->kota()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus! Masih ada data Kota yang terhubung dengan provinsi ini.');
        }

        $prov->delete();
        return redirect()->route('admin.provinsi.index')->with('success', 'Data Provinsi berhasil dihapus');
    }
}
