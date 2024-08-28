<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Login Terlebih Dahulu');
        document.location.href = 'login.php';
        </script>";
    exit;
}

$title = 'Update Barang';

include 'layout/header.php';

// mengambil barang id_barang dari url
// format (int) fungsi nya keamanan sql injection
$id_barang = (int)$_GET['id_barang'];

// [0] maksudnya satu data saja yang diambil
$barang = select("SELECT * FROM barang where id_barang = $id_barang")[0];

// check apakah tombol update ditekan
if (isset($_POST['update'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
         alert('Data Barang Berhasil Diubah');
         document.location.href = 'barang.php';
         </script>
         ";
    } else {
        echo "<script>
        alert('Data Barang Gagal Diubah');
        document.location.href = 'barang.php';
        </script>
        ";
    }
}
?>

<div class="container mt-5">
    <h1>Update Barang</h1>
    <hr>
    <form action="" method="post">

        <!-- fungsi input type hidden barang yang ingin diupdate -->
        <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" value="<?= $barang['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang" value="<?= $barang['jumlah']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang" value="<?= $barang['harga']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>

<?php

include 'layout/footer.php';

?>