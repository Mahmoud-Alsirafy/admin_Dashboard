<?php
require "../connect.php";
$id = $_POST["id"];
$query = "UPDATE `message` SET `status`= '1' WHERE id = '$id'";
$run = mysqli_query($connect, $query);

echo $connect->query("SELECT status FROM message WHERE status = '0' ")->num_rows;