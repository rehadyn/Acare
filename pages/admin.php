<?php
session_start();

include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login"); // Arahkan ke login.php jika belum login
    exit();
}



// Ambil data laporan dari database
$query = "SELECT * FROM laporan ORDER BY id_laporan DESC";
$result = mysqli_query($conn, $query);
$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
?>

    
    <div class="container mt-4">
        <h2>Daftar Laporan</h2>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Laporan</th>
                      	<th>Jenis Laporan</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                        <th>Solusi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data as $row):
                        $id = $row['id_laporan'];
                        $statusOptions = ['permintaan', 'proses', 'selesai'];
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['kode_laporan']) ?></td>
                      	<td><?= htmlspecialchars($row['jenis_laporan']) ?></td>
                        <td>
                            <a href="#" class="toggle-row" data-id="<?= $id ?>">
                                <?= htmlspecialchars($row['nama']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($row['nim']) ?></td>
                        <td>
                            <?php
                            $nomor = $row['nomor_hp'];
                            if (substr($nomor, 0, 1) === '0') {
                                $nomor = '62' . substr($nomor, 1);
                            }
                            ?>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $nomor); ?>" target="_blank">
                                <?= htmlspecialchars($nomor); ?>
                            </a>
                        </td>
                        <td>
                            <select class="form-select update-status" data-id="<?= $id ?>">
                                <?php foreach ($statusOptions as $option): ?>
                                    <option value="<?= $option ?>" <?= ($row['status'] == $option) ? "selected" : "" ?>>
                                        <?= ucfirst($option) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control update-solusi" 
                                   data-id="<?= $id ?>" 
                                   value="<?= htmlspecialchars($row['solusi']) ?>">
                        </td>
                    </tr>
                    <tr class="expand-row" id="expand-<?= $id ?>" style="display: none;">
                        <td colspan="6">
                            <strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($row['deskripsi'])) ?><br>
                            <strong>Berkas:</strong> 
                            <?php if (!empty($row['berkas'])): ?>
                                <a href="<?= htmlspecialchars($row['berkas']) ?>" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat Berkas
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Tidak ada berkas</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="logout.php" class="btn btn-danger">Logout</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const csrfToken = "<?= $_SESSION['csrf_token'] ?? '' ?>";

            // Toggle row
            document.querySelectorAll(".toggle-row").forEach(el => {
                el.addEventListener("click", function (e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const expandRow = document.getElementById(`expand-${id}`);
                    expandRow.style.display = expandRow.style.display === "none" ? "table-row" : "none";
                });
            });

         // Fungsi untuk menampilkan notifikasi SweetAlert sebagai toast
const showNotification = (type, message) => {
    Swal.fire({
        position: 'top-end',  // Menampilkan di kanan atas
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 1500,
        toast: true  // Aktifkan mode toast kecil
    });
};

// Update status
document.querySelectorAll(".update-status").forEach(el => {
    el.addEventListener("change", function () {
        const id = this.dataset.id;
        const status = this.value;

        fetch("../pages/update_status.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                id: id,
                status: status,
                csrf_token: csrfToken
            })
        })
        .then(response => response.json())
        .then(data => {
            showNotification(data.success ? 'success' : 'error', data.success ? 'Status berhasil diupdate' : 'Gagal memperbarui status');
        })
        .catch(error => {
            console.error("Kesalahan:", error);
            showNotification('error', 'Terjadi kesalahan pada server');
        });
    });
});

// Update solusi
document.querySelectorAll(".update-solusi").forEach(el => {
    el.addEventListener("blur", function () {
        const id = this.dataset.id;
        const solusi = this.value;

        fetch("../pages/update_solusi.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                id: id,
                solusi: solusi,
                csrf_token: csrfToken
            })
        })
        .then(response => response.json())
        .then(data => {
            showNotification(data.success ? 'success' : 'error', data.success ? 'Solusi berhasil diupdate' : 'Gagal memperbarui solusi');
        })
        .catch(error => {
            console.error("Kesalahan:", error);
            showNotification('error', 'Terjadi kesalahan pada server');
        });
    });
});

        });
    </script>