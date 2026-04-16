# UTS-PBW-SIPG1-AbsensiPro

UTS PBW Sistem Absensi
1. I Komang Gede Agung Krisna Yuda Kurniawan [2401010030]
2. I Kadek Anjuna Indra Praditya [2401010022]
3. I Dewa Ageng Semara Kepakisan [2401010021]
4. I Rai Agus Aditya Prayuda [2401010013]

![Laravel](https://img.shields.io/badge/Laravel-Framework-red)
![PHP](https://img.shields.io/badge/PHP-Backend-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL-orange)

---

## Deskripsi Singkat
**AbsensiPro** adalah aplikasi berbasis web yang dibuat untuk membantu proses absensi peserta secara lebih efektif dan efisien.  
Sistem ini memungkinkan admin untuk mengelola data peserta, melakukan pencatatan kehadiran, serta melihat hasil absensi dengan mudah.

Project ini dibuat sebagai tugas **UTS Pemrograman Berbasis Web (PBW)**.

---

## Fitur Utama
- Manajemen data peserta
- Sistem absensi (hadir, tidak hadir, dll)
- Edit & hapus data peserta
- Validasi input data
- Notifikasi interaktif (SweetAlert2)
- Tampilan sederhana & user-friendly

---

## Teknologi yang Digunakan
- **Laravel** (Framework PHP)
- **PHP**
- **MySQL**
- **HTML, CSS, JavaScript**
- **SweetAlert2**

---

## Struktur Folder (Singkat)
1. app/ -> Logic utama aplikasi
2. config/ -> Konfigurasi project
3. public/ -> Akses file publik (index.php, assets)
4. resources/ -> View (Blade), CSS, JS
5. routes/ -> Routing aplikasi

---

## Cara Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/agungkrisnayuda/UTS-PBW-SIPG1-AbsensiPro.git
   ```
2. Masuk ke folder project:
   ```bash
   cd UTS-PBW-SIPG1-AbsensiPro
   ```
3. Install dependency:
   ```bash
   composer install
   ```
4. Copy file .env:
   ```bash
   cp .env.example .env
   ```
5. Generate key:
   ```bash
   php artisan key:generate
   ```
6. Setting database di .env
7. Migrasi database:
   ```bash
   php artisan migrate
   ```
8. Jalankan server:
   ```bash
   php artisan serve
   ```
