<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
/*
* This script is use to retrieve data from server
* 
*/ 


	//String connection
	include "includes/connect.php";
	
	$select_chat = "SELECT * FROM chat ORDER BY chatID DESC";
	
	$sc_result = $conn->query($select_chat);
	
	if($sc_result->num_rows > 0) {
		
		while ($row = $sc_result->fetch_assoc()) {
			
			echo "<strong>" . $row['username'] . ": </strong>" . $row['message'];
			echo "<br/>";
			
		}
		
	}
	else {
		
		echo "Error: No Message Found In Database!";
		
	}
	
	$conn->close();
?>