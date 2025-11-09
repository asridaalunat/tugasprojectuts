<?php
include_once '../config/class-master.php';
$master = new MasterData();

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];

    if ($aksi == 'inputjabatan') {
        // pastikan method POST tersedia
        $kode = $_POST['kode'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $deskripsi = $_POST['deskripsi'] ?? '';
        $level = $_POST['level_jabatan'] ?? '';

        // panggil sesuai signature class (mengirim array)
        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'level_jabatan' => $level
        ];

        $hasil = $master->inputJabatan($data);
        if ($hasil) {
            header("Location: ../master-jabatan-list.php?status=inputsuccess");
            exit;
        } else {
            header("Location: ../master-jabatan-input.php?status=failed");
            exit;
        }

    } elseif ($aksi == 'editjabatan' || $aksi == 'updatejabatan') {
        // beberapa varian nama aksi mungkin dipakai, tangani keduanya
        $id = $_POST['id'] ?? $_POST['id_jabatan'] ?? '';
        $kode = $_POST['kode'] ?? $_POST['kode_jabatan'] ?? '';
        $nama = $_POST['nama'] ?? $_POST['nama_jabatan'] ?? '';
        $deskripsi = $_POST['deskripsi'] ?? '';
        $level = $_POST['level_jabatan'] ?? '';

        // Siapkan array sesuai updateJabatan($data)
        // updateJabatan di class kamu meng-update WHERE kode_jabatan = ?
        // jadi pastikan 'kode' berisi kode_jabatan yang menjadi identifier.
        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'level_jabatan' => $level
        ];

        $hasil = $master->updateJabatan($data);
        if ($hasil) {
            header("Location: ../master-jabatan-list.php?status=editsuccess");
            exit;
        } else {
            // redirect kembali ke edit; gunakan id jika ada, kalau tidak gunakan kode
            $redirectId = $id ?: $kode;
            header("Location: ../master-jabatan-edit.php?id=" . urlencode($redirectId) . "&status=editfailed");
            exit;
        }

    } elseif ($aksi == 'deletejabatan' || $aksi == 'deleteJabatan') {
        // ambil id dari GET
        $id = $_GET['id'] ?? '';

        if ($id === '') {
            header("Location: ../master-jabatan-list.php?status=deletefailed");
            exit;
        }

        // Jika id numeric, kemungkinan ini id_jabatan (integer) — ambil kode_jabatan dulu
        if (is_numeric($id)) {
            $row = $master->getJabatanById((int)$id);
            if ($row && isset($row['kode_jabatan'])) {
                $kodeToDelete = $row['kode_jabatan'];
            } elseif ($row && isset($row['kode'])) {
                $kodeToDelete = $row['kode'];
            } else {
                // tidak dapat menemukan kode dari id
                header("Location: ../master-jabatan-list.php?status=deletefailed");
                exit;
            }
        } else {
            // id bukan numeric — anggap ini sudah kode_jabatan
            $kodeToDelete = $id;
        }

        $hasil = $master->deleteJabatan($kodeToDelete);
        if ($hasil) {
            header("Location: ../master-jabatan-list.php?status=deletesuccess");
            exit;
        } else {
            header("Location: ../master-jabatan-list.php?status=deletefailed");
            exit;
        }
    }
}
?>
