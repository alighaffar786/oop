<?php
require "_header.php";
 require_once("User.php");
// check request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $method = $_POST['method'];
   if($method == 'put'){
        $id = $_POST['id']; 
        $name = $_POST["name"];
        $fatherName = $_POST["f_name"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $payload = ["name"=>$name,"father_name"=>$fatherName,"email"=>$email,"password"=>$pass];
        $user = User::get($id);
        $user->update($payload);
        // edit in db
        if(isset($user->errors)){
            $url = '/update.php';
            $headingForm = "Update Form";
            $method = 'put';
            $btn = "Update";
            require '_form.php';
        }
        else{
            $_SESSION['success'] = 'your data Updated successfully';
            header("location: userList.php");
        }
    }
} 
else {
    header("location: userlist.php");
}
require '_footer.php';