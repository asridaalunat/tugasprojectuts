<?php

include_once 'db-config.php';

class Karyawan extends Database
{
    // Input karyawan
    public function inputKaryawan($data)
    {
        $nik       = $data['nik'];
        $nama      = $data['nama'];
        $jabatan   = $data['jabatan'];  
        $alamat    = $data['alamat'];
        $kategori  = $data['kategori']; 
        $email     = $data['email'];
        $telp      = $data['telp'];
        $status    = $data['status'];

        $query = "INSERT INTO tb_karyawan (nik, nama_karyawan, jabatan, alamat, kategori, email, telp, status_karyawan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;
        $stmt->bind_param("ssssssss", $nik, $nama, $jabatan, $alamat, $kategori, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil semua data karyawan
    public function getAllKaryawan()
    {
        $query = "SELECT 
                    id_karyawan AS id,
                    nik,
                    nama_karyawan AS nama,
                    jabatan,
                    kategori,
                    alamat,
                    email,
                    telp,
                    status_karyawan AS status
                  FROM tb_karyawan";
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
                    id_karyawan AS id,
                    nik,
                    nama_karyawan AS nama,
                    jabatan,
                    kategori,
                    alamat,
                    email,
                    telp,
                    status_karyawan AS status
                  FROM tb_karyawan
                  WHERE id_karyawan = ?";
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
        $id        = $data['id'];
        $nik       = $data['nik'];
        $nama      = $data['nama'];
        $jabatan   = $data['jabatan']; 
        $alamat    = $data['alamat'];
        $kategori  = $data['kategori']; 
        $email     = $data['email'];
        $telp      = $data['telp'];
        $status    = $data['status'];

        $query = "UPDATE tb_karyawan SET 
                    nik = ?, nama_karyawan = ?, jabatan = ?, alamat = ?, kategori = ?, email = ?, telp = ?, status_karyawan = ?
                  WHERE id_karyawan = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;
        $stmt->bind_param("ssssssssi", $nik, $nama, $jabatan, $alamat, $kategori, $email, $telp, $status, $id);
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
                    id_karyawan AS id,
                    nik,
                    nama_karyawan AS nama,
                    jabatan,
                    kategori,
                    alamat,
                    email,
                    telp,
                    status_karyawan AS status
                  FROM tb_karyawan
                  WHERE nama_karyawan LIKE ? OR nik LIKE ?";
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
