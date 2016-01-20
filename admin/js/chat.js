function clearChat() {

	document.getElementById('inputchat').value = "";
	document.getElementById('inputchat').focus();
	
}

function sendChat() {
	
	//alert("Message Sent.");
	
	var ajaxRequest;  // The variable that makes Ajax possible!
	var message = document.getElementById('inputchat').value;
	
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
			var ajaxDisplay = document.getElementById(''); //--> The id of the div Element
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	
	var queryString = "?message=" + message;
	ajaxRequest.open("GET", "chat_send.php" + queryString, true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);
	
	document.getElementById('inputchat').value = "";
	document.getElementById('inputchat').focus();
	
}


function retChat() {
	
	//alert("Message Sent.");
	
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
			var ajaxDisplay = document.getElementById('outputchat'); //--> The id of the div Element
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	

	ajaxRequest.open("GET", "chat_live.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);
	
	
}