<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['id'];

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

    <style>
        .no-decoration{
            text-decoration: none;
        }
        form div{
            margin-bottom:10px;
        }
    </style>

<body>
<?php require "navbar.php" ?>

    <div class="container mt-5">
        <h2>Detail produk</h2>
    

        <div class="col-12 col-md-6">
            <form action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>" class="form-control" autocomplete="off" >
                    </div>

                    <div>
                        <label for="kategori">kategori</label>
                        <select name="kategori" id="kategori" class="form-control" >
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                            <?php
                                while($dataKategori=mysqli_fetch_array($queryKategori)){
                            ?>
                                <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" value="<?php echo $data['harga'] ?>" >
                    </div>
                    
                    <div>
                        <label for="currentFoto"> Foto Produk Sekarang</label>
                        <img src="./../images/<?php echo $data['foto'] ?>" alt="" width="300px">
                    </div>

                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                
                    <div>
                        <label for="detail">Detail</label>
                        <textarea type="number" class="form-control" name="detail" id="detail" cols="30" rows="10" > <?php echo $data['detail'] ?></textarea>
                    </div>

                    <div>
                        <label for="ketersediaan_stok">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="<?php $data ['ketersediaan_stok'] ?>"><?php echo $data ['ketersediaan_stok'] ?></option>
                            <?php
                                if($data['ketersediaan_stok']=='tersedia'){
                            ?>
                                    <option value="habis">habis</option>
                            <?php
                                }
                                else{
                            ?>
                                    <option value="habis">tersedia</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="simpan">Update</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                    </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                        $target_dir = "../images/";
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $image_size = $_FILES["foto"]["size"];
                        $random_name = generateRandomString();
                        $new_name = $random_name . "." . $imageFileType;

                        if($nama=='' || $kategori=='' || $harga==''){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                        Nama, Kategori dan Harga wajib diisi !!
                        </div>
            <?php
                        }
                        else{
                            $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori',
                            nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");

                            if($nama_file!=''){
                                if($image_size > 1000000){
            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File upload maksimal 1mb !!
                            </div>
            <?php
                                }
                                else{
                                    if($imageFileType != 'jpg' && $imageFileType != 'png'){
            ?>
                                                <div class="alert alert-warning mt-3" role="alert">
                                                    Tipe File wajib .jpg atau .png
                                                </div>
            <?php
                                }
                                else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                    $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                                    if($queryUpdate){
            ?>
                                    <div class="alert alert-primary mt-3" role="alert">
                                        Produk Berhasil Di Update
                                    </div>

                                    <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                                    }
                                    else{
                                        echo mysqli_error($con);
                                    }
                                }
                            }
                        }
                    }
                }

                if(isset($_POST['hapus'])){
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Produk Berhasil Di Hapus 
                            </div>

                            <meta http-equiv="refresh" content="1; url=produk.php" />
        <?php
                }
                else{
                    echo mysqli_error($con);
                }

            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>