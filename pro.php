<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php $value["id"] ?>">
    Delete
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?php $value["id"] ?>" tabindex="-1" role="dialog"
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
                    are you sure you want delete <?php echo $value["name"] ?>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="delete_pro.php?id=<?php echo $value["id"] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
