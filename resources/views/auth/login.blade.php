<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - UniversRegis</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="user/css/main.css">
    <link rel="stylesheet" href="user/css/custom.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --bg-color: #0b0f1a; /* Samakan dengan register */
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
            z-index: -1;
            pointer-events: none;
            background: transparent;
        }

        .sign-up-in-section {
            /* Samakan background gradient dengan register */
            background:
                radial-gradient(circle at 15% 15%, rgba(79, 70, 229, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(124, 58, 237, 0.15) 0%, transparent 40%) !important;
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* --- ANIMASI LOGO --- */
        .logo-container {
            display: inline-block;
            position: relative;
            margin-bottom: 2rem;
        }

        .floating-logo {
            animation: floating 4s ease-in-out infinite;
            max-width: 160px;
            filter: drop-shadow(0 10px 20px rgba(79, 70, 229, 0.4));
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* --- CARD STYLE --- */
        .login-card-custom {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-top: 5px solid #4f46e5;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            padding: 3.5rem 3rem 3rem 3rem !important;
            position: relative;
            z-index: 1;
        }

        .form-control {
            background: rgba(243, 244, 246, 0.8);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 14px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #fff;
            border-color: #4f46e5;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.15);
            transform: translateY(-2px);
        }

        .btn-login {
            background: var(--primary-gradient);
            border: none;
            border-radius: 15px;
            padding: 14px;
            font-weight: 700;
            color: white !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4);
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
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">

                        <div class="text-center" data-aos="fade-down">
                            <div class="logo-container">
                                <img src="user/img/logo-white.png" alt="logo" class="img-fluid floating-logo">
                            </div>
                        </div>

                        <div class="login-card-custom" data-aos="fade-up" data-aos-duration="1000">
                            <div class="text-center mb-5">
                                <h2 class="fw-800 mb-2" style="color: #111827; font-weight: 800;">Welcome Back</h2>
                                <p class="text-muted small">Silahkan masuk untuk akses akun Anda</p>
                            </div>

                            <form action="{{ route('login') }}" method="POST" id="loginForm">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label-custom">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Masukkan email" required name="email">
                                </div>

                                <div class="mb-4">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label-custom">Password</label>
                                        <a href="#" class="text-decoration-none small fw-bold" style="color: #4f46e5;">Lupa?</a>
                                    </div>
                                    <input type="password" class="form-control" placeholder="••••••••" required name="password">
                                </div>

                                <button type="submit" class="btn btn-login w-100 mb-4" id="submitBtn">
                                    Sign In
                                </button>

                                <div class="text-center mt-4">
                                    <p class="small text-muted mb-0">Belum punya akun?
                                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: #4f46e5;">Daftar Sekarang</a>
                                    </p>
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
        // --- ENGINE METEOR (SAMA DENGAN REGISTER) ---
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

        // --- AOS & PRELOADER ---
        $(window).on('load', function() { $('#preloader').fadeOut(); });
        $(document).ready(function () {
            AOS.init({ duration: 800, once: true });
        });
    </script>
</body>
</html>
