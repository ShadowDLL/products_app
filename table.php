<?php
// Read in the json file into a multi-array
$json = file_get_contents("products.json");
$data = json_decode($json, true);

$totalSum = null;

// sort the array in descending order of the key
if ($data) {
	krsort($data);
}
?>

<?php if ($data): ?>
		
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