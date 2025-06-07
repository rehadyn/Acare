# AkademikCare

AkademikCare adalah aplikasi pengaduan akademik sederhana yang ditulis dengan PHP. Proyek ini memungkinkan mahasiswa menyampaikan keluhan terkait kegiatan akademik dan membantu admin mencatat serta menindaklanjuti laporan tersebut.

## Fitur Utama

- **Formulir Laporan** – Mahasiswa dapat membuat laporan baru beserta unggahan berkas pendukung.
- **Daftar Laporan** – Menampilkan laporan yang masuk berikut statusnya.
- **Halaman Admin** – Admin dapat memperbarui status laporan dan menuliskan solusi.
- **Autentikasi** – Halaman login sederhana untuk akses admin.
- **Proteksi CSRF** – Token CSRF dibangkitkan pada setiap sesi dan diverifikasi ketika melakukan aksi.

## Struktur Direktori

- `index.php` – Router utama yang menentukan halaman mana yang dimuat.
- `layout.php` dan `navbar.php` – Komponen tampilan dasar dan navigasi.
- `csrf.php` – Fungsi pembangkit dan pengecek token CSRF.
- `pages/` – Berisi implementasi halaman:
  - `home.php` – Daftar laporan terbaru.
  - `daftar.php` – Formulir pengaduan.
  - `add.php` – Proses penyimpanan laporan.
  - `admin.php` – Panel admin.
  - `login.php` – Autentikasi admin.
  - `update_status.php` dan `update_solusi.php` – Endpoint AJAX untuk memperbarui laporan.
  - `koneksi.php` – Koneksi basis data untuk direktori ini.
- `uploads/` – Lokasi penyimpanan berkas yang diunggah pengguna.
- `tests/` – Unit test sederhana menggunakan PHPUnit.

## Cara Menjalankan

1. Pastikan PHP dan MySQL telah terpasang di server.
2. Buat database baru kemudian sesuaikan konfigurasi pada `koneksi.php` (baik di direktori utama maupun `pages/`).
3. Import skema tabel yang diperlukan (tabel `laporan` dan `users`).
4. Jalankan server web dan akses `index.php` melalui browser.
5. Login sebagai admin melalui halaman `index.php?page=login` untuk mengelola laporan.

## Pengujian

Setelah menjalankan `composer install`, tes unit dapat dijalankan dengan:

```bash
vendor/bin/phpunit
```

## Catatan Keamanan

Contoh kredensial database pada `koneksi.php` hanya untuk kebutuhan pengembangan. Gantilah informasi tersebut pada lingkungan produksi dan pastikan file koneksi tidak dapat diunduh publik.

