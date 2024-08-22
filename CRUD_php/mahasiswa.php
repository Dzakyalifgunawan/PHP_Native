<?php

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Login Terlebih Dahulu');
        document.location.href = 'login.php';
        </script>";
    exit;
}

$title = 'Daftar Mahasiswa';

include 'layout/header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC")

?>

<div class="container mt-5">
    <h1><i class="fas fa-solid fa-graduation-cap"></i> Data Mahasiswa</h1>
    <hr>
    <a href="create-mahasiswa.php" class="btn btn-primary mb-1">Tambah Data</a>
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Telepon</th>
                <th scope="col">Email</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $mahasiswa['nama']; ?></td>
                    <td><?= $mahasiswa['prodi']; ?></td>
                    <td><?= $mahasiswa['jk']; ?></td>
                    <td><?= $mahasiswa['telepon']; ?></td>
                    <td><?= $mahasiswa['email']; ?></td>
                    <td width="15%" class="text-center">
                        <a class="btn btn-secondary" href="show-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" role="button"><i class="fas fa-solid fa-eye"></i> Detail</a>
                        <a class="btn btn-success" href="update-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" role="button"><i class="fas fa-edit"></i> Ubah</a>
                        <a class="btn btn-danger" href="delete-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" role="button" onclick="return confirm('Yakin Data ini Dihapus ?');"><i class="fas fa-solid fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php

include 'layout/footer.php';

?>