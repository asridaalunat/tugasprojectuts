<?php

include_once 'config/class-master.php';
include_once 'config/class-karyawan.php';
$master = new MasterData();
$karyawan = new karyawan();

// Mengambil daftar jabatan, kategori, dan status karyawan
$jabatanList = $master->getJabatan();
$kategoriList = $master->getKategori(); // ganti provinsi menjadi kategori
$statusList = $master->getStatus();

// Mengambil data karyawan yang akan diedit berdasarkan id dari parameter GET
$dataKaryawan = $karyawan->getUpdateKaryawan($_GET['id']);

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'failed') {
        echo "<script>alert('Gagal mengubah data karyawan. Silakan coba lagi.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'template/header.php'; ?>
</head>

<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

    <div class="app-wrapper">

        <?php include 'template/navbar.php'; ?>
        <?php include 'template/sidebar.php'; ?>

        <main class="app-main">

            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Edit Karyawan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Formulir Karyawan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"
                                            title="Collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"
                                            title="Remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <form action="proses/proses-edit.php" method="POST">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?php echo $dataKaryawan['id']; ?>">

                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                placeholder="Masukkan NIK Karyawan Sesuai dengan KTP Anda" required
                                                value="<?php echo $dataKaryawan['nik']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="Masukkan Nama Karyawan" required
                                                value="<?php echo $dataKaryawan['nama']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="jabatan" class="form-label">Kategori</label>
                                            <select class="form-select" id="jabatan" name="jabatan" required>
                                                <option value="" selected disabled>Pilih Kategori</option>
                                                <?php
                                                foreach ($jabatanList as $jabatan) {
                                                    $selectedJabatan = ($dataKaryawan['jabatan'] == $jabatan['id']) ? "selected" : "";
                                                    echo '<option value="' . $jabatan['id'] . '" ' . $selectedJabatan . '>' . $jabatan['nama'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                placeholder="Masukkan Alamat Karyawan" required
                                                value="<?php echo $dataKaryawan['alamat']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Masukkan Email Anda" required
                                                value="<?php echo $dataKaryawan['email']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="telp" class="form-label">Telp</label>
                                            <input type="text" class="form-control" id="telp" name="telp"
                                                placeholder="Masukkan No Telp Anda" required
                                                value="<?php echo $dataKaryawan['telp']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <?php
                                                foreach ($statusList as $status) {
                                                    $selectedStatus = ($dataKaryawan['status'] == $status['id']) ? "selected" : "";
                                                    echo '<option value="' . $status['id'] . '" ' . $selectedStatus . '>' . $status['nama'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-danger me-2 float-start"
                                            onclick="window.location.href='data-list.php'">Batal</button>
                                        <button type="submit" class="btn btn-warning float-end">Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <?php include 'template/footer.php'; ?>

    </div>

    <?php include 'template/script.php'; ?>

</body>

</html>
