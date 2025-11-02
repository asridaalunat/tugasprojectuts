<?php

// Memasukkan file class-karyawan.php untuk mengakses class karyawan
include '../config/class-karyawan.php';

// Membuat objek dari class karyawan
$karyawan = new karyawan();

// Mengambil data karyawan dari form input menggunakan metode POST dan menyimpannya dalam array
$dataKaryawan = [
    'nik'           => $_POST['nik'],
    'nama'          => $_POST['nama'],
    'nama_jabatan'  => $_POST['jabatan'],       // disesuaikan dengan kolom tb_karyawan: nama_jabatan
    'alamat'        => $_POST['alamat'],
    'nama_provinsi' => $_POST['provinsi'],      // disesuaikan dengan kolom tb_karyawan: nama_provinsi
    'email'         => $_POST['email'],
    'telp'          => $_POST['telp'],
    'status'        => $_POST['status'],
];

// Memanggil method inputKaryawan untuk memasukkan data karyawan dengan parameter array $dataKaryawan
$input = $karyawan->inputKaryawan($dataKaryawan);

// Mengecek apakah proses input berhasil atau tidak - true/false
if ($input) {
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>
