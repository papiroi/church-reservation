<?php
/*
* Logout Script
* 
*/


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;
	

	session_destroy();
	
	header('Location: index.php');