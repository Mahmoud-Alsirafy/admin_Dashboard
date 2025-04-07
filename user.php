<?php
require "style/nav.php";
require "style/sidebar.php";
require "connect.php";
?>
<div class="container-fluid page-body-wrapper full-page-wrapper ">



    <table class="table w-100   ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">firstName</th>
                <th scope="col">lastName</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">role</th>
                <th scope="col">gender</th>
                <th scope="col"> Edit / delete </th>
            </tr>
        </thead>
        <tbody>


            <?php
            $query = "SELECT * FROM `user`";
            $result = mysqli_query($connect, $query);
            $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($user as $key => $value) {

                $id = $value["id"];
            ?>
            <tr>
                <td scope="col"><?php echo ++$key  ?></td>
                <td scope="col"><?php echo $value["firstName"] ?></td>
                <td scope="col"><?php echo $value["lastName"] ?></td>
                <td scope="col"><?php echo $value["email"] ?></td>
                <td scope="col"><?php echo $value["phone"] ?></td>
                <td scope="col"><?php echo $value["role"] ?></td>
                <td scope="col"><?php echo $value["gender"] ?></td>

                <td>
                    <a href="edit.php?id=<?php echo $id ?>" class="btn btn-primary">edit</a>
                    <?php require "model_user.php"   ?>
                </td>
            </tr>
            <?php } ?>




        </tbody>
    </table>

    <?php
    if (isset($_SESSION["delete"])) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION["delete"]; ?>
    </div>
    <?php }
    unset($_SESSION["delete"])
    ?>
    <a href="newUser.php" class="btn btn-primary justify-content-center">add User</a>

</div>

<?php
require "style/footer.php";
?>