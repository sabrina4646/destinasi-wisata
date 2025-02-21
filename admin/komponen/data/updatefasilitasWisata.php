<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uploadedOK = 1;
    $target_folder = "../../../gambar/";
    $target_name = rand(1, 10000) . date("ymdHis") . ".";
    $target_type = "";

    $nama = $_POST['nama'];
    $obyek_wisata_id = $_POST['obyek_wisata_id'];
    $fasilitas_wisata_id = $_POST['fasilitas_wisata_id'];
    $nama_gambar = $_POST['nama_gambar'];

    if ($_FILES['img']['error'] == 0 && $_FILES['img']['size'] != 0) {
        $target_type = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['img']['tmp_name']);
        if ($check !== false) {
            $uploadedOK = 1;
        } else {
            $uploadedOK = 0;
            $_SESSION['alert'] = "danger";
            $_SESSION['message'] = "File bukan image";
        }

        $target_file = $target_folder . $nama_gambar;
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if ($uploadedOK == 0) {
            $_SESSION['alert'] = "danger";
            $_SESSION['message'] = " File gagal updaload";
        } else {
            if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                $_SESSION['alert'] = "danger";
                $_SESSION['message'] = "File gagal updaload";
            }
        }
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "Terjadi Kesalahan";
    }

    $conn = include "../../../connection.php";
    $query = "UPDATE fasilitas_wisata SET nama='" . $nama . "',obyek_wisata_id='" . $obyek_wisata_id . "' WHERE id='" . $fasilitas_wisata_id . "';";
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil ditambkan";
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "data gagal ditambahkan";
    }
}
echo "<script>window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
