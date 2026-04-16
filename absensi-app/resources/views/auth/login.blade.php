<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">
        
        <h2>Login</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn-auth">Login</button>
        </form>

        <div class="auth-link">
            Belum punya akun?
            <a href="{{ route('register') }}">Register</a>
        </div>
        <a href="/" class="back-floating">← Beranda</a>
    </div>

</div>

</body>
</html>