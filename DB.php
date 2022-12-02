<?php
class DB{

    // properties

    private static $_host = '172.17.0.2';
    private static $_username = 'root';
    private static $_password = 'admin';
    private static $_database = 'db1';
    static protected $connection;

    // Methods

// make connection

    private static function startConnection(){
        self::$connection =  new mysqli(self::$_host, self::$_username, self::$_password,self::$_database); 
        
    }
    // close connection

    private static function closeConnection(){
        self::$connection->close();
    }
// insert data


    public static function insert($table, $payload){
        $sql = "INSERT INTO {$table} SET ";
        $query = [];
        foreach($payload as $col=>$val){
            $query[] = $col."='".$val."'";
        }
        $sql.= implode(",", $query);
        self::startConnection();
        mysqli_query(self::$connection,$sql);
        $pk = mysqli_insert_id(self::$connection);
        self::closeConnection();
        $payload['id'] = $pk;
      
        return $payload;
    }
// update connection

    public static function update($table, $id, $payload){
        $args = [];
        foreach ($payload as $key => $value) {
            $args[] = "$key = '$value'"; 
        }
        $data  = implode(',',$args);
        $sql="UPDATE  {$table} SET $data WHERE id='$id' ";
        self::startConnection();
        mysqli_query(self::$connection,$sql);
        // $pk = mysqli_insert_id(self::$connection);
        self::closeConnection();
        return $payload;
    }
// delete connection

    public static function delete($table,$id){
        
        $sql="DELETE FROM $table WHERE id='$id'";
        self::startConnection();
        mysqli_query(self::$connection,$sql);
        self::closeConnection();
    }
// get data connection

    public static function get($table ,$id){
        $sql = "Select * from $table where id = $id";
        self::startConnection();
        $result =  mysqli_query(self::$connection,$sql);
        $row =  mysqli_fetch_assoc($result);
        self::closeConnection();
        return $row;
    }
    public static function getList($table){
        $sql = "Select * from $table";
        self::startConnection();
        $result =  mysqli_query(self::$connection,$sql);
        $rows =  mysqli_fetch_all($result,MYSQLI_ASSOC);
        self::closeConnection();
        return $rows;
    }
}
?>