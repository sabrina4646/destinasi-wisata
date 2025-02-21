<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = include "../../connection.php";
    $nama = $_POST['nama'];
    $user_id = $_POST['user_id'];
    $no_hp = $_POST['no_hp'];
    $paket_wisata_id = $_POST['paket_wisata_id'];
    $tanggal = $_POST['tanggal'];
    $durasi = $_POST['durasi'];
    $jml_peserta = $_POST['jml_peserta'];
    $harga_paket = $_POST['harga_paket'];
    $jml_tagihan = $_POST['jml_tagihan'];
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
    $query = "INSERT INTO pemesanan (nama,user_id,no_hp,paket_wisata_id,tanggal,durasi,jml_peserta,jml_tagihan,fas_inap,fas_trans,fas_makan,harga_paket,diskon,status) VALUES ('" . $nama . "','" . $user_id . "','" . $no_hp . "','" . $paket_wisata_id . "','" . $tanggal . "','" . $durasi . "','" . $jml_peserta . "'," . $jml_tagihan . "," . $fas_inap . "," . $fas_trans . "," . $fas_makan . ",'" . $harga_paket . "','" . $diskon . "','Belum Diproses');";
    $result = mysqli_query($conn,$query);

    if ($result) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Berhasil melakukan pemesanan";

        $query_pemesanan = "SELECT * FROM pemesanan where user_id=" . $user_id . " order by id desc limit 1";
        $result_pemesanan = mysqli_query($conn, $query_pemesanan);
        $pemesanan = mysqli_fetch_array($result_pemesanan, MYSQLI_ASSOC);
        $_SESSION['reservasi']['pemesanan'] = $pemesanan;

        $query_paket_wisata = "SELECT id,nama_paket,(select nama from obyek_wisata where id=paket_wisata.obyek_wisata_id) as nama_obyek_wisata FROM paket_wisata where id=" . $pemesanan['paket_wisata_id'];
        $result_paket_wisata = mysqli_query($conn, $query_paket_wisata);
        $paket_wisata = mysqli_fetch_array($result_paket_wisata, MYSQLI_ASSOC);
        $_SESSION['reservasi']['paket_wisata'] = $paket_wisata;

    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "Gagal melakukan pemesanan";
    }
}

echo "<script>window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
