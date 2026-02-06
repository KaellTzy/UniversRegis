@extends('layouts.user.user')

@section('content')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --glass-bg: rgba(255, 255, 255, 0.7);
        }

        /* Hero Styling */
        .ins-hero-section {
            background:
                radial-gradient(circle at 10% 20%, rgba(79, 70, 229, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(124, 58, 237, 0.08) 0%, transparent 50%);
            padding: 160px 0 100px 0;
            overflow: hidden;
        }

        .ins-heading mark {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding: 0;
        }

        /* Floating Animation */
        .hero-img-anim {
            animation: floating 6s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(79, 70, 229, 0.2));
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(1.5deg);
            }
        }

        /* Modern Glass Card */
        .modern-glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .modern-glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(79, 70, 229, 0.15);
        }

        /* Button Styling */
        .ins-primary-btn {
            background: var(--primary-gradient);
            border: none;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            color: white !important;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .ins-primary-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.4);
        }

        /* FAQ Accordion Modern */
        .accordion-item {
            border: none !important;
            margin-bottom: 15px;
            border-radius: 15px !important;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }

        .accordion-button:not(.collapsed) {
            background: var(--primary-gradient);
            color: white;
        }

        /* Badge Custom */
        .badge-soft {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
            font-weight: 700;
            padding: 8px 20px;
        }
    </style>
    <br><br>
    <section class="ins-hero-section position-relative py-5 overflow-hidden" id="beranda">
        <div class="hero-blob"></div>

        <div class="container pt-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-10 text-center">
                    <div data-aos="fade-up" data-aos-duration="1000">
                        <span class="badge rounded-pill badge-soft mb-4 animate__animated animate__fadeIn">
                            ✨ #Beasiswa No 1 di Indonesia
                        </span>

                        <h1 class="display-1 fw-800 mb-4 tracking-tight">
                            Wujudkan Mimpi Kuliahmu <br>
                            Menjadi <span class="hero-gradient-text">Nyata.</span>
                        </h1>

                        <p class="lead text-muted mb-5 px-lg-5 mx-auto" style="max-width: 800px; font-size: 1.25rem;">
                            UniversRegis adalah jembatan emas bagi ribuan pelajar Indonesia untuk menaklukkan Kampus Impian
                            dengan pendampingan eksklusif dan beasiswa penuh.
                        </p>

                        <div class="d-flex justify-content-center gap-3">
                            @guest
                                <a href="{{ route('register') }}" class="ins-primary-btn">
                                    Mulai Perjalananmu <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            @else
                                <a href="{{ route('user.status') }}" class="ins-primary-btn">
                                    Cek Status
                                </a>
                            @endguest
                        </div>
                    </div>

                    <div class="mt-5 pt-4 hero-img-anim" data-aos="zoom-in-up" data-aos-delay="400">
                        <img src="{{ asset('user/img/people-bg.png') }}" alt="Hero Students" class="img-fluid main-hero-img"
                            style="max-height: 550px;">

                        <div class="d-none d-lg-block position-absolute top-50 start-0 translate-middle-y">
                            <div class="modern-glass-card p-3 shadow-sm rotate-n-15">
                                <span class="fw-bold text-primary">✓ 5000+ Students</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-100">
        <div class="container">
            <div class="modern-glass-card p-4 mb-5" data-aos="fade-up">
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <h2 class="fw-800 mb-0" style="color: #4f46e5;">5.000+</h2>
                        <p class="text-muted fw-bold small text-uppercase">Peserta Lolos</p>
                    </div>
                    <div class="col-md-4 border-start border-end border-light">
                        <h2 class="fw-800 mb-0" style="color: #7c3aed;">90%</h2>
                        <p class="text-muted fw-bold small text-uppercase">Kepuasan Peserta</p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="fw-800 mb-0" style="color: #4f46e5;">40+</h2>
                        <p class="text-muted fw-bold small text-uppercase">PTN Mitra</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="100">
                <h6 class="text-muted small fw-bold text-uppercase mb-4">Dipercaya oleh Mahasiswa dari Universitas Terbaik
                </h6>
                <div class="swiper ins-brand-slider">
                    <div class="swiper-wrapper align-items-center">
                        @php $logos = ['ui','ugm','itb','unair','ipb','its','unpad','undip','ub','binus']; @endphp
                        @foreach ($logos as $logo)
                            <div class="swiper-slide text-center">
                                <img src="{{ asset('user/img/clients/logo-' . $logo . '.png') }}" alt="{{ $logo }}"
                                    style="height: 45px; filter: grayscale(100%); opacity: 0.6; transition: 0.3s;"
                                    onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1'"
                                    onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6'">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 overflow-hidden position-relative" id="tentang">
        <div class="blob-decor"></div>

        <div class="container py-lg-5">
            <div class="row align-items-center g-5">

                <div class="col-lg-6" data-aos="zoom-in-right">
                    <div class="position-relative p-4">
                        <div class="rounded-5 overflow-hidden shadow-2xl position-relative z-index-1"
                            style="border: 8px solid white;">
                            <img src="{{ asset('user/img/bg.png') }}" class="img-fluid w-100" alt="About Image"
                                style="transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">
                        </div>

                        <div class="position-absolute bottom-0 start-0 mb-n4 ms-n2 p-4 modern-glass-card d-none d-md-block animate__animated animate__fadeInUp"
                            style="width: 260px; z-index: 2;">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-3 p-3 me-3">
                                    <i class="fas fa-graduation-cap fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="fw-800 mb-0 text-dark">5+ Tahun</h3>
                                    <p class="small text-muted mb-0 fw-semibold">Dedikasi Pendidikan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ps-lg-5">
                        <div class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                            TENTANG KAMI
                        </div>
                        <h2 class="display-5 fw-800 mb-4">Membangun Masa Depan Bersama <br>
                            <span class="text-gradient">UniversRegis #Beasiswa</span>
                        </h2>
                        <p class="text-muted fs-5 mb-4 leading-relaxed">
                            Kami bukan sekadar platform, melainkan <strong>gerakan nyata</strong> yang menjembatani mimpi
                            pelajar berprestasi untuk meraih kursi di PTN impian.
                        </p>

                        <div class="mt-4">
                            <div class="list-item-hover d-flex align-items-start mb-2">
                                <div class="me-3">
                                    <span class="badge bg-success-soft rounded-circle p-2">
                                        <i class="fas fa-check text-success"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Pendampingan Intensif 24/7</h6>
                                    <p class="small text-muted">Bimbingan tanpa batas waktu oleh mentor ahli.</p>
                                </div>
                            </div>

                            <div class="list-item-hover d-flex align-items-start mb-2">
                                <div class="me-3">
                                    <span class="badge bg-success-soft rounded-circle p-2">
                                        <i class="fas fa-check text-success"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Beasiswa Biaya Kuliah 100%</h6>
                                    <p class="small text-muted">Fokus belajar tanpa beban finansial.</p>
                                </div>
                            </div>

                            <div class="list-item-hover d-flex align-items-start">
                                <div class="me-3">
                                    <span class="badge bg-success-soft rounded-circle p-2">
                                        <i class="fas fa-check text-success"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Jaringan Alumni PTN Terbesar</h6>
                                    <p class="small text-muted">Akses ke komunitas mahasiswa PTN seluruh Indonesia.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <a href="#program" class="btn btn-primary btn-lg rounded-pill px-5 shadow-lg fw-bold">
                                Pelajari Program <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-100" id="daftar">
        <div class="container">
            <div class="p-5 rounded-5 text-center position-relative overflow-hidden shadow-lg"
                style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: 1px solid rgba(255,255,255,0.1);"
                data-aos="zoom-in">

                <div class="position-absolute top-50 start-50 translate-middle w-75 h-75"
                    style="background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); filter: blur(50px); pointer-events: none;">
                </div>

                <div class="position-relative z-1 py-4">
                    <h2 class="display-5 fw-800 mb-4 text-white" style="letter-spacing: -1px;">
                        Mari Bergabung Bersama <br> UniversRegis Beasiswa!
                    </h2>

                    <p class="mb-5 fs-5 mx-auto text-white opacity-90" style="max-width: 600px;">
                        Jangan biarkan biaya menghalangi mimpimu. Daftar sekarang dan raih kursi di Perguruan Tinggi Negeri
                        impianmu.
                    </p>

                    @guest
                        <a href="{{ route('register') }}" class="btn btn-white-custom">
                            Daftar Sekarang
                        </a>
                    @else
                        <a href="{{ route('user.status') }}" class="btn btn-white-custom">
                            Cek Status Anda
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
    <style>
        /* Styling khusus agar semua teks putih & tombol serasi */
        .fw-800 {
            font-weight: 800;
        }

        .opacity-90 {
            opacity: 0.9;
        }

        .btn-white-custom {
            background: #ffffff;
            color: #4f46e5 !important;
            /* Teks tombol tetap kontras agar user tahu itu tombol */
            font-weight: 700;
            padding: 16px 45px;
            border-radius: 50px;
            border: 2px solid #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-block;
        }

        .btn-white-custom:hover {
            background: transparent;
            color: #ffffff !important;
            /* Saat hover tombol jadi transparan teks putih */
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
    </style>

    <section class="py-5 bg-white" id="faq">
        <div class="container py-lg-5">
            <div class="row mb-5">
                <div class="col-lg-6" data-aos="fade-up">
                    <span class="text-primary fw-bold ls-1 mb-2 d-block small">FAQ</span>
                    <h2 class="display-6 fw-800 text-dark mb-3">Pertanyaan yang Sering Diajukan</h2>
                    <p class="text-dark opacity-75 lead">Temukan jawaban cepat mengenai program beasiswa dan proses
                        pendaftaran UniversRegis.</p>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="accordion accordion-flush" id="faqAccordion">

                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-transparent fw-bold fs-5 text-dark py-4 shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                                    Apa itu UniversRegis Beasiswa?
                                </button>
                            </h2>
                            <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-dark pb-4 lh-lg">
                                    UniversRegis Beasiswa adalah program pendidikan strategis yang bekerja sama dengan lebih
                                    dari 40 PTN ternama di Indonesia. Kami memberikan bantuan biaya pendidikan, pendampingan
                                    akademik, serta program pengembangan diri bagi mahasiswa.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button collapsed bg-transparent fw-bold fs-5 text-dark py-4 shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                                    Apa saja syarat utama pendaftaran?
                                </button>
                            </h2>
                            <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-dark pb-4 lh-lg">
                                    Program ini terbuka bagi siswa SMA/SMK sederajat kelas 12 atau lulusan <i>gap year</i>
                                    yang memiliki semangat belajar tinggi. Syarat utama mencakup komitmen untuk mengikuti
                                    seluruh rangkaian pembinaan yang telah dijadwalkan.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 text-center" data-aos="fade-left">
                    <img src="{{ asset('user/img/kuliah.png') }}" class="img-fluid rounded-4 shadow-sm"
                        alt="FAQ UniversRegis" style="max-height: 400px; object-fit: contain;">
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Gradasi teks pada kata kunci */
        .hero-gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Badge yang lebih soft dan modern */
        .badge-soft {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
            padding: 10px 20px;
            letter-spacing: 1px;
            font-weight: 700;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        /* Efek tombol yang bersinar */
        .ins-primary-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white !important;
            padding: 16px 35px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .ins-primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.5);
        }

        /* Animasi mengambang untuk gambar hero */
        .hero-img-anim {
            animation: floating 6s ease-in-out infinite;
            filter: drop-shadow(0 30px 50px rgba(0, 0, 0, 0.1));
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Dekorasi background (blob) */
        .hero-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, transparent 70%);
            top: -10%;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
        }

        /* Efek kartu statistik yang lebih clean */
        .stats-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.1);
        }

        /* Animasi angka agar lebih mencolok */
        .stat-number {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        /* Container logo yang modern */
        .brand-container {
            mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        }

        .brand-logo-img {
            height: 40px;
            width: auto;
            filter: grayscale(100%) brightness(0.8);
            opacity: 0.5;
            transition: all 0.4s ease;
        }

        .brand-logo-img:hover {
            filter: grayscale(0%) brightness(1);
            opacity: 1;
            transform: scale(1.1);
        }

        /* Gradasi teks untuk judul agar terlihat modern */
        .text-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Card glassmorphism yang lebih soft */
        .modern-glass-card {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Dekorasi elemen di belakang gambar */
        .blob-decor {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%);
            z-index: -1;
            top: -50px;
            left: -50px;
            border-radius: 50%;
        }

        /* Animasi checklist */
        .list-item-hover {
            transition: transform 0.3s ease;
            padding: 10px;
            border-radius: 12px;
        }

        .list-item-hover:hover {
            background: rgba(79, 70, 229, 0.05);
            transform: translateX(10px);
        }

        #faq .accordion-button:not(.collapsed) {
            color: var(--bs-primary);
            background-color: transparent;
        }

        #faq .accordion-button::after {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-size: 1.2rem;
        }

        #faq .accordion-item {
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .ls-1 {
            letter-spacing: 1px;
        }

        /* Animasi halus untuk gambar */
        .hero-img-anim {
            transition: transform 0.3s ease-in-out;
        }

        .hero-img-anim:hover {
            transform: translateY(-10px);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                easing: 'ease-out-back'
            });

            // Initialize Swiper
            new Swiper('.ins-brand-slider', {
                slidesPerView: 2,
                spaceBetween: 40,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 5
                    }
                }
            });
        });
    </script>
@endsection
