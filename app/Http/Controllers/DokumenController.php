<?php

namespace App\Http\Controllers;

use App\Exports\PendaftaranExport;
use App\Models\Pendaftaran; // Controller ini ternyata menggunakan model Pendaftaran
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data pendaftaran yang statusnya diproses
        $dokumen = Pendaftaran::with('peserta')->where('status', 'diproses')->get();
        return view('admin.dokumen.index', compact('dokumen'));
    }

    /**
     * Method Baru: Menampilkan halaman penilaian dokumen
     */
    public function nilai($id)
    {
        // Ubah nama variabel dari $data menjadi $dokumen
        $dokumen = Pendaftaran::with('peserta')->findOrFail($id);

        // Kirim variabel $dokumen ke view
        return view('admin.dokumen.nilai', compact('dokumen'));
    }

    public function export()
    {
        return Excel::download(new PendaftaranExport(), 'Data-Pendaftaran.xlsx');
    }

    public function exportPDF()
    {
        $dokumen = Pendaftaran::all();
        $pdf = Pdf::loadView('pdf.dokumen', compact('dokumen'));
        return $pdf->download('Data-Validasi-dokumen.pdf');
    }

    public function show(string $id)
    {
        $dokumen = Pendaftaran::findOrFail($id);
        return view('admin.dokumen.dokumen', compact('dokumen'));
    }

    // Sisanya tetap sama...
    public function update(Request $request, string $id)
    {
        $dokumen = Pendaftaran::findOrFail($id);
        $dokumen->status = $request->status;
        $dokumen->save();
        return redirect()->route('admin.dokumen.index')->with('success', 'Status Berhasil Di Update');
    }

    public function destroy(string $id)
    {
        $dokumen = Pendaftaran::findOrFail($id);
        $dokumen->delete(); // Tambahkan delete() agar data benar-benar terhapus dari DB
        return redirect()->route('admin.dokumen.index')->with('success', 'Data Berhasil di hapus');
    }
}
