<?php

include 'config/app.php';

// menerima id_akun yang dipilih pengguna
$id_akun = (int)$_GET['id_akun'];

if (delete_akun($id_akun) > 0) {
    echo "<script>
         alert('Data Akun Berhasil Dihapus');
         document.location.href = 'modal.php';
         </script>
         ";
} else {
    echo "<script>
        alert('Data Akun Gagal Dihapus');
        document.location.href = 'modal.php';
        </script>
        ";
}
