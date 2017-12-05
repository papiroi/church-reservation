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

	
	include "includes/connect.php";
	
/*
* Page redirection part to login if the admin is not logged in
* 
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		$username = $_SESSION['username'];

	}
	else {

		header ("Location: login.php");

	}
	
	
	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$id = $_GET['id'];
	
		//update the status from 0 to 1 or from undread to read
		$update_read_status = "UPDATE cached_msg 
			SET status='1'
			WHERE convID='$id' AND category='Sent'";
				
		$q_update_read_status = $conn->query($update_read_status);
		
		$update_status = "UPDATE messages SET status = '1' WHERE convID = '$id' AND category = 'Sent'";
		$update_status_query = $conn->query($update_status);
	
	}

	
/*
* Include the connection String
*/
	include_once "includes/connect.php";


?>
<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Reply Message</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="css/background-image.css" />

</head>
<body>
	<div class="container">
		<h1 class="text-center white-text">St. Augustine Parish Church</h1>

<!-- Start of Navigation -->
<?php
/*
* This will show navigation bar menu if there is signed in user or not
*
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		require_once "includes/nav_bar_signed_in.php";
	
	}
	else {
	
		require_once "includes/nav_bar_signed_out.php";
	
	}
?>		
<!--End of Navigation -->		

		<div class="row">
		<div class="col-md-9">
		<div class="center-div">
			<br/>
			<a href="inbox.php" class="btn btn-primary"><< Back to Inbox</a>
			<?php
				// This part of the script will show the message 
				// if there are no message it will display 
				// Error message
				if(isset($_GET['id']) && !empty($_GET['id'])) {
					$messageID = $_GET['id'];
					
					$select_message = "SELECT * FROM cached_msg WHERE convID = '$messageID'";
					$select_message_query = $conn->query($select_message);
					
					while ($row = $select_message_query->fetch_assoc()) {
						
						$sender = $row['sender'];
						$content = $row['Content'];
						$datesent = $row['dateSent'];
						
					}
					
					echo "<h4 class='white-text'>From: $sender</h4>";
					echo "<div class='show-content'><b>Message: $content</b></div>";
					echo "<p>Sent: $datesent</p>";
					
					include "includes/reply_compose.php";
				}
				else {
					
					echo "<h2 class='text-center white-text'>No Message to Display.</h2>";
					
				}
			
			?>
		</div>
		</div>
		</div>
	
	</div>

<?php

	require "includes/footer.php";

?>