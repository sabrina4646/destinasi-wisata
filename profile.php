<?php
include "komponen/header.php";
?>
<main>
    <section class="container py-3">
        <div class="row">
            <div class="col-lg-3">
                <form action="komponen/data/updateProfile.php" method="post">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title  text-center">Profile</h5>
                            <?php include "admin/komponen/alert.php"; ?>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Nama</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $_SESSION['nama'] ?>" required disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">No Telp/HP</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" maxlength="15" value="<?= $_SESSION['no_hp'] ?>" required disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Username</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="<?= $_SESSION['username'] ?>" required disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Password</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="password" id="password" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">

                            <div class="float-end">
                                <button type="button" onclick="edit()" id="editBtn" class="btn btn-danger me-2">Edit</button>
                                <button type="button" onclick="batal()" id="batalBtn" class="btn btn-danger me-2" disabled>Batal</button>
                                <button type="submit" id="simpanBtn" class="btn btn-success" disabled>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Data Pesanan</h5>
                        <div class="table-responsive">
                            <?php
                            $conn = include "connection.php";
                            $query = "SELECT * FROM pemesanan;";
                            $result = mysqli_query($conn, $query);
                            $pemesanan = [];
                            $paket_wisata_id = [];
                            while ($data_pemesanan = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $pemesanan[] = $data_pemesanan;
                                $paket_wisata_id[] = $data_pemesanan['paket_wisata_id'];
                            }
                            if (count($pemesanan) != 0) {
                                $query = "SELECT *,(SELECT nama FROM obyek_wisata where id=paket_wisata.obyek_wisata_id) as obyek_wisata FROM paket_wisata where id in (" . implode(",", $paket_wisata_id) . ")";
                                $result = mysqli_query($conn, $query);
                                $paket_wisata = [];
                                while ($data_paket = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $paket_wisata[$data_paket['id']] = $data_paket;
                                }
                            }
                            ?>
                            <table class="table  table-striped table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Paket Wisata</th>
                                        <th>Tujuan</th>
                                        <th>Durasi</th>
                                        <th>Jumlah Peserta</th>
                                        <th>diskon</th>
                                        <th>Fas Inap</th>
                                        <th>Fas Trans</th>
                                        <th>Fas Makan</th>
                                        <th>Harga Paket</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pemesanan as $p) { ?>
                                        <tr>
                                            <td><?= $p['nama'] ?></td>
                                            <td><?= $p['no_hp'] ?></td>
                                            <td><?= $paket_wisata[$p['paket_wisata_id']]['nama_paket'] ?></td>
                                            <td><?= $paket_wisata[$p['paket_wisata_id']]['obyek_wisata'] ?></td>
                                            <td><?= $p['durasi'] ?> Hari</td>
                                            <td><?= $p['jml_peserta'] ?> Orang</td>
                                            <td><?= number_format($p['diskon'],0,",",".") ?></td>
                                            <td><?= $p['fas_inap'] == true ? "Ya" : "Tidak" ?></td>
                                            <td><?= $p['fas_trans'] == true ? "Ya" : "Tidak" ?></td>
                                            <td><?= $p['fas_makan'] == true ? "Ya" : "Tidak" ?></td>
                                            <td><?= number_format($p['harga_paket'], 0, ",", ".") ?></td>
                                            <td><?= number_format($p['jml_tagihan'], 0, ",", ".") ?></td>
                                            <td><?= date("d F Y", strtotime($p['tanggal'])) ?></td>
                                            <td><?= $p['status'] ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>
<script src="assets/js/jquery-3.7.1.min.js.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script>
    $("#table").dataTable();

    function edit() {
        $("#nama").attr("disabled", false);
        $("#no_hp").attr("disabled", false);
        $("#password").attr("disabled", false);
        $("#batalBtn").attr("disabled", false);
        $("#simpanBtn").attr("disabled", false);
        $("#editBtn").toggle("fast");
    }

    function batal() {
        $("#nama").attr("disabled", true);
        $("#no_hp").attr("disabled", true);
        $("#password").attr("disabled", true);
        $("#batalBtn").attr("disabled", true);
        $("#simpanBtn").attr("disabled", true);
        $("#editBtn").toggle("fast");
        $('form').trigger("reset");
    }
</script>
<?php
include "komponen/footer.php";
?>