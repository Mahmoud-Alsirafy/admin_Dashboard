 <?php
 session_start();
    require "connect.php";

 $id = $_GET["id"];

 $query = "DELETE FROM `user` WHERE id = '$id'"; 
 $result = mysqli_query($connect , $query);

 if($result) {
    header("location:user.php");
    $_SESSION["delete"] = "Success Deleted User";
 }else{
        header("location:user.php");
 }