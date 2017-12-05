<?php
/*
* About Page
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	

	require_once "includes/connect.php";
/*
* Condition to check if there's a logined user
*
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		$username = $_SESSION['username'];
		if($username == 'admin') {

			header('Location: admin/index.php');

		}
		
	}
	else {
		
		$username = 'Guest';
		
	}
	
	function nl2br2($text){
		return preg_replace("/\r\n|\n|\r/", "<br>", $text);
	}
?>

<!DOCTYPE html>
<html class="full" lang="en-US">
<head>

	<title>About - St. Augustine Parish Church</title>
	
<?php

	require_once "includes/head_include.php";

?>

	
	<!-- Custom CSS for Background Image for this page -->
	<link rel="stylesheet" href="css/background-image.css" />
	
	
</head>
<body>

	<div class="container">

		<h1 class="text-center white-text">St. Augustine Parish Church</h1>
<!-- Start of Navigation -->
<?php
/*
* This will show navigation bar menu if there is signed in user or not
*
*/

	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		
		require_once "includes/nav_bar_signed_in.php";
	
	}
	else {
	
		require_once "includes/nav_bar_signed_out.php";
	
	}
?>		
<!--End of Navigation -->

			
			<div class="row">
				<div class="col-md-12">
					<div class="scroll">
				
						
						<?php
							
							$about = $_GET['about'];
							if($about == 'history') {
							
								include_once "includes/about_history.php";
							
							}
							else if ($about == 'diocese') {
							
								include_once "includes/about_diocese.php";
							
							}
							else if($about == 'orgchart') {
							
								include_once "includes/about_org.php";
							
							}
							else if($about == 'masssched') {
							
								include_once "includes/about_masssched.php";
							
							}
							else if($about == 'priestsched') {
							
								include_once "includes/about_priest.php";
							
							}
							else if ($about == 'priests') {
							
								$select_p = "SELECT * FROM priests";
								$select_p_query = $conn->query($select_p);
								
								if($select_p_query->num_rows > 0) {
									echo "<div  class='text-center'>";
									
									
									while($prow = $select_p_query->fetch_assoc()) {
										
										echo "<img src='uploads/" . sha1($prow['name']) . ".jpg' style='width: 200px; height: 175px; border-radius: 5px;'/>";
										
										echo "<h3 class='text-center white-text'>Name: " . $prow['name'] . "</h3>";
										echo "<p class='text-center white-text'>Schedule: " . nl2br($prow['sched'], false) . "</p>";
										echo "<p class='text-center white-text'>" . nl2br($prow['info'], false) . "</p><br/>";
										
										if($select_p_query -> num_rows > 1) {
											echo "<hr/>";
										}
									}
									echo "</div>";
								
								}
								else {
								
									echo "<h2 class='white-text'>No Available Information Right Now.</h2>";
								}
								
							
							}
							else {
							
								$cat = $_GET['about'];
								
								$select_ab = "SELECT * FROM about WHERE code = '$cat' LIMIT 1";
								$select_ab_query = $conn->query($select_ab);
								
								if($select_ab_query->num_rows > 0) {
									
									while($arow = $select_ab_query->fetch_assoc()) {
									
										echo "<h1 class='white-text'>" . $arow['title'] . "</h1>";
										echo "<p class='white-text'>" . $arow['description'] . "</p>";
									
									}
								
								}
							
							}
						
						?>
					
					</div>
					</div>
				</div>
			</div>
			
			

			
	</div>
<?php
	include "includes/include_contacts.php";


	require_once "includes/footer.php";

?>