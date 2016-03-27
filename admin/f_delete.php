<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

	include "includes/connect.php";

	$id = $_POST['id'];
	$file = "../" . $_POST['file'];
	
	$del_form = "DELETE FROM docs WHERE docID = '$id'";
	$del_f_query = $conn->query($del_form);
	
	unlink($file);
	
	header('Location: dform.php');