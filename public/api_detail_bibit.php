<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once '../config.php';

if (isset($_GET['id'])) {
    $id_bibit = (int)$_GET['id'];

    $query = "SELECT b.*, k.nama_kategori 
              FROM bibit b 
              LEFT JOIN kategori k ON b.id_kategori = k.id_kategori 
              WHERE b.id_bibit = $id_bibit 
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $data['status_ketersediaan'] = ($data['stok'] > 0) ? 'tersedia' : 'habis';

        echo json_encode([
            'status' => 'success',
            'data'   => $data
        ]);
        exit;
    }
}

echo json_encode([
    'status' => 'error',
    'pesan'  => 'Bibit tidak ditemukan'
]);
?>