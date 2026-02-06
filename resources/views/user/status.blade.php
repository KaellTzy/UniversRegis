@extends('layouts.user.user')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --surface-white: rgba(255, 255, 255, 0.95);
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    .status-page-wrapper {
        background-color: #f8fafc;
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    #meteorCanvas {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: 0;
        pointer-events: none;
    }

    /* Receipt Card Enhancements */
    .receipt-card {
        background: var(--surface-white);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        position: relative;
        z-index: 1;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
    }

    /* Efek Gerigi Struk */
    .receipt-card::after {
        content: "";
        position: absolute;
        bottom: -10px; left: 0; right: 0;
        height: 20px;
        background-image: radial-gradient(circle at 10px -5px, transparent 12px, var(--surface-white) 13px);
        background-size: 20px 20px;
    }

    .receipt-header {
        background: var(--primary-gradient);
        color: white;
        padding: 50px 20px;
        text-align: center;
        border-radius: 24px 24px 0 0;
        clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%);
    }

    .header-icon-circle {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        backdrop-filter: blur(5px);
    }

    .info-box {
        background: #f1f5f9;
        border-radius: 16px;
        padding: 16px;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .info-box:hover {
        background: white;
        border-color: #e2e8f0;
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .label-custom {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--text-muted);
        font-weight: 700;
        display: block;
        margin-bottom: 4px;
    }

    .value-custom {
        color: var(--text-main);
        font-weight: 700;
        font-size: 0.95rem;
        word-break: break-word; /* Handling nama panjang agar tidak overflow */
    }

    /* Status Badges */
    .status-alert {
        border-radius: 20px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .alert-success-custom {
        background: #f0fdf4;
        color: #166534;
        border-left: 4px solid #22c55e;
    }

    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .score-display {
        background: linear-gradient(to bottom, #ffffff, #f8fafc);
        border: 2px dashed #e2e8f0;
        border-radius: 20px;
    }

    .btn-download {
        background: var(--primary-gradient);
        border: none;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: 0.4s;
        color: white;
    }

    .btn-download:hover {
        opacity: 0.9;
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.4);
        color: white;
    }
</style>

<div class="status-page-wrapper">
    <canvas id="meteorCanvas"></canvas>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">

                @if ($seleksi || $pendaftaran)
                <div class="receipt-card" data-aos="fade-up">
                    <div class="receipt-header">
                        <div class="header-icon-circle">
                            <i class="fas fa-graduation-cap fa-2xl"></i>
                        </div>
                        <h3 class="fw-bold mb-1">HASIL SELEKSI</h3>
                        <p class="small opacity-75 mb-0">Tahun Akademik 2026/2027</p>
                    </div>

                    <div class="p-4 p-md-5">
                        <div class="row g-3 mb-4">
                            @php $data = $seleksi ? $seleksi->pendaftaran : $pendaftaran; @endphp

                            <div class="col-6">
                                <div class="info-box">
                                    <span class="label-custom"><i class="fas fa-id-card me-1"></i> ID Daftar</span>
                                    <div class="value-custom">{{ $data->kode_seleksi }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box">
                                    <span class="label-custom"><i class="fas fa-user me-1"></i> Peserta</span>
                                    {{-- Menampilkan nama lengkap secara utuh --}}
                                    <div class="value-custom">{{ $data->peserta->nama_lengkap }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="label-custom"><i class="fas fa-university me-1"></i> Institusi</span>
                                    <div class="value-custom">{{ $data->ptn->nama }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="label-custom"><i class="fas fa-book-open me-1"></i> Program Studi</span>
                                    <div class="value-custom">{{ $data->ptn->prodi->nama }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="score-display text-center py-4 mb-4">
                            <span class="label-custom">Nilai Akhir</span>
                            <h1 class="display-3 fw-bold text-dark mb-0">
                                {{ $seleksi && $seleksi->nilai_total ? $seleksi->nilai_total : '--' }}
                            </h1>
                            <span class="badge rounded-pill bg-primary px-3">Jalur {{ $data->jalur }}</span>
                        </div>

                        @if($seleksi)
                            @if ($seleksi->status_kelulusan == "lulus")
                                <div class="status-alert alert-success-custom p-4 text-center mb-4">
                                    <i class="fas fa-check-circle fa-2xl mb-3"></i>
                                    <h4 class="fw-bold">Selamat, Anda Lulus!</h4>
                                    <p class="small mb-0 opacity-75">Silahkan unduh sertifikat sebagai bukti kelulusan untuk tahap daftar ulang.</p>
                                </div>
                            @else
                                <div class="status-alert alert-danger-custom p-4 text-center mb-4">
                                    <i class="fas fa-times-circle fa-2xl mb-3"></i>
                                    <h4 class="fw-bold">Belum Berhasil</h4>
                                    <p class="small mb-0 opacity-75">Jangan patah semangat. Masih banyak jalan menuju impian Anda!</p>
                                </div>
                            @endif
                        @else
                            <div class="status-alert {{ $pendaftaran->status == 'ditolak' ? 'alert-danger-custom' : 'bg-light' }} p-4 text-center mb-4">
                                @if($pendaftaran->status == "diproses")
                                    <div class="spinner-border text-primary spinner-border-sm mb-2"></div>
                                    <h5 class="fw-bold">Berkas Sedang Ditinjau</h5>
                                    <p class="small mb-0">Dokumen Anda sedang dalam antrean verifikasi tim seleksi.</p>
                                @elseif($pendaftaran->status == "diterima")
                                    <i class="fas fa-file-signature text-success fa-2xl mb-3"></i>
                                    <h5 class="fw-bold">Verifikasi Berkas Berhasil</h5>
                                    <p class="small mb-0">Data Anda valid. Pengumuman nilai akan segera dirilis.</p>
                                @else
                                    <i class="fas fa-ban fa-2xl mb-3 text-danger"></i>
                                    <h5 class="fw-bold">Berkas Ditolak</h5>
                                    <p class="small mb-0">Ada ketidaksesuaian data pada dokumen yang Anda unggah.</p>
                                @endif
                            </div>
                        @endif

                        @if($seleksi && $seleksi->status_kelulusan == "lulus")
                        <div class="mt-2">
                            <a href="{{ route('status.exportPDF') }}" class="btn btn-download w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-file-pdf"></i>
                                UNDUH SERTIFIKAT KELULUSAN
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class="text-center p-5 receipt-card">
                    <img src="https://illustrations.popsy.co/purple/searching.svg" alt="empty" style="width: 180px" class="mb-4">
                    <h4 class="fw-bold">Belum Ada Data</h4>
                    <p class="text-muted small">Anda belum terdaftar dalam program seleksi manapun.</p>
                    <a href="/" class="btn btn-primary px-4 rounded-pill">Cari Program</a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

<script>
    const canvas = document.getElementById('meteorCanvas');
    const ctx = canvas.getContext('2d');
    let meteors = [];

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    class Meteor {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * canvas.width + 200;
            this.y = Math.random() * canvas.height - 200;
            this.speed = Math.random() * 3 + 1;
            this.len = Math.random() * 60 + 40;
            this.opacity = Math.random() * 0.3;
        }
        draw() {
            ctx.beginPath();
            let gradient = ctx.createLinearGradient(this.x, this.y, this.x - this.len, this.y + this.len);
            gradient.addColorStop(0, `rgba(168, 85, 247, ${this.opacity})`);
            gradient.addColorStop(1, 'rgba(168, 85, 247, 0)');
            ctx.strokeStyle = gradient;
            ctx.lineWidth = 2;
            ctx.moveTo(this.x, this.y);
            ctx.lineTo(this.x - this.len, this.y + this.len);
            ctx.stroke();
        }
        update() {
            this.x -= this.speed;
            this.y += this.speed;
            if (this.y > canvas.height + 100 || this.x < -100) this.reset();
        }
    }

    for (let i = 0; i < 12; i++) meteors.push(new Meteor());

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        meteors.forEach(m => { m.update(); m.draw(); });
        requestAnimationFrame(loop);
    }

    window.addEventListener('resize', resize);
    resize();
    loop();
</script>
@endsection
