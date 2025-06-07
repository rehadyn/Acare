<?php
include 'koneksi.php';
session_start();
require_once 'csrf.php';
ensure_csrf_token();

if (isset($_POST['id']) && isset($_POST['solusi'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        echo json_encode(["success" => false, "error" => "Invalid CSRF token"]);
        exit;
    }
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $solusi = mysqli_real_escape_string($conn, $_POST['solusi']);

    $query = "UPDATE laporan SET solusi = '$solusi' WHERE id_laporan = '$id'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid Request"]);
}
?>
