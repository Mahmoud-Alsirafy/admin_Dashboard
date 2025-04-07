<?php

// require "connect.php";

// extract($_POST);

// $id = $_GET["id"];

// $q_img = "SELECT * FROM `product` WHERE id= '$id'";
// $r_img = mysqli_query($connect, $q_img);
// $p_img = mysqli_fetch_assoc($r_img);

// $old_img = $p_img["image"];

// if(isset($_POST["add"])){

//     $errors = [];

//     if (empty($name)) {
//         $errors["name"] = "name is req";
//     } elseif (is_numeric($name)) {
//         $errors["name"] = "name must be string";
//     } elseif (strlen($name) < 1) {
//         $errors["name"] = "name must be more than this";
//     }

//     if (empty($price)) {
//         $errors["price"] = "price is req";
//     } elseif (!is_numeric($price)) {
//         $errors["price"] = "price must be number";
//     }
//     if (empty($old_price)) {
//         $errors["old_price"] = "old_price is req";
//     } elseif (!is_numeric($old_price)) {
//         $errors["old_price"] = "old_price must be number";
//     }
//     if (empty($cat)) {
//         $errors["cat"] = "cat is req";
//     } elseif (is_numeric($cat)) {
//         $errors["cat"] = "cat must be str";
//     } elseif (strlen($cat) < 1) {
//         $errors["cat"] = "cat must be more than 2 litters";
//     }

//     if (empty($quantity)) {
//         $errors["quantity"] = "quantity is req";
//     } elseif (!is_numeric($quantity)) {
//         $errors["quantity"] = "quantity must be number";
//     } elseif (strlen($quantity) < 1) {
//         $errors["quantity"] = "quantity must be more than this";
//     }
//     if ($_FILES["image"]["error"] == 0) {
//         $image = $_FILES["image"];

//         $imgName = $image["name"];

//         $ext = pathinfo($imgName, PATHINFO_EXTENSION);

//         $tmp = $image["tmp_name"];

//         $error = $image["error"];

//         $size = $image["size"] / (1024 * 1024);

//         $ex = ["png", "jpg"];
//         if (!in_array($ext, $ex)) {
//             $errors["image"] = "image is req";
//         }
//         $newName = uniqid() . $imgName;

//         if (empty($errors)) {

//             unlink("images/$old_img");
//             $query = "UPDATE `product` SET `name`='$name',`price`='$price',`old_price`='$old_price',`image`='$newName',`cat`='$cat',`quantity`='$quantity' WHERE id = '$id' ";
//             $result = mysqli_query($connect, $query);
//             if ($result) {
//                 move_uploaded_file($tmp, "images/$newName");
//                 header("location:product.php");
//             } else {
//                 print_r($errors);
//             }
//         }
//     }else{
//         if (empty($errors)) {

            
//             $query = "UPDATE `product` SET `name`='$name',`price`='$price',`old_price`='$old_price',`cat`='$cat',`quantity`='$quantity' WHERE id = '$id' ";
//             $result = mysqli_query($connect, $query);
//             if ($result) {
    
//                 header("location:product.php");
//             }
//         } else {
//             print_r($errors);
//         }
//     }

// }

require "connect.php";
extract($_POST);

$id = $_GET["id"];

$q_img = "SELECT * FROM product WHERE id= '$id'";
$r_img = mysqli_query($connect, $q_img);
$p_img = mysqli_fetch_assoc($r_img);

$old_img = $p_img["image"];

if(isset($_POST["add"])){

    $errors = [];

    // التحقق من المدخلات
    if (empty($name)) {
        $errors["name"] = "name is req";
    } elseif (is_numeric($name)) {
        $errors["name"] = "name must be string";
    }

    if (empty($price)) {
        $errors["price"] = "price is req";
    } elseif (!is_numeric($price)) {
        $errors["price"] = "price must be number";
    }

    if (empty($old_price)) {
        $errors["old_price"] = "old_price is req";
    } elseif (!is_numeric($old_price)) {
        $errors["old_price"] = "old_price must be number";
    }

    if (empty($cat)) {
        $errors["cat"] = "cat is req";
    }

    if (empty($quantity)) {
        $errors["quantity"] = "quantity is req";
    } elseif (!is_numeric($quantity)) {
        $errors["quantity"] = "quantity must be number";
    }

    // التعامل مع الصور
    $new_images = [];
    if ($_FILES["image"]["error"][0] == 0) {  // التحقق إذا كانت الصور مرفوعة
        foreach ($_FILES["image"]["name"] as $key => $imgName) {
            $ext = pathinfo($imgName, PATHINFO_EXTENSION);
            $tmp = $_FILES["image"]["tmp_name"][$key];
            $error = $_FILES["image"]["error"][$key];
            $size = $_FILES["image"]["size"][$key] / (1024 * 1024);  // حجم الصورة بالميجابايت

            $ex = ["png", "jpg", "jpeg"];
            if (!in_array($ext, $ex)) {
                $errors["image"] = "image format should be png or jpg";
            }

            if ($error == 0) {
                $newName = uniqid() . $imgName;
                move_uploaded_file($tmp, "images/$newName");
                $new_images[] = $newName;
            }
        }

        // لو في صور مرفوعة، حفظهم في قاعدة البيانات
        if (!empty($new_images)) {
            // إزالة الصورة القديمة من المجلد
            foreach (explode(",", $old_img) as $old_image) {
                unlink("images/$old_image");
            }
            $image_string = implode(",", $new_images);
        }
    } else {
        // لو مفيش صور مرفوعة، حافظ على الصورة القديمة
        $image_string = $old_img;
    }

    if (empty($errors)) {
        // استعلام التحديث في قاعدة البيانات
        $query = "UPDATE product SET name='$name', price='$price', old_price='$old_price', image='$image_string', cat='$cat', quantity='$quantity' WHERE id = '$id' ";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: product.php");
        } else {
            print_r($errors);
        }
    } else {
        print_r($errors);
    }
}
?>