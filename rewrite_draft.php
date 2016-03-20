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
		
	}
	else {
		
		$username = 'Guest';
		header('Location: index.php');
		
	}
	
	if(isset($_POST['id']) && !empty($_POST['id'])) {
	
		$id = $_POST['id'];
		$select_msg = "SELECT * FROM messages WHERE convID = '$id'";
		$select_msg_query = $conn->query($select_msg);
		
		while($m_row = $select_msg_query->fetch_assoc()) {
			
			$content = $m_row['Content'];
		
		}
	
	}
	
	
	
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Write - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
	
</head>
<body>

	<div class="container">
		<h1 class="text-center white-text">Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</h1>
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
<!-- Script to send message to admin -->
<!-- Script to send message to admin -->
<!-- Script to send message to admin -->
<?php
	if(isset($_POST['content']) && !empty($_POST['content'])) {
		
		
		//Note: the sender is the user -> $username variable is already declared at the top of the script
		//Set Receiver
		$receiver = $_POST['receipient'];
		
		$find_user = "SELECT * FROM users WHERE username='$receiver'";
		$q_find_user = $conn->query($find_user);
		
		if($q_find_user->num_rows > 0) {
		
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
					
				$q_query_send = $conn->query($query_send);
				
				if($q_query_send == true) {
				
					echo "<script>alert('Message Successfully Send!')</script>";
				
				}
				else {
					
					echo "<script>alert('Opps! Error in Sending Message!')</script>";
					
				}
				
			}
			else {
				
				echo "<script>alert('Receipient User Not Found!');</script>";
				
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
				<div class="compose-receipient">
				<h2 class="white-text">Compose Message to admin</h2>
				
				</div>
				<br/>
				<textarea id="content" name="content" class="form-control compose-text" required autofocus
					title="Content message must not be empty!!!"><?php echo @$content; ?></textarea>
				
				<br/>
				
				<input type="submit" value="Send" class="btn btn-success"/>
				&nbsp;
				<input type="button" value="Save to Draft" class="btn btn-primary" onclick="saveToDraft();"/>
				&nbsp;
				<input type="button" value="Clear" class="btn btn-warning" onclick="fucusontext();"/>
				&nbsp;
				<a href="draft.php" class="btn btn-danger">Cancel</a>
				
			</form>

		</div>
	
	</div>
<?php

	require_once "includes/footer.php";

?>