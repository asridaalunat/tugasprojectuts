<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Karyawan extends Database
{

    // Method untuk input data mahasiswa
    public function inputKaryawan($data)
    {
        // Mengambil data dari parameter $data
        $nik = $data['nik'];
        $nama = $data['nama'];
        $jabatan = $data['jabatan'];
        $alamat = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email = $data['email'];
        $telp = $data['telp'];
        $status = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_karyawan (nik, nama_karyawan, jabatan, alamat, provinsi, email, telp, status_karyawan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if (!$stmt) {
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $nik, $nama, $jabatan, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data mahasiswa
    public function getAllKaryawan()
    {
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT id_karyawan, nik,  nama_karyawan, nama_jabatan, nama_provinsi, alamat, email, telp, status_karyawan 
                  FROM tb_karyawan
                  JOIN tb_jabatan ON jabatan = kode_jabatan
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $karyawan = [];
        // Mengecek apakah ada data yang ditemukan
        if ($result->num_rows > 0) {
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while ($row = $result->fetch_assoc()) {
                $karyawan[] = [
                    'id' => $row['id_karyawan'],
                    'nik' => $row['nik'],
                    'nama' => $row['nama_karyawan'],
                    'jabatan' => $row['nama_jabatan'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_karyawan']
                ];
            }
        }
        // Mengembalikan array data mahasiswa
        return $karyawan;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateKaryawan($id)
    {
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_karyawan WHERE id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if ($result->num_rows > 0) {
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_karyawan'],
                'nik' => $row['nik'],
                'nama' => $row['nama_karyawan'],
                'jabatan' => $row['nama_jabatan'],
                'alamat' => $row['alamat'],
                'provinsi' => $row['nama_provinsi'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_karyawan']
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editKaryawan($data)
    {
        // Mengambil data dari parameter $data
        $id = $data['id_karyawan'];
        $nik = $data['nik'];
        $nama = $data['nama_karyawan'];
        $jabatan = $data['nama_jabatan'];
        $alamat = $data['alamat'];
        $provinsi = $data['nama_provinsi'];
        $email = $data['email'];
        $telp = $data['telp'];
        $status = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_karyawan SET nik = ?,nama_karyawan = ?, jabatan = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_karyawan = ? WHERE id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssi",$nik, $nama, $jabatan, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data mahasiswa
    public function deleteKaryawan($id)
    {
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_karyawan WHERE id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchKaryawan($kataKunci)
    {
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%" . $kataKunci . "%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_karyawan, nik, nama_karyawan, nama_jabatan, nama_provinsi, alamat, email, telp, status_karyawan 
                    FROM tb_karyawan
                    JOIN tb_jabatan ON tb_karyawan.jabatan = tb_jabatan.kode_jabatan
                    JOIN tb_provinsi ON tb_karyawan.provinsi = tb_provinsi.id_provinsi
                    WHERE tb_karyawan.nama_karyawan LIKE ? OR tb_karyawan.nik LIKE ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $karyawan = [];
        if ($result->num_rows > 0) {
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while ($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $karyawan[] = [
                    'id' => $row['id_karyawan'],
                    'nik' => $row['nik'],
                    'nama' => $row['nama_karyawan'],
                    'jabatan' => $row['nama_jabatan'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_karyawan']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $karyawan;
    }

}

?>