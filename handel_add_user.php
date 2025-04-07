<?php
session_start();
require "connect.php";

extract($_POST);


if (isset($_POST["add"])) {
    $errors = [];
    if (empty($firstName)) {
        $errors["firstName"] = "firstName is require";
    } elseif (is_numeric($firstName)) {
        $errors["firstName"] = "firstName must be str";
    } elseif (strlen($firstName) < 2) {
        $errors["firstName"] = "firstName must be more than 3 letters";
    }
    if (empty($lastName)) {
        $errors["lastName"] = "lastName is require";
    } elseif (is_numeric($lastName)) {
        $errors["lastName"] = "lastName must be str";
    } elseif (strlen($lastName) < 2) {
        $errors["lastName"] = "lastName must be more than 3 letters";
    }

    if (empty($email)) {
        $errors["email"] = "email is require";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "the email is un correct";
    } elseif (strlen($email) < 5) {
        $errors["email"] = "email must be more than 5 letters";
    }

    if (empty($password)) {
        $errors["password"] = "password is require";
    } elseif (!is_numeric($password)) {
        $errors["password"] = "password must be num";
    } elseif (strlen($password) < 5) {
        $errors["password"] = "password must be more than 5 letters";
    }
    if (empty($confirmPassword)) {
        $errors["confirmPassword"] = "confirmPassword is require";
    } elseif (!is_numeric($confirmPassword)) {
        $errors["confirmPassword"] = "confirmPassword must be num";
    } elseif (strlen($confirmPassword) < 5) {
        $errors["confirmPassword"] = "confirmPassword must be more than 5 letters";
    }
    if (empty($phone)) {
        $errors["phone"] = "phone is require";
    } elseif (!is_numeric($phone)) {
        $errors["phone"] = "phone must be num";
    } elseif (strlen($phone) < 10) {
        $errors["phone"] = "phone must be more than 10 letters";
    }

    $roles = ["user", "admin"];
    if (!in_array($role, $roles)) {
        $errors["role"] = "Role Must Be User Or Admin";
    }
    $genders = ["male", "female"];
    if (!in_array($gender, $genders)) {
        $errors["gender"] = "Gender Must Be Male Or Female";
    }

    if (empty($errors)) {

        $q="SELECT `email` FROM `user` WHERE email='$email'";
        $r=mysqli_query($connect,$q);
        $e=mysqli_fetch_assoc($r);
        if(mysqli_num_rows($r)==0){
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $con_pass = password_hash($confirmPassword, PASSWORD_DEFAULT);
            $query = "INSERT INTO `user`( `firstName`, `lastName`, `email`, `password`, `confirmPassword`, `phone`, `role`, `gender`) VALUES ('$firstName','$lastName','$email','$pass','$con_pass','$phone','$role','$gender')";
            $result = mysqli_query($connect, $query);
    
            if ($result) {
                header("location:user.php");
            } else {
                header("location:newUser.php");
                $_SESSION["email"]="Email Is Already Token";
            }
        } else {
            header("location:newUser.php");
            $_SESSION["email"]="Email Is Already Token";
        }
       

    } else {
        header("location:newUser.php");
        $_SESSION["errors"] = $errors;
    }
}