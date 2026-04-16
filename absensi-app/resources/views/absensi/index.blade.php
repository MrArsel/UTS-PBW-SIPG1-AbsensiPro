<!DOCTYPE html>
<html>
<head>
    <title>Absensi</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="header">

    <div class="header-left">
        <h1 class="logo">Absensi App</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link active">Absensi</a>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.users') }}" class="nav-link">Akun</a>
            @endif
        </div>
    </div>

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

    <h2>Absensi</h2>

    <div class="card-container">

        <div class="card">
            <p>Total Absensi</p>
            <h3>{{ $data->count() }}</h3>
        </div>

        <div class="card">
            <p>Hari Ini</p>
            <h3>{{ $data->where('tanggal', date('Y-m-d'))->count() }}</h3>
        </div>

        <div class="card">
            <p>Belum Keluar</p>
            <h3>{{ $data->where('jam_keluar', null)->count() }}</h3>
        </div>

    </div>

    <!-- tombol -->
    @php
        $today = $data->where('tanggal', date('Y-m-d'))->first();
    @endphp

    <form action="{{ route('absensi.masuk') }}" method="POST" style="margin-top:20px;">
        @csrf
        <button class="btn-success" {{ $today ? 'disabled' : '' }}>
            Absen Masuk
        </button>
    </form>

    <!-- filter -->
    <form method="GET" style="margin-top:15px;">
        <input type="date" name="tanggal" class="input-date">
        <button class="btn-primary">Filter</button>
    </form>

    <!-- tabel -->
    <div class="box">
        <table class="custom-table">

            <thead>
                <tr>
                    @if(auth()->user()->role == 'admin')
                        <th>Nama</th>
                    @endif
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $d)
                <tr>
                    @if(auth()->user()->role == 'admin')
                        <td>{{ $d->user->name }}</td>
                    @endif

                    <td>{{ $d->tanggal }}</td>
                    <td>{{ $d->jam_masuk }}</td>
                    <td>{{ $d->jam_keluar }}</td>

                    <td>
                        @if($d->jam_keluar)
                            <span class="status done">Selesai</span>
                        @else
                            <span class="status pending">Belum</span>
                        @endif
                    </td>

                    <td>
                        @if(!$d->jam_keluar)
                        <form action="{{ route('absensi.keluar', $d->id) }}" method="POST">
                            @csrf
                            <button class="btn-danger">Absen Keluar</button>
                        </form>
                        @endif
                    </td>
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
            dropdown.classList.remove('show');
        }
    }
</script>

<!-- swtalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({ icon: 'success', title: 'Sukses', text: '{{ session("success") }}' });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({ icon: 'error', title: 'Oops', text: '{{ session("error") }}' });
</script>
@endif

</body>
</html>