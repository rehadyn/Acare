<?php
// navbar.php

function show_navbar()
{
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php?page=home">AkademikCare</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=daftar">Buat Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin">Admin?</a>
                    </li>
 
                    <li class="nav-item"><a class="nav-link" href="index.php?page=login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}
