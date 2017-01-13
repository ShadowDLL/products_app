function saveData(event) {
	// AJAX code to submit form
	event.preventDefault();
	var product = document.getElementById("product").value;
	var qty = document.getElementById("qty").value;
	var price = document.getElementById("price").value;
	var submit = document.getElementById("submit").value;
	
	query = "product=" + product + "&qty=" + qty + "&price=" + price + "&submit=" + submit;
	
	if (product == '' || qty == '' || price == '') {
		alert("Please fill all fields.");
		return false;
	}
	else {
		$.ajax({
			type: "POST",
			url: "save_form.php",	
			cache: false,
			data: query,
			dataType: "text",
			success: function(html) {
				if (html.indexOf("Success") > -1) {
					// refresh the data
					$('#data').load('table.php');
					$('#data-input').get(0).reset();
				}
				else {
					// Escalate the errors, removing all html text
					alert(html.trim());
				}
				
			}
		});
		
	}	
	// return true;
}


