<?php

$title = 'Create Mahasiwa';


include 'layout/header.php';

// check apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
         alert('Data Mahasiswa Berhasil Ditambahkan');
         document.location.href = 'mahasiswa.php';
         </script>
         ";
    } else {
        echo "<script>
        alert('Data Mahasiswa Gagal Ditambahkan');
        document.location.href = 'mahasiswa.php';
        </script>
        ";
    }
}
?>

<div class="container mt-5">
    <h1>Tambah Data Mahasiswa</h1>
    <hr>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa" required>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program studi</label>
                <select name="prodi" id="prodi" class="form-control">
                    <option value="">-- Pilih Prodi --</option>
                    <option value="teknik informatika">Teknik Inforamtika</option>
                    <option value="teknik mesin">Teknik Mesin</option>
                    <option value="tenik listrik">Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Nama Mahasiswa</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="text" class="form-control" id="foto" name="foto" placeholder="Foto" required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </form>
</div>

<?php

include 'layout/footer.php';

?>