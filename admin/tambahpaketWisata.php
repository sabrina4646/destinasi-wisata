<?php
include "komponen/session.php";
include "komponen/header.php";
?>

<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tambah Fasilitas Wisata</h1>
            </div>
            <div class="card mb-2">
                <div class="card-body">

                    <?php include "komponen/alert.php" ?>

                    <form action="komponen/data/simpanPaketWisata.php" method="post" enctype="multipart/form-data">
                        <div class="accordion-body">
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
                                            while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            ?>
                                                <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Nama Paket Wisata</label>
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" id="" rows="5" required></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Harga Paket</label>
                                        <input type="number" name="harga_paket" min=0 class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Harga Fasilitas Transport</label>
                                        <input type="number" name="fas_trans" min=0 class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Harga Fasilitas Inap</label>
                                        <input type="number" name="fas_inap" min=0 class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Harga Fasilitas Makan</label>
                                        <input type="number" name="fas_makan" min=0 class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Diskon</label>
                                        <div class="input-group">
                                            <input type="number" name="diskon" min=0 max=100 class="form-control" required>
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" name="img" id="" class="form-control" required>
                                    </div>
                                    <div class="float-end">
                                        <button class="btn btn-danger" type="reset">Reset</button>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
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