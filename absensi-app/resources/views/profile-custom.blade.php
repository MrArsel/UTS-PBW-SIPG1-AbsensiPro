<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- header -->
<div class="header">

    <div class="header-left">
        <h1 class="logo">AbsensiPro</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.users') }}" class="nav-link active">Akun</a>
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

    <div class="box">
        <h2>Profile Saya</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <label>Nama</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="input">

            <label>Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="input">

            <button class="btn-primary">Update Profile</button>
        </form>
    </div>

</div>

<script>
    function toggleDropdown() {
        document.getElementById("dropdownMenu").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.closest('.user-menu')) {
            document.getElementById("dropdownMenu").classList.remove('show');
        }
    }
</script>
    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: '{{ session("success") }}'
    });
</script>
@endif
</body>
</html>
