<?php

use LDAP\Result;

require_once("DB.php");
class Model
{
    // properties

    protected static $table_name = "";
    protected $id = "";
    public $attributes;
    public $rules = ["required" => [], "unique" => []];
    protected static $primary_key = "id";


    // methods


    // constructer

    public function __construct()
    {
        // $this->table_name="";
        // $this->pk = "";
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
        $this->setInstance($payload);
        $this->validate();
        if (empty($this->errors)) {
            // $res = DB::insert($table, $payload);
            // $this->setInstance($res);


            $res = DB::update($table, $this->id, $payload);
            $this->setInstance($res);
        }


        // $table = get_class($this)::$table_name;
        // $this->validation($payload, $this->id);


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
     
        if(is_array($payload)){
            foreach ($payload as $col => $val) {
                $this->$col = $val;
                $this->attributes->$col = $val;
            }
        }

        return $this;
    }

    // insert validation

    public function validate()
    {
        $this->validteRequire();             
        $this->validteAlphabet();
        $this->validateUnique();
        $this->validteLength();
        return $this;
    }


    // method

    // validteRequire
    public function validteRequire()
    {
        foreach ($this->rules['required'] as $field => $value) {
                if(is_string($field)){
                    if (empty($this->$field)) {
                        $this->errors[$field] = $value;
                    }
                }
                else{
                    if (empty($this->$value)) {
                        $this->errors[$value] = $value . " is Required";
                    }
                    
                }

        }
    }
    // validteAlphabet
    public function validteAlphabet()
    {
        
        foreach ($this->rules['alphabet'] as $field=>$value) {
            if(is_string($field)){
                if (!preg_match("/^[a-zA-Z ]*$/", $this->$field)) {
                    $this->errors[$field] = $value;
                }
            }
            else{
                if (!preg_match("/^[a-zA-Z ]*$/", $this->$value)) {
                    $this->errors[$value] = "Only alphabets and white space are allowed";
                }
            }
            // if (!preg_match("/^[a-zA-Z ]*$/", $this->$value)){
            //     $this->errors[$value] = "Only alphabets and white space are allowed";
            // }
        }
    }
    // validateUnique
    public  function validateUnique()
    {
        $pk_column = $this->getPrimaryKeyColumn();
       
        foreach ($this->rules['unique'] as $field =>$value) {
            if(is_string($field)){
                $model =  self::getAttributeByValue($field, $this->$field, $this->$pk_column);
                if(!empty($model->$pk_column)){
                    $this->errors[$field] = $value;
                } 
            }
            else{
                $model =  self::getAttributeByValue($field, $this->$value, $this->$pk_column);
                if(!empty($model->$pk_column)){
                  
                    $this->errors[$value] = " this '" . $this->$value . "' $value already in use";
                }
            }
            
        }
    }
    // validteLength
    public function validteLength()
    {

        foreach ($this->rules['length'] as $field => $value) {
            foreach ($value as $key => $data) {
                if($key == "max"){
                    if(is_array($data)){
                        foreach($data as $subkey => $value){
                            $max = $value;
                            $valueKey = $subkey; 
                        }
                        
                        if (strlen($this->$field) > $valueKey) {
                            $this->errors[$field] = $max;
                        }
                    }
                    else{
                        $max = $data;
                        if (strlen($this->$field) > $max) {
                            $this->errors[$field] = "The maximum length of $field must $max characters";
                        }

                    }
                }
                else{
                    if(is_array($data)){
                        foreach($data as $subkey => $value){
                            $min = $value;
                            $valueKey = $subkey; 
                        }
                        if (strlen($this->$field) < $valueKey) {
                            $this->errors[$field] = $min;
                        }
                    }
                    else{
                        $min = $data;
                        if (strlen($this->$field) < $min) {
                            $this->errors[$field] = "The maximum length of $field must $min characters";
                        }

                    }
                }
                
            }    
        }
    }
    public static function getAttributeByValue($column, $value, $pk = null)
    {

        $class = self::getCalledClass();
        $pk_column = $class::$primary_key;
        $row = DB::getAttributeByValue($class::$table_name, $column, $value, $pk, $pk_column);
        $instance = new $class();
        $instance->setInstance($row);
        return $instance;
    }

    private function getPrimaryKeyColumn(){
        $class = get_called_class();
        $pk_column = $class::$primary_key;
        return $pk_column;
    }

    private function getTableName(){
        $class = get_called_class();
        
        $pk_column = $class::$table_name;
        return $pk_column;
    }

    private static function getCalledClass(){
        return get_called_class();
    }
}
