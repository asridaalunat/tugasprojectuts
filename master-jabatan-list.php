<?php

// Silakan lihat komentar di file data-list.php untuk penjelasan kode ini, karena struktur dan logikanya serupa.
include_once 'config/class-master.php';
$master = new MasterData();
if (isset($_GET['status'])) {
	if ($_GET['status'] == 'inputsuccess') {
		echo "<script>alert('Data jabatan berhasil ditambahkan.');</script>";
	} else if ($_GET['status'] == 'editsuccess') {
		echo "<script>alert('Data jabatan berhasil diubah.');</script>";
	} else if ($_GET['status'] == 'deletesuccess') {
		echo "<script>alert('Data jabatan berhasil dihapus.');</script>";
	} else if ($_GET['status'] == 'deletefailed') {
		echo "<script>alert('Gagal menghapus data jabatan. Silakan coba lagi.');</script>";
	}
}
$dataJabatan = $master->getJabatan();

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
							<h3 class="mb-0">Data Jabatan</h3>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-end">
								<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
								<li class="breadcrumb-item active" aria-current="page">Master Jabatan</li>
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
									<h3 class="card-title">Daftar Jabatan</h3>
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
								<div class="card-body p-0 table-responsive">
									<table class="table table-striped" role="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode</th>
												<th>Nama</th>
												<th>Deskripsi</th>
												<th>Level Jabatan</th>
												<th class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (empty($dataJabatan)) {
												echo '<tr class="align-middle">
															<td colspan="6" class="text-center">Tidak ada data jabatan.</td>
														</tr>';
											} else {
												foreach ($dataJabatan as $index => $jabatan) {

													// ---------- SAFEGUARD: cari id & nama yang tersedia ----------
													// beberapa varian key yang mungkin ada: 'id', 'id_jabatan', 'kode', 'kode_jabatan'
													$idValue = '';
													if (isset($jabatan['id'])) {
														$idValue = $jabatan['id'];
													} elseif (isset($jabatan['id_jabatan'])) {
														$idValue = $jabatan['id_jabatan'];
													} elseif (isset($jabatan['kode'])) {
														$idValue = $jabatan['kode'];
													} elseif (isset($jabatan['kode_jabatan'])) {
														$idValue = $jabatan['kode_jabatan'];
													}

													// beberapa varian nama yang mungkin ada: 'nama', 'nama_jabatan'
													$namaValue = '';
													if (isset($jabatan['nama'])) {
														$namaValue = $jabatan['nama'];
													} elseif (isset($jabatan['nama_jabatan'])) {
														$namaValue = $jabatan['nama_jabatan'];
													}

													// Ambil kode untuk tampil di kolom "Kode" (fallback kosong jika tidak ada)
													$kodeValue = isset($jabatan['kode']) ? $jabatan['kode'] : (isset($jabatan['kode_jabatan']) ? $jabatan['kode_jabatan'] : '');

													// Ambil deskripsi dan level dengan fallback aman
													$deskripsiValue = isset($jabatan['deskripsi']) ? $jabatan['deskripsi'] : '';
													$levelValue = isset($jabatan['level_jabatan']) ? $jabatan['level_jabatan'] : (isset($jabatan['level']) ? $jabatan['level'] : '');

													// Sanitasi output (jika null, htmlspecialchars akan menerima empty string)
													$no = ($index + 1);
													$kodeEsc = htmlspecialchars((string)$kodeValue ?? '');
													$namaEsc = htmlspecialchars((string)$namaValue ?? '');
													$descEsc = htmlspecialchars((string)$deskripsiValue ?? '');
													$levelEsc = htmlspecialchars((string)$levelValue ?? '');
													$idUrl = urlencode((string)$idValue);

													echo '<tr class="align-middle">
																<td>' . $no . '</td>
																<td>' . $kodeEsc . '</td>
																<td>' . $namaEsc . '</td>
																<td>' . $descEsc . '</td>
																<td>' . $levelEsc . '</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'master-jabatan-edit.php?id=' . $idUrl . '\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data jabatan ini?\')){window.location.href=\'proses/proses-jabatan.php?aksi=deletejabatan&id=' . $idUrl . '\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
												}
											}
											?>
										</tbody>
									</table>
								</div>
								<div class="card-footer">
									<button type="button" class="btn btn-primary"
										onclick="window.location.href='master-jabatan-input.php'"><i
											class="bi bi-plus-lg"></i> Tambah Jabatan</button>
								</div>
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
