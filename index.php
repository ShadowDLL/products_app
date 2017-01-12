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
		
		<form id="data-input" name="form" onsubmit="return saveData(event)"> 
		<div class="form-group row">
	      <label for="product" class="col-sm-2 col-form-label">Product Name *</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="product" placeholder="Product Name (Letters and white space only)" name="product">
	      </div>
	    </div>
	    <div class="form-group row">
	      <label for="qty" class="col-sm-2 col-form-label">Quantity in Stock *</label>
	      <div class="col-sm-6">
	        <input type="text" class="form-control" id="qty" placeholder="Qty in Stock (whole number)" name="qty">
	      </div>
	    </div>
	    <div class="form-group row">
	      <label for="price" class="col-sm-2 col-form-label">Price per Item ($) *</label>
	      <div class="col-sm-4">
	        <input type="text" class="form-control" id="price" placeholder="Price per Item (decimal number)" name="price">
	      </div>
	    </div>
				
		<input class="btn btn-success" id="submit" type="submit" name="submit" value= "Submit"> 
		</form>
		<br>
		<div id="data">
			
		</div>

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