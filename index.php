<?php
// reset working variables
$product = $qty = $price = $submit = $totalSum = null;

// check if form is being submitted and grab the variables
if ($_POST) {
	$product = $_POST['product'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$submit = $_POST['submit'];
}

// otherwise, validation might be in progress and the form values will be in get...
else if ($_GET) {
	$product = $_GET['product'];
	$qty =  $_GET['qty'];
	$price = $_GET['price'];
}

// Read in the json file into a multi-array
$json = file_get_contents("products.json");
$data = json_decode($json, true);

if ($submit) {
	// handle form validation
	$errors = "";	
	
	if (!preg_match('/^[A-Za-z\040]+$/i', $product)) {
		$errors .= "Please enter only letters and space for Product Name. \n";
	}
	
	if (!is_numeric($qty)) {
		$errors .= "Please enter an integer for Quantity in Stock.\n";
	}
	
	if (!is_numeric ($price)) {
		$errors .= "Please enter a number for Price per Item.\n";
	}
	
	if ($errors) {
		echo $errors;
	}
	else {
		echo "Success";
		$time = date('Y-m-d H:i:s');
		$id = time();
		
		$data["$id"] = [
				'id' => $id,
				'product' => $product,
				'qty' => $qty,
				'price' => $price,
				'datetime' => $time,
				'total' => $qty * $price
		];
		$data2Json = json_encode($data);
		file_put_contents("products.json", $data2Json);		
		
	}	
	
}

// sort the array in descending order of the key
if ($data) {
	krsort($data);
}



?>

<!DOCTYPE html>
<html>
	<head>
		<title>A simple product management app</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" /> 
    	<link rel="stylesheet" href="assets/css/bootstrap.css" />
    	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="products.js"></script>		
	</head>
	<body>
		<nav class="navbar navbar-default">
		<div class = "container">				 
			<div class="navbar-header">
				  			  		  
			  <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false"> 
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			  </button>
			 <a class="navbar-brand" href="#">ProductsApp</a>
				 
			</div>
								
			<div id="main-nav" class="navbar-collapse collapse" aria-expanded="false">
			  
				<ul class="nav navbar-nav">
					<li role=""><a href="index.php" id="add" >Add Product</a></li>
				</ul>
			</div>
		</div>			
		</nav>
		
	<div class="container">
	<h4>Add a Product to database.</h4> <br>
	<p><span class="text-danger">* required field.</span></p>
	
	<div class="form-group row">
      <label for="product" class="col-sm-2 col-form-label">Product Name *</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="product" placeholder="Product Name (Letters and white space only)" name="product" value="<?=$product?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="qty" class="col-sm-2 col-form-label">Quantity in Stock *</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="qty" placeholder="Qty in Stock (whole number)" name="qty" value="<?= $qty ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="price" class="col-sm-2 col-form-label">Price per Item ($) *</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="price" placeholder="Price per Item (decimal number)" name="price" value="<?= $price ?>">
      </div>
    </div>
		<form id="data-input" name="form" onsubmit="return saveData(event)"> 
		<input class="btn btn-success" id="submit" type="submit" name="submit" value= "Submit"> 
			
	</form>
	<br>
	<?php if ($data):?>
	
		<table class = "table-striped table-boardered table-condensed" border="1" style="width:100%;">
		  <thead>
		    <tr>
		      <th>Product Name</th> 
		      <th>Quantity in Stock</th>
		      <th>Price per Item ($)</th>
			  <th>Datetime Submitted</th>
			  <th>Total Value Number ($)</th>
			  <th>Actions</th>	       
		    </tr>
		  </thead>
		  <tbody>	  
		    <?php foreach ($data as $row):?>
		     <tr>
		       <td><?= $row['product'] ?></td>
		       <td><?= $row['qty']  ?></td>
		       <td><?= $row['price'] ?></td>
		       <td><?= $row['datetime'] ?></td>
		       <td><?= $row['total'] ?></td>
			   <td><a id="<?= $row['id'] ?>" href="#" onclick="editItem()" >Edit</a></td>
		    </tr>
		    <?php $totalSum += $row['total']; ?>
		    <?php endforeach; ?>
		  
		  </tbody>
		  <tfoot>
		    <tr>
		      <th colspan = "4">Total</th> 
		      
			  <th colspan = "2"><?= $totalSum ?></th>
			  
		    </tr>
		  </tfoot>
		  
		</table>
	<?php endif; ?>

	</div>
	
	
	
	<div class = "navbar navbar-bottom">
		<hr>
		<div class="container">
			<h5>Developed on Jan 4, 2017 by Bayode Aderinola | bayodesegun@gmail.com</h5>
		</div>
	</div>
	</body>
	<script>
		$('#data').load('table.php');
	</script>
</html>