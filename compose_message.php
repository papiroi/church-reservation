<?php
/*
* Compose Messages Page
* 
*/


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

		if($username == 'admin') {

			header('Location: admin/index.php');

		}
		
	}
	else {
		
		$username = 'Guest';
		
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Compose Messages - St. Augustine Parish Church</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
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

		<!-- Start of Div of Compose Message -->
		<div class="messages">
		<div id="messages"></div>
			<h2 class="white-text">Compose Message to admin</h2>
<!-- Script to send message to admin -->
<!-- Script to send message to admin -->
<!-- Script to send message to admin -->
<?php
	if(isset($_POST['content']) && !empty($_POST['content'])) {
		
		
		//Note: the sender is the user -> $username variable is already declared at the top of the script
		//Set Receiver
		$receiver = 'admin';
		
		$content = $_POST['content'];
		
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
		
		$status = "0";
		
		$category = "Sent";
		
		

			$query_send = "INSERT INTO messages (convID, Content, sender, receiver, dateSent, status, category)
				VALUES ('$convID','$content','$username','$receiver',NOW(),'$status','$category')
				";
				
			$query_send_copy = "INSERT INTO cached_msg (convID, Content, sender, receiver, dateSent, status, category)
				VALUES ('$convID','$content','$username','$receiver',NOW(),'$status','$category')
				";
				
			$q_query_send = $conn->query($query_send);
			
			if($q_query_send == true) {
			
				$qsc = $conn->query($query_send_copy);
				echo "<script>alert('Message Successfully Sent to Admin!')</script>";
			
			}
			else {
				
				echo "<script>alert('Opps! Error in Sending Message!')</script>";
				
			}
	}
	else {
		//echo "<script>alert('Opps! Empty Message not Allowed!')</script>";
	}

?>
<!-- end of Script to send message to admin -->
<!-- end of Script to send message to admin -->
<!-- end of Script to send message to admin -->
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
				<textarea id="content" name="content" class="form-control compose-text" autofocus required
					title="Empty Message Will Not Allow!"></textarea>
				
				<br/>
				
				<input type="submit" value="Send" class="btn btn-success"/>
				&nbsp;
				<input type="button" value="Save to Draft" class="btn btn-primary" onclick="saveToDraft();"/>
				&nbsp;
				<input type="button" value="Clear" class="btn btn-danger" onclick="fucusontext();"/>
				
			</form>

		</div>
	
	</div>
<?php

	include "includes/include_contacts.php";

	require_once "includes/footer.php";

?>