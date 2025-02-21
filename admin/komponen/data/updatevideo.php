<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $url = $_POST['url'];
    $video_id = $_POST['video_id'];
    $conn = include "../../../connection.php";
    $query = "UPDATE video SET url='" . $url . "' WHERE id='" . $video_id . "'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil diupdate";
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "data gagal diupdate";
    }
}
// echo "<script>window.location.replace('../../tambahgaleri.php');</script>";
echo "<script>window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
