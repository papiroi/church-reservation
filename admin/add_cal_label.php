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
		$content = $_POST['content'];
		
		$insert = "INSERT INTO cal_label (name, content, dateMod) 
			VALUES ('$name','$content',NOW())";
			
		$insert_query = $conn->query($insert);
		
		if($insert_query) {
			
			$msg = "<div class='alert alert-success text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Calendar Label Added!</div>";
			
		
		}
		else {
		
			$msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Error in Adding to Database!</div>";
		
		}
	
	}

?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Calendar Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Add Calendar Label</h1>
		
		
		

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
			<?php echo @$msg; ?>
			<div class="center-div">
				<h2 class='white-text'>Add Calendar Label</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					
					<label>Display Name: </label>
					<input type="text" id="name" name="name" class="form-control" placeholder="Name of the Label in Calendar" required autofocus/>
					<br/>
					<label>Display Content: </label>
					<input type="text" id="content" name="content" class="form-control" placeholder="Content of Label to show." required/>
					<br/>
					<input type="submit" value="Add Label" class="btn btn-primary" />
					&nbsp;
					&nbsp;
					<input type="reset" value="Clear" class="btn btn-danger" />
					
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>