<?php
require_once("User.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $method = $_POST['method'];
    
   if($method == 'delete'){
        
        $id = $_POST['id'];
        $user=User::get($id);
        $user->delete();
        $_SESSION['success'] = 'your data Deleted successfully';
        header('location: userList.php');
        
    }
    
}
else{
    header('location: login.php');
}

?>