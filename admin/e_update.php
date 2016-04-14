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
	
		$id = $_POST['eventid'];
		$name = $_POST['name'];
		$code = $_POST['code'];
		$description = $_POST['description'];
		$reminder = $_POST['reminder'];
	
		$update_e = "UPDATE events SET name='$name', code = '$code', description = '$description', reminder = '$reminder' WHERE eventID = '$id'";
		$update_e_query = $conn->query($update_e);
		
		if($update_e_query) {
		
			$update_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Event Info Updated!</div>";
				
				$select_event = "SELECT * FROM events WHERE eventID = '$id'";
				$select_event_query = $conn->query($select_event);
				
				while($e_row = $select_event_query->fetch_assoc()) {
					
					$event_id = $e_row['eventID'];
					$event_name = $e_row['name'];
					//$event_code = $e_row['code'];
				
				}
		
		}
		else {
		
			$update_msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Failed to Update Record!</div>";
		}
	
	}
	
	if(isset($_POST['id']) && !empty($_POST['id'])) {
	
		$id = $_POST['id'];
		
		$select_event = "SELECT * FROM events WHERE eventID = '$id'";
		$select_event_query = $conn->query($select_event);
		
		while ($e_row = $select_event_query->fetch_assoc()) {
		
			$event_id = $e_row['eventID'];
			$event_name = $e_row['name'];
			//$event_code = $e_row['code'];
			$description = $e_row['description'];
			$reminder = $e_row['reminder'];
		
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

		<h1 class="white-text">Admin Pannel: Edit Event</h1>
		
		
		

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
			<?php echo @$update_msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Update Event Info</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Name:</label>
					<input type="hidden" name="eventid" value="<?php echo @$event_id; ?>" />
					<input type="text" value="<?php echo @$event_name; ?>" class="form-control" id="name" name="name"
						required autofocus placeholder="Name of Event"/>
					<br/>
					<!--<label>Code:</label>
					<input type="text" value="<?php echo @$event_code; ?>" class="form-control" id="code" name="code" placeholder="Code of Event" required />-->
					<br/>
					<label>Description:</label>
					<textarea id="description" name="description" class="form-control"><?php echo @$description; ?></textarea>
					<br/>
					<label>Note: </label>
					<textarea id="reminder" name="reminder" class="form-control"><?php echo @$reminder; ?></textarea>
					<br/>
					<input type="submit" class="btn btn-primary" value="Update" />
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-danger" value="Revert Changes" />
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>