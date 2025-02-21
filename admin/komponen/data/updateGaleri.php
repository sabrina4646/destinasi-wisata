<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uploadedOK = 1;
    $target_folder = "../../../gambar/";

    $deskripsi = $_POST['deskripsi'];
    $galeri_id = $_POST['galeri_id'];
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
        unlink($target_file);

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
    $query = "UPDATE galeri SET deskripsi ='" . $deskripsi . "' WHERE id='" . $galeri_id . "';";
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil diubah";
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "data gagal diubah";
    }
}
echo "<script>window.location.replace('".$_SERVER['HTTP_REFERER']."');</script>";