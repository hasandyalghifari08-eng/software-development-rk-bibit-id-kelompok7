<?php require __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Kelola Bibit — Admin RK Bibit ID</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Ctext y=%27.9em%27 font-size=%2790%27%3E🌱%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="../public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <script src="../public/js/api.js" defer></script>
    <script src="../public/js/admin.js" defer></script>
</head>
<body>
    <script src="../public/js/layout.js" data-part="adminnav"></script>
    <main class="container py-4">
        <?php
        $pesanOk = ['tersimpan' => 'Data berhasil disimpan.', 'terhapus' => 'Bibit berhasil dihapus.'];
        $pesanGagal = ['gagal' => 'Terjadi kesalahan. Coba lagi.', 'gambar' => 'Gambar ditolak. Gunakan JPG/PNG maksimal 200 KB.'];
        $k = $_GET['pesan'] ?? '';
        if (isset($pesanOk[$k])) {
            echo '<div class="alert alert-success" role="alert">' . $pesanOk[$k] . '</div>';
        } elseif (isset($pesanGagal[$k])) {
            echo '<div class="alert alert-danger" role="alert">' . $pesanGagal[$k] . '</div>';
        }
        ?>

        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
            <div>
                <small>Dashboard</small>
                <h1 class="h2 fw-bold mb-1">Kelola Bibit</h1>
                <p class="text-secondary mb-0">Tambah, ubah, atau hapus data bibit dan stoknya.</p>
            </div>
            <a class="btn btn-primary btn-lg" href="admin-form.php">+ Tambah Bibit</a>
        </div>

        <div class="stat stat-l mb-3">
            <div>
                <b id="stat-total">0</b>
                <span>Total bibit</span>
            </div>
            <div>
                <b id="stat-ada">0</b>
                <span>Stok tersedia</span>
            </div>
            <div>
                <b id="stat-habis">0</b>
                <span>Stok habis</span>
            </div>
        </div>

        <div class="table-responsive tabel-wrap">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama bibit</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody-bibit">
                    <tr>
                        <td colspan="6">Memuat data…</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>