<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    
    <title>crud</title>
</head>

<body>
    <header class="bg-secondary d-flex align-items-center p-3 w-100 h-100">
     <ul class=" mb-0 p-0 text-decoration-none">
        <li >
            <a class="text-white me-2" >
            <?php
            
            if(isset($_SESSION['user_detail']['name'])){
                echo $_SESSION[' detail']['name'];
            } else{
                echo "USER";
            }
            ?>
            </a>
        </li>
     </ul>
     <?php if(isset($_SESSION['user_detail']['name'])){?>
        <form action="logout.php" class=" ms-auto d-inline" method="post">
                    
        <input type="submit" class=" btn btn-primary" value="logout">
        </form>
    <?php 
        }
    ?>
    </header>
    
    <main class="container d-flex flex-column  justify-content-center align-items-center">
            