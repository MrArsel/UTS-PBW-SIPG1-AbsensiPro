<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="<?php echo e(asset('dashboard.css')); ?>">
</head>
<body>
<div class="header">

    <!-- KIRI -->
    <div class="header-left">
        <h1 class="logo">Absensi App</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
            <?php if(auth()->user()->role == 'admin'): ?>
                <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">Akun</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- KANAN -->
    <div class="user-menu">
        <span class="username" onclick="toggleDropdown()">
            👤 <?php echo e(auth()->user()->name); ?>

        </span>

        <div id="dropdownMenu" class="dropdown">
            <a href="/profile" class="dropdown-item">👤 Profil</a>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="dropdown-item logout">
                    ⇥ Logout
                </button>
            </form>
        </div>
    </div>

</div>
<div class="content">

    <!-- CARD -->
    <div class="card-container">

        <div class="card">
            <h3>Total User</h3>
            <p><?php echo e($totalUser); ?></p>
        </div>

        <div class="card">
            <h3>Total Absensi</h3>
            <p><?php echo e($totalAbsensi); ?></p>
        </div>

        <div class="card">
            <h3>Hari Ini</h3>
            <p><?php echo e($absensiHariIni); ?></p>
        </div>

    </div>

    <!-- GRAFIK -->
    <div class="box">
        <h3>Grafik Absensi</h3>
        <canvas id="chartAbsensi"></canvas>
    </div>

    <!-- USER -->
    <div class="box">
        <h3>User Terbaru</h3>
        <ul class="user-list">
            <?php $__currentLoopData = $userTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($u->name); ?> - <?php echo e($u->email); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartAbsensi');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($chartTanggal, 15, 512) ?>,
        datasets: [{
            label: 'Jumlah Absensi',
            data: <?php echo json_encode($chartJumlah, 15, 512) ?>,
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
</html><?php /**PATH /Users/user/absensi-app/resources/views/dashboard/admin.blade.php ENDPATH**/ ?>