<?php
require 'Model.php';
class User extends Model
{
    // properties

    public static $table_name = "user";
    public $rules = ["alphabet" => ["name"=>"Name is Require", "father_name"], "length" => ["password"=>[8,10]]
                                        , "unique" => ["email"], "required" => ["name", "father_name", "email", "password"]];
    public  $id, $name, $father_name, $email, $password;

    
}
