<?php
// REST API

// render halaman menjadi json
header('Content-Type: application/json');

require '../config/app.php';

// untuk membuat fungsi delete
parse_str(file_get_contents('php://input'), $delete);

// menerima input id data yang akan dihapus
$id_barang = $delete['id_barang'];


// query Hapus data REST API dengan php
$query = "DELETE FROM barang WHERE id_barang = $id_barang";

mysqli_query($db, $query);

// check status data REST API dengan php
if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Dihapus']);
} else {
    echo json_encode(['pesan' => 'Data Barang Gagal Dihapus']);
}
echo json_encode(['data_barang' => $query]);
