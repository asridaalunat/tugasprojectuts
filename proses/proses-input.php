<?php
// Memasukkan file class-karyawan.php untuk mengakses class Karyawan
include '../config/class-karyawan.php';

// Membuat objek dari class Karyawan
$karyawan = new Karyawan();

// Mengambil data karyawan dari form input menggunakan metode POST dan menyimpannya dalam array
$dataKaryawan = [
    'nama' => $_POST['nama'],
    'jabatan' => $_POST['jabatan'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email' => $_POST['email'],
];

// Memanggil method inputKaryawan untuk memasukkan data karyawan
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
