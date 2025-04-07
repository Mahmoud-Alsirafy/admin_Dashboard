 <?php
 // session_start();
// require "connect.php";
// extract($_POST);


// if (isset($_POST["add"])) {
//     $errors = [];

//     $image = $_FILES["image"];

//     $imgName = $image["name"];

//     $ext = pathinfo($imgName, PATHINFO_EXTENSION);

//     $tmp = $image["tmp_name"];

//     $error = $image["error"];

//     $size = $image["size"] / (1024 * 1024);

//     if (empty($name)) {
//         $errors["name"] = "name is req";
//     } elseif (is_numeric($name)) {
//         $errors["name"] = "name must be str";
//     } elseif (strlen($name) < 2) {
//         $errors["name"] = "name must be more than 2 litters";
//     }
//     if (empty($cat)) {
//         $errors["cat"] = "cat is req";
//     } elseif (is_numeric($cat)) {
//         $errors["cat"] = "cat must be str";
//     } elseif (strlen($cat) < 1) {
//         $errors["cat"] = "cat must be more than 2 litters";
//     }

//     if (empty($price)) {
//         $errors["price"] = "price is req";
//     } elseif (!is_numeric($price)) {
//         $errors["price"] = "price must be num";
//     } elseif (strlen($price) < 1) {
//         $errors["price"] = "price must be more than 2 litters";
//     }
//     if (empty($old_price)) {
//         $errors["old_price"] = "old_price is req";
//     } elseif (!is_numeric($old_price)) {
//         $errors["old_price"] = "old_price must be num";
//     } elseif (strlen($old_price) < 1) {
//         $errors["old_price"] = "old_price must be more than 2 litters";
//     }

//     if (empty($quantity)) {
//         $errors["quantity"] = "quantity is req";
//     } elseif (!is_numeric($quantity)) {
//         $errors["quantity"] = "quantity must be num";
//     } elseif (strlen($quantity) < 1) {
//         $errors["quantity"] = "quantity must be more than 2 litters";
//     }

//     $ex = ["png", "jpg"];
//     if (!in_array($ext, $ex)) {
//         $errors["image"] = "image is req";
//     }

    
//     if (empty($errors)) {
//         $newName = uniqid() . $imgName;
//         $query = "INSERT INTO `product`
//         (`name`, `price`,`old_price`, `image`, `cat` , `quantity`)
//          VALUES
//           ('$name','$price','$old_price','$newName', '$cat' , '$quantity')";
//         $result = mysqli_query($connect, $query);
//         if($result) {
//             move_uploaded_file($tmp , "images/$newName" );
//             header("location:product.php");
//             $_SESSION["success"] = "inserted successful";
//         }else{
//             header("location:product.php");
//         }
//     }else{
//         $_SESSION["errors"] = $errors;
//         header("location:new_product.php");
//     }
// } 


session_start();
require "connect.php";
extract($_POST);

if (isset($_POST["add"])) {
    $errors = [];

    // التحقق من صحة البيانات
    if (empty($name)) {
        $errors["name"] = "name is req";
    } elseif (is_numeric($name)) {
        $errors["name"] = "name must be str";
    } elseif (strlen($name) < 2) {
        $errors["name"] = "name must be more than 2 letters";
    }

    if (empty($cat)) {
        $errors["cat"] = "cat is req";
    } elseif (is_numeric($cat)) {
        $errors["cat"] = "cat must be str";
    } elseif (strlen($cat) < 1) {
        $errors["cat"] = "cat must be more than 2 letters";
    }

    if (empty($price)) {
        $errors["price"] = "price is req";
    } elseif (!is_numeric($price)) {
        $errors["price"] = "price must be num";
    }

    if (empty($old_price)) {
        $errors["old_price"] = "old_price is req";
    } elseif (!is_numeric($old_price)) {
        $errors["old_price"] = "old_price must be num";
    }

    if (empty($quantity)) {
        $errors["quantity"] = "quantity is req";
    } elseif (!is_numeric($quantity)) {
        $errors["quantity"] = "quantity must be num";
    }

    // التعامل مع الصور
    $images = $_FILES["image"];
    $ex = ["png", "jpg"];
    $uploadedImages = []; // لحفظ أسماء الصور التي تم رفعها

    foreach ($images["name"] as $key => $imgName) {
        $ext = pathinfo($imgName, PATHINFO_EXTENSION);
        $tmp = $images["tmp_name"][$key];
        $error = $images["error"][$key];
        $size = $images["size"][$key] / (1024 * 1024);

        if (!in_array($ext, $ex)) {
            $errors["image"] = "image must be png or jpg";
        } else {
            // تسمية الصورة باسم جديد
            $newName = uniqid() . $imgName;
            $uploadedImages[] = $newName;

            // نقل الصورة إلى المجلد
            move_uploaded_file($tmp, "images/$newName");
        }
    }

    if (empty($errors)) {
        // حفظ المنتج مع أسماء الصور في قاعدة البيانات
        $imagesString = implode(",", $uploadedImages); // تخزين أسماء الصور كقائمة نصية
        $query = "INSERT INTO `product`
        (`name`, `price`, `old_price`, `image`, `cat`, `quantity`) 
        VALUES
         ('$name','$price','$old_price','$imagesString','$cat','$quantity')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            header("location:product.php");
            $_SESSION["success"] = "inserted successfully";
        } else {
            header("location:product.php");
        }
    } else {
        $_SESSION["errors"] = $errors;
        header("location:new_product.php");
    }
}