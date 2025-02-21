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
                <h1 class="h2">Dashboard Data Pemesanan</h1>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                $conn = include "../connection.php";
                                $query = "SELECT * FROM pemesanan;";
                                $result = mysqli_query($conn, $query);
                                $pemesanan = [];
                                $paket_wisata_id = [];
                                while ($data_pemesanan = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $pemesanan[] = $data_pemesanan;
                                    $paket_wisata_id[] = $data_pemesanan['paket_wisata_id'];
                                }
                                $query = "SELECT *,(SELECT nama FROM obyek_wisata where id=paket_wisata.obyek_wisata_id) as obyek_wisata FROM paket_wisata where id in (" . implode(",", $paket_wisata_id) . ")";
                                $result = mysqli_query($conn, $query);
                                $paket_wisata = [];
                                while ($data_paket = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $paket_wisata[$data_paket['id']] = $data_paket;
                                }
                                ?>
                                <table class="table table-striped table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Nama</th>
                                            <th rowspan="2">No HP</th>
                                            <th rowspan="2">Paket Wisata</th>
                                            <th rowspan="2">Tujuan</th>
                                            <th rowspan="2">Durasi</th>
                                            <th rowspan="2">Jumlah Peserta</th>
                                            <th rowspan="2">diskon</th>
                                            <th rowspan="2">Fas Inap</th>
                                            <th rowspan="2">Fas Trans</th>
                                            <th rowspan="2">Fas Makan</th>
                                            <th rowspan="2">Harga Paket</th>
                                            <th rowspan="2">Jumlah Tagihan</th>
                                            <th rowspan="2">Tanggal</th>
                                            <th rowspan="2">Status</th>
                                            <th colspan="3">Act</th>
                                        </tr>
                                        <tr>
                                            <td>Proses</td>
                                            <td>Edit</td>
                                            <td>Hapus</td>
                                        </tr>
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
                                                <td>
                                                    <form action="komponen/data/updateStatusPemesanan.php" method="post">
                                                        <?php
                                                        $status = "";
                                                        switch ($p['status']) {
                                                            case "Belum Diproses":
                                                                $status = "Proses";
                                                                break;
                                                            case "Proses":
                                                                $status = "Selesai";
                                                                break;
                                                            default:
                                                                $status = "";
                                                                break;
                                                        }
                                                        ?>
                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                        <input type="hidden" name="status" value="<?= $status ?>">
                                                        <?php if ($p['status'] != "Selesai") { ?>
                                                            <button class="btn btn-primary btn-sm" onclick="return confirm('Yakin akan <?= $status == 'Selesai' ? $status . 'kan' : $status ?> data ini?')"><?= $status == "Selesai" ? $status . "kan" : $status ?></button>
                                                        <?php } else { ?>
                                                            <span class="btn btn-sm btn-success"><i class="bi bi-check2-square"></i></span>
                                                        <?php } ?>
                                                    </form>

                                                </td>
                                                <td>
                                                    <a href="editPemesanan.php?id=<?= base64_encode($p['id']) ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>

                                                </td>
                                                <td>
                                                    <form action="komponen/data/hapus.php" method="post">
                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                        <input type="hidden" name="table" value="pemesanan">
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="bi bi-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    $("#table").dataTable({
        columnDefs: [{
            orderable: false,
            target: [14, 15, 16]
        }],
        order: [13, 'asc']
    })
</script>
</body>

</html>