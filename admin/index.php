<?php
// admin/index.php
require_once 'auth_check.php';
require_once '../config.php';

// 1. Query Statistik Ringkasan Stok
$q_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM bibit");
$total_bibit = mysqli_fetch_assoc($q_total)['total'];

$q_tersedia = mysqli_query($conn, "SELECT COUNT(*) as tersedia FROM bibit WHERE stok > 0");
$stok_tersedia = mysqli_fetch_assoc($q_tersedia)['tersedia'];

$q_habis = mysqli_query($conn, "SELECT COUNT(*) as habis FROM bibit WHERE stok = 0");
$stok_habis = mysqli_fetch_assoc($q_habis)['habis'];

// 2. Query READ Data Bibit beserta Kategori
$query = "SELECT b.*, k.nama_kategori 
          FROM bibit b 
          LEFT JOIN kategori k ON b.id_kategori = k.id_kategori 
          ORDER BY b.id_bibit DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Bibit - Admin RK BIBIT ID</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 20px; }
        .stats { display: flex; gap: 15px; margin-bottom: 20px; }
        .card { background: white; padding: 15px 25px; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 6px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2e7d32; color: white; }
        .badge-tersedia { color: #2e7d32; font-weight: bold; }
        .badge-habis { color: #d32f2f; font-weight: bold; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 14px; }
        .btn-tambah { background: #2e7d32; color: white; margin-bottom: 15px; display: inline-block; }
        .btn-edit { background: #ffa000; color: white; }
        .btn-hapus { background: #d32f2f; color: white; }
    </style>
</head>
<body>

    <h2>Dashboard Kelola Bibit</h2>
    <p><a href="info_toko.php">Edit Info Toko</a> | <a href="logout.php" style="color:red;">Logout</a></p>

    <!-- Ringkasan Statistik -->
    <div class="stats">
        <div class="card"><strong>Total Bibit:</strong> <?= $total_bibit; ?></div>
        <div class="card"><strong>Stok Tersedia:</strong> <?= $stok_tersedia; ?></div>
        <div class="card"><strong>Stok Habis:</strong> <?= $stok_habis; ?></div>
    </div>

    <a href="tambah_bibit.php" class="btn btn-tambah">+ Tambah Bibit Baru</a>

    <!-- Tabel READ Data Bibit -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bibit</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= htmlspecialchars($row['nama']); ?></strong></td>
                        <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                        <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <?php if ($row['stok'] > 0): ?>
                                <span class="badge-tersedia">Tersedia</span>
                            <?php else: ?>
                                <span class="badge-habis">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_bibit.php?id=<?= $row['id_bibit']; ?>" class="btn btn-edit">Ubah</a>
                            <a href="hapus_bibit.php?id=<?= $row['id_bibit']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus bibit ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data bibit.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>