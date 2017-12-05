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

	if(isset($_POST['name'])) {
		
		$name = $_POST['name'];
	
		$dir = "../uploads/";
		$file = $dir . basename(sha1(date("Y-m-d h:i:sa")) . ".pdf");
		$file_loc = "uploads/" . basename(sha1(date("Y-m-d h:i:sa")) . ".pdf");
		
		$mime = substr($_FILES["uploadfile"]["name"], -4);
		
		
		if($mime == '.pdf') {
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file)) {
			
				$add_form = "INSERT INTO docs (name, location, dateMod) 
					VALUES ('$name','$file_loc',NOW())";
				$add_form_query = $conn->query($add_form);
				
				
				$msg = "<div class='alert alert-success text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Form Successfully Added!</div>";
			
			}
			else {
				$msg =  "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Form Failed to Add!</div>";
			}
		}
		else {
		
			$msg =  "<div class='alert alert-warning text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Invalid File Selected!</div>";
			
		}
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Upload Form Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Upload Form</h1>
		
		
		

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
			
			<div class="col-md-6 col-md-offset-3">
			<?php echo @$p_msg; ?>
			<div class="center-div">
				<?php echo @$msg; ?>
				<h2 class='white-text'>Upload Form</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
					
					<label>Name:</label>
					<input type="text" id="name" name="name" class="form-control" required/>
					<br/>
					
					<label>Upload File:</label><em>PDF Files Only</em>
					<input type="file" id="uploadfile" name="uploadfile" class="white-text" accept="application/pdf" required/>
					<br/>
					
					<input type="submit" value="Upload" class="btn btn-primary" />
				
				</form>
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>