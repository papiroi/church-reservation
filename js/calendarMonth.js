//alert('sample');

function january() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/january.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function february() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/february.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}

function march() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/march.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function april() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/april.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}

function may() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/may.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function june() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/june.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}

function july() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/july.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function august() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/august.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function september() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/september.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function october() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/october.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function november() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/november.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}


function december() {

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
	
	//var queryString = "?content=" + content;
	ajaxRequest.open("GET", "calendar/december.php", true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);

}