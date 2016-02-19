function saveToDraft() {

	//alert("show the alert");
	
	var content = document.getElementById('content').value;
	
	// Fake Notificaton
	alert("Message Save to Draft");
	
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
			var ajaxDisplay = document.getElementById('messages'); //--> The id of the div Element
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	
	var queryString = "?content=" + content;
	ajaxRequest.open("GET", "save_draft.php" + queryString, true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}

function fucusontext() {

	document.getElementById('content').value = "";
	document.getElementById('content').focus();
	
}