<?php

namespace App\Http\Controllers;

use App\Exports\UniversitasExport;
use App\Models\Kota;
use App\Models\Pendaftaran;
use App\Models\Prodi;
use App\Models\Provinsi;
use App\Models\Universitas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class UniversitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data universitas dengan relasinya
        $uni = Universitas::with(['prodi', 'kota', 'provinsi'])->get();

        // Mengambil data master untuk isi dropdown di modal Tambah/Edit
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $prodi = Prodi::all();

        // Pastikan semua variabel ini di-compact ke view
        return view('admin.universitas.index', compact('uni', 'provinsi', 'kota', 'prodi'));
    }

    public function export()
    {
        return Excel::download(new UniversitasExport(), 'Data-Universitas.xlsx');
    }

    public function exportPDF()
    {
        $uni = Universitas::all();

        $pdf = Pdf::loadView('pdf.Universitas', compact('uni'));

        return $pdf->download('Data-Univ.pdf'); // Langsung download
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kota_id' => 'required',
            'provinsi_id' => 'required',
            'kode_prodi' => 'required',
            'prodi_id' => 'required',
            'minimal_nilai_utbk' => 'required',
        ]);

        $uni = new Universitas();
        $uni->nama = $request->nama;
        $uni->kota_id = $request->kota_id;
        $uni->provinsi_id = $request->provinsi_id;
        $uni->kode_prodi = $request->kode_prodi;
        $uni->prodi_id = $request->prodi_id;
        $uni->minimal_nilai_utbk = $request->minimal_nilai_utbk;
        $uni->save();

        return redirect()->route('admin.universitas.index')->with('success', 'Data Universitas berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Universitas $universitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Universitas $universitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Gunakan $id agar lebih aman
        $request->validate([
            'nama' => 'required',
            'kota_id' => 'required',
            'provinsi_id' => 'required',
            'kode_prodi' => 'required',
            'prodi_id' => 'required',
            'minimal_nilai_utbk' => 'required',
        ]);

        $uni = Universitas::findOrFail($id);
        $uni->nama = $request->nama;
        $uni->kota_id = $request->kota_id; // Perbaikan: gunakan kota_id
        $uni->provinsi_id = $request->provinsi_id; // Perbaikan: gunakan provinsi_id
        $uni->prodi_id = $request->prodi_id;
        $uni->kode_prodi = $request->kode_prodi;
        $uni->minimal_nilai_utbk = $request->minimal_nilai_utbk;
        $uni->save();

        return redirect()->route('admin.universitas.index')->with('success', 'Data Universitas berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $uni = Universitas::findOrFail($id);

        // GUNAKAN 'ptn_dan_prodi' (bukan universitas_id)
        $hasPendaftar = \App\Models\Pendaftaran::where('ptn_dan_prodi', $id)->exists();

        if ($hasPendaftar) {
            return redirect()->back()->with('error', 'Gagal! Universitas ini tidak bisa dihapus karena sudah memiliki pendaftar.');
        }

        $uni->delete();
        return redirect()->route('admin.universitas.index')->with('success', 'Data berhasil dihapus');
    }
}
