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
	// return the error messages(s)
	echo $errors;
}
else {
	// Read in the json file into a multi-array
	$json = file_get_contents("products.json");
	$data = json_decode($json, true);
	
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

	// Save the data back to file
	$data2Json = json_encode($data);
	file_put_contents("products.json", $data2Json);	

	// return success message to calling Ajax	
	echo "Success";	
	
}	
