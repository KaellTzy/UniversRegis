<style>
    /* --- FOOTER COSMIC STYLE --- */
    .footer-cosmic {
        background-color: #0b0f1a !important; /* Warna sama dengan Login/Register */
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(79, 70, 229, 0.2);
    }

    /* Canvas khusus untuk footer agar tidak berat */
    #footerMeteorCanvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
    }

    .footer-top {
        position: relative;
        z-index: 1;
        background: radial-gradient(circle at 85% 15%, rgba(124, 58, 237, 0.1) 0%, transparent 40%) !important;
    }

    .footer-social-list li a {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-social-list li a:hover {
        background: var(--primary-gradient);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
        z-index: 1;
    }

    .footer-logo-wrap img {
        transition: transform 0.5s ease;
    }

    .footer-logo-wrap:hover img {
        transform: scale(1.05);
    }

    .text-gradient {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }
</style>

<footer class="footer-section footer-cosmic">
    <canvas id="footerMeteorCanvas"></canvas>

    <div class="footer-top ptb-120">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-12 col-lg-5 mb-md-4 mb-lg-0 text-center text-lg-start">
                    <div class="footer-single-col">
                        <div class="footer-logo-wrap mb-4">
                            <img src="{{ asset('user/img/logo-white.png') }}" alt="logo" class="img-fluid logo-color">
                        </div>
                        <p class="text-white opacity-75 pe-lg-5">
                            Ubah mimpi mu menjadi nyata dengan <span class="text-gradient">UniversRegis Beasiswa</span>.
                            Platform pendaftaran kuliah paling modern dan transparan di Indonesia.
                        </p>
                        <ul class="list-unstyled list-inline footer-social-list mb-0 mt-4">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom py-4">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-12 text-center">
                    <div class="copyright-text">
                        <p class="mb-0 text-white-50 small">
                            &copy; 2026 <span class="text-white fw-bold">UniversRegis</span>. All Rights Reserved.
                            Developed with ❤️ by <a href="#" class="text-white text-decoration-none fw-bold">Raka</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </footer>

<script>
    // --- ENGINE METEOR KHUSUS FOOTER ---
    (function() {
        const canvas = document.getElementById('footerMeteorCanvas');
        const ctx = canvas.getContext('2d');
        let meteors = [];

        function resize() {
            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
        }

        class FooterMeteor {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * canvas.width + 100;
                this.y = Math.random() * -canvas.height;
                this.speed = Math.random() * 3 + 1; // Lebih lambat dari header agar elegan
                this.len = Math.random() * 80 + 40;
                this.opacity = Math.random() * 0.3;
            }
            draw() {
                ctx.save();
                ctx.strokeStyle = `rgba(79, 70, 229, ${this.opacity})`;
                ctx.lineWidth = 1.5;
                ctx.beginPath();
                ctx.moveTo(this.x, this.y);
                ctx.lineTo(this.x - this.len, this.y + this.len);
                ctx.stroke();
                ctx.restore();
            }
            update() {
                this.x -= this.speed;
                this.y += this.speed;
                if (this.y > canvas.height || this.x < -100) this.reset();
            }
        }

        for (let i = 0; i < 10; i++) meteors.push(new FooterMeteor());

        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            meteors.forEach(m => { m.update(); m.draw(); });
            requestAnimationFrame(loop);
        }

        window.addEventListener('resize', resize);
        resize();
        loop();
    })();
</script>
