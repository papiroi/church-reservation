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
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>Admin Panel - Scheduling and Reservation System for Tarlac San Sebastian Cathedral Parish</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="../css/background-image.css" />
	
	
</head>
<body>

	<div class="container">

		<h1 class="white-text">Admin Panel</h1>
<!-- Start of Navigation -->
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
<!--End of Navigation -->

		<!-- Start of Div of Compose Message -->
		<div class="center-div">
		<div id="messages"></div>
			<h2 class="white-text">Compose Message</h2>
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
				
				
				$send_copy = "INSERT INTO cached_msg (convID, Content, sender, receiver, dateSent, status, category)
					VALUES ('$convID','$content','$username','$receiver',NOW(),'$status','$category')";
				
				if($q_query_send == true) {
				
					$send_copy = $conn->query($send_copy);
				
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
				<label for="receipient">Receipient:</label>
				<input type="text" id="receipient" name="receipient" class="form-control" required 
					title="You Must Enter the Username of the receipient!!!" />
				</div>
				<br/>
				<textarea id="content" name="content" class="form-control compose-text" required autofocus
					title="Content message must not be empty!!!"></textarea>
				
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

	require_once "includes/footer.php";

?>