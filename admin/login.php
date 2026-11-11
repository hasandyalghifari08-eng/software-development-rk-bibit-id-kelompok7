<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Login — Admin RK Bibit ID</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Ctext y=%27.9em%27 font-size=%2790%27%3E🌱%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="../public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <main class="login-wrap">
        <div class="card login-box p-4 shadow-sm">
            <a class="navbar-brand text-decoration-none text-body" href="../public/index.html">🌱 RK BIBIT ID</a>
            <h1 class="h4 fw-bold mt-3 mb-1">Login Admin</h1>
            <p class="small text-secondary">Halaman ini hanya untuk pemilik toko.</p>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger py-2 small" role="alert">Username atau password salah.</div>
            <?php endif; ?>
            
            <form method="post" action="proses-login.php">
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="username">Username</label>
                    <input class="form-control" id="username" name="username" type="text" required autocomplete="username">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
                </div>
                
                <button class="btn btn-primary btn-lg w-100" type="submit">Masuk</button>
            </form>
            
            <a class="d-inline-block small mt-3 text-decoration-none" href="../public/index.html">← Kembali ke website</a>
        </div>
    </main>
</body>
</html>