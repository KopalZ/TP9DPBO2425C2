<?php

class Pembalap {

    // Properti private untuk menyimpan atribut data pembalap
    // Menggunakan akses private untuk menerapkan konsep enkapsulasi
    private $id;
    private $nama;
    private $tim;
    private $negara;
    private $poinMusim;
    private $jumlahMenang;

    // Konstruktor untuk menginisialisasi objek Pembalap dengan data awal
    // Dijalankan saat instansiasi kelas
    public function __construct($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang){
        $this->id = $id;
        $this->nama = $nama;
        $this->tim = $tim;
        $this->negara = $negara;
        $this->poinMusim = $poinMusim;
        $this->jumlahMenang = $jumlahMenang;
    }

    // --- Bagian Getter (Accessor) ---
    // Digunakan untuk mengambil nilai properti private dari luar kelas

    // Mengembalikan ID pembalap
    public function getId(){
        return $this->id;
    }

    // Mengembalikan nama pembalap
    public function getNama(){
        return $this->nama;
    }

    // Mengembalikan nama tim
    public function getTim(){
        return $this->tim;
    }

    // Mengembalikan asal negara
    public function getNegara(){
        return $this->negara;
    }

    // Mengembalikan jumlah poin musim ini
    public function getPoinMusim(){
        return $this->poinMusim;
    }

    // Mengembalikan jumlah kemenangan
    public function getJumlahMenang(){
        return $this->jumlahMenang;
    }

    // --- Bagian Setter (Mutator) ---
    // Digunakan untuk mengubah nilai properti private dari luar kelas

    // Mengubah nilai nama pembalap
    public function setNama($nama){
        $this->nama = $nama;
    }

    // Mengubah nilai tim pembalap
    public function setTim($tim){
        $this->tim = $tim;
    }

    // Mengubah nilai negara
    public function setNegara($negara){
        $this->negara = $negara;
    }

    // Mengubah nilai poin musim
    public function setPoinMusim($poinMusim){
        $this->poinMusim = $poinMusim;
    }

    // Mengubah nilai jumlah kemenangan
    public function setJumlahMenang($jumlahMenang){
        $this->jumlahMenang = $jumlahMenang;
    }
}
?>