<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login.php jika belum login
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .expand-row td {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .toggle-row {
            cursor: pointer;
            color: #0d6efd;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include '../navigasi.php'; ?>
    
    <div class="container mt-4">
        <h2>Daftar Laporan</h2>
        
        <!-- Notifikasi Session -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?= $_SESSION['flash_type'] ?>">
                <?= $_SESSION['flash_message'] ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
						<th>Kode Laporan</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                        <th>Solusi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM laporan ORDER BY id_laporan DESC";
                    $result = mysqli_query($conn, $query);
                    
                    if (!$result) {
                        die("Error: " . mysqli_error($conn));
                    }

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id_laporan'];
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                      	<td><?= htmlspecialchars($row['kode_laporan']) ?></td>
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
                                <option value="Permintaan" <?= ($row['status'] == "Permintaan") ? "selected" : "" ?>>Permintaan</option>
                                <option value="Progres" <?= ($row['status'] == "Progres") ? "selected" : "" ?>>Progres</option>
                                <option value="Selesai" <?= ($row['status'] == "Selesai") ? "selected" : "" ?>>Selesai</option>
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
                                <a href="<?= $row['berkas'] ?>" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat Berkas
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Tidak ada berkas</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  <a href="logout.php" class="btn btn-danger">Logout</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const csrfToken = "<?= $_SESSION['csrf_token'] ?>";

            // Fungsi untuk handle AJAX errors
            function handleError(error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan pada server',
                });
            }

            // Toggle row
            document.querySelectorAll(".toggle-row").forEach(el => {
                el.addEventListener("click", function (e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const expandRow = document.getElementById(`expand-${id}`);
                    expandRow.style.display = expandRow.style.display === "none" ? "table-row" : "none";
                });
            });

            // Update status
            document.querySelectorAll(".update-status").forEach(el => {
                el.addEventListener("change", function () {
                    const id = this.dataset.id;
                    const status = this.value;

                    fetch("../pages/update_status.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: new URLSearchParams({
                            id: id,
                            status: status,
                            csrf_token: csrfToken
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error(response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Status berhasil diupdate',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            throw new Error(data.error || 'Unknown error');
                        }
                    })
                    .catch(handleError);
                });
            });

            // Update solusi
            document.querySelectorAll(".update-solusi").forEach(el => {
                el.addEventListener("blur", function () {
                    const id = this.dataset.id;
                    const solusi = this.value;

                    fetch("../pages/update_solusi.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: new URLSearchParams({
                            id: id,
                            solusi: solusi,
                            csrf_token: csrfToken
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error(response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Solusi berhasil diupdate',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            throw new Error(data.error || 'Unknown error');
                        }
                    })
                    .catch(handleError);
                });
            });
        });
    </script>
</body>
</html>