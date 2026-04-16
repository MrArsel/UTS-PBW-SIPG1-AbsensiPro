<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/Favicon.png')); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* CONTAINER */
        .user-home {
            max-width: 100%;
            margin: auto;
        }

        /* BOX UMUM */
        .user-home > div {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            animation: fadeUp 0.5s ease;
        }

        /* WELCOME */
        .welcome-box h2 {
            margin: 0;
            color: #1e3a8a;
        }

        /* STATUS */
        .status-box h3 {
            margin-bottom: 10px;
        }

        .status {
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        /* WARNA STATUS */
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

        /* ACTIVITY */
        .activity-box b {
            color: #1e3a8a;
        }

        /* ANIMASI */
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

<!-- HEADER (SAMA SEPERTI ADMIN) -->
<div class="header">

    <!-- KIRI -->
    <div class="header-left">
        <h1 class="logo">Absensi App</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
        </div>
    </div>

    <!-- KANAN -->
<div class="user-menu">
    <span class="username" onclick="toggleDropdown()">
        <i class='bx bx-user'></i> <?php echo e(auth()->user()->name); ?>

    </span>

    <div id="dropdownMenu" class="dropdown">
        <a href="/profile" class="dropdown-item">
            <i class='bx bx-user-circle'></i> Profil
        </a>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="dropdown-item logout">
                <i class='bx bx-log-out'></i> Logout
            </button>
        </form>
    </div>
</div>

</div>

<!-- CONTENT -->
<div class="content">
<div class="user-home">

    <!-- GREETING -->
    <div class="welcome-box">
        <h2>Halo, <?php echo e(auth()->user()->name); ?></h2>
        <p>Semoga harimu produktif! Jangan lupa absensi ya.</p>
    </div>

    <!-- STATUS HARI INI -->
    <?php
        $today = $data->where('tanggal', date('Y-m-d'))->first();
    ?>

    <div class="status-box">
        <h3>Status Hari Ini</h3>

        <?php if(!$today): ?>
            <p class="status belum">Belum Absen</p>
        <?php elseif($today->jam_keluar): ?>
            <p class="status selesai">Selesai</p>
        <?php else: ?>
            <p class="status proses">Sudah Masuk</p>
        <?php endif; ?>
    </div>

    <!-- AKTIVITAS TERAKHIR -->
    <div class="activity-box">
        <h3>Aktivitas Terakhir</h3>

        <?php if($data->count()): ?>
            <?php $last = $data->last(); ?>

            <p>
                Terakhir absen pada 
                <b><?php echo e($last->tanggal); ?></b> 
                pukul 
                <b><?php echo e($last->jam_masuk); ?></b>
            </p>
        <?php else: ?>
            <p>Belum ada aktivitas</p>
        <?php endif; ?>
    </div>

</div>
    <h2>Riwayat Absensi</h2>

    <?php if($data->isEmpty()): ?>
        <p style="color: gray;">Belum ada data absensi</p>
    <?php endif; ?>

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
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($d->tanggal); ?></td>
                    <td><?php echo e($d->jam_masuk); ?></td>
                    <td><?php echo e($d->jam_keluar); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>

<!-- JS DROPDOWN -->
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
</html><?php /**PATH /Users/user/absensi-app/resources/views/dashboard/user.blade.php ENDPATH**/ ?>