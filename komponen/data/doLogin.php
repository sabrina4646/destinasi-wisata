<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * From users WHERE (username='" . $username . "' or no_hp='" . $username . "') and password='" . $password . "'";

    $conn = include "../../connection.php";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (isset($user)) {
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['no_hp'] = $user['no_hp'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] =$user['id'];
    } else {
        $_SESSION['alert'] = 'danger';
        $_SESSION['message'] = "user tidak ditemukan";
    }
}
echo "<script>window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
