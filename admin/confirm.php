<?php
/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

	// user to confirm the reservation reqquest of the user
	
	// include string connection
	include_once "includes/connect.php";
	
	if(isset($_POST['reserv_num']) && !empty($_POST['reserv_num'])) {
		
		$reserv_num = $_POST['reserv_num'];
		
		$select_reserv = "SELECT * FROM reservation";
		
		$select_reserv_query = $conn->query($select_reserv);
		
		if($select_reserv_query->num_rows > 0) {
			//The record is present
			//ok
			//no errors
			
			$confirmation = "UPDATE reservation SET confirmation='Confirmed' WHERE reserv_num = '$reserv_num'";
			$confirmation_query = $conn->query($confirmation);
			
			if($confirmation_query) {
				echo "<script>alert('Successfully Confirmed!');</script>";
				header('Location: reservations.php');
			}
			
			
		}
		
		
	}
	else {
		// if there are no post variable are preset
		header('Location: reservations.php');
		
	}
