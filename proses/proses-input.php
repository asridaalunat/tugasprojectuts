<?php

// Memasukkan file class-karyawan.php untuk mengakses class Karyawan
include '../config/class-karyawan.php';

// Membuat objek dari class Karyawan
$karyawan = new Karyawan();

// Mengambil data karyawan dari form input menggunakan metode POST
$dataKaryawan = [
    'nik'      => $_POST['nik'] ?? '',
    'nama'     => $_POST['nama'] ?? '',
    'jabatan'  => $_POST['jabatan'] ?? '',
    'alamat'   => $_POST['alamat'] ?? '',
    'kategori' => $_POST['kategori'] ?? '',   // tetap ada
    'email'    => $_POST['email'] ?? '',
    'telp'     => $_POST['telp'] ?? '',
    'status'   => $_POST['status'] ?? ''
];

// Memanggil method inputKaryawan untuk memasukkan data karyawan
$input = $karyawan->inputKaryawan($dataKaryawan);

// Mengecek apakah proses input berhasil atau tidak
if ($input) {
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    header("Location: ../data-input.php?status=failed");
}

?>
