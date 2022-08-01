<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahkategori = mysqli_num_rows($queryKategori);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $jumlahproduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>

    .summary-kategory{
        background-color: #CCD6A6;
        border-radius: 25px;
    }

    .summary-produk{
        background-color: #AEDBCE;
        border-radius: 25px;
    }

    .no-decoration{
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house"></i>Home
                </li>
            </ol>
        </nav>
        <h2>Halo, <?php echo $_SESSION['username']?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="summary-kategory shadow p-5">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-align-left fa-7x"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahkategori; ?> kategori</p>
                                <p><a href="kategori.php" class="no-decoration">lihat detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 ">
                    <div class="summary-produk shadow p-5">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-box fa-7x"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo $jumlahproduk; ?> produk</p>
                                <p><a href="produk.php" class="no-decoration">lihat detail</a></p>
                            </div>
                            </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>