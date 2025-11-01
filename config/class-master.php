<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getJabatan(){
        $query = "SELECT * FROM tb_jabatan";
        $result = $this->conn->query($query);
        $jabatan = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jabatan[] = [
                    'id' => $row['kode_jabatan'],
                    'nama' => $row['nama_jabatan']
                ];
            }
        }
        return $jabatan;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProvinsi(){
        $query = "SELECT * FROM tb_provinsi";
        $result = $this->conn->query($query);
        $provinsi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $provinsi[] = [
                    'id' => $row['id_provinsi'],
                    'nama' => $row['nama_provinsi']
                ];
            }
        }
        return $provinsi;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Aktif'],
            ['id' => 2, 'nama' => 'Tidak Aktif'],
            ['id' => 2, 'nama' => 'Cuti'],
        ];
    }

    // Method untuk input data program studi
    public function inputJabatan($data){
        $kodeJabatan = $data['kode'];
        $namaJabatan = $data['nama'];
        $query = "INSERT INTO tb_jabatan (kode_jabatan, nama_jabatan) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeJabatan, $namaJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdateJabatan($id){
        $query = "SELECT * FROM tb_jabatan WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jabatan = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $jabatan = [
                'id' => $row['kode_jabatan'],
                'nama' => $row['nama_jabatan']
            ];
        }
        $stmt->close();
        return $jabatan;
    }

    // Method untuk mengedit data program studi
    public function updateJabatan($data){
        $kodeJabatan = $data['kode'];
        $namaJabatan = $data['nama'];
        $query = "UPDATE tb_jabatan SET nama_jabatan = ? WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaJabatan, $kodeJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deleteJabatan($id){
        $query = "DELETE FROM tb_jabatan WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>