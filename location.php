<?php
class Location{
    // database connection and table name
    private $conn;
    private $table_name = "location";
 
    // object properties
    private $id;
    private $name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
				WHERE status = 1
                ORDER BY
                    name";  
 
        $res = $this->conn->query( $query );
        return $res;
    }
 
}
?>