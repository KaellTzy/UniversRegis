@extends('layouts.admin.admin')

@section('content')
    @include('layouts.admin.components.alert')

    <div class="premium-container">
        <div class="particle-system">
            @for ($i = 1; $i <= 20; $i++)
                <div class="particle p{{ $i }}"></div>
            @endfor
        </div>

        <div class="col-lg-5 col-md-8 mx-auto position-relative" style="z-index: 10;">
            <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="post" id="statusForm">
                @csrf
                @method('PUT')

                <div class="master-card animate__animated animate__fadeInUp">
                    <div class="card-header-visual text-center">
                        <div class="orb-wrapper mx-auto">
                            <div class="moving-orb"></div>
                            <div class="profile-container">
                                <img src="{{ asset('admin-asset/images/icon.png') }}" alt="Logo" class="orb-image logo-style">
                            </div>
                        </div>

                        <h2 class="main-title mt-4">Konfirmasi Status</h2>
                        <p class="id-tag">No Pendaftaran : <span>#{{ $dokumen->id }}</span></p>
                    </div>

                    <div class="card-body px-4 px-md-5">
                        <div class="status-current-pill">
                            <span class="pulse-indicator {{ $dokumen->status == 'diproses' ? 'pulse-warning' : 'pulse-success' }}"></span>
                            <span class="status-text">STATUS: {{ strtoupper($dokumen->status) }}</span>
                        </div>

                        <div class="text-center">
                            <label class="section-label">KEPUTUSAN VERIFIKASI</label>
                        </div>

                        <div class="decision-grid mb-4">
                            <label class="decision-card accept">
                                <input type="radio" name="status" value="diterima" {{ $dokumen->status == 'diterima' ? 'checked' : '' }} required>
                                <div class="card-content">
                                    <i class="ti ti-circle-check-filled"></i>
                                    <span>TERIMA</span>
                                </div>
                            </label>

                            <label class="decision-card reject">
                                <input type="radio" name="status" value="ditolak" {{ $dokumen->status == 'ditolak' ? 'checked' : '' }} required>
                                <div class="card-content">
                                    <i class="ti ti-circle-x-filled"></i>
                                    <span>TOLAK</span>
                                </div>
                            </label>
                        </div>

                        <div class="action-zone mt-4 text-center">
                            <button type="submit" class="cyber-button mb-3">
                                <span class="cyber-text">EKSEKUSI PERUBAHAN</span>
                            </button>

                            <a href="{{ route('admin.dokumen.index') }}" class="back-nav">
                                <i class="ti ti-arrow-left"></i> KEMBALI KE DATABASE
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* --- Container & Background --- */
        .premium-container {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: #f0f3f9;
            position: relative;
            overflow: hidden;
            border-radius: 30px;
        }

        .particle-system {
            position: absolute;
            width: 100%; height: 100%;
            top: 0; left: 0; z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(78, 115, 223, 0.2);
            border-radius: 50%;
            animation: moveParticles infinite ease-in-out;
        }

        @for ($i = 1; $i <= 20; $i++)
            .p{{ $i }} {
                width: {{ rand(5, 15) }}px;
                height: {{ rand(5, 15) }}px;
                left: {{ rand(0, 100) }}%;
                top: {{ rand(0, 100) }}%;
                animation-duration: {{ rand(10, 25) }}s;
                animation-delay: -{{ rand(0, 20) }}s;
            }
        @endfor

        @keyframes moveParticles {
            0%, 100% { transform: translate(0, 0); }
            33% { transform: translate(30px, -50px); }
            66% { transform: translate(-20px, 20px); }
        }

        /* --- Master Card --- */
        .master-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            border: 1px solid white;
            box-shadow: 20px 20px 60px #d1d9e6, -20px -20px 60px #ffffff;
            padding-bottom: 25px;
            width: 100%;
        }

        .card-header-visual { padding-top: 80px; }

        .orb-wrapper {
            position: relative;
            width: 130px; height: 130px;
            margin-top: -65px;
            display: flex; align-items: center; justify-content: center;
        }

        .moving-orb {
            position: absolute;
            width: 100%; height: 100%;
            background: linear-gradient(45deg, #4e73df, #224abe);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: morphOrb 8s infinite alternate ease-in-out;
            box-shadow: 0 10px 30px rgba(78, 115, 223, 0.4);
        }

        @keyframes morphOrb {
            0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; transform: scale(1); }
            100% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; transform: scale(1.1); }
        }

        .profile-container {
            position: relative;
            z-index: 5;
            width: 100px; height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background: white; /* Supaya background logo bersih */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .orb-image { width: 100%; height: 100%; object-fit: cover; }

        /* CSS Khusus agar Logo utuh tidak terpotong */
        .logo-style {
            width: 80% !important;
            height: 80% !important;
            object-fit: contain !important;
        }

        .main-title { font-weight: 900; color: #2d3436; letter-spacing: -1px; margin-bottom: 5px; }
        .id-tag { font-size: 13px; color: #b2bec3; font-weight: 700; }
        .id-tag span { background: #dfe6e9; padding: 3px 10px; border-radius: 6px; color: #4e73df; }

        .status-current-pill {
            display: flex; align-items: center; justify-content: center;
            background: #fff; padding: 10px 20px; border-radius: 100px;
            font-weight: 800; font-size: 11px;
            box-shadow: inset 4px 4px 8px #d1d9e6, inset -4px -4px 8px #ffffff;
            width: fit-content; margin: 20px auto 30px auto;
        }

        .pulse-indicator { width: 10px; height: 10px; border-radius: 50%; margin-right: 12px; }
        .pulse-warning { background: #fdcb6e; box-shadow: 0 0 10px #fdcb6e; animation: pS 1.5s infinite; }
        .pulse-success { background: #00b894; box-shadow: 0 0 10px #00b894; animation: pS 1.5s infinite; }
        @keyframes pS { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }

        .section-label { font-size: 10px; font-weight: 800; color: #a0aec0; letter-spacing: 2px; margin-bottom: 20px; display: block; }

        .decision-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .decision-card { cursor: pointer; }
        .decision-card input { display: none; }

        .card-content {
            background: #f8fafc; padding: 25px 15px; border-radius: 24px;
            text-align: center; display: flex; flex-direction: column; gap: 10px;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent; font-weight: 700; color: #64748b;
        }

        .decision-card.accept input:checked + .card-content {
            background: #ecfdf5; border-color: #10b981; color: #10b981;
            transform: translateY(-8px); box-shadow: 0 15px 30px rgba(16, 185, 129, 0.15);
        }

        .decision-card.reject input:checked + .card-content {
            background: #fef2f2; border-color: #ef4444; color: #ef4444;
            transform: translateY(-8px); box-shadow: 0 15px 30px rgba(239, 68, 68, 0.15);
        }

        .card-content i { font-size: 32px; }

        .cyber-button {
            width: 100%; background: #1e293b; color: white; border: none;
            padding: 20px; border-radius: 22px; font-weight: 800; letter-spacing: 1px;
            transition: 0.3s; position: relative; overflow: hidden;
        }

        .cyber-button:hover {
            background: #4e73df; transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(78, 115, 223, 0.4);
        }

        .back-nav { display: inline-block; color: #94a3b8; text-decoration: none; font-size: 12px; font-weight: 700; transition: 0.3s; }
        .back-nav:hover { color: #4e73df; transform: translateX(-5px); }
    </style>
@endsection
