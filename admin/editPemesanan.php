<?php
include "komponen/session.php";
include "komponen/header.php";
$conn = include "../connection.php";
$pemesanan_id = base64_decode($_GET['id']);
$query = "SELECT * FROM pemesanan WHERE id='" . $pemesanan_id . "'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<div class="container-fluid">
    <div class="row">

        <?= include "komponen/nav.php" ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Pemesanan</h1>
            </div>
            <?php include "komponen/alert.php" ?>
            <form action="komponen/data/updatePemesanan.php" method="post">

                <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                <input type="hidden" name="pemesanan_id" value="<?= $data['id'] ?>">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="row mb-2">
                            <label for="" class="col-lg-4">Nama Pemesanan</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="" class="col-lg-4">Nomor Telp/HP</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" maxlength="15" name="no_hp" value="<?= $data['no_hp'] ?>" required readonly>
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
                                    while ($data_paket = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    ?>
                                        <option value="<?= $data_paket['id'] ?>" <?=$data['paket_wisata_id'] == $data_paket['id'] ? "selected":"" ?>><?= $data_paket['nama_paket'] . " - " . $data_paket['obyek_wisata'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="label col-lg-4">Untuk Tanggal</label>
                            <div class="col-lg-4">
                                <input type="date" name="tanggal" id="" class="form-control" value="<?=$data['tanggal']?>" required>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <label for="" class="col-lg-4">Durasi Pelaksanaan Perjalanan</label>
                            <div class="col-lg-2">
                                <input type="number" min=1 class="form-control" name="durasi" value="<?=$data['durasi']?>" id="hari" required>
                            </div>
                            <label for="" class="col-lg-2">Hari</label>
                        </div>
                        <div class="row mb-2">
                            <label for="" class="col-lg-4">Jumlah Peserta</label>
                            <div class="col-lg-2">
                                <input type="number" min=1 class="form-control" value="<?=$data['jml_peserta']?>" name="jml_peserta" id="jmlPeserta" required>
                            </div>
                            <label for="" class="col-lg-2">Orang</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="diskon" id="diskon" readonly value="<?=$data['diskon']?>">
                            </div>
                            <label for="" class="col-lg-2">Diskon: <span id="stringDiskon"></span>%</label>
                        </div>
                        <div class="row mb-2">
                            <label for="" class="form-label col-lg-4">Pelayanan Paket Perjalanan</label>
                            <div class="form-check col-lg-2">
                                <input type="checkbox" name="fasilitas[]" id="fasInap" value="penginapan" class="form-check-input" <?=$data['fas_inap'] == true ? "checked":""?>>
                                <label for="" class="form-check-label">Penginapan</label>
                            </div>
                            <div class="form-check col-lg-2">
                                <input type="checkbox" name="fasilitas[]" id="fasTrans" value="transportasi" class="form-check-input" <?=$data['fas_trans'] == true ? "checked":""?>>
                                <label for="" class="form-check-label">Transportasi</label>
                            </div>
                            <div class="form-check col-lg-2">
                                <input type="checkbox" name="fasilitas[]" id="fasMakan" value="makan" class="form-check-input" <?=$data['fas_makan'] == true ? "checked":""?>>
                                <label for="" class="form-check-label">Makan</label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="" class="from-label col-lg-4">Harga Paket Perjalanan</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="hargaPaket" readonly value="<?=$data['harga_paket']?>">
                                <input type="hidden" name="harga_paket" id="harga_paket" value="<?=$data['harga_paket']?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="" class="from-label col-lg-4">Jumlah Tagihan</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="jmlTagihan" readonly value="<?=$data['jml_tagihan']?>">
                                <input type="hidden" name="jml_tagihan" id="jml_tagihan" value="<?=$data['jml_tagihan']?>"> 
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        
                        <div class="float-end">
                            <a href="index.php" class="btn btn-danger me-2">Batal</a>
                            <button type="reset" class="btn btn-danger me-2">Reset</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
<?php include "komponen/footer.php"; ?>
<script src="../assets/js/jquery-3.7.1.min.js.js"></script>
<script>
    let hargaTiket = 0;
    let hargaFasInap = 0;
    let hargaFasTrans = 0;
    let hargaFasMakan = 0;
    let diskon = 0;
    $("#paketWisata").change(() => {
        let id = $("#paketWisata").val();
        $.ajax({
            url: "../komponen/data/paketWisata.php",
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
    $(()=>{
        $("#paketWisata").trigger("change");
    })
</script>
</body>

</html>