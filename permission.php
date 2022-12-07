<?php
    require "_header.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

?>
    <!-- Modal -->
    <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true " style="display: block;" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-danger">Are you sure you delete this field</h3>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="http://crud.local/userList.php">cancel</a>
                    <form method="post" action="/delete.php" class="d-inline">
                        <?php
                           $id = $_POST['id']
                        ?>
                        <input hidden type="text" name="id" value="<?php echo $id; ?>">
                        <input type="text" hidden name="method" value="delete">
                        <input type="submit" value="Delete" class="btn btn-danger" >
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    }
    else{
        header('location: login.php');
    }
require "_footer.php";
?>