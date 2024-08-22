<?php

// untuk menerima user yang login 
session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Login Terlebih Dahulu');
        document.location.href = 'login.php';
        </script>";
    exit;
}

$title = 'Data Barang';

include 'layout/header.php';

// fungsi ORDER BY id_barang DESC mengurutkan id_barang dari angka terbesar hingga kecil di database
$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");
?>
<div class="container mt-5">
    <h1><i class="fas fa-solid fa-box"></i> CRUD Data Barang</h1>
    <hr>
    <a href="create.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah Data</a>
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_barang as $barang) : ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $barang['nama']; ?></td>
                    <td><?= $barang['jumlah']; ?></td>
                    <td>Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                    <!-- strtotime() fungsinya mengubah string menjadi waktu -->
                    <td><?= date('d-m-Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                    <td width="15%" class="text-center">
                        <a class="btn btn-success" href="update.php?id_barang=<?= $barang['id_barang']; ?>" role="button"><i class="fas fa-edit"></i> Ubah</a>
                        <a class="btn btn-danger" href="delete.php?id_barang=<?= $barang['id_barang']; ?>" role="button" onclick="return confirm('Yakin Data ini Dihapus ?');"><i class="fas fa-solid fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php

include 'layout/footer.php';

?>