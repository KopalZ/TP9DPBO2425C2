<?php
include_once(__DIR__ . "/../models/TabelKendaraan.php");
include_once(__DIR__ . "/../models/Kendaraan.php");
include_once(__DIR__ . "/../views/ViewKendaraan.php");
include_once("KontrakPresenterKendaraan.php"); // Load kontraknya

// Tambahkan "implements KontrakPresenterKendaraan"
class PresenterKendaraan implements KontrakPresenterKendaraan {
    
    private $tabel;
    private $view;
    private $list = [];

    public function __construct($tabel, $view) {
        $this->tabel = $tabel;
        $this->view = $view;
        $this->initList();
    }

    public function initList() {
        $data = $this->tabel->getAllKendaraan();
        // echo "<pre>";
        // var_dump($data); 
        // echo "</pre>";
        // die();
        $this->list = [];
        foreach ($data as $item) {
            $this->list[] = new Kendaraan($item['id'], $item['merk'], $item['tipe'], $item['cc_mesin'], $item['top_speed']);
        }
    }

    // Wajib ada karena kontrak
    public function tampilkanData(): string {
        return $this->view->tampilPembalap($this->list);
    }

    // Wajib ada karena kontrak
    public function tampilkanForm($id = null): string {
        $data = null;
        if ($id !== null) {
            $data = $this->tabel->getKendaraanById($id);
        }
        return $this->view->tampilFormPembalap($data);
    }

    // Wajib ada karena kontrak
    public function tambah($merk, $tipe, $cc, $speed) {
        $this->tabel->addKendaraan($merk, $tipe, $cc, $speed);
    }
    
    // Wajib ada karena kontrak
    public function ubah($id, $merk, $tipe, $cc, $speed) {
        $this->tabel->updateKendaraan($id, $merk, $tipe, $cc, $speed);
    }
    
    // Wajib ada karena kontrak
    public function hapus($id) {
        $this->tabel->deleteKendaraan($id);
    }
}
?>