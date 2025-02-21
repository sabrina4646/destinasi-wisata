<?php
include "komponen/session.php";
include "komponen/header.php";
$conn = include "../connection.php";
$video_id = base64_decode($_GET['id']);
$query = "SELECT * FROM video WHERE id='" . $video_id . "'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Video</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php include "komponen/alert.php" ?>
                    <form action="komponen/data/updatevideo.php" method="post">
                        <input type="hidden" name="video_id" value="<?=$data['id']?>">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Url</label>
                                        <input type="text" name="url" value="<?=$data['url']?>" class="form-control" required>
                                    </div>
                                    <div class="float-end">
                                        <button class="btn btn-danger" type="reset">Reset</button>
                                        <button class="btn btn-primary" type="submit">Update</button>
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