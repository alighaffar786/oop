<?php
require '_header.php';
require_once("User.php");

// $user = User::get(301);
// print_r($user);
// die;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User;
    $name = $_POST["name"];
    $fatherName = $_POST["f_name"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $payload = ["name"=>$name,"father_name"=>$fatherName,"email"=>$email,"password"=>$pass];
    
    $user->create($payload);
    // print_r($user);
     if(isset($user->errors)){
        $url = '/insert.php';
        $headingForm = "Sign up";
        $btn = "Signup";
        require '_form.php';
    }
    else{
        header('location: login.php');
        $_SESSION['name'] = $name;
    }
}
else{
    header("location: singup.php");
}
require '_footer.php';

?>