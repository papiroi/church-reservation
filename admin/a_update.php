<?php
/*
* Start of St. Augustine Parish Church Online Reservation and Scheduling
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
	
	if(isset($_POST['title']) && !empty($_POST['title'])) {
	
		$id = $_POST['aboutid'];
		$title = $_POST['title'];
		$desc = $_POST['desc'];
		
		$update_about = "UPDATE about SET title = '$title', description = '$desc' WHERE aboutID = '$id'";
		$update_about_query = $conn->query($update_about);
		
		if($update_about_query) {
		
			$update_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Details Updated!</div>";
				
					//$id = $_POST['aboutid'];
		
					$select_about = "SELECT * FROM about WHERE aboutID = '$id'";
					$select_about_query = $conn->query($select_about);
					
					while($a_row = $select_about_query -> fetch_assoc()) {
					
						$aboutid = $a_row['aboutID'];
						$title = $a_row['title'];
						$description = $a_row['description'];
					
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
		
		$select_about = "SELECT * FROM about WHERE aboutID = '$id'";
		$select_about_query = $conn->query($select_about);
		
		while($a_row = $select_about_query -> fetch_assoc()) {
		
			$aboutid = $a_row['aboutID'];
			$title = $a_row['title'];
			$description = $a_row['description'];
		
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

		<h1 class="white-text">Admin Pannel: Update Event</h1>
		
		
		

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
				<h2 class='white-text'>Update Abouts Details</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Title:</label>
					<input type="hidden" name="aboutid" value="<?php echo @$aboutid; ?>" />
					<input type="text" value="<?php echo @$title; ?>" class="form-control" id="title" name="title"
						required autofocus placeholder="Title of Event"/>
					<br/>
					<label>Description:</label>
					<textarea class="form-control" cols="" rows="8" name="desc" id="desc"><?php echo @$description; ?></textarea>
					<br/>
					<input type="submit" class="btn btn-primary" value="Update" />
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-danger" value="Revert" />
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>