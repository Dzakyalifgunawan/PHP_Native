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

$title = 'Data Akun';

include 'layout/header.php';

// fungsi ORDER BY id_akun DESC mengurutkan id_akun dari angka terbesar hingga kecil di database
$data_akun = select("SELECT * FROM akun ORDER BY id_akun DESC");

// jika tombo tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
         alert('Data Akun Berhasil Ditambahkan');
         document.location.href = 'modal.php';
         </script>
         ";
    } else {
        echo "<script>
        alert('Data Akun Gagal Ditambahkan');
        document.location.href = 'modal.php';
        </script>
        ";
    }
}

if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
         alert('Data Akun Berhasil Diubah');
         document.location.href = 'modal.php';
         </script>
         ";
    } else {
        echo "<script>
        alert('Data Akun Gagal Diubah');
        document.location.href = 'modal.php';
        </script>
        ";
    }
}
?>
<div class="container mt-5">
    <h1><i class="fas fa-solid fa-users"></i> Data Akun</h1>
    <hr>
    <!-- data-bs-target harus sama id yapng ada di modal tambah -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah Data</button>
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_akun as $akun) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $akun['nama']; ?></td>
                    <td><?= $akun['username']; ?></td>
                    <td><?= $akun['email']; ?></td>
                    <td>Password Ter-enskripsi</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Ubah</button>
                        <button type="submit" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>"><i class="fas fa-solid fa-trash"></i> Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <!-- fungsi atribut minlength menentukan jumlah karakter minimum yang diperbolehkan dalam elemen input -->
                        <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">-- pilih level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah-->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password <small>(Masukkan passord baru/lama)</small></label>
                            <!-- fungsi atribut minlength menentukan jumlah karakter minimum yang diperbolehkan dalam elemen input -->
                            <input type="password" name="password" id="password" class="form-control" minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <?php $level = $akun['level']; ?>
                                <option value="1" <?= $level == '1' ? 'selected' : null; ?>>Admin</option>
                                <option value="2" <?= $level == '2' ? 'selected' : null; ?>>Operator</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin Ingin Menghapus Data Akun ini : <?= $akun['nama']; ?> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="delete-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Iya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php

include 'layout/footer.php';

?>