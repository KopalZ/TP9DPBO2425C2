<?php

interface KontrakModelKendaraan
{
    public function getAllKendaraan();
    public function getKendaraanById($id);

    // Method CRUD Kendaraan
    public function addKendaraan($merk, $tipe, $cc, $speed);
    public function updateKendaraan($id, $merk, $tipe, $cc, $speed);
    public function deleteKendaraan($id);
}

?>