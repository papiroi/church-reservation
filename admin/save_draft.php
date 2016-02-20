<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
/*
* include connection string 
* $conn
*/
	include "includes/connect.php";

/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		$username = $_SESSION['username'];
		
	}
	else {
		
		$username = 'Guest';
		header('Location: index.php');
		
	}
	

	$content = $_GET['content'];
	
		// Random Number Generator
		function generateRandomString($length = 10) {
			$characters = '0123456789';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
	$convID = generateRandomString();
	
	$receiver = '';
	
	$status = "0";
	
	$category = "Draft";
	
	$query_draft = "INSERT INTO messages (convID, Content, sender, receiver, dateSent, status, category)
				VALUES ('$convID','$content','$username','$receiver',NOW(),'$status','$category')
				";
				
	$q_query_draft = $conn->query($query_draft);
	
	if($q_query_draft == true) {
		echo "<script>alert('Message Saved to Draft!')</script>";
	}