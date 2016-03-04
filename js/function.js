function showEvent(day,month) {

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
	
	var queryString = "?day=" + day + "&month=" + month;
	ajaxRequest.open("GET", "showEvent.php" + queryString, true); // --> Name of php script + plus query string if any
	ajaxRequest.send(null);
}

function goBack() {
    window.history.back();
}


function viewReservation() {
	
	
	$("#review").show();


	var eventtype = document.getElementById('eventtype').value;
	var bapType = document.getElementById('bap-type').value;
	var priest = document.getElementById('priest').value;
	var eventDate = document.getElementById('dateselect').value;
	var eventTime = document.getElementById('timeselect').value;
	
	if(bapType == 'Ordinary') {
		eventTime = "5";
	}
	else {
		if(eventTime == '') {
			//alert("Time Must Not Be Empty");
			eventTime = document.getElementById('timeselect').fucus();
		}
	}
	
	document.getElementById('event_review').value = eventtype;
	document.getElementById('priest_review').value = priest;
	document.getElementById('date_review').value = eventDate;
	document.getElementById('bap-type_review').value = bapType;
	document.getElementById('time_review').value = timeSelect(eventTime);

	
	return false;
}

function timeSelect(time) {
	var time_final = "";
	
	if(time == '1') {
		time_final = "8:00am";
	}
	else if(time == '2') {
		time_final = "9:00am";
	}
	else if(time == '3') {
		time_final = "10:00am";
	}
	else if(time == '4') {
		time_final = "11:00am";
	}
	else if(time == '5') {
		time_final = "12:00pm";
	}
	else if(time == '6') {
		time_final = "1:00pm";
	}
	else if(time == '7') {
		time_final = "2:00pm";
	}
	else if(time == '8') {
		time_final = "3:00pm";
	}
	else if(time == '9') {
		time_final = "4:00pm";
	}
	else if(time == '10') {
		time_final = "5:00pm";
	}
	
	
	return time_final;
	
}

function closeReview() {
	
	$(function() {
		$("#review").hide();
	});
	
}



function closePending() {
	
	$(function() {
		$("#pending_status_div").hide(100);
	});
	
}


function clearInput() {
	
	document.getElementById('eventtype').value = "";
	document.getElementById('bap-type').value = "Special";
	document.getElementById('priest').value = "Any";
	document.getElementById('dateselect').value = "";
	document.getElementById('timeselect').value = "";
	
	$("#bap-type").hide();
	
	$("#priest").show();
	$("#lblpriest").show();
	$("#lbltimeselect").show();
	$("#timeselect").show();
	
}

function validateForm() {
	
	//alert("validate from");
	
	viewReservation();
	
	var confirmation = confirm("Are you sure you want to submit?");
	
	if(confirmation == true) {
		return true;
	}
	else {
		closeReview();
		return false;
	}
	
}