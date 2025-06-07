# AkademikCare

AkademikCare merupakan aplikasi pengaduan akademik sederhana berbasis PHP.
Aplikasi ini memungkinkan mahasiswa membuat laporan masalah terkait proses akademik
serta memudahkan admin memantau dan memberi solusi atas laporan tersebut.

## Fitur

- **Halaman Home** menampilkan daftar laporan yang telah masuk.
- **Formulir Laporan** untuk mahasiswa membuat laporan baru dan mengunggah berkas pendukung.
- **Halaman Admin** untuk melihat detail laporan, memperbarui status, serta menambahkan solusi.
- **Autentikasi Admin** melalui halaman login sederhana.

## Struktur Direktori

- `index.php` – Router utama yang memuat halaman sesuai parameter `page`.
- `layout.php` dan `navbar.php` – Menyediakan tampilan dasar dan navigasi.
- `pages/` – Berisi beragam halaman seperti `home.php`, `daftar.php`, `admin.php`, dan lainnya.
- `uploads/` – Tempat penyimpanan berkas yang diunggah pengguna.

## Persiapan

1. Siapkan server web dengan PHP dan MySQL.
2. Buat database dan sesuaikan kredensial pada `koneksi.php` (baik di direktori
   utama maupun di dalam `pages/`).
3. Import struktur tabel yang diperlukan (misalnya tabel `laporan` dan `users`).
4. Jalankan aplikasi melalui browser dengan membuka `index.php`.

## Catatan Keamanan

File `koneksi.php` berisi contoh kredensial bawaan. Pastikan mengganti
kredensial tersebut pada lingkungan produksi dan lindungi file dari akses
publik.

## Pengujian

Proyek ini menyiapkan kerangka `PHPUnit` dasar. Jalankan perintah berikut setelah
melakukan `composer install` untuk menjalankan test:

```bash
vendor/bin/phpunit
```

