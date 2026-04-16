<!DOCTYPE html>
<html>
<head>
    <title>AbsensiPro</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    body {
        background: linear-gradient(to bottom, #f0f4ff, #ffffff);
    }
    .stats {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin: 60px 0;
    }

    .stat-box {
        background: white;
        padding: 20px 40px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .stat-box:hover {
        transform: translateY(-10px);
    }

    .stat-box h2 {
        color: #1e3a8a;
        font-size: 32px;
    }

    .preview {
        text-align: center;
        padding: 60px 20px;
    }

    .preview-img {
        width: 70%;
        margin-top: 20px;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        transition: 0.3s;
    }

    .preview-img:hover {
        transform: scale(1.03);
    }

    /* === cta === */
    .cta {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: white;
        text-align: center;
        padding: 50px 20px;
        border-radius: 20px;
        margin: 60px 20px;
    }

    .cta h2 {
        margin-bottom: 20px;
    }

    /* === hero animasi === */
    .hero-img img {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
</style>
<body>
<div class="feature-card scroll-animate">
<!-- navbar -->
<div class="navbar">
    <div class="logo">
        <img src="{{ asset('images/Favicon.png') }}" alt="logo">
        <span>AbsensiPro</span>
    </div>

    <div>
        @auth
            <a href="/dashboard" class="btn-outline">Dashboard</a>
        @else
            <a href="/login" class="btn-outline">
                <span>Login</span>
            </a>
        @endauth
    </div>
</div>

<div class="hero">
    <div class="hero-text">
        <h1>Sistem Absensi Online<br>Modern & Akurat</h1>
        <p>Kelola kehadiran dengan mudah, cepat, dan real-time.</p>

        <br>

        <a href="/register" class="btn-main">
            <span>🚀 Mulai Sekarang</span>
        </a>
    </div>

    <div class="hero-img">
        <img src="{{ asset('images/dashboard.png') }}" alt="dashboard">
    </div>
</div>

<!-- fitur -->
<div class="fitur">
    <div class="fitur-card">
        <i class='bx bx-time icon'></i>
        <h3>Absensi Mudah</h3>
        <p>Catat kehadiran hanya dengan satu klik secara cepat dan praktis.</p>
    </div>

    <div class="fitur-card">
        <i class='bx bx-bolt-circle icon'></i>
        <h3>Real-Time</h3>
        <p>Data absensi langsung tersimpan dan dapat dipantau saat itu juga.</p>
    </div>

    <div class="fitur-card">
        <i class='bx bx-bar-chart-alt-2 icon'></i>
        <h3>Dashboard Statistik</h3>
        <p>Lihat ringkasan absensi dengan grafik dan data yang informatif.</p>
    </div>

    <div class="fitur-card">
        <i class='bx bx-user icon'></i>
        <h3>Manajemen User</h3>
        <p>Admin dapat mengelola akun pengguna dengan mudah.</p>
    </div>
</div>

<!-- stats -->
<div class="stats">
    <div class="stat-box">
        <h2>500+</h2>
        <p>Pengguna Aktif</p>
    </div>
    <div class="stat-box">
        <h2>10K+</h2>
        <p>Data Absensi</p>
    </div>
    <div class="stat-box">
        <h2>99%</h2>
        <p>Akurasi Sistem</p>
    </div>
</div>

<!-- preview -->
<div class="preview">
    <h2>Preview Sistem</h2>
    <p>Lihat bagaimana sistem bekerja secara real-time</p>

    <img src="{{ asset('images/preview.png') }}" class="preview-img">
</div>

<!-- cta -->
<div class="cta">
    <h2>Siap Mengelola Absensi Lebih Mudah?</h2>
    <a href="/register" class="btn-main">
        <span>Mulai Sekarang</span>
    </a>
</div>

<!-- footer -->
<div class="footer">
    <p>© {{ date('Y') }} AbsensiPro</p>
</div>
<script>
    const elements = document.querySelectorAll('.scroll-animate');

    window.addEventListener('scroll', () => {
        elements.forEach(el => {
            const position = el.getBoundingClientRect().top;
            const screenHeight = window.innerHeight;

            if (position < screenHeight - 100) {
                el.classList.add('show');
            }
        });
    });
</script>
</body>
</html>