<?php
class DB{

    public $path;

    public function __construct()
   {
        $this->path = __DIR__ . '/.env';
       if(!file_exists($this->path)) {
           throw new \InvalidArgumentException(sprintf('%s does not exist', $this->path));
       }
   }

   public function load() 
   {
       if (!is_readable($this->path)) {
           throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
       }
       
       $lines = file($this->path);
       foreach ($lines as $line) {

           list($name, $value) = explode('=', $line, 2);
           $name = trim($name);
           $value = trim($value);

           if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
               putenv(sprintf('%s=%s', $name, $value));
               $_ENV[$name] = $value;
               $_SERVER[$name] = $value;
           }
       }
   }
    // properties
    
    private static $_host = "";
    private static $_username = "";
    private static $_password = '';
    private static $_database = '';
    static protected $connection;

    // Methods

// make connection
    

    private static function startConnection(){
        $class = get_called_class();
        $laod = new $class();
        $laod->load();
        self::$_host = getenv('server_name');
        self::$_username = getenv('username');
        self::$_password = getenv('password');
        self::$_database = getenv('dbname');
        
        // self::$_database=
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
    public static function getList($table,$par=null){
        // print_r($condition);
        // die;
        $sql = "Select * from $table ";
        if($par != null){
            if(isset($par['condition']) && !isset($par['operator'])){
                foreach($par['condition'] as $col=>$value){
                    $query = " where ". $col."'$value'";
                }
                $sql .= $query;
                
            }
           if(isset($par['operator'])){
                foreach($par['condition'] as $col=>$value){
                    $query[] =  $col."'$value'";
                }
                $operator = $par['operator'];
                $sql .= " WHERE ".implode(" $operator ",$query);
           }
           if(isset($par['order_by'])){
            $order = $par['order_by'];
            $sql .= " order by $order";
            
           }
    
        }

        self::startConnection();
        $result =  mysqli_query(self::$connection,$sql);
        $rows =  mysqli_fetch_all($result,MYSQLI_ASSOC);
        self::closeConnection();
        return $rows;
    }
    public static function getAttributeByValue($table,$column,$value, $pk, $pk_column){
         $sql = "Select * from $table where $column='$value'";
        if(!empty($pk) &&  $pk > 0){
            $sql.=" AND {$pk_column} <> $pk";
        }
        self::startConnection();
        $result =  mysqli_query(self::$connection,$sql);
        $row =  mysqli_fetch_assoc($result);
        self::closeConnection();
        return $row;
    }
}
