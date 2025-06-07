<?php
include 'koneksi.php';
session_start();
require_once 'csrf.php';
ensure_csrf_token();

header('Content-Type: application/json');

$query = "SELECT * FROM laporan ORDER BY id_laporan DESC";
$result = mysqli_query($conn, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memuat data']);
}
exit;
