<?php

// Memasukkan file class-karyawan.php untuk mengakses class Karyawan
include_once '../config/class-karyawan.php';

// Membuat objek dari class Karyawan
$karyawan = new Karyawan();

// Mengambil data karyawan dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataKaryawan = [
    'id'             => $_POST['id'],
    'nik'            => $_POST['nik'],
    'nama'           => $_POST['nama'],
    'jabatan'   => $_POST['jabatan'],      
    'alamat'         => $_POST['alamat'],
    'provinsi'  => $_POST['provinsi'],     
    'email'          => $_POST['email'],
    'telp'           => $_POST['telp'],
    'status'         => $_POST['status'],
];

// Memanggil method editKaryawan untuk mengupdate data karyawan dengan parameter array $dataKaryawan
$edit = $karyawan->editKaryawan($dataKaryawan);

// Mengecek apakah proses edit berhasil atau tidak - true/false
if ($edit) {
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id karyawan
    header("Location: ../data-edit.php?id=" . $dataKaryawan['id'] . "&status=failed");
}

?>
