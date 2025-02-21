<?php
include "komponen/header.php";
if (!isset($_SESSION['username'])) {
    echo "<script>window.location.replace('login.php');</script>";
}
$conn = include "connection.php";
?>
<main>
    <section class="container-fluid py-3">
        <div class="row">
            <?php
            if (isset($_SESSION['reservasi'])) { ?>
                <div class="row mb-3">
                    <div class="col-lg-6 mx-auto">
                        <?php include "admin/komponen/alert.php"; ?>
                        <div class="card card text-bg-success">
                            <div class="card-header text-uppercase text-center">
                                <h5>Rangkuman reservasi paket wisata</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-light">
                                        <tbody>
                                            <tr>
                                                <td width="50%">Nama</td>
                                                <td>:<?= $_SESSION['reservasi']['pemesanan']['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Paket</td>
                                                <td>:<?= $_SESSION['reservasi']['paket_wisata']['nama_paket'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Tujuan</td>
                                                <td>:<?= $_SESSION['reservasi']['paket_wisata']['nama_obyek_wisata'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Untuk Tanggal</td>
                                                <td>:<?= date("d F Y", strtotime($_SESSION['reservasi']['pemesanan']['tanggal'])) ?></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Jumlah Peserta</td>
                                                <td>:<?= $_SESSION['reservasi']['pemesanan']['jml_peserta'] ?> Orang</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Waktu Perjalanan</td>
                                                <td>:<?= $_SESSION['reservasi']['pemesanan']['durasi'] ?> Hari</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Layanan Paket</td>
                                                <td>:
                                                    <?= ($_SESSION['reservasi']['pemesanan']['fas_inap'] == true) ? "Penginapan," : "" ?>
                                                    <?= ($_SESSION['reservasi']['pemesanan']['fas_trans'] == true) ? "Transportasi," : "" ?>
                                                    <?= ($_SESSION['reservasi']['pemesanan']['fas_makan'] == true) ? "Makanan" : "" ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Dsikon</td>
                                                <td>:Rp <?= number_format($_SESSION['reservasi']['pemesanan']['diskon'], 0, ",", ".") ?></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Harga Paket</td>
                                                <td>:Rp <?= number_format($_SESSION['reservasi']['pemesanan']['harga_paket'], 0, ",", ".") ?></td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Jumlah Tagihan</td>
                                                <td>:Rp <?= number_format($_SESSION['reservasi']['pemesanan']['jml_tagihan'], 0, ",", ".") ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 mx-auto">
                        <div class="card card text-bg-success">
                            <div class="card-body">
                                <h6 class="card-title text-center">Pesan Lagi ?</h6>
                                <a href="pemesanan.php" class="btn btn-secondary float-start col-lg-5 m-1">Ya</a>
                                <a href="index.php" class="btn btn-danger float-end col-lg-5 m-1">Tidak</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                unset($_SESSION['reservasi']);
            } else { ?>
                <div class="col-lg-8 mx-auto">
                    <form action="komponen/data/simpanPesanan.php" method="post">

                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title  text-center">Pemesanan Paket Wisata</h2>

                                <div class="row mb-2">
                                    <label for="" class="col-lg-4">Nama Pemesanan</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="nama" value="<?= $_SESSION['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="col-lg-4">Nomor Telp/HP</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" maxlength="15" name="no_hp" value="<?= $_SESSION['no_hp'] ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="col-lg-4">Paket Wisata</label>
                                    <div class="col-lg-8">
                                        <select name="paket_wisata_id" id="paketWisata" class="form-select">
                                            <option value="">-- Pilih Paket Wisata--</option>
                                            <?php
                                            $query = "SELECT id,nama_paket,(SELECT nama FROM obyek_wisata WHERE id=paket_wisata.obyek_wisata_id) as obyek_wisata FROM paket_wisata";
                                            $result = mysqli_query($conn, $query);
                                            while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            ?>
                                                <option value="<?= $data['id'] ?>"><?= $data['nama_paket'] . " - " . $data['obyek_wisata'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="label col-lg-4">Untuk Tanggal</label>
                                    <div class="col-lg-4">
                                        <input type="date" name="tanggal" id="" class="form-control" required>
                                    </div>

                                </div>
                                <div class="row mb-2">
                                    <label for="" class="col-lg-4">Durasi Pelaksanaan Perjalanan</label>
                                    <div class="col-lg-2">
                                        <input type="number" min=1 class="form-control" name="durasi" value="1" id="hari" required>
                                    </div>
                                    <label for="" class="col-lg-2">Hari</label>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="col-lg-4">Jumlah Peserta</label>
                                    <div class="col-lg-2">
                                        <input type="number" min=1 class="form-control" value="1" name="jml_peserta" id="jmlPeserta" required>
                                    </div>
                                    <label for="" class="col-lg-2">Orang</label>
                                    <div class="col-lg-2">
                                        <input type="text" name="diskon" id="diskon" class="form-control" readonly>
                                    </div>
                                    <label for="" class="col-lg-2">Diskon: <span id="stringDiskon"></span> %</label>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="form-label col-lg-4">Pelayanan Paket Perjalanan</label>
                                    <div class="form-check col-lg-2">
                                        <input type="checkbox" name="fasilitas[]" id="fasInap" value="penginapan" class="form-check-input">
                                        <label for="" class="form-check-label">Penginapan</label>
                                    </div>
                                    <div class="form-check col-lg-2">
                                        <input type="checkbox" name="fasilitas[]" id="fasTrans" value="transportasi" class="form-check-input">
                                        <label for="" class="form-check-label">Transportasi</label>
                                    </div>
                                    <div class="form-check col-lg-2">
                                        <input type="checkbox" name="fasilitas[]" id="fasMakan" value="makan" class="form-check-input">
                                        <label for="" class="form-check-label">Makan</label>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="from-label col-lg-4">Harga Paket Perjalanan</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" id="hargaPaket" readonly>
                                        <input type="hidden" name="harga_paket" id="harga_paket">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="from-label col-lg-4">Jumlah Tagihan</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" id="jmlTagihan" readonly>
                                        <input type="hidden" name="jml_tagihan" id="jml_tagihan">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-start"><a href="profile.php" class="btn btn-primary">Lihat Pesanan</a></div>
                                <div class="float-end">
                                    <button type="reset" class="btn btn-danger me-2">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>

    </section>
</main>
<script src="assets/js/jquery-3.7.1.min.js.js"></script>
<script>
    let hargaTiket = 0;
    let hargaFasInap = 0;
    let hargaFasTrans = 0;
    let hargaFasMakan = 0;
    let diskon = 0;
    $("#paketWisata").change(() => {
        let id = $("#paketWisata").val();
        $.ajax({
            url: "komponen/data/paketWisata.php",
            type: "post",
            dataType: "json",
            data: {
                obyek_wisata_id: id
            },
            success: (e) => {
                hargaTiket = parseInt(e.harga_paket);
                hargaFasInap = parseInt(e.fas_inap);
                hargaFasMakan = parseInt(e.fas_makan);
                hargaFasTrans = parseInt(e.fas_trans);
                diskon = parseInt(e.diskon);
                hitung();
            }
        })
    })

    hitung = () => {
        let hargaPaket = hargaTiket;
        if ($("#fasInap").is(":checked")) {
            hargaPaket += hargaFasInap;
        }
        if ($("#fasTrans").is(":checked")) {
            hargaPaket += hargaFasTrans;
        }
        if ($("#fasMakan").is(":checked")) {
            hargaPaket += hargaFasMakan;
        }

        let jml_peserta = $("#jmlPeserta").val();
        let hari = $("#hari").val();
        if (jml_peserta == "") {
            jml_peserta = 0;
        }

        if (hari == "") {
            hari = 0;
        }

        let jml_tagihan = jml_peserta * hari * hargaPaket;
        let hargaDiskon = 0;
        if (jml_tagihan >= 1000000) {
            hargaDiskon = jml_tagihan * (diskon / 100);
            jml_tagihan = jml_tagihan - hargaDiskon;
        }
        $("#diskon").val(hargaDiskon);
        $("#jmlTagihan").val(jml_tagihan);
        $("#jml_tagihan").val(jml_tagihan);
        $("#hargaPaket").val(hargaPaket);
        $("#harga_paket").val(hargaPaket);
        $("#stringDiskon").html(diskon);

    }

    $("#jmlPeserta").on("keyup", () => {
        hitung();
    });
    $("#hari").on("keyup", () => {
        hitung();
    });

    $("#fasInap").click(() => {
        hitung();
    })
    $("#fasTrans").click(() => {
        hitung();
    })
    $("#fasMakan").click(() => {
        hitung();
    })
</script>
<?php
include "komponen/footer.php";
?>