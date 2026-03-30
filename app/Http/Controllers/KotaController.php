<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KotaController extends Controller {
    public function index() {
        $kota = Kota::with('provinsi')->get();
        $provinsi = Provinsi::all();
        return view('admin.kota.index', compact('kota', 'provinsi'));
    }
    public function store(Request $request) {
        $request->validate(['id_provinsi' => 'required', 'kota' => 'required']);
        Kota::create($request->all());
        return back()->with('success', 'Kota berhasil ditambah');
    }
    public function update(Request $request, $id) {
        Kota::findOrFail($id)->update($request->all());
        return back()->with('success', 'Kota berhasil diupdate');
    }
    public function destroy($id) {
        $kota = Kota::findOrFail($id);
        if(\App\Models\Universitas::where('kota_id', $id)->exists()) return back()->with('error', 'Kota masih digunakan oleh Universitas!');
        $kota->delete();
        return back()->with('success', 'Kota dihapus');
    }
}
