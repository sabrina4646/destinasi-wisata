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
                    $query = "SELECT * FROM obyek_wisata where id='" . $id . "'";
                    $result = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <img src="gambar/<?= $data['img'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title"><?= $data['nama'] ?></h6>
                                    <p class="card-text text-muted"><?= $data['deskripsi'] ?></p>
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