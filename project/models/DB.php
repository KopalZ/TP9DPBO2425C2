<?php

class DB {

    // Properti Konfigurasi Database (dibuat private agar aman & tidak bisa diubah dari luar class)
    private $host = "localhost"; // Alamat server database
    private $db_name = "";       // Nama database yang akan dituju
    private $username = "";      // Username login database
    private $password = "";      // Password login database
    
    // Variabel internal untuk menyimpan objek koneksi dan hasil query
    private $conn;   // Menyimpan objek koneksi PDO yang aktif
    private $result; // Menyimpan hasil eksekusi query terakhir

    // Constructor: Fungsi yang otomatis jalan pertama kali saat class DB dipanggil (new DB(...))
    function __construct($host, $db_name, $username, $password) {
        // Mengisi properti class dengan data yang dikirim dari parameter
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        
        // Langsung mencoba membuat koneksi saat objek DB dibuat
        $this->conn = $this->connect();
    }

    // Method utama untuk melakukan koneksi ke database MySQL
    public function connect() {

        $conn = null; // Siapkan variabel kosong

        try {
            // 1. Siapkan DSN (Data Source Name): Alamat lengkap tujuan koneksi
            // Format: mysql:host=NAMASERVER;dbname=NAMADATABASE;charset=utf8mb4
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            
            // 2. Siapkan Opsi/Pengaturan untuk PDO
            $options = [
                // Kalau ada error SQL, paksa program berhenti dan tampilkan pesan error (Exception)
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Kalau ambil data, formatnya harus Array Asosiatif (['nama' => 'Andi']) bukan index angka
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Keamanan: Gunakan prepared statement asli MySQL (mencegah SQL Injection)
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            // 3. Eksekusi koneksi menggunakan library PDO bawaan PHP
            $conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch (PDOException $exception) {
            // Jika koneksi gagal (misal salah password), tangkap errornya dan stop program
            throw new RuntimeException("Koneksi gagal: " . $exception->getMessage(), 0, $exception);
        }
        
        // Kembalikan objek koneksi yang berhasil dibuat
        return $conn;
    }

    // Method sakti untuk menjalankan segala jenis query (SELECT, INSERT, UPDATE, DELETE)
    // $query  = String query SQL (contoh: "SELECT * FROM pembalap WHERE id = :id")
    // $params = Data yang mau dimasukkan ke query (contoh: ['id' => 1])
    public function executeQuery($query, $params = []) {

        // Cek dulu, kalau belum konek, jangan lanjut (Safety Check)
        if ($this->conn === null) {
            throw new RuntimeException('Database belum terkoneksi. Pastikan connect() berhasil.');
        }

        try {
            // 1. PREPARE: PHP bilang ke MySQL "Siap-siap ya, aku mau kirim query ini"
            // (Placeholder seperti :id belum diisi data asli di sini)
            $stmt = $this->conn->prepare($query);
            
            // 2. EXECUTE: Kirim data aslinya ($params) secara terpisah untuk dijalankan
            // Teknik ini mencegah hacker menyusupkan kode jahat (SQL Injection)
            $stmt->execute($params);
            
            // Simpan hasilnya ke properti $this->result buat diambil nanti
            $this->result = $stmt;
            
            return $stmt; // Kembalikan statement (berguna buat cek rowCount dll)
            
        } catch (PDOException $e) {
            // Kalau query salah ketik atau data error, stop dan kasih tau errornya
            throw new RuntimeException('Query gagal: ' . $e->getMessage(), 0, $e);
        }
    }

    // Method khusus untuk mengambil data hasil SELECT
    public function getAllResult() {
        // Kalau belum ada query yang dijalankan, balikin array kosong biar gak error
        if ($this->result === null) {
            return [];
        }
        // fetchAll: Ambil SEMUA baris data dari memori dan ubah jadi Array PHP
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method bersih-bersih untuk menutup koneksi (opsional, PHP otomatis nutup di akhir)
    public function close() {
        $this->conn = null;
    }

}
?>