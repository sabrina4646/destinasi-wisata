<?php
include "komponen/header.php";
if (isset($_SESSION['username'])) {
    echo "<script>window.location.replace('index.php');</script>";
}
$conn = include "connection.php";
?>
<main>
    <section class="container-fluid py-3">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <form action="komponen/data/simpanRegistrasi.php" method="post">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title  text-center">Registrasi</h2>
                            <?php include "admin/komponen/alert.php"; ?>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Nama</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">No Telp/HP</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="no_hp" maxlength="15" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Username</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Password</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">

                            <div class="float-end">
                                <button type="reset" class="btn btn-danger me-2">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</main>

<?php
include "komponen/footer.php";
?>