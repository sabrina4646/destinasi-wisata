<?php
include "komponen/header.php";
$q = $_GET['query'];
?>
<main>
    <section class="container py-3">
        <div class="row">
            <div class="col-lg-9">
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h3 class="pb-4 mb-4 fst-italic border-bottom">
                            Obyek Wisata
                        </h3>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <?php
                        $conn = include "connection.php";
                        $query = "SELECT * FROM obyek_wisata where nama like '%" . $q . "%'";
                        $result = mysqli_query($conn, $query);
                        while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                            <a href="obyekWisataDetail.php?id=<?= $data['id'] ?>">
                                <h2><?= $data['nama'] ?></h2>
                            </a>
                            <p><?= (strlen($data['deskripsi']) > 50) ? substr($data['deskripsi'], 0, 50) . '...' : $data['deskripsi']; ?></p>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h3 class="pb-4 mb-4 fst-italic border-bottom">
                            Paket Wisata
                        </h3>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <?php
                        $query = "SELECT * From paket_wisata where nama_paket like '%" . $q . "%'";
                        $result = mysqli_query($conn, $query);
                        while ($paket = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                            <a href="paketWisataDetail.php?id=<?= $paket['id'] ?>">
                                <h2><?= $paket['nama_paket'] ?></h2>
                            </a>
                            <p><?= (strlen($paket['deskripsi']) > 50) ? substr($paket['deskripsi'], 0, 50) . '...' : $paket['deskripsi']; ?></p>
                            <hr>
                        <?php } ?>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h3 class="pb-4 mb-4 fst-italic border-bottom">
                            Fasilitas Wisata
                        </h3>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <?php
                        $query = "SELECT *,(select nama from obyek_wisata where id = fasilitas_wisata.obyek_wisata_id) as obyek_wisata From fasilitas_wisata where nama like '%" . $q . "%'";
                        $result = mysqli_query($conn, $query);
                        while ($fasilitas = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                            <h2><?= $fasilitas['nama'] ?> - <?= $fasilitas['obyek_wisata'] ?></h2>
                            <p><?= (strlen($fasilitas['deskripsi']) > 50) ? substr($fasilitas['deskripsi'], 0, 50) . '...' : $fasilitas['deskripsi']; ?></p>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php include "komponen/search.php" ?>
            
        </div>


    </section>
</main>
<?php
include "komponen/footer.php";
?>