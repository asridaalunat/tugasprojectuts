<?php
include_once 'config/class-master.php';
$master = new MasterData();

$id = $_GET['id'] ?? '';
$data = $master->getJabatanById($id);

if (!$data) {
    echo "<script>alert('Data jabatan tidak ditemukan!');window.location='master-jabatan-list.php';</script>";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>
<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary input-page">
    <div class="app-wrapper">

        <?php include 'template/navbar.php'; ?>
        <?php include 'template/sidebar.php'; ?>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6"><h3 class="mb-0">Edit Jabatan</h3></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Jabatan</li>
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
                                <div class="card-header"><h3 class="card-title">Form Edit Jabatan</h3></div>
                                <form action="proses/proses-jabatan.php?aksi=editjabatan" method="POST">
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id_jabatan'] ?? $data['id'] ?? '') ?>">

                                        <div class="mb-3">
                                            <label for="kode" class="form-label">Kode</label>
                                            <input type="text" class="form-control" id="kode" name="kode" value="<?= htmlspecialchars($data['kode'] ?? $data['kode_jabatan'] ?? '') ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Jabatan</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($data['nama'] ?? $data['nama_jabatan'] ?? '') ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= htmlspecialchars($data['deskripsi'] ?? '') ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="level_jabatan" class="form-label">Level Jabatan</label>
                                            <input type="number" class="form-control" id="level_jabatan" name="level_jabatan" value="<?= htmlspecialchars($data['level_jabatan'] ?? $data['level'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='master-jabatan-list.php'">Batal</button>
                                        <button type="submit" class="btn btn-primary float-end">Simpan Perubahan</button>
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
