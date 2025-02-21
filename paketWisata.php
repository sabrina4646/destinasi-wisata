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
                    $query = "SELECT * FROM paket_wisata";
                    $result = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <img src="gambar/<?= $data['img'] ?>" class="card-img-top" alt="..." height="180">
                                <div class="card-body">
                                    <a href="paketWisataDetail.php?id=<?= $data['id'] ?>">
                                        <h6 class="card-title"><?= $data['nama_paket'] ?></h6>
                                    </a>
                                    <p class="card-text text-muted"><?= (strlen($data['deskripsi']) > 50) ? substr($data['deskripsi'], 0, 50) . '...' : $data['deskripsi']; ?></p>
                                    <a href="pemesanan.php" class="btn btn-sm btn-primary">Pesan Sekarang</a>
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