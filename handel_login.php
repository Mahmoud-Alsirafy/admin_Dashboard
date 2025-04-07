<?php
session_start();
require "connect.php";


extract($_POST);

$query = "SELECT * FROM `user` WHERE email = '$email'";

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) == 1) {
  $user = mysqli_fetch_assoc($result);



  $pass_user = $user["password"];
  $role = $user["role"];


  if (password_verify($password, $pass_user)) {
    if ($role == "user") {
      header("location:login.php");
      $_SESSION["user"]="User Or Password Is Un Correct";
    }
     else {
      header("location:index.php");
      $_SESSION["login"]="login";
    }
  }
}