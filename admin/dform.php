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


?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Events Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">

		<h1 class="white-text">Admin Pannel: Form Lists</h1>
		
		
		

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
			
			<div class="col-md-12">
			<div class="center-div">
				<h2 class="white-text">Delete Form</h2>
				<table class="table">
					<tr>
					<th>Display Name</th>
					<th>Operation</th>
					</tr>
				<?php
					$select_form = "SELECT * FROM docs";
					$select_form_query = $conn->query($select_form);
					
					if($select_form_query -> num_rows > 0) {
					
						while($frow = $select_form_query->fetch_assoc()) {
							echo "<tr>";
							echo "<td>";
							echo $frow['name'];
							echo "</td>";
							
							echo "<td>";
							echo "<form action='f_delete.php' method='post'>";
							echo "<input type='hidden' name='id' value='" . $frow['docID'] . "' />";
							echo "<input type='hidden' name='file' value='" . $frow['location'] . "' />";
							echo "<input type='submit' class='btn btn-danger'/>";
							echo "</form>";
							echo "</td>";
							echo "</tr>";
							
						}
						
					}
					else {
						
					}
				?>
			</table>
			</div>
			</div>
		</div>
	</div>


<?php

	require "includes/footer.php";

?>
?>