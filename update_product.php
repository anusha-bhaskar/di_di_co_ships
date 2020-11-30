<?php 

// include database and object files
include_once 'config/database.php';
include_once 'product.php';
include_once 'unit.php';
include_once 'location.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$product = new ProductDetails($db);
// if the form was submitted
if($_POST){
    // set product property values
	if($product->setProductDetails($_REQUEST)){
        echo "<div class='alert alert-success'>Product was updated.</div>";
    } // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to update product.</div>";
    }
  }
?>
<?php 
	// get ID of the product to be edited
	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
	
	// read the details of product to be edited
	$productRes = $product->readOne($id);
	$data = $productRes->fetch_assoc();
	
	$unit = new Unit($db);
	// read the unit from the database
	$unitRes = $unit->read();
	// put them in a select drop-down
	$unitData = $unitRes->fetch_all(MYSQLI_ASSOC);
	
	// read the location from the database
	$location = new Location($db);
	$locationRes = $location->read();
	$locationData = $locationRes->fetch_all(MYSQLI_ASSOC);
	//echo "<pre>";print_r($locationData);exit;
	
	function setUnitDropdown($unitSlug){
		$returnHtml = '';
		$unitData = $GLOBALS['unitData'];
		foreach($unitData as $key=>$val){
			if($val["slug"] == $unitSlug){
				$returnHtml .=  "<option value='{$val["slug"]}' selected>{$val["name"]}</option>";
			} else {
				$returnHtml .=  "<option value='{$val["slug"]}'>{$val["name"]}</option>";
			}
		}
		return $returnHtml;
	}
	// set page header
	$page_title = "Update Products";
	include_once "header.php";
?>
<a href='index.php' class='btn btn-primary float-right'>Read Products</a></br></br>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]. "?id={$data['id']}");?>" method="post">
	    <div class="form-group row">
            <label for="productName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $data['name'];?>" class="form-control" id="name" name="name" placeholder="Name" required>
            </div>
        </div>
		<div class="form-group row">
            <label for="locationName" class="col-sm-2 col-form-label">Location</label>
            <div class="col-sm-10">
                <select class='form-control' name='locationId' id="locationId" required>
				<option value=''>Select Location...</option>
				<?php foreach($locationData as $key=>$val){ ?>
					<option value='<?php echo $val["id"];?>' <?php if($val["id"] == $data['locationId']) {echo "selected";}?>><?php echo $val["name"];?></option>
				<?php } ?>	
				</select>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
				<textarea class="form-control" id="description" name="description" placeholder="Description"><?php echo $data['description'];?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="weight" class="col-sm-2 col-form-label">Weight</label>
            <div class="col-sm-3">
                <input value="<?php echo $data['weight'];?>" type="text" class="form-control" id="weight" name="weight" placeholder="Weight" required>
            </div>
			<label for="weightUnit" class="col-sm-2 col-form-label">Weight Unit</label>
            <div class="col-sm-3">
				<select class='form-control' name='weightUnit' id="weightUnit" required>
					<option>Select unit...</option>
					<?php echo setUnitDropdown($data['weightUnit']);?>
				</select>
			</div>
        </div>
		<div class="form-group row">
            <label for="length" class="col-sm-2 col-form-label">Length</label>
            <div class="col-sm-3">
                <input value="<?php echo $data['length'];?>" type="text" class="form-control" id="length" name="length" placeholder="Length" required>
            </div>
			<label for="lengthUnit" class="col-sm-2 col-form-label">Length Unit</label>
            <div class="col-sm-3">
				<select class='form-control' name='lengthUnit' id="lengthUnit" required>
					<option value=''>Select unit...</option>
					<?php echo setUnitDropdown($data['lengthUnit']);?>
				</select>
			</div>
        </div>
		<div class="form-group row">
            <label for="width" class="col-sm-2 col-form-label">Width</label>
            <div class="col-sm-3">
                <input value="<?php echo $data['width'];?>" type="text" class="form-control" id="width" name="width" placeholder="Width" required>
            </div>
			<label for="widthUnit" class="col-sm-2 col-form-label">Width Unit</label>
            <div class="col-sm-3">
				<select class='form-control' name='widthUnit' id="widthUnit" required>
					<option value=''>Select unit...</option>
					<?php echo setUnitDropdown($data['widthUnit']);?>
				</select>
			</div>
        </div>
		<div class="form-group row">
            <label for="height" class="col-sm-2 col-form-label">Height</label>
            <div class="col-sm-3">
                <input value="<?php echo $data['height'];?>" type="text" class="form-control" id="height" name="height" placeholder="Height" required>
            </div>
			<label for="heightUnit" class="col-sm-2 col-form-label">Height Unit</label>
            <div class="col-sm-3">
				<select class='form-control' name='heightUnit' id="heightUnit" required>
					<option value=''>Select unit...</option>
					<?php echo setUnitDropdown($data['heightUnit']);?>
				</select>
			</div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php
	// set page footer
include_once "footer.php";
?>                      