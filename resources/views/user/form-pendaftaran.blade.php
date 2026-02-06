<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran - Laskar Beasiswa</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --bg-color: #0b0f1a;
            --glass-bg: rgba(255, 255, 255, 0.98);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            overflow-x: hidden;
        }

        #meteorCanvas { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; pointer-events: none; }

        .sign-up-in-section {
            background: radial-gradient(circle at 15% 15%, rgba(79, 70, 229, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 85% 85%, rgba(124, 58, 237, 0.15) 0%, transparent 40%) !important;
            min-height: 100vh; display: flex; align-items: center; padding: 60px 0;
        }

        .logo-small { max-width: 120px; margin-bottom: 1.5rem; filter: drop-shadow(0 5px 15px rgba(79, 70, 229, 0.3)); }

        .form-card-custom {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-top: 5px solid #4f46e5;
            border-radius: 25px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            padding: 2.5rem 2rem !important;
            z-index: 1;
        }

        .form-label-custom { font-weight: 700; color: #1f2937; font-size: 0.82rem; margin-bottom: 8px; display: block; }

        /* --- JALUR SELECTION (Sesuai Request: Tidak Diubah) --- */
        .jalur-group { display: flex; gap: 12px; }
        .jalur-option { flex: 1; position: relative; }
        .jalur-option input { position: absolute; opacity: 0; width: 0; height: 0; }
        .jalur-card {
            display: flex; align-items: center; justify-content: center; padding: 12px;
            background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 12px;
            cursor: pointer; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-align: center;
        }
        .jalur-card span { font-size: 0.9rem; font-weight: 800; color: #64748b; letter-spacing: 0.5px; }
        .jalur-option input:checked + .jalur-card {
            background: #fff; border-color: #4f46e5;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.15); transform: translateY(-2px);
        }
        .jalur-option input:checked + .jalur-card span { color: #4f46e5; }

        /* --- PREMIUM SELECT2 --- */
        .select2-container--default .select2-selection--single {
            background-color: #f8fafc !important;
            border: 2px solid #e2e8f0 !important;
            border-radius: 12px !important;
            height: 50px !important;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #4f46e5 !important;
        }
        .select2-selection__rendered { padding-left: 15px !important; font-weight: 600; color: #1e293b !important; }
        .select2-dropdown {
            background: #fff !important; border: 1px solid #e2e8f0 !important;
            border-radius: 15px !important; box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            overflow: hidden; padding: 5px;
        }
        .select2-results__option--highlighted[aria-selected] { background: var(--primary-gradient) !important; border-radius: 8px; }

        .form-control {
            background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px;
            padding: 10px 15px; font-weight: 500; font-size: 0.9rem;
        }

        .btn-submit {
            background: var(--primary-gradient); border: none; border-radius: 12px;
            padding: 14px; font-weight: 800; color: white !important; transition: 0.3s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); }

        .section-divider {
            font-size: 0.7rem; font-weight: 800; color: #4f46e5;
            text-transform: uppercase; letter-spacing: 1.2px;
            margin: 20px 0 15px 0; display: flex; align-items: center; gap: 10px;
        }
        .section-divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

        #preloader { position: fixed; inset: 0; background: var(--bg-color); z-index: 9999; display: flex; align-items: center; justify-content: center; }
    </style>
</head>

<body>
    <canvas id="meteorCanvas"></canvas>

    <div id="preloader">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
    </div>

    <div class="main-wrapper">
        <section class="sign-up-in-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-md-10">

                        <div class="text-center" data-aos="fade-down">
                            <a href="/"><img src="{{ asset('user/img/logo-white.png') }}" alt="logo" class="logo-small"></a>
                        </div>

                        <div class="form-card-custom" data-aos="fade-up">
                            <div class="text-center mb-4">
                                <h4 class="fw-800 text-dark mb-1">Isi Pendaftaran</h4>
                                <p class="text-muted small">Silahkan pilih program dan unggah dokumen.</p>
                            </div>

                            <form action="{{ route('form-pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="section-divider">Pilihan Seleksi</div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Pilih PTN dan Prodi <span class="text-danger">*</span></label>
                                        <select name="ptn_dan_prodi" class="form-select select2">
                                            <option value=""></option>
                                            @foreach ($universitas as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->nama }} — {{ $data->prodi->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label class="form-label-custom">Pilih Jalur Pendaftaran <span class="text-danger">*</span></label>
                                        <div class="jalur-group">
                                            <label class="jalur-option">
                                                <input type="radio" name="jalur" value="SNBT" checked required>
                                                <div class="jalur-card">
                                                    <span>SNBT 2024</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="section-divider">Berkas Pendaftaran</div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Kartu Identitas <span class="text-danger">*</span></label>
                                        <input type="file" name="kartu_identitas" class="form-control" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Rapor <span class="text-danger">(Format PDF)</span></label>
                                        <input type="file" name="rapor" class="form-control">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Dokumen Prestasi <span class="text-muted">(Jika ada)</span></label>
                                        <input type="file" name="dokumen_prestasi" class="form-control">
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-submit w-100">Kirim Pendaftaran</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi Select2 Premium
            $('.select2').select2({
                placeholder: "Cari PTN atau Prodi...",
                allowClear: true,
                width: '100%'
            });

            AOS.init({ duration: 800, once: true });
            setTimeout(() => { $('#preloader').fadeOut(); }, 500);
        });

        // --- METEOR ENGINE ---
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
                this.speed = Math.random() * 5 + 2;
                this.len = Math.random() * 100 + 50;
                this.opacity = Math.random() * 0.5;
            }
            draw() {
                ctx.save();
                ctx.strokeStyle = `rgba(124, 58, 237, ${this.opacity})`;
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(this.x, this.y);
                ctx.lineTo(this.x - this.len, this.y + this.len);
                ctx.stroke();
                ctx.restore();
            }
            update() {
                this.x -= this.speed;
                this.y += this.speed;
                if (this.y > canvas.height + 100 || this.x < -100) this.reset();
            }
        }

        for (let i = 0; i < 20; i++) meteors.push(new Meteor());

        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            meteors.forEach(m => { m.update(); m.draw(); });
            requestAnimationFrame(loop);
        }

        window.addEventListener('resize', resize);
        resize();
        loop();
    </script>
</body>
</html>
