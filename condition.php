<?php
require '_header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("User.php");
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $query = new User();
    $param=["email"=>"$email","password"=>"$pass"];
    $user = User::login($param);
    if(isset($user->errors)){
        $url = '/condition.php';
        $headingForm = "Login";
        $btn = "Login";
        require '_form.php';
    }
    else{
        if(empty($user->name)){
            $url = '/condition.php';
            $headingForm = "Login";
            $loginError = "Please enter correct Email and password please try again";
            $btn = "Login";
            require '_form.php';
        }
        else{
            header("location: userList.php");
        }
    }   
}
else{
    header('location:login.php');
}
require '_footer.php';
?>