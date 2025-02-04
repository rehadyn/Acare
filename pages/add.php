<?php
// pages/addlpr.php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    // Ambil data form
    $nama      = $_POST['nama'];
    $nim       = $_POST['nim'];
    $kelas     = $_POST['kelas'];
    $semester  = $_POST['semester'];
    $nomorHp   = $_POST['nomorHp'];
    $jenis     = $_POST['jenisLaporan'];
    $deskripsi = $_POST['deskripsi'];

    $status     = 'permintaan';
    $keterangan = 'Menunggu konfirmasi';

    // Generate kode laporan (misal: LPR-1234)
    $randNum      = mt_rand(1000, 9999);
    $kode_laporan = "LPR-$randNum";

    // Tanggal pelaporan
    $tanggal_pelaporan = date('Y-m-d H:i:s');

    // Upload berkas (jika ada)
    $berkasPath = null;
    if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] === 0) {
        $fileName   = $_FILES['berkas']['name'];
        $tmpFile    = $_FILES['berkas']['tmp_name'];
        $uniqueName = time() . '_' . $fileName;
        $dest       = 'uploads/' . $uniqueName;

        if (move_uploaded_file($tmpFile, $dest)) {
            $berkasPath = $dest;
        }
    }

    // Query INSERT (versi sederhana; Anda boleh pakai prepared statement)
    // Pastikan tabel 'laporan' punya kolom sesuai (kode_laporan, nama, nim, dll.)
    // Gunakan mysqli_real_escape_string($conn, ...) untuk keamanan, atau prepared statement.
    $sql = "INSERT INTO laporan
            (kode_laporan, nama, nim, kelas, semester, nomor_hp,
             jenis_laporan, deskripsi, berkas, tanggal_pelaporan, status, keterangan)
            VALUES
            (
             '$kode_laporan',
             '$nama',
             '$nim',
             '$kelas',
             '$semester',
             '$nomorHp',
             '$jenis',
             '$deskripsi',
             " . ($berkasPath ? "'$berkasPath'" : "NULL") . ",
             '$tanggal_pelaporan',
             '$status',
             '$keterangan'
            )";

    $q = mysqli_query($conn, $sql);

    if ($q) {
        // Jika sukses, arahkan ke home + status=berhasil + sertakan kode
        header("Location: index.php?page=home&status=berhasil&kode=$kode_laporan");
        exit;
    } else {
        // Gagal insert
        $error = mysqli_error($conn);
        header("Location: index.php?page=home&status=gagal&error=" . urlencode($error));
        exit;
    }
} else {
    // Jika file ini diakses tanpa submit form
    header('Location: index.php?page=daftar');
    exit;
}
