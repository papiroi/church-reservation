<?php
/*
* Start of Tarlac Cathedral Online Reservation and Scheduling
* 
*/

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;


/*
* Include the basepath file
* in the constant BASE
*/
	include "basepath.php";

	
/*
* include connection string
*/
	include "includes/connect.php";

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

	if(isset($_POST['name']) && !empty($_POST['name'])) {
	
		$name = $_POST['name'];
		$code = $_POST['code'];
		$description = $_POST['description'];
		$reminder = $_POST['reminder'];
		
		$add_event = "INSERT INTO events (name, code, description, reminder, dateMod)
			VALUES ('$name','$code','$description','$reminder',NOW())";
			
		$add_event_query = $conn->query($add_event);
		
		if($add_event_query) {
		
			$p_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Event Added!</div>";
			
		}
		else {
		
			$p_msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Error in Adding Event!</div>";
		
		}
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Event Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Add Event</h1>
		
		
		

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
			
			<div class="col-md-7">
			<?php echo @$p_msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Add Event</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Name:</label>
					<input type="text" class="form-control" id="name" name="name"
						required autofocus placeholder="Name to Display"/>
					<br/>
					<label>Code:</label>
					<input type="text" class="form-control" id="code" name="code" placeholder="Unique Code for the Event" required />
					<br/>
					<label>Description:</label>
					<textarea id="desc" name="description" class="form-control" placeholder="Description of the Event" required></textarea>
					<br/>
					<label>Reminder:</label>
					<textarea id="desc" name="reminder" class="form-control" placeholder="Reminder for the Event" required></textarea>
					<br/>
					<input type="submit" class="btn btn-primary" value="Save" />
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-danger" value="Clear" />
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>