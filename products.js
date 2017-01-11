function saveData() {
	// AJAX code to submit form
	
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
			url: "index.php",	
			cache: false,
			data: query,
			dataType: "text",
			success: function(html) {
				if (html.includes("Success")) {
					// No errors: go home
					document.getElementById("add").click();
				}
				else {
					// Escalate the errors, removing all html text
					alert(html.substring(0, html.indexOf('<!DOCTYPE')).trim());
				}
				
			}
		});
		
	}	
	return true;
}


