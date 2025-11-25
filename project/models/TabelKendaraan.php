<?php
// Mengimpor file dependensi yang dibutuhkan
include_once("DB.php");
include_once("KontrakModelKendaraan.php");

class TabelKendaraan extends DB implements KontrakModelKendaraan {
    
    // Konstruktor kelas
    // Meneruskan parameter koneksi database ke konstruktor kelas induk (DB)
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk mengambil seluruh data kendaraan dari database
    // Mengembalikan array yang berisi semua baris data
    public function getAllKendaraan() {
        $this->executeQuery("SELECT * FROM kendaraan");
        return $this->getAllResult();
    }

    // Method untuk mengambil satu data kendaraan berdasarkan ID
    // Menggunakan parameter binding (:id) untuk keamanan query
    public function getKendaraanById($id) {
        $this->executeQuery("SELECT * FROM kendaraan WHERE id = :id", ['id' => $id]);
        $results = $this->getAllResult();
        
        // Mengembalikan baris pertama jika ada, atau null jika tidak ditemukan
        return $results[0] ?? null;
    }

    // Method untuk menambahkan data kendaraan baru (Create)
    // Menerima input data dan menyimpannya ke tabel kendaraan
    public function addKendaraan($merk, $tipe, $cc, $speed) {
        $query = "INSERT INTO kendaraan (merk, tipe, cc_mesin, top_speed) VALUES (:merk, :tipe, :cc, :speed)";
        
        // Eksekusi query dengan array parameter untuk binding nilai
        $this->executeQuery($query, ['merk' => $merk, 'tipe' => $tipe, 'cc' => $cc, 'speed' => $speed]);
    }

    // Method untuk memperbarui data kendaraan yang sudah ada (Update)
    // Mengubah data berdasarkan ID yang diberikan
    public function updateKendaraan($id, $merk, $tipe, $cc, $speed) {
        $query = "UPDATE kendaraan SET merk=:merk, tipe=:tipe, cc_mesin=:cc, top_speed=:speed WHERE id=:id";
        
        // Eksekusi query update dengan parameter lengkap
        $this->executeQuery($query, ['id' => $id, 'merk' => $merk, 'tipe' => $tipe, 'cc' => $cc, 'speed' => $speed]);
    }

    // Method untuk menghapus data kendaraan (Delete)
    // Menghapus baris data berdasarkan ID
    public function deleteKendaraan($id) {
        $this->executeQuery("DELETE FROM kendaraan WHERE id = :id", ['id' => $id]);
    }
}
?>