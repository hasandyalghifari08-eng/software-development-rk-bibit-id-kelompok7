<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once '../config.php';
$response = [];

$query = "SELECT b.id_bibit, b.nama, b.harga, b.stok, b.ringkas, b.gambar, k.nama_kategori 
          FROM bibit b 
          LEFT JOIN kategori k ON b.id_kategori = k.id_kategori 
          ORDER BY b.id_bibit DESC";

$result = mysqli_query($conn, $query);

if ($result) {
    $data_bibit = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['status_ketersediaan'] = ($row['stok'] > 0) ? 'tersedia' : 'habis';
        
        $data_bibit[] = $row;
    }
    
    $response = [
        'status' => 'success',
        'pesan' => 'Data bibit berhasil diambil',
        'total_data' => count($data_bibit),
        'data' => $data_bibit
    ];
} else {
    $response = [
        'status' => 'error',
        'pesan' => 'Gagal mengambil data: ' . mysqli_error($conn),
        'data' => null
    ];
}

echo json_encode($response);
?>