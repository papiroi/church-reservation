<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

	include "includes/connect.php";

	$id = $_POST['id'];
	
	$del = "DELETE FROM cal_label WHERE labelID = '$id'";
	$del_query = $conn->query($del);
	
	header('Location: del_cal_label.php');