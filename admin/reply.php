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


?>
<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Reply Message</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">
		<h1 class="white-text">Reply Message</h1>
		<?php
			if(isset($_GET['s']) && $_GET['s'] == 'logout') {
			
			session_destroy();
			
			if($conn) {
				$conn->close();
			}
			
			header("Location: " . $_SERVER['PHP_SELF']);
			
			}
		
			// Include the nav bar for Admin
			require_once "includes/menu.php";
		?>
		<div class="row">
		<div class="col-md-9">
		<div class="center-div">
			<br/>
			<a href="inbox.php" class="btn btn-primary"><< Back to Inbox</a>
			<?php
				// This part of the script will show the message 
				// if there are no message it will display 
				// Error message
				if(isset($_POST['conversation']) && !empty($_POST['conversation'])) {
					$messageID = $_POST['conversation'];
					
					$select_message = "SELECT * FROM messages WHERE MessageID = '$messageID'";
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