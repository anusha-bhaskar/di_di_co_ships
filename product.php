<?php
class Product{
 
    // database connection and table name
    protected $conn;
    private $table_name = "product";
 
    // object properties
    private $name;
	private $description;
	private $dateAdded;
	private $dateModified;
 
    public function __construct($db){
        $this->conn = $db;
    }
	
	public function setProduct($data){
		$this->name = htmlspecialchars(strip_tags($data['name']));
		$this->locationId = htmlspecialchars(strip_tags($data['locationId']));
		$this->description = htmlspecialchars(strip_tags($data['description']));
		$this->dateModified = date('Y-m-d H:i:s');
		if(isset($data['id']) && $data['id']){
			//update product
			$query = "UPDATE ".$this->table_name." SET name=?, description=?, locationId=?, dateModified=? WHERE id=?";
			$res = $this->conn->prepare($query);
			$res->bind_param("ssisi", $this->name, $this->description, $this->locationId, $this->dateModified, $data['id']);
			if($res->execute()){
				return true;
			}else{
				return false;
			}
		} else {
			$this->dateAdded = date('Y-m-d H:i:s');
			//insert product
			$query = "INSERT INTO ".$this->table_name." (name, description, locationId, dateAdded, dateModified) VALUES  (?, ?, ?, ?, ?)";
			$res = $this->conn->prepare($query); 
			$res->bind_param("ssiss", $this->name,$this->description, $this->locationId,$this->dateAdded,$this->dateModified);
			if($res->execute()){
				return $this->conn->insert_id;
			}else{
				return false;
			}
		}
	}
	
	function deleteProduct($product_id){
		//delete product details
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
		$res = $this->conn->prepare($query);
		$res->bind_param("i", $product_id);
	 
		if($result = $res->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// used for paging products
	public function countAll(){
		$query = "SELECT id FROM " . $this->table_name . "";
		$res = $this->conn->query( $query );
		$num = $res->num_rows;
		return $num;
	}
}


class ProductDetails Extends Product{
 
    // database connection and table name
    private $table_name = "product_details";
 
    // object properties
    private $product_id;
	private $weight, $weightUnit;
	private $width, $widthUnit;
	private $height, $heightUnit;
	private $length, $lengthUnit;
 
	public function setProductDetails($data){
		$this->name = htmlspecialchars(strip_tags($data['name']));
		$this->description = htmlspecialchars(strip_tags($data['description']));
		$this->dateAdded = date('Y-m-d H:i:s');
		$this->dateModified = date('Y-m-d H:i:s');
		$this->weight = htmlspecialchars(strip_tags($data['weight']));
		$this->weightUnit = htmlspecialchars(strip_tags($data['weightUnit']));
		$this->width = htmlspecialchars(strip_tags($data['width']));
		$this->widthUnit = htmlspecialchars(strip_tags($data['widthUnit']));
		$this->height = htmlspecialchars(strip_tags($data['height']));
		$this->heightUnit = htmlspecialchars(strip_tags($data['heightUnit']));
		$this->length = htmlspecialchars(strip_tags($data['length']));
		$this->lengthUnit = htmlspecialchars(strip_tags($data['lengthUnit']));
		if(isset($data['id']) && $data['id']){
			if($this->setProduct($data)){
				//update product details
				$query = "UPDATE ".$this->table_name." SET weight=?, weightUnit=?, width=?, widthUnit=?, height=?, heightUnit=?, length=?, lengthUnit=?, dateModified=? WHERE product_id = ?";
				$res = $this->conn->prepare($query);
				$res->bind_param("sssssssssi", $this->weight, $this->weightUnit, $this->width,$this->widthUnit, $this->height, $this->heightUnit, $this->length, $this->lengthUnit,$this->dateModified, $data['id']);
			}
		} else {
			//insert product
			$this->product_id = $this->setProduct($data);
			if($this->product_id){
				$query = "INSERT INTO ".$this->table_name." (product_id, weight, weightUnit, width, widthUnit, height, heightUnit, length, lengthUnit, dateAdded, dateModified) VALUES  (?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?)";
				$res = $this->conn->prepare($query);
				$res->bind_param("sssssssssss", $this->product_id,$this->weight, $this->weightUnit, $this->width,$this->widthUnit, $this->height, $this->heightUnit, $this->length, $this->lengthUnit,$this->dateAdded,$this->dateModified);				
			}
		}
		if($res->execute()){
			return true;
		}else{
			return false;
		}
	}
 
    function readAll($from_record_num, $records_per_page){
		$query = "SELECT
					p.id, p.name, p.description, pd.weight, pd.weightUnit, pd.length, pd.lengthUnit, pd.width, pd.widthUnit,pd.height, pd.heightUnit, loc.name as locationName
				FROM product as P
				LEFT JOIN " . $this->table_name . " as pd
				ON p.id = pd.id
				LEFT JOIN location as loc
				ON p.locationId = loc.id
				ORDER BY
					p.dateAdded DESC
				LIMIT
					{$from_record_num}, {$records_per_page}";
	 
		$res = $this->conn->query( $query );
		return $res;
	}
	
	function readOne($product_id){
		$query = "SELECT
					p.id, p.name, p.locationId, p.description, pd.weight, pd.weightUnit, pd.length, pd.lengthUnit, pd.width, pd.widthUnit,pd.height, pd.heightUnit
				FROM product as P
				LEFT JOIN " . $this->table_name . " as pd
				ON p.id = pd.id
				WHERE p.id = {$product_id}
				LIMIT 0,1";
	 
		$res = $this->conn->query($query);
		return $res;
	}
	
	function deleteProductDetails($product_id){
		//delete product details
		$query = "DELETE FROM " . $this->table_name . " WHERE product_id = ?";
		$res = $this->conn->prepare($query);
		$res->bind_param("i", $product_id);
	 
		if($result = $res->execute()){
			//delete product details
			$this->deleteProduct($product_id);
			return true;
		}else{
			return false;
		}
	}
}
?>