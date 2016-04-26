<?php
	/*
	* reply_send.php
	* use to reply by user
	*/
	
/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

/*
* Page redirection part to login if the user is not logged in
* 
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		


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
		
		$id = $_POST['id'];
		$receiver = $_POST['sender_reply'];
		$sender = $_SESSION['username'];
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
		
		$query_send = "INSERT INTO cached_msg (convID, Content, sender, receiver, dateSent, status, category)
					VALUES ('$convID','$message','$sender','$receiver',NOW(),'$status','$category')
					";
		$query_send2 = "INSERT INTO messages (convID, Content, sender, receiver, dateSent, status, category)
					VALUES ('$convID','$message','$sender','$receiver',NOW(),'$status','$category')
					";

		$q_query_send = $conn->query($query_send);
		
		if($q_query_send == true) {
			$q_query_send2 = $conn->query($query_send2);
			
			echo "<script>";
			echo "alert('Message Sent to Admin');";
			echo "window.location.href = 'reply.php?id=$id';";
			echo "</script>";

			//header("Location: reply.php?id=$id");
		}
		
	}
	else {
		
		header('Location: inbox.php');
		
	}