function showEvent(day) {

	//alert("The day is " + day)

	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('calendar'); //--> The id of the div Element
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	
	var queryString = "?day=" + day;
	ajaxRequest.open("GET", "showEvent.php" + queryString, true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);
}