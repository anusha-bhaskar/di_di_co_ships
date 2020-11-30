<?php
class Unit{
    // database connection and table name
    private $conn;
    private $table_name = "unit";
 
    // object properties
    private $slug;
    private $name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    slug, name
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