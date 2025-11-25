<?php

class Kendaraan {
    // Properti private untuk menyimpan atribut data kendaraan
    // Akses dibatasi (private) untuk menjaga enkapsulasi data
    private $id;
    private $merk;
    private $tipe;
    private $ccMesin;
    private $topSpeed;

    // Konstruktor untuk menginisialisasi objek Kendaraan dengan nilai awal
    // Dijalankan secara otomatis saat instansiasi objek (new Kendaraan)
    public function __construct($id, $merk, $tipe, $ccMesin, $topSpeed) {
        $this->id = $id;
        $this->merk = $merk;
        $this->tipe = $tipe;
        $this->ccMesin = $ccMesin;
        $this->topSpeed = $topSpeed;
    }

    // Method getter untuk mengambil nilai ID
    public function getId() { 
        return $this->id; 
    }

    // Method getter untuk mengambil nilai Merk
    public function getMerk() { 
        return $this->merk; 
    }

    // Method getter untuk mengambil nilai Tipe
    public function getTipe() { 
        return $this->tipe; 
    }

    // Method getter untuk mengambil nilai Kapasitas Mesin (CC)
    public function getCcMesin() { 
        return $this->ccMesin; 
    }

    // Method getter untuk mengambil nilai Top Speed
    public function getTopSpeed() { 
        return $this->topSpeed; 
    }
}
?>