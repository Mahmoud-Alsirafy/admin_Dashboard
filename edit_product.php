<?php

require "connect.php";
require_once "style/nav.php";
require_once "style/sidebar.php";
$id = $_GET["id"];
$query = "SELECT `name`, `price`,`old_price`, `image`, `cat` , `quantity` FROM `product` WHERE id = '$id'";
$result = mysqli_query($connect, $query);
$pro = mysqli_fetch_assoc($result);

?>


<form action="update_product.php?id=<?php echo $id ?>" method="POST" class="row g-3 p-5" enctype="multipart/form-data">



    <div class="col-md-6">
        <label for="validationDefault01" class="form-label"> name</label>
        <input type="text" name="name" value="<?php echo $pro["name"] ?>" class="form-control" id="validationDefault01">
    </div>





    <div class="col-md-6">
        <label for="validationDefaultUsername" class="form-label">price</label>

        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">$</span>
            <input type="text" name="price" value="<?php echo $pro["price"] ?>" class="form-control"
                id="validationDefaultUsername" aria-describedby="inputGroupPrepend2">
        </div>


    </div>
    <div class="col-md-6">
        <label for="validationDefaultUsername" class="form-label">old_price</label>

        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">$</span>
            <input type="text" name="old_price" value="<?php echo $pro["old_price"] ?>" class="form-control"
                id="validationDefaultUsername" aria-describedby="inputGroupPrepend2">
        </div>


    </div>

    <div class="col-md-6">
        <label for="validationDefaultUsername" class="form-label">image</label>

        <div class="input-group">
            <input type="file" name="image[]" multiple class="form-control" id="validationDefaultUsername"
                aria-describedby="inputGroupPrepend2">
        </div>


    </div>
    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">cat</label>

        <input type="text" name="cat" value="<?php echo $pro["cat"] ?>" class="form-control" id="validationDefault03">
    </div>

    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">quantity</label>

        <input type="text" name="quantity" value="<?php echo $pro["quantity"] ?>" class="form-control"
            id="validationDefault03">
    </div>

    <div class="col-12 mt-3">
        <button name="add" class="btn btn-primary" type="submit">Update Product</button>
        <a href="product.php" class="btn btn-success">View Products</a>
    </div>
</form>

<?php
require "style/footer.php"
?>