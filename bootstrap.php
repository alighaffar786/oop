<?php 

require_once("User.php");
// $user = new User();
// $payload = ["name"=>"dfd","father_name"=>"ghaffar","email"=>"alighaffa879r@gmail.com","password"=>"123456678"];
// $user->create($payload);
    // print_r();
    // echo $user->errors['password'];
    print_r($user);
// $user->update(["name"=>"ali"]);
// $user = User::get(294);
// $user->update(["father_name"=>"khan","email"=>"amir@gmail.comffff"]);
// print_r($user);

// $user = User::get(294);
// $user->update(["password"=>"2xcvsdasdafasdfasdf65","email"=>"amir@gmail.comffff"]);
// $user = new User();
// $payload = ["name"=>"888","father_name"=>"","email"=>"aghaffar@gmail.com","password"=>"12345678"];
// $user->create($payload);
// print_r($user);
// $users  = User::getList();
// $condition=["id>"=>290];
// $operator="AND";
// $order = "name";
// $param=[
//     "condition"=>[[name]],
//     "order_by"=> ["name"=> "desc","role"=>"ASC"],
// ];    "condition"=>["father_name ="=>"khan","role ="=>"user"],
$param=[
    "condition"=>[
        [
            ["name"=>["startWith"=>"a"]],
            ["and"],
            ["id"=>["lessThan"=>"301"]]
        ],
        ["and"],
        [
            ["father_name"=>["startWith"=>"a"]],
            ["and"],
            ["id"=>["lessThan"=>"301"]]
        ]
        // ["name"=>["startWith"=>"a"]],
        // ["and"],
        // ["id"=>["greaterThan"=>"285"]],
    ],
    "order_by"=> ["name"=> "desc"],
    // alterrate
];

// $condition = [
//     []
// ]


// Select * from users ( ) and ( )

// Select * from users where id 
$user = User::getList($param);
print_r($user);

// Select * from users where (id > 9 and id <10) and (sdafasd);
// condition => [
//     ["id",">",9,"AND"],
//     ["id","<",10]
// ]
// ["id"=>["lessThan"=>"25"]]

// print_r($user);https://www.c-sharpcorner.com/blogs/use-both-order-by-asc-and-desc-in-single-sql-server-query1
