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
	
		$id = $_POST['formid'];
		$name = $_POST['name'];
		
		$update = "UPDATE  docs SET name = '$name' WHERE docID = '$id'";
		$update_query = $conn->query($update);
		
		if($update_query) {
		
			$update_msg = "<div class='alert alert-info text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Form Updated!</div>";
				
				
			$select_form = "SELECT * FROM docs WHERE docID = '$id'";
			$select_form_query = $conn->query($select_form);
			
			while($frow = $select_form_query->fetch_assoc()) {
			
				$form_id = $frow['docID'];
				$form_name = $frow['name'];
				$form_file = $frow['location'];
			
			}
		}
		else {
		
			$update_msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Failed to Update Record!</div>";
		
		}
	
	}

	if(isset($_POST['id'])) {
		$id = $_POST['id'];
		
		$select_form = "SELECT * FROM docs WHERE docID = '$id'";
		$select_form_query = $conn->query($select_form);
		
		while($frow = $select_form_query->fetch_assoc()) {
		
			$form_id = $frow['docID'];
			$form_name = $frow['name'];
			$form_file = $frow['location'];
		
		}
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Form Edit</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Update Form</h1>
		
		
		

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
				<h2 class='white-text'>Update Form</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<input type="hidden" value="<?php echo @$form_id; ?>" name="formid" />
					<label>Name: </label>
					<input type="text"  value="<?php echo @$form_name; ?>" name="name" id="name" class="form-control" required/>
					<br/>
					<label>File:</label>
					<a class="white-text" href="<?php echo "../" . @$form_file; ?>" target="_blank"><?php echo @$form_name . ".pdf"?></a>
					<br/>
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