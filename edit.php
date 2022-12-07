<?php
require "_header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("User.php");
    $user = User::get($_POST['id']);
    $id = $user->id;
    $name = $user->name;
    $fatherName = $user->father_name;
    $email = $user->email;
    $pass = $user->password;
    $url = '/update.php';
    $headingForm = "Update Form";
    $method = 'put';
    $btn = "Update";
    require '_form.php';
} 
else{
    header('location: userList.php');
}
require "_footer.php";
