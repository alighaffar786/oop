<?php

use LDAP\Result;

require_once("DB.php");
class Model
{
    // properties

    protected static $table_name = "";
    protected $pk = "id";
    public $erros;
    public $attributes;
    public $rules = ["required" => [], "unique" => []];


    // methods


    // constructer

    public function __construct()
    {
        // $this->table_name="";
        $this->pk = "";
        $this->attributes = new stdClass;
    }
    // create
    public function create($payload)
    {
        $table = get_class($this)::$table_name;
        $this->setInstance($payload);
        $this->validate();
        if (empty($this->errors)) {
            $res = DB::insert($table, $payload);
            $this->setInstance($res);
        }
    }
    // update
    public function update($payload)
    {
        $table = get_class($this)::$table_name;
        // $this->validation($payload, $this->id);
        $res = DB::update($table, $this->id, $payload);
        $this->setInstance($res);

        // if (empty($this->errors)) {

        // }
    }
    // delete
    public function delete()
    {
        $table = get_class($this)::$table_name;
        DB::delete($table, $this->id);
    }
    
    // get recorde by id

    public static function get($id)
    {

        $class = get_called_class();
        $row = DB::get($class::$table_name, $id);
        $instance = new $class();
        $instance->setInstance($row);
        return $instance;
    }

    // get list
    public static function getList($conditions = [], $orders = [])
    {
        // $conditions = [
        //     "name"=>["=","ali"]
        // ];
        $class = get_called_class();
        $rows = DB::getList($class::$table_name);
        $instance = new $class();
        return $instance->multiInstance($rows);
    }

    //create multiple instance in array 

    private function multiInstance($rows)
    {
        $class = get_called_class();
        foreach ($rows as $payload) {
            $obj = new $class;
            $obj->setInstance($payload);
            $array[] =  $obj;
        }
        return $array;
    }

    // create instance

    private function setInstance($payload)
    {
        // $pk = $this->pk;
        // if (!isset($this->$pk)) {
        //     $this->$pk = null;
        // }
        foreach ($payload as $col => $val) {
            $this->$col = $val;
            $this->attributes->$col = $val;
        }

        // return $this;
    }

    // insert validation

    public function validate()
    {
        $this->validteRequire();
        $this->validteAlphabet();
        $this->validateUnique();
        $this->validteLength();
    }
    

    // method

    // validteRequire
    public function validteRequire()
    {
        foreach ($this->rules['required'] as $field) {
            if (empty($this->$field)) {
                $this->errors[$field] = $field . " is Required";
            }
        }
    }
    // validteAlphabet
    public function validteAlphabet()
    {
        foreach ($this->rules['alphabet'] as $field) {
            if (!preg_match("/^[a-zA-Z ]*$/", $this->$field)) {
                $this->errors[$field] = "Only alphabets and white space are allowed";
            }
        }
    }
    // validateUnique
    public  function validateUnique()
    {
        foreach ($this->rules['unique'] as $field) {
            $users = self::getList();
            if (empty($this->id)) {
                foreach ($users as $user) {
                    if ($user->email == $this->$field) {
                        $email = $user->email;
                    }
                }
            } else {
                foreach ($users as $user) {
                    if ($user->email == $this->$field && $user->id != $this->id) {
                        $email = $user->email;
                    }
                }
            }
            if (!empty($email)) {
                $this->errors[$field] = "this $email email already in use";
            }
        }
    }
    // validteLength
    public function validteLength()
    {
        foreach ($this->rules['length'] as $field) {
            if (strlen($this->$field) < 8) {
                $this->errors[$field] = "Password no must contain 8 digits.";
            }
        }
    }

    public static function getAttributeByValue($column, $value, $pk = 0){

    }
}
