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
    $nama = strip_tags($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga = strip_tags($post['harga']);
    // rand() untuk membuat angka secara acak
    $barcode = rand(100000, 999999);

    // query tambah data
    $query = "INSERT INTO barang VALUES (null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";


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
    $nama = strip_tags($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga = strip_tags($post['harga']);

    // query update data
    // kenapa tidak tambahkan CURRENT_TIMESTAMP() karena waktu dan tanggal akan diupdate secara otomatis
    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga', WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

function delete_barang($id_barang)
{

    global $db;

    // query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

// fungsi menambahkan data Mahasiswa
function create_mahasiswa($post)
{
    global $db;

    // variabel ini mengambil atribut name tag input
    // strip_tags untuk mengamankan serangan XSS
    $nama = strip_tags($post['nama']);
    $prodi = strip_tags($post['prodi']);
    $jk = strip_tags($post['jk']);
    $telepon = strip_tags($post['telepon']);
    $email = strip_tags($post['email']);
    $foto = upload_file();

    // Check upload foto
    if (!$foto) {
        return false;
    }

    // query tambah data
    $query = "INSERT INTO mahasiswa VALUES (null, '$nama', '$prodi', '$jk', '$telepon', '$email', '$foto')";


    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

function update_mahasiswa($post)
{
    global $db;

    // variabel ini mengambil atribut name tag input
    // strip_tags untuk mengamankan serangan XSS
    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $nama = strip_tags($post['nama']);
    $prodi = strip_tags($post['prodi']);
    $jk = strip_tags($post['jk']);
    $telepon = strip_tags($post['telepon']);
    $email = strip_tags($post['email']);
    $fotolama = strip_tags($post['fotolama']);

    // Check upload foto baru atau tidak
    // maksud ['foto']['error'] == 4 jika ada foto error 4 maka tidak upload file baru
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_file();
    }

    // query ubah data
    $query = "UPDATE mahasiswa SET nama= '$nama', prodi = '$prodi', jk = '$jk' , telepon = '$telepon', email = '$email', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";


    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

// fungsi upload file
function upload_file()
{
    // mengambil atribut name dengan value foto
    $namaFile = $_FILES['foto']['name'];

    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];

    // penyimpanan sementara
    $tmpName = $_FILES['foto']['tmp_name'];

    // Check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    // fungsi explode() memeriksa extensi setelah nama file
    $extensifile = explode('.', $namaFile); // foto.jpg
    // fungsi strtolower() mengubah extensi nya menjadi huruf kecil semua
    $extensifile = strtolower(end($extensifile)); // .JPG -> .jpg

    // Check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        //pesan gagal
        echo "<script>
            alert('Format File Tidak Valid');
            document.location.href = 'create-mahasiswa.php';        
        </script>";
        die();
    }

    // Check ukuran file
    if ($ukuranFile > 2048000) {
        echo "<script>
            alert('Ukuran File Max 2 MB');
            document.location.href = 'create-mahasiswa.php';        
        </script>";
    }

    // generate nama file baru dan fungsi nya untuk keamanan
    // contoh foto.jpg -> aowndoinaw3232n423
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder img
    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru); //assets/img/wndaon1231n1o
    return $namaFileBaru;
}

function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    // unlink file
    // ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets/img/" . $foto['foto']);

    // query hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

function create_akun($post)
{
    global $db;

    // variabel ini mengambil atribut name tag input
    // strip_tags untuk mengamankan serangan XSS
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // enskripsi password
    $pass = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO akun VALUES (null, '$nama', '$username', '$email', '$pass', '$level')";


    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

function update_akun($post)
{
    global $db;

    // variabel ini mengambil atribut name tag input
    // strip_tags untuk mengamankan serangan XSS
    $id_akun = strip_tags($post['id_akun']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // enskripsi password
    $pass = password_hash($password, PASSWORD_DEFAULT);

    // query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$pass', level = '$level' WHERE id_akun = $id_akun";


    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}

// fungsi menghapus data Akun
function delete_akun($id_akun)
{
    global $db;

    // query hapus data Akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    // mengembalikan data diisi ke data yang baru
    return mysqli_affected_rows($db);
}
