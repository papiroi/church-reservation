<?php
	
	session_start();
	
	$_SESSION['code'] = 1;
	
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
	
	
	include "includes/connect.php";
	
	if(isset($_POST['conv']) && !empty($_POST['conv'])) {
	
		$convid = $_POST['conv'];
		
		$delete = "DELETE FROM messages WHERE convID = '$convid'";
		$del_query = $conn->query($delete);
		
		header('Location: sent_messages.php');
	
	}