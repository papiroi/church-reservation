<?php
/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	
/*
* Reidrect to index if call directly
*/
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
	
		// Nothing to do
	}
	else {
	
		header ("Location: index.php");
	
	}
?>
<!DOCTYPE html>
<html class='register-full' lang="en-US">
<head>
	<title>Update Successful</title>
	
	
<?php

	include_once "includes/head_include.php";
	
?>
	
	<link rel="stylesheet" href="css/register-background-image.css";
	
</head>
<body>
	<div class="container">
	
		<div class=''>
			<div class="success-message-div">
		
			<h2>Successfully Updated Your Details!</h2>
			<br/>
			<a href="index.php"><span class="white-text glyphicon glyphicon-home text-center"> <strong>Home</strong></span></a>
			</div>
		</div>
		
		
	</div>

<?php
	
	require_once "includes/footer.php";

?>