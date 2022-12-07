<?php
require 'Model.php';
class User extends Model
{
    // properties
    public  $id, $name, $father_name, $email, $password;

    public static $table_name = "user";
    protected static $primary_key = "id";
    public $rules = [
    "alphabet" => ["name"=>"alphabet error","father_name"],
    "length" => ["password"=>["min"=>[8=>"minimum error"],"max"=>[10=>"maximum error"]]],
    "unique" => ["email"=>"unique error"],
    "required" => ["name", "father_name", "email", "password"]
    ];
    
    public $loginrules = [
        // "length" => ["password"=>["min"=>[8=>""],"max"=>[10=>"maximum error"]]],
        "required" => ["email", "password"]
    ];
}