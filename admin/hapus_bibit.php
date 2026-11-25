<?php
// admin/hapus_bibit.php
require_once 'auth_check.php';
require_once '../config.php';

// Memastikan parameter ID bibit tersedia di URL
if (isset($_GET['id'])) {
    $id_bibit = (int)$_GET['id'];

    // 1. Ambil nama file gambar dari database sebelum menghapus data
    $query_gambar = "SELECT gambar FROM bibit WHERE id_bibit = $id_bibit";
    $res_gambar   = mysqli_query($conn, $query_gambar);

    if ($res_gambar && mysqli_num_rows($res_gambar) > 0) {
        $row = mysqli_fetch_assoc($res_gambar);
        $nama_gambar = $row['gambar'];

        // 2. Hapus file gambar fisik dari folder uploads/ jika filenya ada
        if (!empty($nama_gambar)) {
            $file_path = '../uploads/' . $nama_gambar;
            if (file_exists($file_path)) {
                unlink($file_path); // Menghapus file fisik dari server
            }
        }
    }

    // 3. Hapus baris data bibit dari tabel MySQL
    $query_hapus = "DELETE FROM bibit WHERE id_bibit = $id_bibit";
    if (mysqli_query($conn, $query_hapus)) {
        header("Location: index.php?status=sukses_hapus");
        exit;
    } else {
        echo "Gagal menghapus data dari database: " . mysqli_error($conn);
        exit;
    }
}

// Jika diakses tanpa parameter ID, langsung kembalikan ke index admin
header("Location: index.php");
exit;
?>