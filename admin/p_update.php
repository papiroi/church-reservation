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
	
		$id = $_POST['priestid'];
		$name = $_POST['name'];
		$sched = $_POST['sched'];
		
		$update_priest = "UPDATE priests SET name = '$name', sched = '$sched' WHERE priestID = '$id'";
		$update_priest_query = $conn->query($update_priest);
		
		if($update_priest_query) {
		
			$update_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Priest Info Updated!</div>";
		
		}
		else {
		
			$update_msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Failed to Update Record!</div>";
		
		}
	
	
	}
	
	if(isset($_POST['id']) && !empty($_POST['id'])) {
	
		$id = $_POST['id'];
		
		$select_priest = "SELECT * FROM priests WHERE priestID = '$id'";
		$select_priest_query = $conn->query($select_priest);
		
		while($p_row = $select_priest_query -> fetch_assoc()) {
		
			$priest_id = $p_row['priestID'];
			$priest_name = $p_row['name'];
			$priest_sched = $p_row['sched'];
		
		}
	
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Priests Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel</h1>
		
		
		

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
				<h2 class='white-text'>Update Priest Info</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<label>Name:</label>
					<input type="hidden" name="priestid" value="<?php echo @$priest_id; ?>" />
					<input type="text" value="<?php echo @$priest_name; ?>" class="form-control" id="name" name="name"
						required autofocus placeholder="Name of Priest"/>
					<br/>
					<label>Schedule:</label>
					<input type="text" value="<?php echo @$priest_sched; ?>" class="form-control" id="sched" name="sched" placeholder="Schedule of the Priest" required />
					<br/>
					<input type="submit" class="btn btn-primary" value="Update" />
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-danger" value="Clear All" />
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>