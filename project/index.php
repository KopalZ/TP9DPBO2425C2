<?php

// 1. Include Koneksi Database & Komponen Pembalap
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

// 2. Include Komponen Kendaraan (Fitur Baru)
include_once("models/TabelKendaraan.php");
include_once("views/ViewKendaraan.php");
include_once("presenters/PresenterKendaraan.php");

// 3. Konfigurasi Database
$dbHost = 'localhost';
$dbName = 'mvp_db';
$dbUser = 'root';
$dbPass = '';

// 4. Routing Halaman
// Cek parameter 'page' di URL. Default ke 'pembalap' jika tidak ada.
$page = isset($_GET['page']) ? $_GET['page'] : 'pembalap';

// Inisialisasi variabel presenter agar bisa diakses di blok logic bawah
$presenter = null;

if ($page == 'pembalap') {
    // Inisialisasi MVP Pembalap
    $tabel = new TabelPembalap($dbHost, $dbName, $dbUser, $dbPass);
    $view = new ViewPembalap();
    $presenter = new PresenterPembalap($tabel, $view);

} elseif ($page == 'kendaraan') {
    // Inisialisasi MVP Kendaraan
    $tabel = new TabelKendaraan($dbHost, $dbName, $dbUser, $dbPass);
    $view = new ViewKendaraan();
    $presenter = new PresenterKendaraan($tabel, $view);
}

// ------------------------------------------------------------------
// LOGIC UTAMA (Handle Action & Tampilan)
// ------------------------------------------------------------------

// A. Handle Action DELETE (via Link GET)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    if ($page == 'pembalap') {
        $presenter->hapusPembalap($_GET['id']);
    } elseif ($page == 'kendaraan') {
        $presenter->hapus($_GET['id']);
    }
    
    // Redirect bersih supaya URL kembali rapi
    header("Location: index.php?page=" . $page);
    exit();
}

// B. Handle Form SUBMIT (via POST)
if (isset($_POST['action'])) {
    
    if ($page == 'pembalap') {
        // Logic Simpan/Update Pembalap
        if ($_POST['action'] == 'add') {
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        }

    } elseif ($page == 'kendaraan') {
        // Logic Simpan/Update Kendaraan
        if ($_POST['action'] == 'add') {
            $presenter->tambah($_POST['merk'], $_POST['tipe'], $_POST['cc_mesin'], $_POST['top_speed']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubah($_POST['id'], $_POST['merk'], $_POST['tipe'], $_POST['cc_mesin'], $_POST['top_speed']);
        }
    }
    
    // Redirect setelah submit
    header("Location: index.php?page=" . $page);
    exit();
}

// C. Menampilkan Halaman (View)
// Cek apakah user meminta form (add/edit) atau tabel list
if (isset($_GET['screen'])) {
    
    // --- TAMPILAN FORM ---
    if ($_GET['screen'] == 'add') {
        // Tampilkan form tambah kosong
        if ($page == 'pembalap') {
            echo $presenter->tampilkanFormPembalap();
        } else {
            echo $presenter->tampilkanForm(); // Method dari KontrakPresenterKendaraan
        }

    } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
        // Tampilkan form edit dengan data
        if ($page == 'pembalap') {
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        } else {
            echo $presenter->tampilkanForm($_GET['id']); // Method dari KontrakPresenterKendaraan
        }
    }

} else {
    
    // --- TAMPILAN TABEL UTAMA ---
    
    // 1. Tampilkan Navigasi Menu (Supaya bisa pindah antar tabel)
    echo '
    <div style="background-color: #f8f9fa; padding: 15px; border-bottom: 1px solid #ddd; margin-bottom: 20px; font-family: sans-serif;">
        <strong>Navigasi:</strong> 
        <a href="index.php?page=pembalap" style="margin-right: 15px; text-decoration: none; color: ' . ($page == 'pembalap' ? 'red' : 'blue') . ';">Data Pembalap</a>
        |
        <a href="index.php?page=kendaraan" style="margin-left: 15px; text-decoration: none; color: ' . ($page == 'kendaraan' ? 'red' : 'blue') . ';">Data Kendaraan</a>
    </div>
    ';

    // 2. Tampilkan Tabel Data sesuai page yang aktif
    if ($page == 'pembalap') {
        echo $presenter->tampilkanPembalap();
    } elseif ($page == 'kendaraan') {
        echo $presenter->tampilkanData(); // Method dari KontrakPresenterKendaraan
    }
}

?>