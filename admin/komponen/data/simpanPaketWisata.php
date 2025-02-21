<?php
session_start();
// simpan data
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uploadedOK = 1;
    $target_folder = "../../../gambar/";
    $target_name = rand(1, 10000) . date("ymdHis") . ".";
    $target_type = "";

    $nama = $_POST['nama'];
    $obyek_wisata_id = $_POST['obyek_wisata_id'];
    $deskripsi = $_POST['deskripsi'];
    $harga_paket = $_POST['harga_paket'];
    $fas_trans = $_POST['fas_trans'];
    $fas_inap = $_POST['fas_inap'];
    $fas_makan = $_POST['fas_makan'];
    $diskon = $_POST['diskon'];

    if ($_FILES['img']['error'] == 0) {
        $target_type = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['img']['tmp_name']);
        if ($check !== false) {
            $uploadedOK = 1;
        } else {
            $uploadedOK = 0;
            $_SESSION['alert'] = "danger";
            $_SESSION['message']= "File bukan image";
        }

        $target_file = $target_folder . $target_name . $target_type;
        if (file_exists($target_file)) {
            $uploadedOK = 0;
            $_SESSION['alert'] = "danger";
            $_SESSION['message']= " File sudah ada";
        }

        if ($uploadedOK == 0) {
            $_SESSION['alert'] = "danger";
            $_SESSION['message']= " File gagal updaload";
        } else {
            if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                $conn = include "../../../connection.php";
                $query = "INSERT INTO paket_wisata (nama_paket,obyek_wisata_id,deskripsi,harga_paket,fas_trans,fas_inap,fas_makan,diskon,img) VALUES ('" . $nama . "','" . $obyek_wisata_id . "','" . $deskripsi . "','" . $harga_paket . "','" . $fas_trans . "','" . $fas_inap . "','" . $fas_makan . "','" . $diskon . "','" . $target_name . $target_type . "')";
                if (mysqli_query($conn, $query)) {
                    $_SESSION['alert'] = "success";
                     $_SESSION['message'] = "Data berhasil ditambkan";
                } else {
                    $_SESSION['alert'] = "danger";
                     $_SESSION['message'] = "data gagal ditambahkan";
                }
            } else {
                $_SESSION['alert'] = "danger";
                $_SESSION['message']= "File gagal updaload";
            }
        }
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message']= "Terjadi Kesalahan";
    }
}
echo "<script>window.location.replace('".$_SERVER['HTTP_REFERER']."');</script>";