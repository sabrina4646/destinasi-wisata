<?php
include "komponen/header.php";
?>
<main>
    <section class="container py-3">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    $conn = include "connection.php";
                    $query = "SELECT *,(select nama from obyek_wisata where id = fasilitas_wisata.obyek_wisata_id) as obyek_wisata FROM fasilitas_wisata";
                    $result = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <img src="gambar/<?= $data['img'] ?>" class="card-img-top" alt="..." height="180">
                                <div class="card-body">
                                    <h6 class="card-title"><?= $data['nama'] ?> - <?= $data['obyek_wisata'] ?></h6>
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