<?php

/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;

	include "includes/connect.php";

	$msgid = $_POST['msgid'];
	
	$del_inbox = "DELETE FROM cached_msg WHERE convID = '$msgid'";
	$del_i_query = $conn->query($del_inbox);
	
	header('Location: inbox.php');