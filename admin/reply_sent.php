<?php
	/*
	* reply.php
	* use to reply by admin
	*/
	
/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

/*
* Page redirection part to login if the admin is not logged in
* 
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		if($_SESSION['username'] != 'admin') {

			header ("Location: error_location.php");

		}	
		else {
			// Nothing to do here
		}

	}
	else {

		header ("Location: login.php");

	}

	
/*
* Include the connection String
*/
	include_once "includes/connect.php";

	
	
/*
* get all variables
*/

	if(isset($_POST['sender_reply']) && !empty($_POST['sender_reply'])) {
		
		$receiver = $_POST['sender_reply'];
		$sender = 'admin';
		$message = $_POST['reply_message'];
		
		// Random Number Generator
		function generateRandomString($length = 10) {
			$characters = '0123456789ABCDEFGHIJLKMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		//create conversation ID
		$convID = generateRandomString();
		
		$status = '0';
		$category = 'Sent';
		
		$query_send = "INSERT INTO messages (convID, Content, sender, receiver, dateSent, status, category)
					VALUES ('$convID','$message','$sender','$receiver',NOW(),'$status','$category')
					";
					
		$q_query_send = $conn->query($query_send);
		
		if($q_query_send == true) {
			header('Location: sent_messages.php');
		}
		
	}
	else {
		
		header('Location: inbox.php');
		
	}