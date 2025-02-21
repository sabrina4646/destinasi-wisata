<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * From users WHERE username='" . $username . "' and password='" . $password . "' and is_admin=1";

    $conn = include "../../../connection.php";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (isset($user)) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
    } else {
        $_SESSION['alert']='danger';
        $_SESSION['message']="user tidak ditemukan";
    }
}
echo "<script>window.location.replace('".$_SERVER['HTTP_REFERER']."');</script>";