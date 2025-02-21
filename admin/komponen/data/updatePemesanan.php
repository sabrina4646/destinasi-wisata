<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $conn = include "../../../connection.php";
    $nama = $_POST['nama'];
    $user_id = $_POST['user_id'];
    $pemesanan_id = $_POST['pemesanan_id'];
    $no_hp = $_POST['no_hp'];
    $paket_wisata_id = $_POST['paket_wisata_id'];
    $tanggal = $_POST['tanggal'];
    $durasi = $_POST['durasi'];
    $jml_peserta = $_POST['jml_peserta'];
    $harga_paket = $_POST['harga_paket'];
    $jml_tagihan = $_POST['jml_tagihan'];
    $diskon = $_POST['diskon'];
    $fas_inap = 0;
    $fas_trans = 0;
    $fas_makan = 0;
    foreach ($_POST['fasilitas'] as $fasilitas) {
        switch ($fasilitas) {
            case "penginapan":
                $fas_inap = true;
                break;
            case "transportasi":
                $fas_trans = true;
                break;
            case "makan":
                $fas_makan = true;
                break;
            default:
                "";
                break;
        }
    }
    $query = "UPDATE  pemesanan SET nama='" . $nama . "',user_id='" . $user_id . "',no_hp='" . $no_hp . "',paket_wisata_id='" . $paket_wisata_id . "',tanggal='" . $tanggal . "',durasi='" . $durasi . "',jml_peserta='" . $jml_peserta . "',jml_tagihan=" . $jml_tagihan . ",fas_inap=" . $fas_inap . ",fas_trans=" . $fas_trans . ",fas_makan=" . $fas_makan . ",harga_paket='" . $harga_paket . "',diskon='" . $diskon . "' WHERE id='" . $pemesanan_id . "'";
    $result = mysqli_query($conn,$query);
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil diubah";
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "data gagal diubah";
    }
}
echo "<script>window.location.replace('".$_SERVER['HTTP_REFERER']."');</script>";