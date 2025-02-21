<?php
include "komponen/header.php";
$id = $_GET['id'];
?>
<main>
    <section class="container py-3">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    $conn = include "connection.php";
                    $query = "SELECT *, (select nama from obyek_wisata where id=paket_wisata.obyek_wisata_id) as obyek_wisata FROM paket_wisata where id='" . $id . "'";
                    $result = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <img src="gambar/<?= $data['img'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $data['nama_paket'] ?></h5>
                                    <h6 class="card-title"><?= $data['obyek_wisata'] ?></h6>
                                    <p class="card-text text-muted"><?= $data['deskripsi'] ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Harga Paket Perorang : Rp <?= number_format($data['harga_paket'], 0, ',', '.') ?></li>
                                    <li class="list-group-item">Harga Fasilitas Transport : Rp <?= number_format($data['fas_trans'], 0, ',', '.') ?></li>
                                    <li class="list-group-item">Harga Fasilitas Makan : Rp <?= number_format($data['fas_makan'], 0, ',', '.') ?></li>
                                    <li class="list-group-item">Harga Fasilitas Inap : Rp <?= number_format($data['fas_inap'], 0, ',', '.') ?></li>
                                    <li class="list-group-item">Diskon : <?= number_format($data['diskon'], 0, ',', '.') ?>%</li>
                                </ul>
                                <div class="card-body">
                                    <a href="pemesanan.php" class="card-link">Pesan Sekarang!</a>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php include "komponen/search.php" ?>

        </div>

    </section>
</main>
<?php
include "komponen/footer.php";
?>