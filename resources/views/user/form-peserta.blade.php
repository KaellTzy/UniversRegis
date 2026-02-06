<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biodata - UniversRegis</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}">
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }

        /* --- LOGO SIZE --- */
        .logo-small { max-width: 120px; margin-bottom: 1.5rem; filter: drop-shadow(0 5px 15px rgba(79, 70, 229, 0.3)); }

        /* --- CONTAINER FORM DIPERKECIL --- */
        .form-card-custom {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-top: 5px solid #4f46e5;
            border-radius: 25px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            padding: 2.5rem 2rem !important; /* Padding disesuaikan */
            z-index: 1;
        }

        .form-label-custom { font-weight: 700; color: #1f2937; font-size: 0.82rem; margin-bottom: 6px; display: block; }

        .form-control {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 15px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-control:focus { border-color: #4f46e5; background: #fff; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

        /* --- GENDER CARDS --- */
        .gender-group { display: flex; gap: 12px; }
        .gender-option { flex: 1; position: relative; }
        .gender-option input { position: absolute; opacity: 0; width: 0; height: 0; }
        .gender-card {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .gender-card i { font-size: 1.1rem; color: #94a3b8; }
        .gender-card span { font-size: 0.85rem; font-weight: 700; color: #64748b; }
        .gender-option input:checked + .gender-card {
            background: #fff;
            border-color: #7c3aed;
            box-shadow: 0 8px 15px rgba(124, 58, 237, 0.1);
        }
        .gender-option input:checked + .gender-card i,
        .gender-option input:checked + .gender-card span { color: #4f46e5; }

        .btn-submit {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 800;
            color: white !important;
            transition: 0.3s;
            font-size: 1rem;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); }

        .section-divider {
            font-size: 0.7rem; font-weight: 800; color: #4f46e5;
            text-transform: uppercase; letter-spacing: 1.2px;
            margin: 20px 0 15px 0; display: flex; align-items: center; gap: 10px;
        }
        .section-divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

        #preloader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: var(--bg-color); z-index: 9999; display: flex; align-items: center; justify-content: center; }
    </style>
</head>

<body>
    <canvas id="meteorCanvas"></canvas>

    <div id="preloader">
        <div class="text-center">
            <img src="{{ asset('user/img/icon.png') }}" width="45" class="mb-2">
            <div class="loading-bar"></div>
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
                                <h4 class="fw-800 text-dark mb-1">Formulir Biodata</h4>
                                <p class="text-muted small">Lengkapi seluruh kolom di bawah ini.</p>
                            </div>

                            <form action="{{ route('form-peserta.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="section-divider">Data Diri</div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Nama Sesuai KTP" required name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">NISN <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="NISN" required name="nisn">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">NIK <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="NIK" required name="nik">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <div class="gender-group">
                                            <label class="gender-option">
                                                <input type="radio" name="jenis_kelamin" value="Laki-laki" required>
                                                <div class="gender-card">
                                                    <i class="fa-solid fa-mars"></i><span>Laki-laki</span>
                                                </div>
                                            </label>
                                            <label class="gender-option">
                                                <input type="radio" name="jenis_kelamin" value="Perempuan">
                                                <div class="gender-card">
                                                    <i class="fa-solid fa-venus"></i><span>Perempuan</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">Tempat Lahir</label>
                                        <input type="text" class="form-control" placeholder="Tempat Lahir" required name="tempat_lahir">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">Tanggal Lahir</label>
                                        <input type="date" class="form-control" required name="tanggal_lahir">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">No Handphone (WA)</label>
                                        <input type="number" class="form-control" placeholder="08..." required name="no_hp">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Alamat Domisili</label>
                                        <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2" required></textarea>
                                    </div>

                                    <div class="section-divider">Sekolah</div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label-custom">Asal Sekolah</label>
                                        <input type="text" class="form-control" placeholder="Nama Sekolah" required name="nama_sekolah">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">Tahun Lulus</label>
                                        <input type="number" class="form-control" placeholder="2024" required name="tahun_lulus">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">NPSN</label>
                                        <input type="number" class="form-control" placeholder="Kode NPSN" required name="npsn">
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-submit w-100">Kirim Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('user/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        const canvas = document.getElementById('meteorCanvas');
        const ctx = canvas.getContext('2d');
        let meteors = [];
        function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
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
                ctx.beginPath(); ctx.moveTo(this.x, this.y); ctx.lineTo(this.x - this.len, this.y + this.len); ctx.stroke();
                ctx.restore();
            }
            update() { this.x -= this.speed; this.y += this.speed; if (this.y > canvas.height + 100 || this.x < -100) this.reset(); }
        }
        for (let i = 0; i < 20; i++) meteors.push(new Meteor());
        function loop() { ctx.clearRect(0, 0, canvas.width, canvas.height); meteors.forEach(m => { m.update(); m.draw(); }); requestAnimationFrame(loop); }
        window.addEventListener('resize', resize);
        resize(); loop();
        $(window).on('load', function() { $('#preloader').fadeOut(); });
        $(document).ready(function () { AOS.init({ duration: 800, once: true }); });
    </script>
</body>
</html>
