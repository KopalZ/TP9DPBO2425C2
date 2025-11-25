<?php
include_once("KontrakView.php");
include_once("models/Kendaraan.php");

class ViewKendaraan implements KontrakView {
    
    public function tampilPembalap($list): string { 
        
        // --- [DEBUGGING MODE] ---
        // Kalau layar muncul tulisan angka (misal "DATA DITERIMA: 3"), berarti database SUKSES.
        // Kalau "DATA DITERIMA: 0", berarti database/model KOSONG/ERROR.
        // Hapus 3 baris di bawah ini kalau sudah fix.
        // echo "<div style='background: yellow; padding: 10px;'>DATA DITERIMA VIEW: " . count($list) . "</div>";
        // ------------------------

        $tbody = '';
        $no = 1;
        foreach($list as $k){
            $tbody .= '<tr>';
            $tbody .= '<td>'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($k->getMerk()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($k->getTipe()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($k->getCcMesin()) .' cc</td>';
            $tbody .= '<td>'. htmlspecialchars($k->getTopSpeed()) .' km/h</td>';
            $tbody .= '<td>
                    <a href="index.php?page=kendaraan&screen=edit&id='. $k->getId() .'" class="btn btn-edit">Edit</a>
                    <a href="index.php?page=kendaraan&action=delete&id='. $k->getId() .'" class="btn btn-delete" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                  </td>';
            $tbody .= '</tr>';
            $no++;
        }
        
        $templatePath = __DIR__ . '/../template/skin.html';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);

            // 1. REPLACE DATA BARIS (Krusial!)
            $template = str_replace('</tbody>', $tbody . '</tbody>', $template);

            // 2. REPLACE TOTAL DATA (Baru ditambahkan)
            // Mengganti "Total:" di template dengan "Total: (jumlah data)"
            $totalData = count($list);
            $template = str_replace('Total:', 'Total: ' . $totalData, $template);

            // 3. REPLACE HEADER & JUDUL
            $template = str_replace('<h1>Daftar Pembalap</h1>', '<h1>Daftar Kendaraan</h1>', $template);
            $template = str_replace('<th>Nama</th>', '<th>Merk</th>', $template);
            $template = str_replace('<th>Tim</th>', '<th>Tipe</th>', $template);
            $template = str_replace('<th>Negara</th>', '<th>CC Mesin</th>', $template);
            $template = str_replace('<th>Poin Musim</th>', '<th>Top Speed</th>', $template);
            $template = str_replace('<th>Jumlah Menang</th>', '', $template); // Hapus kolom sisa

            // 4. REPLACE TOMBOL TAMBAH
            $template = str_replace('+ Tambah Pembalap', '+ Tambah Kendaraan', $template);
            $template = str_replace('href="index.php?screen=add"', 'href="index.php?page=kendaraan&screen=add"', $template);

            return $template;
        }
        
        return $tbody;
    }

    public function tampilFormPembalap($data = null): string {
        $template = file_get_contents(__DIR__ . '/../template/form_kendaraan.html');
        
        if ($data) {
             // 1. Ubah Status Form dari 'add' ke 'edit'
             // Ini penting supaya index.php tahu ini proses update, bukan insert
             $template = str_replace('value="add"', 'value="edit"', $template);

             // 2. Isi ID (Hidden Input)
             // Ini wajib supaya database tahu baris mana yang mau diedit
             $template = str_replace('value="" id="id"', 'value="'.$data['id'].'" id="id"', $template);

             // 3. Isi Data Form (PREFILL)
             // Trik: Kita cari attribute 'name=".."' di HTML, lalu kita selipkan 'value=".."' di sebelahnya.
             
             // Mengisi Merk
             $template = str_replace('name="merk"', 'name="merk" value="'.$data['merk'].'"', $template);
             
             // Mengisi Tipe
             $template = str_replace('name="tipe"', 'name="tipe" value="'.$data['tipe'].'"', $template);
             
             // Mengisi CC Mesin
             $template = str_replace('name="cc_mesin"', 'name="cc_mesin" value="'.$data['cc_mesin'].'"', $template);
             
             // Mengisi Top Speed
             $template = str_replace('name="top_speed"', 'name="top_speed" value="'.$data['top_speed'].'"', $template);
        }
        
        return $template;
    }
}
?>