<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .user-home {
            max-width: 100%;
            margin: auto;
        }

        .user-home > div {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            animation: fadeUp 0.5s ease;
        }

        .welcome-box h2 {
            margin: 0;
            color: #1e3a8a;
        }

        .status-box h3 {
            margin-bottom: 10px;
        }

        .status {
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .status.belum {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status.selesai {
            background: #dcfce7;
            color: #166534;
        }

        .status.proses {
            background: #dbeafe;
            color: #1e3a8a;
        }

        .activity-box b {
            color: #1e3a8a;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="header">

    <!-- kiri -->
    <div class="header-left">
        <h1 class="logo">AbsensiPro</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
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

<!-- content -->
<div class="content">
    <div class="user-home">
        <div class="welcome-box">
            <h2>Halo, {{ auth()->user()->name }}</h2>
            <p>Semoga harimu produktif! Jangan lupa absensi ya.</p>
        </div>
        <!-- status hari ini -->
        @php
            $today = $data->where('tanggal', date('Y-m-d'))->first();
        @endphp

        <div class="status-box">
            <h3>Status Hari Ini</h3>

            @if(!$today)
                <p class="status belum">Belum Absen</p>
            @elseif($today->jam_keluar)
                <p class="status selesai">Selesai</p>
            @else
                <p class="status proses">Sudah Masuk</p>
            @endif
        </div>

        <div class="activity-box">
            <h3>Aktivitas Terakhir</h3>

            @if($data->count())
                @php $last = $data->last(); @endphp

                <p>
                    Terakhir absen pada 
                    <b>{{ $last->tanggal }}</b> 
                    pukul 
                    <b>{{ $last->jam_masuk }}</b>
                </p>
            @else
                <p>Belum ada aktivitas</p>
            @endif
        </div>

    </div>

    <h2>Riwayat Absensi</h2>

    @if($data->isEmpty())
        <p style="color: gray;">Belum ada data absensi</p>
    @endif

    <div class="box">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{ $d->tanggal }}</td>
                    <td>{{ $d->jam_masuk }}</td>
                    <td>{{ $d->jam_keluar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("show");
    }

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
