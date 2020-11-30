<?php
// set page header
$page_title = "Read Products";
include_once "header.php";

// set page no, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 3;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'config/database.php';
include_once 'product.php';
 
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$product = new ProductDetails($db);
 
// query products
$data = $product->readAll($from_record_num, $records_per_page);
$num = $data->num_rows;

echo "<a href='create_product.php' class='btn btn-primary float-right'>Create Product</a></br></br>";
if($num > 0){ 
	echo '<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Location</th>
				<th>Weight</th>
				<th>Dimensions</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>';
	while($row = $data->fetch_assoc()) {
		extract($row);	
		echo "<tr>";
		echo "<td>{$name}</td>";
		echo "<td>{$locationName}</td>";
		echo "<td>{$weight} {$weightUnit}</td>";
		echo "<td>{$length} {$lengthUnit} x {$width} {$widthUnit} x {$height} {$heightUnit}</td>";
		echo "<td><a href='update_product.php?id={$id}' class='btn btn-info left-margin'>Edit</a>
				  <a delete-id='{$id}' class='btn btn-danger delete-object'>Delete</a>
			 </td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
	// the page where this paging is used
	$page_url = "index.php?";
	 
	// count all products in the database to calculate total pages
	$total_rows = $product->countAll();
	 
	// paging buttons here
	include_once 'pagination.php';
} else {
	echo "<div class='alert alert-info'>No products found.</div>";
}
// set page footer
include_once "footer.php";
?>
<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
	if(confirm("Are you sure you want to delete this?")){
		var id = $(this).attr('delete-id');
		var $ele = $(this).parent().parent();
		$.ajax({
		type:'POST',
		url:'delete_product.php',
		data:{product_id:id},
		success: function(data){
			 if(data){
				 alert("Product deleted successfully");
				 window.location = "index.php";
			 } else {
				 alert("can't delete the product");
			 }
		}

		 })
	} else {
        return false;
    }
    return false;
});
</script>