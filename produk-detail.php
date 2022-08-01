<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unas Mart | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php" ?>

    <div class="container-fluid banner-detail d-flex align-items-center ">
        <div class="container">
            <h1 class="text-white text-center">Detail Produk</h1>
        </div>
    </div>

    <!-- detail produk -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <img src="images/<?php echo $produk['foto'] ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama'] ?></h1>
                    <p class="fs-5">
                    <?php echo $produk['detail'] ?>
                    </p>
                    <p class="text-harga">
                        Rp. <?php echo $produk['harga'] ?>
                    </p>
                    <p class="fs-5"> Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok'] ?></strong></p>
                </div>
            </div>
        </div>
    </div>

        <?php require "footer.php" ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>