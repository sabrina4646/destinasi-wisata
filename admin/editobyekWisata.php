<?php
include "komponen/session.php";
include "komponen/header.php";
$conn = include "../connection.php";
$obyek_wisata_id = base64_decode($_GET['id']);
$query = "SELECT * FROM obyek_wisata WHERE id='" . $obyek_wisata_id . "'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Obyek Wisata</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php include "komponen/alert.php" ?>
                    <form action="komponen/data/updateObyekWisata.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="obyek_wisata_id" value="<?=$data['id']?>">
                        <input type="hidden" name="nama_gambar" value="<?=$data['img']?>">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Nama Obyek Wisata</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$data['nama']?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea name="alamat" id="" class="form-control" rows="3" required><?=$data['alamat']?></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="" class="form-control" rows="5" required><?=$data['deskripsi']?></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" name="img" id="" class="form-control">
                                    </div>
                                    <div class="float-end">
                                        <button class="btn btn-danger" type="reset">Reset</button>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img src="../gambar/<?=$data['img']?>" alt="" width="400" height="400" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "komponen/footer.php"; ?>

</body>

</html>