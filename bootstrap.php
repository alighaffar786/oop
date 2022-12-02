<?php 

require_once("User.php");
// $user = new User();
// $payload = ["name"=>"dfd","father_name"=>"ghaffar","email"=>"alidddx@gfdfdmail.com","password"=>"12678"];
// $user->create($payload);
// $user->update(["name"=>"ali"]);
// $user = User::get(294);
// $user->update(["father_name"=>"khan","email"=>"amir@gmail.comffff"]);
// print_r($user);


$user = new User();
$payload = ["name"=>"Ali Abbas","father_name"=>"afzaal","email"=>"ali@site.com","password"=>"1265878"];
// $user->create($payload);
// print_r($user);

$users  = User::getList();
print_r($users);