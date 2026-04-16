<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="header">

    <!-- kiri -->
    <div class="header-left">
        <h1 class="logo">Absensi App</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.users') }}" class="nav-link">Akun</a>
            @endif
        </div>
    </div>

    <!-- kanan -->
    <div class="user-menu">
        <span class="username" onclick="toggleDropdown()">
            <i class='bx bx-user'></i> {{ auth()->user()->name }}
        </span>

        <div id="dropdownMenu" class="dropdown">
            <a href="/profile" class="dropdown-item">
                <i class='bx bx-user-circle'></i> Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item logout">
                    <i class='bx bx-log-out'></i> Logout
                </button>
            </form>
        </div>
    </div>

</div>
<div class="content">

    <!-- card -->
    <div class="card-container">

        <div class="card">
            <h3>Total User</h3>
            <p>{{ $totalUser }}</p>
        </div>

        <div class="card">
            <h3>Total Absensi</h3>
            <p>{{ $totalAbsensi }}</p>
        </div>

        <div class="card">
            <h3>Hari Ini</h3>
            <p>{{ $absensiHariIni }}</p>
        </div>

    </div>

    <!-- grafik -->
    <div class="box">
        <h3>Grafik Absensi</h3>
        <canvas id="chartAbsensi"></canvas>
    </div>

    <!-- user -->
    <div class="box">
        <h3>User Terbaru</h3>
        <ul class="user-list">
            @foreach($userTerbaru as $u)
                <li>{{ $u->name }} - {{ $u->email }}</li>
            @endforeach
        </ul>
    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartAbsensi');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartTanggal),
            datasets: [{
                label: 'Jumlah Absensi',
                data: @json($chartJumlah),
                borderWidth: 2,
                tension: 0.3
            }]
        }
    });
</script>
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("show");
    }

    // klik di luar = tutup dropdown
    window.onclick = function(event) {
        if (!event.target.closest('.user-menu')) {
            const dropdown = document.getElementById("dropdownMenu");
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
</script>
</body>
</html>