<?php require __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Info Toko — Admin RK Bibit ID</title>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Ctext y=%27.9em%27 font-size=%2790%27%3E🌱%3C/text%3E%3C/svg%3E">
<link rel="stylesheet" href="../public/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../public/style.css">
<script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script><script src="../public/js/api.js" defer></script><script src="../public/js/admin.js" defer></script>
</head>
<body>
<script src="../public/js/layout.js" data-part="adminnav"></script>
<main class="container py-4">
<?php
$pesanOk = ['tersimpan' => 'Data berhasil disimpan.', 'terhapus' => 'Bibit berhasil dihapus.'];
$pesanGagal = ['gagal' => 'Terjadi kesalahan. Coba lagi.', 'gambar' => 'Gambar ditolak. Gunakan JPG/PNG maksimal 200 KB.'];
$k = $_GET['pesan'] ?? '';
if (isset($pesanOk[$k])) echo '<div class="alert alert-success" role="alert">' . $pesanOk[$k] . '</div>';
elseif (isset($pesanGagal[$k])) echo '<div class="alert alert-danger" role="alert">' . $pesanGagal[$k] . '</div>';
?>
<small>Dashboard</small><h1 class="h2 fw-bold mb-1">Info Toko</h1>
<p class="small text-secondary">Data ini tampil di halaman Tentang Toko dan tombol pemesanan.</p>
<form class="row g-3 form-admin" method="post" action="proses-toko.php" id="form-toko">
<div class="col-12"><label class="form-label fw-semibold" for="nama_toko">Nama toko</label><input class="form-control" id="nama_toko" name="nama_toko" type="text" value="RK Bibit ID"></div>
<div class="col-12"><label class="form-label fw-semibold" for="deskripsi_toko">Deskripsi toko</label><textarea class="form-control" id="deskripsi_toko" name="deskripsi_toko" rows="4">Toko bibit tanaman buah, hias, bunga, dan sayur.</textarea></div>
<div class="col-12"><label class="form-label fw-semibold" for="alamat">Alamat</label><input class="form-control" id="alamat" name="alamat" type="text" value="Jl. Contoh No. 1, Kediri"></div><div class="col-12"><label class="form-label fw-semibold" for="jam">Jam operasional</label><input class="form-control" id="jam" name="jam" type="text" value="Setiap hari, 08.00-17.00"></div>
<div class="col-12"><label class="form-label fw-semibold" for="wa">Nomor WhatsApp (format 62...)</label><input class="form-control" id="wa" name="wa" type="text" value="6281234567890"></div><div class="col-12"><label class="form-label fw-semibold" for="shopee">Link Shopee</label><input class="form-control" id="shopee" name="shopee" type="url" value="https://shopee.co.id/"></div><div class="col-12"><label class="form-label fw-semibold" for="tiktok">Link TikTok Shop</label><input class="form-control" id="tiktok" name="tiktok" type="url" value="https://www.tiktok.com/"></div>
<div class="col-12"><button class="btn btn-primary btn-lg" type="submit">Simpan</button></div></form></main>
</body>
</html>
