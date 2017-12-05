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

	if(isset($_POST['name']) && !empty($_POST['name'])) {
	
		$labelid = $_POST['id'];
		$name = $_POST['name'];
		$content = $_POST['content'];

		$update_label = "UPDATE cal_label SET name = '$name', content = '$content' WHERE labelID = '$labelid'";
		$update_query = $conn->query($update_label);

		if($update_query == true) {
			$msg = "<div class='alert alert-success text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Calendar Label Updated!</div>";
			
		}
		else {
			$msg = "<div class='alert alert-danger text-center'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Error in Adding to Database!</div>";
		}
	
	}

	if(isset($_POST['id']) && !empty($_POST['id'])) {
		
		$id = $_POST['id'];
		
		$select_l = "SELECT * FROM cal_label WHERE labelID = '$id'";
		$select_l_query = $conn->query($select_l);
		
		while($lrow = $select_l_query->fetch_assoc()) {
			
			
			$name = $lrow['name'];
			$content = $lrow['content'];
			
			
		}
		
	}
?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>User Limitation Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Update Calendar Label</h1>
		
		
		

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
				<h2 class='white-text'>Update Calendar label</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<input type="hidden" name="id" value="<?php echo $id; ?>"/>
					<label>Name:</label>
					<input type="text" id="name" name="name" value="<?php echo @$name; ?>" class="form-control"/>
					<br/>
					<label>Content:</label>
					<input type="text" id="content" name="content" value="<?php echo @$content; ?>" class="form-control"/>
					<br/>
					<input type="submit" value="Update Calendar Label" class="btn btn-primary" />
					&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Revert" class="btn btn-warning" />
					
				</form>
				
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>