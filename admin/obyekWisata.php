<?php
include "komponen/session.php";
include "komponen/header.php";
?>
<link rel="stylesheet" href="../assets/css/datatables.min.css">
<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Obyek Wisata</h1>

            </div>
            <div class="card">
                <div class="card-body">
                    <?php include "komponen/alert.php";?>
                    <a href="tambahobyekWisata.php" class="btn btn-primary">Tambah Obyek Wisata</a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Gambar</th>
                                    <th>act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = include "../connection.php";
                                $query = "SELECT * FROM obyek_wisata";
                                $reuslt = mysqli_query($conn, $query);
                                while ($data = mysqli_fetch_array($reuslt, MYSQLI_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?=$data['nama']?></td>
                                    <td><?=$data['alamat']?></td>
                                    <td><img src="../gambar/<?=$data['img']?>" alt="" width="100" height="100"></td>
                                    <td>
                                        <div class="col-auto">
                                            <form action="komponen/data/hapus.php" method="post">
                                                <input type="hidden" name="id" value="<?=$data['id']?>">
                                                <input type="hidden" name="table" value="obyek_wisata">
                                                <a href="editobyekWisata.php?id=<?=base64_encode($data['id'])?>" class="btn btn-success btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "komponen/footer.php"; ?>
<script src="../assets/js/jquery-3.7.1.min.js.js"></script>
<script src="../assets/js/datatables.min.js"></script>
<script>
    $("#table").dataTable()
</script>

</body>

</html>