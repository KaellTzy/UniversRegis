<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - UniversRegis</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="user/css/main.css">
    <link rel="stylesheet" href="user/css/custom.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --bg-color: #0b0f1a;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            overflow-x: hidden;
        }

        /* --- FIX METEOR CANVAS --- */
        #meteorCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1; /* Di belakang semua konten */
            pointer-events: none;
            background: transparent;
        }

        .sign-up-in-section {
            /* Pastikan background section transparan agar meteor terlihat */
            background:
                radial-gradient(circle at 15% 15%, rgba(79, 70, 229, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(124, 58, 237, 0.1) 0%, transparent 40%) !important;
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* --- ANIMASI LOGO --- */
        .logo-container { display: inline-block; position: relative; }
        .animated-logo { animation: float 4s ease-in-out infinite; filter: drop-shadow(0 5px 15px rgba(79, 70, 229, 0.3)); }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

        /* --- CONTAINER STYLE --- */
        .pricing-content-wrap {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            border-top: 5px solid #4f46e5;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            overflow: hidden;
            display: flex;
        }

        .left-radius { background: rgba(79, 70, 229, 0.03); border-right: 1px solid rgba(0, 0, 0, 0.05); }

        .form-control {
            background: rgba(243, 244, 246, 0.8);
            border-radius: 12px;
            border: 2px solid transparent;
            padding: 12px 18px;
            transition: all 0.3s ease;
        }

        .form-control:focus { border-color: #4f46e5; background: #fff; transform: translateY(-2px); }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
        }

        #preloader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: var(--bg-color);
            z-index: 9999;
            display: flex; align-items: center; justify-content: center;
        }
    </style>
</head>

<body>

    <canvas id="meteorCanvas"></canvas>

    <div id="preloader">
        <div class="preloader-wrap text-center">
            <img src="user/img/icon.png" alt="logo" class="img-fluid mb-3" width="60">
            <div class="loading-bar"></div>
        </div>
    </div>

    <div class="main-wrapper">
        <section class="sign-up-in-section ptb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11 col-12">
                        <div class="pricing-content-wrap shadow-lg" data-aos="zoom-in" data-aos-duration="1000">

                            <div class="price-feature-col pricing-feature-info left-radius p-5 order-1 order-lg-0 d-none d-lg-block" style="width: 40%;">
                                <div class="mb-5" data-aos="fade-down" data-aos-delay="500">
                                    <div class="logo-container">
                                        <img src="user/img/logo-color.png" alt="logo" class="img-fluid animated-logo" width="160">
                                    </div>
                                </div>
                                <h4 class="text-dark fw-bold mb-3">UniversRegis!</h4>
                                <p class="text-muted small">Platform modern pendaftaran beasiswa. Temukan program terbaik dan bangun masa depanmu. 🎓✨</p>
                            </div>

                            <div class="price-feature-col pricing-action-info p-5 bg-white order-0 order-lg-1 flex-grow-1">
                                <div class="mb-4">
                                    <h2 class="fw-800 mb-1" style="color: #111827; font-weight: 800;">Create Account</h2>
                                    <p class="text-muted small">Daftar sekarang untuk memulai perjalanan Anda.</p>
                                </div>
                                <form action="{{ route('register') }}" method="POST" id="regForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Full Name" required name="name">
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <input type="email" class="form-control" placeholder="Email Address" required name="email">
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <input type="password" class="form-control" placeholder="Password" required name="password">
                                        </div>
                                        <div class="col-sm-12 mb-4">
                                            <input type="password" class="form-control" placeholder="Confirm Password" required name="password_confirmation">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mb-4" id="submitBtn">Register Account</button>
                                    </div>
                                    <div class="text-center">
                                        <p class="small text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Sign In</a></p>
                                    </div>
                                </form>
                            </div>
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
        // --- LOGIKA METEOR (FIXED) ---
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
                this.speed = Math.random() * 5 + 2; // Kecepatan
                this.len = Math.random() * 100 + 50; // Panjang ekor
                this.opacity = Math.random() * 0.5;
            }
            draw() {
                ctx.save();
                ctx.strokeStyle = `rgba(124, 58, 237, ${this.opacity})`; // Warna ungu indigo
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

        // Buat 20 meteor
        for (let i = 0; i < 20; i++) meteors.push(new Meteor());

        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            meteors.forEach(m => { m.update(); m.draw(); });
            requestAnimationFrame(loop);
        }

        window.addEventListener('resize', resize);
        resize();
        loop();

        // --- PRELOADER ---
        $(window).on('load', function() { $('#preloader').fadeOut(); });
        $(document).ready(function() {
            AOS.init({ duration: 800, once: true });
        });
    </script>
</body>
</html>
