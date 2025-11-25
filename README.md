# Janji
Saya Naufal Zahid dengan NIM 2405787 mengerjakan Evaluasi Tugas Praktikum 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Sistem Manajemen Data Balapan — PHP MVP

Proyek ini merupakan implementasi website berbasis PHP Native dengan penerapan pola arsitektur **Model-View-Presenter (MVP)** untuk mengelola data Pembalap dan Kendaraan Balap.

Penerapan MVP dalam proyek ini dilakukan secara ketat dengan memisahkan logika bisnis (Model), tampilan (View), dan penghubung (Presenter). Komunikasi antar komponen diatur menggunakan **Interface (Kontrak)** untuk menjaga konsistensi dan fleksibilitas kode.

---

## 🔗 Informasi Repositori

| Kategori | Detail |
| :--- | :--- |
| **Nama Repo** | `TP9DPBO2425C2` |
| **Database** | `mvp_db` (2 tabel: pembalap, kendaraan) |
| **Arsitektur** | Model-View-Presenter (MVP) |

---

## Tema Website: Data Statistik Balapan

Website ini digunakan untuk mencatat spesifikasi kendaraan balap dan statistik pembalap.

**Contoh penggunaan:**
- User dapat menambahkan data **Pembalap** baru (Nama, Tim, Negara, Poin, Jumlah Menang).
- User dapat menambahkan data **Kendaraan** baru (Merk, Tipe, Kapasitas Mesin, Top Speed).
- Navigasi yang mudah antar entitas data.

---

## 🗃️ Struktur Database

### 1️⃣ Tabel `pembalap`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, AUTO_INCREMENT) | ID unik Pembalap |
| `nama` | VARCHAR(255) | Nama Lengkap Pembalap |
| `tim` | VARCHAR(255) | Nama Tim Balap |
| `negara` | VARCHAR(255) | Asal Negara |
| `poinMusim` | INT | Total Poin Musim Ini |
| `jumlahMenang` | INT | Total Kemenangan (Podium 1) |

### 2️⃣ Tabel `kendaraan`


https://github.com/user-attachments/assets/61296e71-ba6d-4365-90c4-c97869237184


| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, AUTO_INCREMENT) | ID unik Kendaraan |
| `merk` | VARCHAR(100) | Merk Pabrikan (misal: Ducati) |
| `tipe` | VARCHAR(100) | Tipe/Model Motor/Mobil (misal: Desmosedici GP24) |
| `cc_mesin` | INT | Kapasitas Mesin (CC) |
| `top_speed` | INT | Kecepatan Maksimum (km/h) |

---

## 🧩 Fitur Utama (CRUD per Entitas)

Setiap entitas (Pembalap dan Kendaraan) memiliki fitur lengkap:

| Fitur | Deskripsi |
| :--- | :--- |
| **Create** | Menambahkan data baru melalui form input. |
| **Read** | Menampilkan daftar data dalam bentuk tabel dinamis. |
| **Update** | Mengedit data yang sudah ada (Form terisi otomatis / *Prefill*). |
| **Delete** | Menghapus data dari database. |

---

## 🏗️ Struktur Folder Proyek (MVP)

Struktur folder dirancang untuk memisahkan *concern* sesuai pola MVP.

```bash
TP9/
 ├── models/                  # [MODEL] Mengurus Data & Database
 │   ├── DB.php               # Koneksi Database (PDO)
 │   ├── Pembalap.php         # Class Objek Pembalap
 │   ├── Kendaraan.php        # Class Objek Kendaraan
 │   ├── TabelPembalap.php    # Query SQL Pembalap
 │   ├── TabelKendaraan.php   # Query SQL Kendaraan
 │   ├── KontrakModel.php     # Interface/Kontrak Model Pembalap
 │   └── KontrakModelKendaraan.php # Interface/Kontrak Model Kendaraan
 │
 ├── views/                   # [VIEW] Mengurus Tampilan HTML
 │   ├── KontrakView.php      # Interface/Kontrak View
 │   ├── ViewPembalap.php     # Logic Tampilan Pembalap
 │   └── ViewKendaraan.php    # Logic Tampilan Kendaraan (Manipulasi Template)
 │
 ├── presenters/              # [PRESENTER] Penghubung Model & View
 │   ├── KontrakPresenter.php # Interface/Kontrak Presenter
 │   ├── PresenterPembalap.php
 │   ├── PresenterKendaraan.php
 │   └── KontrakPresenterKendaraan.php
 │
 ├── template/                # Template HTML Dasar
 │   ├── skin.html            # Kerangka Tabel Utama
 │   ├── form.html            # Form Input Pembalap
 │   └── form_kendaraan.html  # Form Input Kendaraan
 │
 ├── index.php                # Main Entry Point (Routing)
 └── mvp_db.sql               # File SQL Database
```

---

## Flow / Alur Program
### 1. Routing (index.php)
- Menerima request dari user.
- Menentukan halaman mana yang diminta (?page=pembalap atau ?page=kendaraan).
- Menginisialisasi Model, View, dan Presenter yang sesuai.

### 2. Presenter
- Bertindak sebagai "Manajer".
- Menerima perintah dari index.php (misal: tombol 'Simpan' ditekan).
- Meminta Model untuk mengolah data (Simpan ke DB).
- Meminta View untuk menampilkan hasil (Tampilkan Tabel/Form).

### 3. Model
- Fokus hanya pada data.
- Melakukan koneksi ke database menggunakan DB.php.
- Menjalankan query SQL (INSERT, SELECT, UPDATE, DELETE).

Wajib mematuhi KontrakModel.

### 4. View
- Fokus hanya pada tampilan.
- Menerima data dari Presenter.
- Memuat file HTML dari folder template/.

Melakukan manipulasi string (str_replace) untuk mengganti judul, header tabel, dan isi data sesuai konteks (Pembalap/Kendaraan).
---

## 💻 Cara Menjalankan
1. Buat database baru di phpMyAdmin bernama mvp_db.
2. Import file mvp_db.sql yang disertakan dalam repositori ini.
3. Konfigurasi koneksi database di file models/DB.php (jika password/username berbeda).
4. Jalankan aplikasi di browser:
  ```Bash
  http://localhost/TP9/index.php
  ```
5. Gunakan menu navigasi untuk berpindah antara Data Pembalap dan Data Kendaraan.

---

## 🎥 Dokumentasi
https://github.com/user-attachments/assets/07c8051b-0ed9-4dd0-9253-7f20cbd06a1d
