<?php

include 'layout/header.php';
$data_barang = select("SELECT * FROM barang");
?>
<div class="container mt-5">
    <h1>CRUD Data Barang</h1>
    <hr>
    <a href="form-tambah.php" class="btn btn-primary mb-1">Tambah Data</a>
    <table class="table table-bordered table-striped mt-3">
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
                        <a class="btn btn-success" href="#" role="button">Ubah</a>
                        <a class="btn btn-danger" href="#" role="button">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php

include 'layout/footer.php';

?>