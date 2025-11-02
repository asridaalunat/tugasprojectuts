<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';

// Membuat objek dari class MasterData
$master = new MasterData();

// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if (isset($_GET['aksi'])) {

    // Aksi: Input Jabatan
    if ($_GET['aksi'] == 'inputJabatan') {

        // Pastikan semua data POST tersedia
        $dataJabatan = [
            'kode'          => $_POST['kode_jabatan'] ?? '',
            'nama'          => $_POST['nama_jabatan'] ?? '',
            'deskripsi'     => $_POST['deskripsi'] ?? '',
            'level_jabatan' => $_POST['level_jabatan'] ?? ''
        ];

        // Memanggil method inputJabatan
        $input = $master->inputJabatan($dataJabatan);

        if ($input) {
            header("Location: ../master-jabatan-list.php?status=inputsuccess");
        } else {
            header("Location: ../master-jabatan-input.php?status=failed");
        }

    // Aksi: Update Jabatan
    } elseif ($_GET['aksi'] == 'updateJabatan') {

        $dataJabatan = [
            'kode'          => $_POST['kode_jabatan'] ?? '',
            'nama'          => $_POST['nama_jabatan'] ?? '',
            'deskripsi'     => $_POST['deskripsi'] ?? '',
            'level_jabatan' => $_POST['level_jabatan'] ?? ''
        ];

        $update = $master->updateJabatan($dataJabatan);

        if ($update) {
            header("Location: ../master-jabatan-list.php?status=editsuccess");
        } else {
            $kode = !empty($dataJabatan['kode']) ? $dataJabatan['kode'] : '';
            header("Location: ../master-jabatan-edit.php?id=" . $kode . "&status=failed");
        }

    // Aksi: Delete Jabatan
    } elseif ($_GET['aksi'] == 'deleteJabatan') {

        // Pastikan ID tersedia
        $id = $_GET['id'] ?? '';
        if ($id !== '') {
            $delete = $master->deleteJabatan($id);

            if ($delete) {
                header("Location: ../master-jabatan-list.php?status=deletesuccess");
            } else {
                header("Location: ../master-jabatan-list.php?status=deletefailed");
            }
        } else {
            header("Location: ../master-jabatan-list.php?status=deletefailed");
        }
    }
}

?>
