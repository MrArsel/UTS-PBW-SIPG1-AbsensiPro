<!DOCTYPE html>
<html>
<head>
    <title>Absensi</title>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/Favicon.png')); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- HEADER SAMA -->
<div class="header">

    <div class="header-left">
        <h1 class="logo">Absensi App</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link active">Absensi</a>
            <?php if(auth()->user()->role == 'admin'): ?>
                <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">Akun</a>
            <?php endif; ?>
        </div>
    </div>

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

    <h2>Absensi</h2>

    <!-- CARD -->
    <div class="card-container">

        <div class="card">
            <p>Total Absensi</p>
            <h3><?php echo e($data->count()); ?></h3>
        </div>

        <div class="card">
            <p>Hari Ini</p>
            <h3><?php echo e($data->where('tanggal', date('Y-m-d'))->count()); ?></h3>
        </div>

        <div class="card">
            <p>Belum Keluar</p>
            <h3><?php echo e($data->where('jam_keluar', null)->count()); ?></h3>
        </div>

    </div>

    <!-- BUTTON -->
    <?php
        $today = $data->where('tanggal', date('Y-m-d'))->first();
    ?>

    <form action="<?php echo e(route('absensi.masuk')); ?>" method="POST" style="margin-top:20px;">
        <?php echo csrf_field(); ?>
        <button class="btn-success" <?php echo e($today ? 'disabled' : ''); ?>>
            Absen Masuk
        </button>
    </form>

    <!-- FILTER -->
    <form method="GET" style="margin-top:15px;">
        <input type="date" name="tanggal" class="input-date">
        <button class="btn-primary">Filter</button>
    </form>

    <!-- TABLE -->
    <div class="box">
        <table class="custom-table">

            <thead>
                <tr>
                    <?php if(auth()->user()->role == 'admin'): ?>
                        <th>Nama</th>
                    <?php endif; ?>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if(auth()->user()->role == 'admin'): ?>
                        <td><?php echo e($d->user->name); ?></td>
                    <?php endif; ?>

                    <td><?php echo e($d->tanggal); ?></td>
                    <td><?php echo e($d->jam_masuk); ?></td>
                    <td><?php echo e($d->jam_keluar); ?></td>

                    <td>
                        <?php if($d->jam_keluar): ?>
                            <span class="status done">Selesai</span>
                        <?php else: ?>
                            <span class="status pending">Belum</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if(!$d->jam_keluar): ?>
                        <form action="<?php echo e(route('absensi.keluar', $d->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn-danger">Absen Keluar</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>

</div>

<!-- DROPDOWN JS -->
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

<!-- ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(session('success')): ?>
<script>
Swal.fire({ icon: 'success', title: 'Sukses', text: '<?php echo e(session("success")); ?>' });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
Swal.fire({ icon: 'error', title: 'Oops', text: '<?php echo e(session("error")); ?>' });
</script>
<?php endif; ?>

</body>
</html><?php /**PATH /Users/user/absensi-app/resources/views/absensi/index.blade.php ENDPATH**/ ?>