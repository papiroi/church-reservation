<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
/*
* This script is use to send chat message to server
*
*/
	
	$username = $_SESSION['username'];
	
	function generateRandomString($length = 10) {
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
	}
	
	$reference = generateRandomString();
	
	// Import connection String
	include "includes/connect.php";

	$message = $_GET['message'];
	
	
	$send_q = "INSERT INTO chat (message, username, reference, dateReg) 
		VALUES ('$message', '$username', '$reference', NOW())";
	
	$sq = $conn->query($send_q);
	
	if(!$sq) {
		
		echo "<script>";
		echo "alert('Error');";
		echo "</script>";
		
	} 
	else {
		
		echo "OK";
		
	}
	
?>