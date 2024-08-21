<?php

$title = 'Create Mahasiwa';


include 'layout/header.php';

// check apakah tombol tambah ditekan
if (isset($_POST['update'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
         alert('Data Mahasiswa Berhasil Diupdate');
         document.location.href = 'mahasiswa.php';
         </script>
         ";
    } else {
        echo "<script>
        alert('Data Mahasiswa Gagal Diupdate');
        document.location.href = 'mahasiswa.php';
        </script>
        ";
    }
}

// mengambil barang id_barang dari url
// format (int) fungsi nya keamanan sql injection
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// [0] maksudnya satu data saja yang diambil
$mahasiswa = select("SELECT * FROM mahasiswa where id_mahasiswa = $id_mahasiswa")[0];
?>

<div class="container mt-5">
    <h1>Update Data Mahasiswa</h1>
    <hr>
    <!-- enctype="multipart/form-data" fungsinya mengunggah sebuah file -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <!-- untuk mengecek foto lama mau diganti atau tidak -->
        <input type="hidden" name="fotolama" value="<?= $mahasiswa['foto']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa" required value="<?= $mahasiswa['nama']; ?>">
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program studi</label>
                <select name="prodi" id="prodi" class="form-control">
                    <?php $prodi = $mahasiswa['prodi'] ?>
                    <option value="teknik informatika" <?= $prodi == 'teknik informatika' ? 'selected' : null; ?>>Teknik Inforamtika</option>
                    <option value="teknik mesin" <?= $prodi == 'teknik mesin' ? 'selected' : null; ?>>Teknik Mesin</option>
                    <option value="tenik listrik" <?= $prodi == 'tenik listrik' ? 'selected' : null; ?>>Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <?php $jk = $mahasiswa['jk'] ?>
                    <option value="laki-laki" <?= $jk == 'laki-laki' ? 'selected' : null; ?>>Laki-Laki</option>
                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null; ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon" required value="<?= $mahasiswa['telepon']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Nama Mahasiswa</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?= $mahasiswa['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto" onchange="previewImg()">
            <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="" class="img-thumbnail img-preview mt-3" width="400px">
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // Preview Image
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?php

include 'layout/footer.php';

?>