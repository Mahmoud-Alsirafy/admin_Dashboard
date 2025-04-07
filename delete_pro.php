 <?php
    session_start();
    require "connect.php";

    $id = $_GET["id"];
    $q_img = "SELECT * FROM `product` WHERE id= '$id'";
    $r_img = mysqli_query($connect, $q_img);
    $p_img = mysqli_fetch_assoc($r_img);

     $old_img = explode(',', $p_img["image"]) ;

    $query = "DELETE FROM `product` WHERE id = '$id'";
    $result = mysqli_query($connect, $query);

    if ($result) { 
        foreach($old_img as $img){
            unlink("images/$img");
        }
        header("location:product.php");
        $_SESSION["delete"] = "Success Deleted User";
    } else {
        header("location:product.php");
    }

    
// require "connect.php";
// session_start();

// $id = $_GET["id"];

// // جلب المنتج
// $q_img = "SELECT * FROM `product` WHERE id= '$id'";
// $r_img = mysqli_query($connect, $q_img);
// $p_img = mysqli_fetch_assoc($r_img);

// // إذا كانت الصور مخزنة في حقل واحد مفصولة بفاصل
// $images = explode(',', $p_img["image"]);

// // حذف المنتج من قاعدة البيانات
// $query = "DELETE FROM `product` WHERE id = '$id'";
// $result = mysqli_query($connect, $query);

// if ($result) {
//     // حذف جميع الصور المرتبطة بالمنتج
//     foreach ($images as $image) {
//         $imagePath = "images" . $image;
//         if (file_exists($imagePath)) {
//             unlink($imagePath);  // حذف الصورة
//         }
//     }

//         // إعادة توجيه بعد الحذف
//         header("location:product.php");
//     $_SESSION["delete"] = "Product deleted successfully!";
// } else {
//         header("location:product.php");
//         $_SESSION["delete"] = "Product Not deleted successfully!";

// }
// ?>