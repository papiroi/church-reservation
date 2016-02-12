<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
	

/*
* Check if session username or name of the logged in user isset
* if not Guest User 
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		$username = $_SESSION['username'];;
	}
	else {
		$username = "Guest";
	}

/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		// Nothing to do
	}
	else {
		header('Location: index.php');
	}
	

/*
* The Connection String
*
*/

	require_once "includes/connect.php";

?>
<!doctype html>
<html class="full" lang="en-US">
<head>
	<title>Chat - Scheduling and Reservation for Tarlac San Sebastian Cathedral Parish</title>
	
	<?php
		include "includes/head_include.php";
	?>


	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />
	
	<script src="js/chat.js"></script>
</head>
<body onload="retChat();">

	<div class="container">
		
		<h1 class="white-text text-center">Admin Pannel: Chat</h1>
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
		<div class="center-div">
			
			<div class="chat-output" id="outputchat"></div>
			
			<div class="chat-input">
			
				<input type="text" name="inputchat" id="inputchat" class="form-control" />
				<br/>
				<input type="button" value="Send"  name="send" id="send" onclick="sendChat();" class="btn btn-primary" />
				<input type="button" value="Clear" name="clear" id="clear" onclick="clearChat();" class="btn btn-danger" />
			</div>
			
		</div>
	
	</div>
	
	<script>

		setInterval(function(){
		retChat() // this will run after every 5 seconds
		}, 50);
	</script>
<?php


	include "includes/footer.php";
	
?>