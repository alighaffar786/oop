<?php 
// require '_header.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'Model.php';
        $name = $_POST['name'];
        $fatherName = $_POST["fatherName"];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        // $form = '';
        $model = new Model();
        $model->create(['name'=>$name,'father_name'=>$fatherName,'email'=>$email,'password'=>$pass]);
    }
    else{
        header('location : signup.php');
    }
// require '_footer.php';
?>