<?php 

require_once("User.php");
// $user = new User();
// $payload = ["name"=>"dfd","father_name"=>"ghaffar","email"=>"alidddx@gfdfdmail.com","password"=>"12678"];
// $user->create($payload);
// $user->update(["name"=>"ali"]);
// $user = User::get(294);
// $user->update(["father_name"=>"khan","email"=>"amir@gmail.comffff"]);
// print_r($user);

// $user = User::get(294);
// $user->update(["father_name"=>"khan","email"=>"amir@gmail.comffff"]);
// $user = new User();
// $payload = ["name"=>"888","father_name"=>"","email"=>"aghaffar@gmail.com","password"=>"12345678"];
// $user->create($payload);
// print_r($user);
// $users  = User::getList();

$user = User::get(285);
// $user->update(["name"=>"","email"=>"umer@gmil.com","password"=>"65"]);
print_r($user);