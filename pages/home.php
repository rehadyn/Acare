<?php
// pages/home.php
include 'koneksi.php';

// Jika ada parameter ?status, kita tampilkan SweetAlert
if (isset($_GET['status'])) {
?>
    <!-- Load SweetAlert & Bootstrap JS jika belum di-load di layout -->
    <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        <?php if ($_GET['status'] === 'berhasil'): ?>
            // Ambil param kode jika ada
            const kode = "<?= isset($_GET['kode']) ? addslashes($_GET['kode']) : '' ?>";
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Laporan Anda telah ditambahkan dengan Kode: ' + kode,
                confirmButtonText: 'OK'
            });
        <?php elseif ($_GET['status'] === 'gagal'): ?>
            const errMsg = "<?= isset($_GET['error']) ? addslashes($_GET['error']) : 'Terjadi kesalahan' ?>";
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errMsg,
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
<?php
}

// Query data dari tabel laporan
// Karena Anda hanya ingin menampilkan 4 kolom (kode, semester, jenis, status),
// kita select kolom itu saja. (Atau bisa SELECT * lalu tidak menampilkan kolom lain)
$sql = "SELECT kode_laporan, semester, jenis_laporan, status
        FROM laporan
        ORDER BY id_laporan DESC";
$res = mysqli_query($conn, $sql);
?>
<h1>Selamat Datang di AkademikCare</h1>
<p>AkademikCare adalah platform pengaduan akademik yang dirancang untuk membantu mahasiswa, dalam menyampaikan keluhan terkait proses akademik. Dengan fitur yang inovatif, AkademikCare menawarkan solusi cepat dan transparan untuk berbagai permasalahan, </p>
<!-- tombol buat kaporan -->
<a href="index.php?page=addlpr" class="btn btn-primary">Buat Laporan</a>
<P></P>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Kode Laporan</th>
                <th>Semester</th>
                <th>Jenis Laporan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <!-- Kode Laporan -->
                    <td><?= htmlspecialchars($row['kode_laporan']) ?></td>

                    <!-- Semester -->
                    <td><?= htmlspecialchars($row['semester']) ?></td>

                    <!-- Jenis Laporan -->
                    <td><?= htmlspecialchars($row['jenis_laporan']) ?></td>

                    <!-- Status (dengan warna) -->
                    <?php
                    $status = $row['status'];
                    // Tentukan class untuk warna status
                    $statusClass = '';
                    if ($status === 'permintaan') {
                        $statusClass = 'status-permintaan';
                    } elseif ($status === 'proses') {
                        $statusClass = 'status-proses';
                    } elseif ($status === 'selesai') {
                        $statusClass = 'status-selesai';
                    }
                    ?>
                    <td>
                        <span class="<?= $statusClass ?>">
                            <?= htmlspecialchars($status) ?>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>