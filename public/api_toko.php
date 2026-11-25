<?php
// public/api_toko.php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once '../config.php';

// Query untuk mengambil data profil toko
$query = "SELECT * FROM toko WHERE id_toko = 1 LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data_toko = mysqli_fetch_assoc($result);
    echo json_encode([
        'status' => 'success',
        'data'   => $data_toko
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'pesan'  => 'Data toko tidak ditemukan'
    ]);
}
?>