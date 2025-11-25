<?php

interface KontrakPresenterKendaraan
{
    // Method untuk menampilkan data
    public function tampilkanData(): string;
    public function tampilkanForm($id = null): string;

    // Method untuk CRUD (Void karena tidak mengembalikan string HTML)
    public function tambah($merk, $tipe, $cc, $speed);
    public function ubah($id, $merk, $tipe, $cc, $speed);
    public function hapus($id);
}

?>