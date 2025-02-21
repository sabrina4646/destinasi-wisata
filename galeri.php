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
                    $query = "SELECT * FROM galeri";
                    $result = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <img src="gambar/<?= $data['img'] ?>" class="card-img-top" alt="..." height="180">
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