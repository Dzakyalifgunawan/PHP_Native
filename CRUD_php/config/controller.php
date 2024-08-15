<?php

// fungsi menampilkan data
function select($query)
{
    // memanggil konesksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    // variabel ini mengambil atribut name tag input
    $nama = $post['nama'];
    $jumlah = $post['jumlah'];
    $harga = $post['harga'];

    // query tambah data
    $query = "INSERT INTO barang VALUES (null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";


    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}
