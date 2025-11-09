<?php

// Memasukkan file class-karyawan.php untuk mengakses class Karyawan
include_once '../config/class-karyawan.php';

// Membuat objek dari class Karyawan
$karyawan = new Karyawan();

// Mengambil data karyawan dari form edit menggunakan metode POST
$dataKaryawan = [
    'id'        => $_POST['id'],
    'nik'       => $_POST['nik'],
    'nama'      => $_POST['nama'],
    'jabatan'   => $_POST['jabatan'],      
    'alamat'    => $_POST['alamat'],
    'kategori'  => $_POST['kategori'],      // tetap ada
    'email'     => $_POST['email'],
    'telp'      => $_POST['telp'],
    'status'    => $_POST['status'],
];

// Memanggil method editKaryawan untuk mengupdate data karyawan
$edit = $karyawan->editKaryawan($dataKaryawan);

// Mengecek apakah proses edit berhasil atau tidak
if ($edit) {
    header("Location: ../data-list.php?status=editsuccess");
} else {
    header("Location: ../data-edit.php?id=" . $dataKaryawan['id'] . "&status=failed");
}

?>
