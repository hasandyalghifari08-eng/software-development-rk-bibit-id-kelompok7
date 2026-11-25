<?php
// admin/edit_bibit.php
require_once 'auth_check.php';
require_once '../config.php';

$pesan = "";
$data_bibit = null;

// 1. Ambil data bibit lama berdasarkan ID yang dikirim via URL GET
if (isset($_GET['id'])) {
    $id_bibit = (int)$_GET['id'];
    $query_get = "SELECT * FROM bibit WHERE id_bibit = $id_bibit LIMIT 1";
    $result_get = mysqli_query($conn, $query_get);

    if ($result_get && mysqli_num_rows($result_get) > 0) {
        $data_bibit = mysqli_fetch_assoc($result_get);
    } else {
        header("Location: index.php?error=tidak_ditemukan");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

// 2. Memproses perubahan data saat form disubmit via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_bibit    = (int)$_POST['id_bibit'];
    $id_kategori = (int)$_POST['id_kategori'];
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok']; // Update jumlah stok di sini
    $ringkas     = mysqli_real_escape_string($conn, $_POST['ringkas']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $cahaya      = mysqli_real_escape_string($conn, $_POST['cahaya']);
    $air         = mysqli_real_escape_string($conn, $_POST['air']);
    $media       = mysqli_real_escape_string($conn, $_POST['media']);
    $tinggi      = mysqli_real_escape_string($conn, $_POST['tinggi']);
    
    $gambar_lama = $_POST['gambar_lama'];
    $nama_gambar = $gambar_lama; // Default menggunakan gambar lama

    // Cek apakah admin mengunggah file gambar baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $nama_file   = $_FILES['gambar']['name'];
        $ukuran_file = $_FILES['gambar']['size'];
        $tmp_name    = $_FILES['gambar']['tmp_name'];

        $ekstensi_valid = ['jpg', 'jpeg', 'png'];
        $ekstensi_file  = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

        if (!in_array($ekstensi_file, $ekstensi_valid)) {
            $pesan = "Format gambar baru harus JPG, JPEG, atau PNG!";
        } elseif ($ukuran_file > 204800) { // Maksimal 200 KB
            $pesan = "Ukuran gambar terlalu besar! Maksimal 200 KB.";
        } else {
            // Generate nama file unik baru
            $nama_gambar_baru = uniqid('bibit_', true) . '.' . $ekstensi_file;
            $tujuan_upload    = '../uploads/' . $nama_gambar_baru;

            if (move_uploaded_file($tmp_name, $tujuan_upload)) {
                // Hapus file gambar lama jika ada di server
                $path_gambar_lama = '../uploads/' . $gambar_lama;
                if (file_exists($path_gambar_lama) && !empty($gambar_lama)) {
                    unlink($path_gambar_lama);
                }
                $nama_gambar = $nama_gambar_baru;
            } else {
                $pesan = "Gagal mengunggah gambar baru!";
            }
        }
    }

    // Eksekusi update jika tidak ada error validasi gambar
    if (empty($pesan)) {
        $query_update = "UPDATE bibit SET 
                            id_kategori = '$id_kategori',
                            nama        = '$nama',
                            harga       = '$harga',
                            stok        = '$stok',
                            ringkas     = '$ringkas',
                            deskripsi   = '$deskripsi',
                            cahaya      = '$cahaya',
                            air         = '$air',
                            media       = '$media',
                            tinggi      = '$tinggi',
                            gambar      = '$nama_gambar'
                        WHERE id_bibit  = $id_bibit";

        if (mysqli_query($conn, $query_update)) {
            header("Location: index.php?status=sukses_edit");
            exit;
        } else {
            $pesan = "Gagal memperbarui data: " . mysqli_error($conn);
        }
    }
}
?>