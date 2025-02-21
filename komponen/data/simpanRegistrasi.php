<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = include "../../connection.php";
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "INSERT INTO users (nama,no_hp,username,password,is_admin) VALUES ('" . $nama . "','" . $no_hp . "','" . $username . "','" . $password . "',0);";

    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Berhasil melakukan registrasi";
        $query = "SELECT * From users WHERE username='" . $username . "' and no_hp='" . $no_hp . "' and password='" . $password . "';";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['no_hp'] = $data['no_hp'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] =$data['id'];
    } else {
        $_SESSION['alert'] = "danger";
        $_SESSION['message'] = "Gagal melakukan registrasi";
    }
}

echo "<script>window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
