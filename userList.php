
<?php 
    require "_header.php";
    // $query = new User();
    require_once("User.php");
?> 
   <div class="w-100">
   <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='w-25 rounded  m-3 text-white fw-bold shadow p-3 bg-success'> " . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }
        ?>
    <table style='margin:auto;' class="bg-white table">
        <tr>
            <!-- table heading  -->
            <th>Name</th>
            <th>Father Name</th>
            <th>User Detail</th>
        </tr>
        <?php
        
        $users = User::getList();
        // $result = $table->get('user');
        foreach ($users as $user) {
            $id = $user->id;
        
            $name = $user->name;
            $fatherName = $user->father_name;
            echo "<tr><td>" . $name . "</td><td>" . $fatherName . "</td><td>";
            ?>
            <!-- edit form -->
            <form action="edit.php" class="d-inline" method="post">
                <input hidden name="id" value = "<?php echo $id; ?> " type="text">
                <input type="submit" class="btn btn-primary" value="Update">
            </form>
            <!-- Delete -->
            <form action="permission.php" class="d-inline" method="post">
                <input hidden name="id" value = "<?php echo $id; ?> " type="text">
                <input type="submit" class=" btn btn-danger" value="Delete">
            </form>
            </td></tr>
            <?php
        }
            ?>
        
    </table>
   </div>
<?php 
    
    require "_footer.php"
?>