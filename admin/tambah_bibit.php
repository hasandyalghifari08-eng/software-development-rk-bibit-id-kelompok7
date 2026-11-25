<?php
// admin/tambah_bibit.php
require_once 'auth_check.php';
require_once '../config.php';

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kategori = $_POST['id_kategori'];
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];
    $ringkas     = mysqli_real_escape_string($conn, $_POST['ringkas']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $cahaya      = mysqli_real_escape_string($conn, $_POST['cahaya']);
    $air         = mysqli_real_escape_string($conn, $_POST['air']);
    $media       = mysqli_real_escape_string($conn, $_POST['media']);
    $tinggi      = mysqli_real_escape_string($conn, $_POST['tinggi']);

    // Logika Pengolahan Upload Gambar
    $nama_file   = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tmp_name    = $_FILES['gambar']['tmp_name'];
    $error       = $_FILES['gambar']['error'];

    if ($error === 0) {
        $ekstensi_valid = ['jpg', 'jpeg', 'png'];
        $ekstensi_file  = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

        if (!in_array($ekstensi_file, $ekstensi_valid)) {
            $pesan = "Format gambar harus JPG, JPEG, atau PNG!";
        } elseif ($ukuran_file > 204800) { // Max 200 KB (200 * 1024 bytes)
            $pesan = "Ukuran gambar terlalu besar! Maksimal 200 KB.";
        } else {
            // Generate nama file unik
            $nama_gambar_baru = uniqid('bibit_', true) . '.' . $ekstensi_file;
            $tujuan_upload    = '../uploads/' . $nama_gambar_baru;

            if (move_uploaded_file($tmp_name, $tujuan_upload)) {
                $query = "INSERT INTO bibit (id_kategori, nama, harga, stok, ringkas, deskripsi, cahaya, air, media, tinggi, gambar) 
                          VALUES ('$id_kategori', '$nama', '$harga', '$stok', '$ringkas', '$deskripsi', '$cahaya', '$air', '$media', '$tinggi', '$nama_gambar_baru')";
                
                if (mysqli_query($conn, $query)) {
                    header("Location: index.php?status=sukses_tambah");
                    exit;
                } else {
                    $pesan = "Gagal menyimpan ke database: " . mysqli_error($conn);
                }
            } else {
                $pesan = "Gagal mengunggah file gambar ke folder uploads!";
            }
        }
    } else {
        $pesan = "Silakan pilih file gambar!";
    }
}
?>