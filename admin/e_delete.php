<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

	include "includes/connect.php";

	$id = $_POST['id'];
	
	$del_priest = "DELETE FROM events WHERE eventID = '$id'";
	$del_p_query = $conn->query($del_priest);
	
	header('Location: events.php');