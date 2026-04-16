<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/Favicon.png')); ?>">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">
        <h2>Register</h2>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>

            <div class="input-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-auth">Register</button>
        </form>

        <div class="auth-link">
            Sudah punya akun?
            <a href="<?php echo e(route('login')); ?>">Login</a>
        </div>
                <a href="/" class="back-floating">← Beranda</a>
    </div>

</div>

</body>
</html><?php /**PATH /Users/user/absensi-app/resources/views/auth/register.blade.php ENDPATH**/ ?>