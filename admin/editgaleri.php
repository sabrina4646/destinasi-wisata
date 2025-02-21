<?php
include "komponen/session.php";
include "komponen/header.php";
$conn = include "../connection.php";
$galeri_id = base64_decode($_GET['id']);
$query = "SELECT * FROM galeri WHERE id='" . $galeri_id . "'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Galeri</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php include "komponen/alert.php" ?>
                    <form action="komponen/data/updateGaleri.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="nama_gambar" value="<?=$data['img']?>">
                        <input type="hidden" name="galeri_id" value="<?=$data['id']?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" name="img" id="" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="" class="form-control" rows="5" required><?=$data['deskripsi']?></textarea>
                                </div>
                                <div class="float-end">
                                    <button class="btn btn-danger" type="reset">Reset</button>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="../gambar/<?=$data['img']?>" class="img-thumbnail" width="400" height="400" alt="">
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