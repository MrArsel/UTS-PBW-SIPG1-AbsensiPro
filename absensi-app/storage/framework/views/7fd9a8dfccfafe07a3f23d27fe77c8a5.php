<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/Favicon.png')); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- HEADER -->
<div class="header">

    <div class="header-left">
        <h1 class="logo">Absensi App</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
            <?php if(auth()->user()->role == 'admin'): ?>
                <a href="<?php echo e(route('admin.users')); ?>" class="nav-link active">Akun</a>
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

    <div class="box">
        <h2>Profile Saya</h2>

        <form method="POST" action="<?php echo e(route('profile.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <label>Nama</label>
            <input type="text" name="name" value="<?php echo e(auth()->user()->name); ?>" class="input">

            <label>Email</label>
            <input type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" class="input">

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
<?php if(session('success')): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: '<?php echo e(session("success")); ?>'
});
</script>
<?php endif; ?>
</body>
</html><?php /**PATH /Users/user/absensi-app/resources/views/profile-custom.blade.php ENDPATH**/ ?>