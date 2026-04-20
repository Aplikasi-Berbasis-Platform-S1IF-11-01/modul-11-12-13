<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Sistem Inventaris'); ?> - Toko Pak Cik & Mas Aimar</title>
    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <!-- Boxicons for icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Navbar -->
        <header class="navbar">
            <a href="#" class="navbar-brand">
                <i class='bx bx-store-alt'></i>
                <span>Toko Pak Cik & Mas Aimar</span>
            </a>
            
            <nav class="navbar-menu">
                <span class="nav-link"><i class='bx bx-user'></i> <?php echo e(Auth::user()->name); ?></span>
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                        <i class='bx bx-log-out'></i> Logout
                    </button>
                </form>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class='bx bx-check-circle'></i> <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <i class='bx bx-error-circle'></i> <?php echo e(session('error')); ?>

            </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Simple DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\jjj\k\2311102030\resources\views/layouts/app.blade.php ENDPATH**/ ?>