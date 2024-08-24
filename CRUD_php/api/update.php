<?php
// REST API

// render halaman menjadi json
header('Content-Type: application/json');

require '../config/app.php';

// untuk membuat fungsi put
parse_str(file_get_contents('php://input'), $put);

// menerima input 
$id_barang = $put['id_barang'];
$nama = $put['nama'];
$jumlah = $put['jumlah'];
$harga = $put['harga'];

// validasi data REST API dengan php
if ($nama == null) {
    echo json_encode(['pesan' => 'Nama Barang Tidak Boleh Kosong']);
    exit;
}

// query update data REST API dengan php
$query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

mysqli_query($db, $query);

// check status data REST API dengan php
if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Diubah']);
} else {
    echo json_encode(['pesan' => 'Data Barang Gagal Diubah']);
}
echo json_encode(['data_barang' => $query]);
