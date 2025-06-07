<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        echo json_encode(["success" => false, "error" => "Invalid CSRF token"]);
        exit;
    }
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $query = "UPDATE laporan SET status = '$status' WHERE id_laporan = '$id'";
        if (mysqli_query($conn, $query)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Data POST tidak lengkap"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Metode request tidak valid"]);
}
?>