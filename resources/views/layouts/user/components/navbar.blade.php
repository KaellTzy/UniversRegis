<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniversRegis - Profile Info Nav</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --nav-text: #1e293b;
            --purple-accent: #7c3aed;
            --purple-light: rgba(124, 58, 237, 0.1);
            --glass-white: rgba(255, 255, 255, 0.85);
        }

        body {
            padding-top: 100px;
            background-color: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }

        .ins-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
        }

        .sticky-header {
            background: var(--glass-white) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            padding: 10px 0;
            position: relative;
        }

        #navMeteorCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .navbar-brand img { height: 40px; }

        /* --- ANIMASI BARU: MENU NAVIGASI (BERANDA, TENTANG, FAQ) --- */
        .main-menu .nav-link {
            font-weight: 700;
            color: var(--nav-text) !important;
            padding: 10px 15px !important;
            position: relative;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Garis bawah meluncur (Sliding Underline) */
        .main-menu .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--purple-accent);
            border-radius: 50px;
            transition: all 0.3s ease;
            transform: translateX(-50%);
            box-shadow: 0 0 10px rgba(124, 58, 237, 0.5);
        }

        /* Hover Effect */
        .main-menu .nav-link:hover {
            color: var(--purple-accent) !important;
            transform: translateY(-3px); /* Efek melayang sedikit */
        }

        .main-menu .nav-link:hover::after {
            width: 25px; /* Panjang garis bawah saat hover */
        }

        /* Click Effect (Membal) */
        .main-menu .nav-link:active {
            transform: scale(0.9);
            transition: 0.1s;
        }

        /* --- USER INFO PILL (Nama, Email, Role) --- */
        .user-pill {
            display: flex;
            align-items: center;
            background: white;
            padding: 6px 15px;
            border-radius: 16px;
            margin-left: 20px;
            border: 1px solid rgba(124, 58, 237, 0.15);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: 0.3s;
        }

        .user-pill:hover {
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.1);
            border-color: rgba(124, 58, 237, 0.3);
        }

        .user-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--nav-text);
        }

        .user-email {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        .user-role {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--purple-accent);
            font-weight: 700;
            margin-top: 2px;
        }

        /* --- BUTTON LOGOUT UNGU --- */
        .btn-logout-purple {
            background: var(--purple-light);
            color: var(--purple-accent) !important;
            font-weight: 700;
            font-size: 0.8rem;
            border-radius: 12px;
            padding: 8px 20px !important;
            margin-left: 12px;
            border: 1px solid rgba(124, 58, 237, 0.2);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .btn-logout-purple:hover {
            background: var(--purple-accent);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.3);
        }

        .ins-primary-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 24px !important;
            transition: 0.3s;
        }

        .ins-primary-btn:hover {
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4);
            transform: scale(1.03);
        }

        /* Mobile View Adjustments */
        @media (max-width: 1199px) {
            .navbar-nav { padding: 20px 0; }
            .user-pill { margin: 10px auto; width: 90%; justify-content: center; }
            .btn-logout-purple { margin: 10px auto; width: 90%; justify-content: center; }
        }
    </style>
</head>
<body>

<header class="ins-header">
    <nav class="navbar navbar-expand-xl sticky-header">
        <canvas id="navMeteorCanvas"></canvas>

        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('user/img/logo-color.png') }}" alt="Logo" />
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav main-menu ms-auto align-items-center">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="#tentang" class="nav-link">Tentang</a></li>
                    <li class="nav-item"><a href="#faq" class="nav-link">FAQ</a></li>

                    @auth
                        <li class="nav-item d-flex align-items-center flex-column flex-xl-row">
                            <div class="user-pill">
                                <img src="{{ asset('admin-asset/images/profile/user-1.jpg') }}" class="rounded-circle me-3" width="35" height="35" style="object-fit: cover; border: 2px solid var(--purple-light);">
                                <div class="user-meta">
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                    <span class="user-email">{{ Auth::user()->email }}</span>
                                    <span class="user-role">{{ Auth::user()->role ?? 'Student' }}</span>
                                </div>
                            </div>

                            <a class="nav-link btn-logout-purple" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item ms-xl-3 d-flex align-items-center">
                            <a href="{{ route('login') }}" class="btn-signin text-decoration-none me-3 fw-bold text-dark">Sign In</a>
                            <a href="{{ route('register') }}" class="ins-primary-btn">Get Started</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // --- ANIMASI METEOR ---
    const navCanvas = document.getElementById('navMeteorCanvas');
    const nctx = navCanvas.getContext('2d');
    let navMeteors = [];

    function resizeNavCanvas() {
        navCanvas.width = navCanvas.offsetWidth;
        navCanvas.height = navCanvas.offsetHeight;
    }

    class NavMeteor {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * navCanvas.width + 100;
            this.y = Math.random() * navCanvas.height - 30;
            this.speed = Math.random() * 1.5 + 0.5;
            this.len = Math.random() * 40 + 20;
            this.opacity = Math.random() * 0.4;
        }
        draw() {
            nctx.save();
            nctx.strokeStyle = `rgba(124, 58, 237, ${this.opacity})`;
            nctx.lineWidth = 1.2;
            nctx.beginPath();
            nctx.moveTo(this.x, this.y);
            nctx.lineTo(this.x - this.len, this.y + this.len);
            nctx.stroke();
            nctx.restore();
        }
        update() {
            this.x -= this.speed;
            this.y += this.speed;
            if (this.y > navCanvas.height + 50 || this.x < -50) this.reset();
        }
    }

    for (let i = 0; i < 6; i++) navMeteors.push(new NavMeteor());

    function drawNavMeteors() {
        nctx.clearRect(0, 0, navCanvas.width, navCanvas.height);
        navMeteors.forEach(m => { m.update(); m.draw(); });
        requestAnimationFrame(drawNavMeteors);
    }

    window.addEventListener('resize', resizeNavCanvas);
    resizeNavCanvas();
    drawNavMeteors();
</script>

</body>
</html>
