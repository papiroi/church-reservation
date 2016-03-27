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
	
	if(isset($_POST['title']) && !empty($_POST['title'])) {
	
		@$id = $_POST['aboutid'];
		$title = $_POST['title'];
		$mon = $_POST['monday'];
		$tue = $_POST['tuesday'];
		$wed = $_POST['wednesday'];
		$thu = $_POST['thursday'];
		$fri = $_POST['friday'];
		$sat = $_POST['saturday'];
		$sun = $_POST['sunday'];
		
		$update_about = "UPDATE about SET title = '$title' WHERE aboutID = '$id'";
		$update_about_query = $conn->query($update_about);
		
		$update_sched = "UPDATE mass SET
			monday = '$mon',
			tuesday = '$tue',
			wednesday =  '$wed',
			thursday = '$thu',
			friday = '$fri',
			saturday = '$sat',
			sunday = '$sun'
			WHERE schedID = '1'";
		$update_sched_query = $conn->query($update_sched);
		
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
					
					}
					$select_sched = "SELECT * FROM mass WHERE schedID = '1'";
					$select_sched_query = $conn->query($select_sched);
					
					while($srow = $select_sched_query->fetch_assoc()) {
					
						$mon0 = $srow['monday']; 
						$tue0 = $srow['tuesday']; 
						$wed0 = $srow['wednesday']; 
						$thu0 = $srow['thursday']; 
						$fri0 = $srow['friday']; 
						$sat0 = $srow['saturday']; 
						$sun0 = $srow['sunday']; 
					
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
		
		}
		
		$select_sched = "SELECT * FROM mass WHERE schedID = '1'";
		$select_sched_query = $conn->query($select_sched);
		
		while($srow = $select_sched_query->fetch_assoc()) {
		
			$mon0 = $srow['monday']; 
			$tue0 = $srow['tuesday']; 
			$wed0 = $srow['wednesday']; 
			$thu0 = $srow['thursday']; 
			$fri0 = $srow['friday']; 
			$sat0 = $srow['saturday']; 
			$sun0 = $srow['sunday']; 
		
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
					
					<input type="text" value="<?php echo @$title; ?>" class="form-control" id="title" name="title"
						required autofocus placeholder="Title of Event"/>
					<br/>
					<label>Monday:</label>
					<input type="text" value="<?php echo @$mon0 ;?>" id="monday" name="monday" class="form-control" required placeholder="Time Schedule or Notes"/>
					<br/>
				
					<label>Tuesday:</label>
					<input type="text" value="<?php echo @$tue0 ;?>" id="tuesday" name="tuesday" class="form-control" required  placeholder="Time Schedule or Notes"/>
					<br/>
					
					<label>Wednesday:</label>
					<input type="text" value="<?php echo @$wed0 ;?>" id="wednesday" name="wednesday" class="form-control" required  placeholder="Time Schedule or Notes"/>
					<br/>
					
					<label>Thursday:</label>
					<input type="text" value="<?php echo @$thu0 ;?>" id="thursday" name="thursday" class="form-control" required placeholder="Time Schedule or Notes"/>
					<br/>
					
					<label>Friday:</label>
					<input type="text" value="<?php echo @$fri0 ;?>" id="friday" name="friday" class="form-control" required  placeholder="Time Schedule or Notes"/>
					<br/>
					
					<label>Saturday:</label>
					<input type="text" value="<?php echo @$sat0 ;?>" id="saturday" name="saturday" class="form-control" required placeholder="Time Schedule or Notes"/>
					<br/>
					
					<label>Sunday:</label>
					<input type="text" value="<?php echo @$sun0; ?>" id="sunday" name="sunday" class="form-control" required  placeholder="Time Schedule or Notes"/>
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