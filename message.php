<?php
require "style/nav.php";
require "style/sidebar.php";
require "connect.php";

$query = "SELECT * FROM `message`";
$result = mysqli_query($connect, $query);
?>



<div class="container-fluid page-body-wrapper full-page-wrapper ">



    <table class="table w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">status</th>
                <th scope="col">message</th>

            </tr>
        </thead>
        <tbody>

            <?php
            if (mysqli_num_rows($result) > 0) {
                $mes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($mes as $key => $value) {
                    $id = $value["id"]
            ?>
                    <tr>
                        <td scope="col"><?php echo ++$key ?></td>
                        <td scope="col"><?php echo $value["name"] ?></td>
                        <td scope="col"><?php echo $value["email"] ?></td>
                        <td scope="col"><?php echo $value["phone"] ?></td>
                        <td class="_td" scope="col"><?php echo ($value["status"] == 0) ? "Un Read" : "Read" ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button im="<?php echo $value["id"] ?>" type="button" class="btn btn-primary _view"
                                data-toggle="modal" data-target="#exampleModal<?php echo $value["id"] ?>">
                                View Message
                            </button>

                            <!-- Modal -->
                            <div class="modal fade " id="exampleModal<?php echo $value["id"] ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span style="color: red;">
                                                <?php echo $value["message"] ?>
                                            </span>
                                        </div>
                                        <div class=" modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="delete_mss.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

            <?php }
            } ?>


            <?php include "pro.php" ?>

        </tbody>
    </table>


</div>



<script src="../assets/js/jquery-3.7.1.min.js"></script>
<script>
    $("._view").click(function() {
        $(this).closest("tr").find("._td").html("Read");
        var id = $(this).attr("im");
        $.post("style/update_mes.php", {
            id: id
        }, function(num) {
            $("._num").html(num + "+");
        })

    })
</script>
<?php
require "style/footer.php";

?>