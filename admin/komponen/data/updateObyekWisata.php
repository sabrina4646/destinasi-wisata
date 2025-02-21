<?php
session_start();
// simpan data
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uploadedOK = 1;
    $target_folder = "../../../gambar/";
    $target_name = rand(1, 10000) . date("ymdHis") . ".";
    $target_type = "";

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $deskripsi = $_POST['deskripsi'];
    $nama_gambar = $_POST['nama_gambar'];
    $obyek_wisata_id = $_POST['obyek_wisata_id'];


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
    $query = "UPDATE obyek_wisata SET nama='" . $nama . "',alamat='" . $alamat . "',deskripsi='" . $deskripsi . "' WHERE id='" . $obyek_wisata_id . "';";
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil diupdate";
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "data gagal diupdate";
    }
}
echo "<script>window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
