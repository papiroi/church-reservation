<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
| Datbase Connection String
| Requirements:
| 	Server Name
|	Database Username
|	Database Password
|	Datbase Name
*/

	$db_server = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db = "church";
	
	$conn = new mysqli ($db_server, $db_user, $db_pass, $db) or die("Database Error!");
	
	
