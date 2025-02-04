<?php
// layout.php

function layout_head($title = "Academicare")
{
?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($title) ?></title>

        <!-- jQuery -->
        <script
            src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

        <!-- jsGrid -->
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            /* Agar konten tidak tertutup navbar fixed-top */
            .content-wrapper {
                margin-top: 70px;
                margin-bottom: 70px;
            }

            /* Status label styling */
            .status-permintaan {
                color: white;
                background-color: #007bff;
                padding: 4px 8px;
                border-radius: 4px;
                text-transform: capitalize;
            }

            .status-proses {
                color: #212529;
                background-color: #ffc107;
                padding: 4px 8px;
                border-radius: 4px;
                text-transform: capitalize;
            }

            .status-selesai {
                color: white;
                background-color: #28a745;
                padding: 4px 8px;
                border-radius: 4px;
                text-transform: capitalize;
            }

            /* Agar footer selalu di bawah */
            html {
                height: 100%;
            }

            body {
                display: flex;
                flex-direction: column;
                min-height: 100%;
                margin: 0;
            }

            .content-wrapper {
                flex: 1;
            }

            footer {
                text-align: center;
                padding: 10px;
                background-color: #f8f9fa;
                border-top: 1px solid #dee2e6;
            }
                  .expand-row td {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .toggle-row {
            cursor: pointer;
            color: #0d6efd;
            text-decoration: underline;
        }
/* Sembunyikan baris deskripsi secara default */
.expandable-body {
    display: none; /* Mulai dalam kondisi tersembunyi */
}

/* Saat baris utama diperluas, deskripsi muncul */
tr[aria-expanded="true"] + .expandable-body {
    display: table-row; /* Munculkan baris deskripsi */
}
 
        </style>


    </head>

    <body>
    <?php
}

function layout_foot()
{
    ?>
        <!-- Footer -->
        <footer>
            <p>Create with ❤️ SpecEd TechHub. Reza Hadiwijaya Dynasti | 2024</p>
        </footer>
    </body>

    </html>
<?php
}
