<?php

include_once 'db-config.php';

class Karyawan extends Database
{
    // Input karyawan
    public function inputKaryawan($data)
    {
        $nik = $data['nik'];
        $nama = $data['nama'];
        $jabatan = $data['jabatan'];  // id/jabatan
        $alamat = $data['alamat'];
        $provinsi = $data['provinsi']; // id/provinsi
        $email = $data['email'];
        $telp = $data['telp'];
        $status = $data['status'];

        $query = "INSERT INTO tb_karyawan (nik, nama_karyawan, jabatan, alamat, provinsi, email, telp, status_karyawan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;
        $stmt->bind_param("ssssssss", $nik, $nama, $jabatan, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil semua data karyawan
    public function getAllKaryawan()
    {
        $query = "SELECT 
                    tb_karyawan.id_karyawan AS id,
                    tb_karyawan.nik,
                    tb_karyawan.nama_karyawan AS nama,
                    tb_jabatan.nama AS jabatan,
                    tb_provinsi.nama AS provinsi,
                    tb_karyawan.alamat,
                    tb_karyawan.email,
                    tb_karyawan.telp,
                    tb_karyawan.status_karyawan AS status
                  FROM tb_karyawan
                  LEFT JOIN tb_jabatan ON tb_karyawan.jabatan = tb_jabatan.kode
                  LEFT JOIN tb_provinsi ON tb_karyawan.provinsi = tb_provinsi.kode";
        $result = $this->conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil karyawan by ID
    public function getUpdateKaryawan($id)
    {
        $query = "SELECT 
                    tb_karyawan.id_karyawan AS id,
                    tb_karyawan.nik,
                    tb_karyawan.nama_karyawan AS nama,
                    tb_jabatan.nama AS jabatan,
                    tb_provinsi.nama AS provinsi,
                    tb_karyawan.alamat,
                    tb_karyawan.email,
                    tb_karyawan.telp,
                    tb_karyawan.status_karyawan AS status
                  FROM tb_karyawan
                  LEFT JOIN tb_jabatan ON tb_karyawan.jabatan = tb_jabatan.kode
                  LEFT JOIN tb_provinsi ON tb_karyawan.provinsi = tb_provinsi.kode
                  WHERE tb_karyawan.id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->num_rows > 0 ? $result->fetch_assoc() : false;
        $stmt->close();
        return $data;
    }

    // Edit karyawan
    public function editKaryawan($data)
    {
        $id = $data['id'];
        $nik = $data['nik'];
        $nama = $data['nama'];
        $jabatan = $data['jabatan']; // id/jabatan
        $alamat = $data['alamat'];
        $provinsi = $data['provinsi']; // id/provinsi
        $email = $data['email'];
        $telp = $data['telp'];
        $status = $data['status'];

        $query = "UPDATE tb_karyawan SET 
                    nik = ?, nama_karyawan = ?, jabatan = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_karyawan = ?
                  WHERE id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;
        $stmt->bind_param("ssssssssi", $nik, $nama, $jabatan, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Hapus karyawan
    public function deleteKaryawan($id)
    {
        $query = "DELETE FROM tb_karyawan WHERE id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Cari karyawan
    public function searchKaryawan($kataKunci)
    {
        $likeQuery = "%" . $kataKunci . "%";
        $query = "SELECT 
                    tb_karyawan.id_karyawan AS id,
                    tb_karyawan.nik,
                    tb_karyawan.nama_karyawan AS nama,
                    tb_jabatan.nama AS jabatan,
                    tb_provinsi.nama AS provinsi,
                    tb_karyawan.alamat,
                    tb_karyawan.email,
                    tb_karyawan.telp,
                    tb_karyawan.status_karyawan AS status
                  FROM tb_karyawan
                  LEFT JOIN tb_jabatan ON tb_karyawan.jabatan = tb_jabatan.kode
                  LEFT JOIN tb_provinsi ON tb_karyawan.provinsi = tb_provinsi.kode
                  WHERE tb_karyawan.nama_karyawan LIKE ? OR tb_karyawan.nik LIKE ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return [];
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
}

?>
