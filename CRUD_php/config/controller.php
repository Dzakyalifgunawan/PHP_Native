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

// fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    // variabel ini mengambil atribut name tag input
    $id_barang = $post['id_barang'];
    $nama = $post['nama'];
    $jumlah = $post['jumlah'];
    $harga = $post['harga'];

    // query update data
    // kenapa tidak tambahkan CURRENT_TIMESTAMP() karena waktu dan tanggal akan diupdate secara otomatis
    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}
