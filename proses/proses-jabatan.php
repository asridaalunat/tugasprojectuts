<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if ($_GET['aksi'] == 'inputJabatan') {
    // Mengambil data prodi dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataJabatan = [
        'kode'          => $_POST['kode_jabatan'],
        'nama'          => $_POST['nama_jabatan'],
        'deskripsi'     => $_POST['deskripsi'],
        'level_jabatan' => $_POST['level_jabatan']
    ];
    // Memanggil method inputJabatan untuk memasukkan data jabatan dengan parameter array $dataJabatan
    $input = $master->inputJabatan($dataJabatan);
    if ($input) {
        // Jika berhasil, redirect ke halaman master-jabatan-list.php dengan status inputsuccess
        header("Location: ../master-jabatan-list.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jabatan-input.php dengan status failed
        header("Location: ../master-jabatan-input.php?status=failed");
    }
} elseif ($_GET['aksi'] == 'updateJabatan') {
    // Mengambil data prodi dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataJabatan = [
        'kode'          => $_POST['kode_jabatan'],
        'nama'          => $_POST['nama_jabatan'],
        'deskripsi'     => $_POST['deskripsi'],
        'level_jabatan' => $_POST['level_jabatan']
    ];
    // Memanggil method updateJabatan untuk mengupdate data jabatan dengan parameter array $dataJabatan
    $update = $master->updateJabatan($dataJabatan);
    if ($update) {
        // Jika berhasil, redirect ke halaman master-jabatan-list.php dengan status editsuccess
        header("Location: ../master-jabatan-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jabatan-edit.php dengan status failed dan membawa kode jabatan
        header("Location: ../master-jabatan-edit.php?id=" . $dataJabatan['kode'] . "&status=failed");
    }
} elseif ($_GET['aksi'] == 'deleteJabatan') {
    // Mengambil id prodi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteJabatan untuk menghapus data jabatan berdasarkan kode
    $delete = $master->deleteJabatan($id);
    if ($delete) {
        // Jika berhasil, redirect ke halaman master-jabatan-list.php dengan status deletesuccess
        header("Location: ../master-jabatan-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jabatan-list.php dengan status deletefailed
        header("Location: ../master-jabatan-list.php?status=deletefailed");
    }
}

?>
