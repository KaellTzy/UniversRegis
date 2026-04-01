@extends('layouts.admin.admin') {{-- Pastikan ini sesuai dengan nama layout utama Anda --}}

@section('content')
    <style>
        /* Memastikan dropdown terlihat jelas di dalam modal */
        .modal-body select {
            color: #000 !important;
            background-color: #fff !important;
        }

        .modal {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold">Daftar Universitas & Passing Grade</h5>
                        <div>
                            <a href="{{ route('admin.universitas.export') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                            <button type="button" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal"
                                data-bs-target="#modalTambah">
                                <i class="fas fa-plus"></i> Tambah Universitas
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Universitas</th>
                                        <th>Prodi</th>
                                        <th>Lokasi</th>
                                        <th class="text-center">Min. UTBK</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($uni as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="fw-bold">{{ $u->nama }}</span><br>
                                                <small class="text-muted">Kode: {{ $u->kode_prodi }}</small>
                                            </td>
                                            <td>{{ $u->prodi->nama ?? 'Data Prodi Hilang' }}</td>
                                            <td>
                                                <small>{{ $u->kota->kota ?? '-' }},
                                                    {{ $u->provinsi->provinsi ?? '-' }}</small>
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge bg-info text-dark">{{ $u->minimal_nilai_utbk }}</span></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $u->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.universitas.destroy', $u->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $u->nama }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm ms-1">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content text-dark">
                                                    <form action="{{ route('admin.universitas.update', $u->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data: {{ $u->nama }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Universitas</label>
                                                                <input type="text" name="nama" class="form-control"
                                                                    value="{{ $u->nama }}" required>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Provinsi</label>
                                                                    <select name="provinsi_id" class="form-select" required>
                                                                        <option value="" disabled selected>Pilih
                                                                            Provinsi</option>
                                                                        @foreach ($provinsi as $p)
                                                                            <option value="{{ $p->id }}">
                                                                                {{ $p->provinsi }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Kota</label>
                                                                    <select name="kota_id" class="form-select" required>
                                                                        <option value="" disabled selected>Pilih Kota
                                                                        </option>
                                                                        @foreach ($kota as $k)
                                                                            <option value="{{ $k->id }}">
                                                                                {{ $k->kota }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Program Studi</label>
                                                                <select name="prodi_id" class="form-select" required>
                                                                    @foreach ($prodi as $pr)
                                                                        <option value="{{ $pr->id }}"
                                                                            {{ $u->prodi_id == $pr->id ? 'selected' : '' }}>
                                                                            {{ $pr->nama_prodi ?? $pr->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kode Prodi</label>
                                                                <input type="text" name="kode_prodi" class="form-control"
                                                                    value="{{ $u->kode_prodi }}" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Min. UTBK</label>
                                                                    <input type="number" name="minimal_nilai_utbk"
                                                                        class="form-control"
                                                                        value="{{ $u->minimal_nilai_utbk }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">Data universitas belum
                                                ada. Klik "Tambah Universitas".</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <form action="{{ route('admin.universitas.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Universitas Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Universitas</label>
                            <input type="text" name="nama" class="form-control"
                                placeholder="Contoh: Universitas Gadjah Mada" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Provinsi</label>
                                <select name="provinsi_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    @foreach ($provinsi as $p)
                                        <option value="{{ $p->id }}">{{ $p->provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kota</label>
                                <select name="kota_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kota</option>
                                    @foreach ($kota as $k)
                                        <option value="{{ $k->id }}">{{ $k->kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Program Studi</label>
                            <select name="prodi_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Prodi</option>
                                @foreach ($prodi as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->nama_prodi ?? $pr->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Prodi</label>
                            <input type="text" name="kode_prodi" class="form-control" placeholder="Contoh: UGM-01"
                                required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Min. Nilai UTBK</label>
                                <input type="number" name="minimal_nilai_utbk" class="form-control" placeholder="700"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
