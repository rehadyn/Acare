<?php
$host = "localhost";
$user = "reza_ipkh";
$pass = "uknikM2x9wo0";
$db   = "reza_lapor";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    error_log("Koneksi gagal: " . mysqli_connect_error()); // Logging
    exit; // Akhiri eksekusi tanpa output tambahan
}
?>