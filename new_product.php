<?php
require_once "style/nav.php";
require_once "style/sidebar.php";

?>


<div class="container mt-5">
    <h2>Add New Product</h2>
    <form action="handel_add_product.php" method="POST" enctype="multipart/form-data">
        <div class=" d-flex justify-content-between">
            <div class="mb-3 w-100">
                <?php
                if (isset($_SESSION["errors"]["name"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["errors"]["name"]; ?>
                    </div>
                <?php }
                unset($_SESSION["errors"]["name"])
                ?>
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3 w-100">
                <?php
                if (isset($_SESSION["errors"]["cat"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["errors"]["cat"]; ?>
                    </div>
                <?php }
                unset($_SESSION["errors"]["cat"])
                ?>
                <label class="form-label">Category</label>
                <input type="text" name="cat" class="form-control">
            </div>
        </div>
        <div class=" d-flex justify-content-between">
            <div class="mb-3 w-100">
                <?php
                if (isset($_SESSION["errors"]["price"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["errors"]["price"]; ?>
                    </div>
                <?php }
                unset($_SESSION["errors"]["price"])
                ?>
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="mb-3 w-100">
                <?php
                if (isset($_SESSION["errors"]["old_price"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["errors"]["old_price"]; ?>
                    </div>
                <?php }
                unset($_SESSION["errors"]["old_price"])
                ?>
                <label class="form-label">Old Price</label>
                <input type="number" name="old_price" class="form-control">
            </div>
        </div>
        <div class=" d-flex justify-content-between">
            <div class="mb-3 w-100">
                <?php
                if (isset($_SESSION["errors"]["quantity"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["errors"]["quantity"]; ?>
                    </div>
                <?php }
                unset($_SESSION["errors"]["quantity"])
                ?>
                <label class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control">
            </div>
            <div class="mb-3 w-100">
                <?php
                if (isset($_SESSION["errors"]["image"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION["errors"]["image"]; ?>
                    </div>
                <?php }
                unset($_SESSION["errors"]["image"])
                ?>
                <label class="form-label">Product Images</label>
                <input type="file" name="image[]" class="form-control" multiple>
            </div>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Add Product</button>


    </form>
</div>




<?php
require "style/footer.php"
?>