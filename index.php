<?php
// index.php (router utama)

// Mulai session di awal sebelum include file lain
session_start();
require_once 'csrf.php';
ensure_csrf_token();


include 'layout.php';
include 'navbar.php';

layout_head("Website Lapor (Router)");
show_navbar();

// Siapkan kontainer
echo '<div class="container content-wrapper">';

// Tentukan page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
  case 'home':
    include 'pages/home.php';
    break;

  case 'daftar':
    include 'pages/daftar.php';
    break;

  case 'addlpr':
    include 'pages/add.php';
    break;

  case 'admin':
    include 'pages/admin.php';
    break;

  case 'login':
    include 'pages/login.php';
    break;
  
   case 'updatesolusi':
    include 'pages/update_solusi.php';
    break;
  
   case 'updatestatus':
    include 'pages/update_status.php';
    break;

  default:
    // Halaman tidak dikenali => 404
    echo "<h2>Halaman tidak ditemukan!</h2>";
    break;
}

echo '</div>'; // tutup .content-wrapper

// Sertakan script & foot
include 'sc.php';
layout_foot();
