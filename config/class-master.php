<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar jabatan
    public function getJabatan(){
        $query = "SELECT * FROM tb_jabatan";
        $result = $this->conn->query($query);
        $jabatan = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jabatan[] = [
                    'id' => $row['id_jabatan'],
                    'kode' => $row['kode_jabatan'],
                    'nama' => $row['nama_jabatan'],
                    'deskripsi' => $row['deskripsi'],           
                    'level_jabatan' => $row['level_jabatan']    
                ];
            }
        }
        return $jabatan;
    }

    // Method untuk mendapatkan daftar kategori (sebelumnya provinsi)
    public function getKategori(){
        $query = "SELECT * FROM tb_kategori";
        $result = $this->conn->query($query);
        $kategori = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $kategori[] = [
                    'id' => $row['id_kategori'],
                    'nama' => $row['nama_kategori']
                ];
            }
        }
        return $kategori;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Aktif'],
            ['id' => 2, 'nama' => 'Tidak Aktif'],
            ['id' => 3, 'nama' => 'Cuti'],
        ];
    }

    // Method untuk input data jabatan
    public function inputJabatan($data){
        $kodeJabatan = $data['kode'];
        $namaJabatan = $data['nama'];
        $deskripsi = isset($data['deskripsi']) ? $data['deskripsi'] : '';
        $levelJabatan = isset($data['level_jabatan']) ? $data['level_jabatan'] : '';
        $query = "INSERT INTO tb_jabatan (kode_jabatan, nama_jabatan, deskripsi, level_jabatan) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ssss", $kodeJabatan, $namaJabatan, $deskripsi, $levelJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data jabatan berdasarkan kode
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
                'kode' => $row['kode_jabatan'],
                'nama' => $row['nama_jabatan'],
                'deskripsi' => $row['deskripsi'],           
                'level_jabatan' => $row['level_jabatan']    
            ];
        }
        $stmt->close();
        return $jabatan;
    }

    // Method untuk mengedit data jabatan
    public function updateJabatan($data){
        $kodeJabatan   = $data['kode'];
        $namaJabatan   = $data['nama'];
        $deskripsi     = $data['deskripsi'];                 
        $levelJabatan  = $data['level_jabatan'];             

        $query = "UPDATE tb_jabatan SET nama_jabatan = ?, deskripsi = ?, level_jabatan = ? WHERE kode_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ssss", $namaJabatan, $deskripsi, $levelJabatan, $kodeJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data jabatan
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

    // Method untuk input data kategori (sebelumnya provinsi)
    public function inputKategori($data){
        $namaKategori = $data['nama'];
        $query = "INSERT INTO tb_kategori (nama_kategori) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaKategori);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data kategori berdasarkan id
    public function getUpdateKategori($id){
        $query = "SELECT * FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $kategori = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $kategori = [
                'id' => $row['id_kategori'],
                'nama' => $row['nama_kategori']
            ];
        }
        $stmt->close();
        return $kategori;
    }

    // Method untuk mengedit data kategori
    public function updateKategori($data){
        $idKategori = $data['id'];
        $namaKategori = $data['nama'];
        $query = "UPDATE tb_kategori SET nama_kategori = ? WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaKategori, $idKategori);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data kategori
    public function deleteKategori($id){
        $query = "DELETE FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /* ======================================================
       TAMBAHAN BARU UNTUK FUNGSI JABATAN BERDASARKAN ID
       ====================================================== */
    public function getJabatanById($id){
        $query = "SELECT * FROM tb_jabatan WHERE id_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jabatan = $result->fetch_assoc();
        $stmt->close();
        return $jabatan;
    }
}
?>
