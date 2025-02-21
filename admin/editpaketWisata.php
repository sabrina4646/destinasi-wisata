<?php
include "komponen/session.php";
include "komponen/header.php";
$conn = include "../connection.php";
$paket_wisata_id = base64_decode($_GET['id']);
$query = "SELECT * FROM paket_wisata WHERE id='" . $paket_wisata_id . "'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Fasilitas Wisata</h1>
            </div>
            <div class="card mb-2">
                <div class="card-body">

                    <?php include "komponen/alert.php" ?>
                    <form action="komponen/data/updatePaketWisata.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="paket_wisata_id" value="<?= $data['id'] ?>">
                        <input type="hidden" name="nama_gambar" value="<?= $data['img'] ?>">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Obyek Wisata</label>
                                    <select name="obyek_wisata_id" id="" class="form-select" required>
                                        <option value="">--Pilih Obyek Wisata--</option>
                                        <?php
                                        $conn = include "../connection.php";
                                        $query = "SELECT id,nama FROM obyek_wisata";
                                        $result = mysqli_query($conn, $query);
                                        while ($data_obyek = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        ?>
                                            <option value="<?= $data_obyek['id'] ?>" <?= ($data['obyek_wisata_id'] == $data_obyek['id']) ? "selected" : "" ?>><?= $data_obyek['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Nama Paket Wisata</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $data['nama_paket'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="" rows="5" required><?= $data['deskripsi'] ?></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Harga Paket</label>
                                    <input type="number" name="harga_paket" min=0 class="form-control" value="<?= $data['harga_paket'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Harga Fasilitas Transport</label>
                                    <input type="number" name="fas_trans" min=0 class="form-control" value="<?= $data['fas_trans'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Harga Fasilitas Inap</label>
                                    <input type="number" name="fas_inap" min=0 class="form-control" value="<?= $data['fas_inap'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Harga Fasilitas Makan</label>
                                    <input type="number" name="fas_makan" min=0 class="form-control" value="<?= $data['fas_makan'] ?>" required>
                                </div>
                                <div class="mb-2">
                                        <label for="" class="form-label">Diskon</label>
                                        <div class="input-group">
                                            <input type="number" name="diskon" min=0 max=100 class="form-control" value="<?=$data['diskon']?>" required>
                                            <span class="input-group-text">%</span>
                                        </div>
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
                                <img src="../gambar/<?= $data['img'] ?>" alt="" width="400" height="400" class="img-thumbnail">
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