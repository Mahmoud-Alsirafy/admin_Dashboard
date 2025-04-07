<?php

require "style/nav.php";
require "style/sidebar.php";
require "connect.php";
$id = $_GET["id"];
$query = "SELECT `firstName`, `lastName`, `email`, `phone`, `role`, `gender` FROM `user` WHERE id = '$id'";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);
?>
<form action="handel_update.php?id=<?php echo $id ?>" method="POST" class="row g-3 p-5">


    <div class="col-md-6">
        <label for="validationDefault01" class="form-label"> firstName</label>
        <input type="text" name="firstName" value="<?php echo $user["firstName"] ?>" class="form-control"
            id="validationDefault01">
    </div>

    <div class="col-md-6">
        <label for="validationDefault01" class="form-label"> lastName</label>
        <input type="text" name="lastName" value="<?php echo $user["lastName"] ?>" class="form-control"
            id="validationDefault01">
    </div>





    <div class="col-md-6">
        <label for="validationDefaultUsername" class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">@</span>
            <input type="text" name="email" value="<?php echo $user["email"] ?>" class="form-control"
                id="validationDefaultUsername" aria-describedby="inputGroupPrepend2">
        </div>


    </div>


    <br>
    <div class="col-md-6">
        <label for="validationDefaultUsername" class="form-label">phone</label>
        <div class="input-group">
            <input type="text" name="phone" value="<?php echo $user["phone"] ?>" class="form-control"
                id="validationDefaultUsername" aria-describedby="inputGroupPrepend2">
        </div>


    </div>



    <div class="col-md-6 ">
        <label for="validationDefault04" class="form-label ">role</label>
        <select name="role" class="form-control" id="validationDefault04">
            <option <?php echo ($user["role"]) == "user" ? "selected" : ""; ?> value="user">user</option>
            <option <?php echo ($user["role"]) == "admin" ? "selected" : ""; ?> value="admin">admin</option>
        </select>
    </div>




    <div class="col-md-6 ">
        <label for="validationDefault04" class="form-label">gender</label>
        <select class="form-control" name="gender" id="validationDefault04">
            <option <?php echo ($user["gender"]) == "male" ? "selected" : ""; ?> value="male">male</option>
            <option <?php echo ($user["gender"]) == "female" ? "selected" : ""; ?> value="female">female</option>
        </select>
    </div>










    <div class="col-12 mt-3">
        <button name="update" class="btn btn-primary" type="submit">update</button>

    </div>
</form>

<?php
require "style/footer.php";
?>