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
	<title>Accounts</title>

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
			
			<div class="col-md-12">
			<div class="center-div">
                <div class="accounting-title">
                    <h2 class="white-text">Accounts Info</h2>
                    <button type='button' class='btn btn-success'/>Add New Account</button>
                </div>
				
				<table class="table">
					<th>Account Name</th>
					<th>Account Type</th>
					<th>Status</th>
				<?php
					$select_priests = "SELECT * FROM priests";
					$select_priests_query = $conn->query($select_priests);
					
					if($select_priests_query -> num_rows > 0) {
					
						while($p_row = $select_priests_query -> fetch_assoc()) {
							
							echo "<tr>";
							echo "<td>" . $p_row['name'] . "</td>";
							echo "<td>" . $p_row['sched'] . "</td>";
							echo "<td>";
							
							echo "<form action='p_update.php' method='post'>";
							echo "<input type='hidden' name='id' value='" . $p_row['priestID'] . "'/>";
							echo "<select name='status'><option value='active'>Active</option><option value='inactive'>Inactive</option></select>";
							echo "</form>";
							echo "</td>";
							echo "</tr>";
						
						}
					
					}
					else {
					
						echo "<h3 class='white-text'>NO Available Priest</h3>";
					
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