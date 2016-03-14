<?php
/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

	// Use to delete reservation
	
	// include string connection
	include_once "includes/connect.php";
	
	if(isset($_POST['reserv_num']) && !empty($_POST['reserv_num'])) {
		
		$reserv_num = $_POST['reserv_num'];
		
	
			
		$delete = "DELETE FROM reservation WHERE reserv_num = '$reserv_num'";
		$delete_query = $conn->query($delete);
			
		if($delete_query) {
			// Message the user the his/her reservation is deleted by admin
			
			echo "<script>alert('Successfully Confirmed!');</script>";
			header('Location: reservations.php');
			
			
			
		}
			
			
	}
		
	else {
		// if there are no post variable are preset
		header('Location: reservations.php');
		
	}
