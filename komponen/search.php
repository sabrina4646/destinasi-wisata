<div class="col-lg-3 border-start">
    <div class="sticky-top" style="top:2rem;">
        <form action="search.php" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari" name="query" value="<?= $_GET['query'] ??= "" ?>">
                <button class="btn btn-outline-secondary" type="submit" "><i class=" bi bi-search"></i></button>
            </div>

        </form>
        <?php
        $conn = include "connection.php";
        $query = "SELECT * FROM video";
        $result = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>
            <iframe width="100%" height="auto" src="<?=$data['url']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <?php } ?>
    </div>
</div>