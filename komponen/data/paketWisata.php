<?php
$conn = include "../../connection.php";
$id = $_POST['obyek_wisata_id'];
$query = "SELECT * FROM paket_wisata WHERE id = ".$id;
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result,MYSQLI_ASSOC);

header("Content-Type: application/json");
echo json_encode($data);
?>
