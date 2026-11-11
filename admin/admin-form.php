<?php require __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Tambah / Ubah Bibit — Admin RK Bibit ID</title>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Ctext y=%27.9em%27 font-size=%2790%27%3E🌱%3C/text%3E%3C/svg%3E">
<link rel="stylesheet" href="../public/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../public/style.css">
<script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script><script src="../public/js/api.js" defer></script><script src="../public/js/admin.js" defer></script>
</head>
<body>
<script src="../public/js/layout.js" data-part="adminnav"></script>
<main class="container py-4"><a class="d-inline-block small mb-2 text-decoration-none" href="admin.php">← Kembali ke daftar bibit</a>

<?php
$pesanOk = ['tersimpan' => 'Data berhasil disimpan.', 'terhapus' => 'Bibit berhasil dihapus.'];
$pesanGagal = ['gagal' => 'Terjadi kesalahan. Coba lagi.', 'gambar' => 'Gambar ditolak. Gunakan JPG/PNG maksimal 200 KB.'];
$k = $_GET['pesan'] ?? '';
if (isset($pesanOk[$k])) echo '<div class="alert alert-success" role="alert">' . $pesanOk[$k] . '</div>';
elseif (isset($pesanGagal[$k])) echo '<div class="alert alert-danger" role="alert">' . $pesanGagal[$k] . '</div>';
?>
<h1 class="h2 fw-bold mb-3" id="judul-form">Tambah Bibit</h1>
<form class="row g-3 form-admin" method="post" action="proses-simpan.php" id="form-bibit" enctype="multipart/form-data">
<input type="hidden" id="id" name="id" value="">
<div class="col-12"><label class="form-label fw-semibold" for="nama">Nama bibit</label><input class="form-control" id="nama" name="nama" type="text" required maxlength="80"></div>
<div class="col-12"><label class="form-label fw-semibold" for="kategori">Kategori</label><select class="form-select" id="kategori" name="kategori" required><option>Buah</option><option>Hias</option><option>Bunga</option><option>Sayur</option></select></div>
<div class="col-6"><label class="form-label fw-semibold" for="harga">Harga (Rp)</label><input class="form-control" id="harga" name="harga" type="number" required min="0"></div><div class="col-6"><label class="form-label fw-semibold" for="stok">Stok (jumlah)</label><input class="form-control" id="stok" name="stok" type="number" required min="0"></div>
<div class="col-12"><label class="form-label fw-semibold" for="ringkas">Deskripsi singkat</label><input class="form-control" id="ringkas" name="ringkas" type="text" maxlength="120"></div>
<div class="col-12"><label class="form-label fw-semibold" for="deskripsi">Deskripsi lengkap</label><textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea></div>
<div class="col-md-6"><label class="form-label fw-semibold" for="cahaya">Kebutuhan cahaya</label><input class="form-control" id="cahaya" name="cahaya" type="text" maxlength="100"></div><div class="col-md-6"><label class="form-label fw-semibold" for="air">Penyiraman</label><input class="form-control" id="air" name="air" type="text" maxlength="100"></div><div class="col-md-6"><label class="form-label fw-semibold" for="media">Media tanam</label><input class="form-control" id="media" name="media" type="text" maxlength="100"></div><div class="col-md-6"><label class="form-label fw-semibold" for="tinggi">Tinggi bibit</label><input class="form-control" id="tinggi" name="tinggi" type="text" maxlength="30"></div>
<div class="col-12"><label class="form-label fw-semibold" for="gambar">Gambar bibit (JPG/PNG, maks. 200 KB)</label><input class="form-control" id="gambar" name="gambar" type="file" accept="image/png,image/jpeg"></div>
<div class="col-12 d-flex gap-2"><button class="btn btn-primary btn-lg" type="submit">Simpan</button><a class="btn btn-soft btn-lg" href="admin.php">Batal</a></div>
</form></main>
</body>
</html>
