<?php 
// if the form was submitted
if($_POST){
	// include database and object files
	include_once 'config/database.php';
	include_once 'product.php';
	
	// instantiate database and objects
	$database = new Database();
	$db = $database->getConnection();
	
	$product = new ProductDetails($db);
	
    if($product->deleteProductDetails($_REQUEST['product_id'])){
       echo 'true';
    } // if unable to create the product, tell the user
    else{
       echo 'false';
    }
  }
?>
                   