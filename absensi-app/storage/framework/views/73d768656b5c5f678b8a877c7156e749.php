<!DOCTYPE html>
<html>
<head>
    <title>Kelola User</title>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard.css')); ?>">
</head>
<style>


/* === TABLE MODERN === */
.table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 12px;
}

/* HEADER */
.table th {
    background: #1e3a8a;
    color: white;
    padding: 12px;
    text-align: left;
}

/* ROW */
.table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    transition: 0.3s;
}

/* HOVER ROW */
.table tr:hover td {
    background: #f1f5ff;
    transform: scale(1.01);
}

/* ZEBRA */
.table tr:nth-child(even) {
    background: #fafafa;
}

/* === BUTTON EDIT === */
.btn-edit {
    position: relative;
    background: linear-gradient(135deg, #3b82f6, #1e3a8a);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    overflow: hidden;
    transition: 0.3s;
}

/* SWIPE EFFECT */
.btn-edit::before {
    content: "";
    position: absolute;
    left: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    transition: 0.4s;
}

.btn-edit:hover::before {
    left: 100%;
}

/* === BUTTON DELETE === */
.btn-delete {
    position: relative;
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
    overflow: hidden;
    transition: 0.3s;
}

.btn-delete::before {
    content: "";
    position: absolute;
    left: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    transition: 0.4s;
}

.btn-delete:hover::before {
    left: 100%;
}

/* === BOX ANIMASI MASUK === */
.box {
    animation: fadeInUp 0.6s ease;
}

/* ANIMATION */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<body>

<!-- HEADER SAMA -->
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

    <h2>Kelola User</h2>

    <div class="box">
        <table class="table">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>

            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($u->name); ?></td>
                <td><?php echo e($u->email); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.users.edit', $u->id)); ?>" class="btn-edit">Edit</a>

                    <form action="<?php echo e(route('admin.users.delete', $u->id)); ?>" style="display:inline;" method="POST" onsubmit="confirmDelete(this)">
                        <?php echo csrf_field(); ?>
                        <button class="btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>

</div>
<script>
function toggleDropdown() {
    document.getElementById("dropdownMenu").classList.toggle("show");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(form) {
    event.preventDefault();

    Swal.fire({
        title: 'Yakin hapus user?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1e3a8a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
</body>
</html><?php /**PATH /Users/user/absensi-app/resources/views/admin/users.blade.php ENDPATH**/ ?>