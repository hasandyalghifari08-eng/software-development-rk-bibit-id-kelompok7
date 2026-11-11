<?php
// admin/info_toko.php
require_once 'auth_check.php';
require_once '../config.php';

$pesan = "";

// 1. Ambil data toko saat ini (id_toko = 1)
$query_get  = "SELECT * FROM toko WHERE id_toko = 1 LIMIT 1";
$result_get = mysqli_query($conn, $query_get);
$data_toko  = mysqli_fetch_assoc($result_get);

// 2. Memproses update data jika form disubmit via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_toko      = mysqli_real_escape_string($conn, $_POST['nama_toko']);
    $deskripsi_toko = mysqli_real_escape_string($conn, $_POST['deskripsi_toko']);
    $alamat         = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jam            = mysqli_real_escape_string($conn, $_POST['jam']);
    $wa             = mysqli_real_escape_string($conn, $_POST['wa']);
    $shopee         = mysqli_real_escape_string($conn, $_POST['shopee']);
    $tiktok         = mysqli_real_escape_string($conn, $_POST['tiktok']);

    $query_update = "UPDATE toko SET 
                        nama_toko      = '$nama_toko',
                        deskripsi_toko = '$deskripsi_toko',
                        alamat         = '$alamat',
                        jam            = '$jam',
                        wa             = '$wa',
                        shopee         = '$shopee',
                        tiktok         = '$tiktok'
                    WHERE id_toko      = 1";

    if (mysqli_query($conn, $query_update)) {
        header("Location: info_toko.php?status=sukses");
        exit;
    } else {
        $pesan = "Gagal memperbarui info toko: " . mysqli_error($conn);
    }
}

if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    $pesan = "Data toko berhasil diperbarui!";
    // Ambil ulang data terbaru setelah update
    $result_get = mysqli_query($conn, $query_get);
    $data_toko  = mysqli_fetch_assoc($result_get);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Info Toko - Admin RK BIBIT ID</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 20px; }
        .box { background: white; padding: 25px; border-radius: 6px; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-simpan { background: #2e7d32; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .pesan { margin-bottom: 15px; padding: 10px; background: #e8f5e9; color: #2e7d32; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Kelola Informasi Toko</h2>
        <p><a href="index.php">← Kembali ke Dashboard</a></p>

        <?php if(!empty($pesan)): ?>
            <div class="pesan"><?= $pesan; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Toko</label>
                <input type="text" name="nama_toko" value="<?= htmlspecialchars($data_toko['nama_toko'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Deskripsi Toko</label>
                <textarea name="deskripsi_toko" rows="3" required><?= htmlspecialchars($data_toko['deskripsi_toko'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label>Alamat Toko</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($data_toko['alamat'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Jam Operasional</label>
                <input type="text" name="jam" value="<?= htmlspecialchars($data_toko['jam'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Nomor WhatsApp (format 62...)</label>
                <input type="text" name="wa" value="<?= htmlspecialchars($data_toko['wa'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Link Shopee</label>
                <input type="url" name="shopee" value="<?= htmlspecialchars($data_toko['shopee'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Link TikTok Shop</label>
                <input type="url" name="tiktok" value="<?= htmlspecialchars($data_toko['tiktok'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn-simpan">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>