<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
/*
| database.php contains database class for all operations in our database.
| Select, Insert, Update and Delete functions in databases, tables and records excluded
|
*/

class Database {

	// Variable to use in our connection 
	public $conn;
	
	
	// Database Class Constructor
	// Initializing the value of public $conn variable
	// $conn is the connection string for the database
	public function __construct($conn) {
	
		$this->conn = $conn;
	
	}
	
	
	// Create users table if it is not existing
	public function create_user_table() {
	
		$create_users_query = "CREATE TABLE IF NOT EXISTS users (
			  userID int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			  username varchar(60) NOT NULL,
			  password varchar(64) NOT NULL,
			  firstName varchar(100) NOT NULL,
			  lastName varchar(100) NOT NULL,
			  mobile varchar(11) NOT NULL,
			  email varchar(100) NOT NULL,
			  address varchar(200) NOT NULL,
			  bday date NOT NULL,
			  priv varchar(20) NOT NULL,
			  status varchar(20) NOT NULL,
			  activation varchar(64) NOT NULL,
			  recovery varchar(64) NOT NULL,
			  dateReg datetime NOT NULL,
			  dateLastMod datetime NOT NULL
			)";
			
		// Line Script to create the user table
		$cuq = $this->conn->query($create_users_query);
		
		
		if(!$cuq) {
			exit("Database Script Error: 1");
		}
		
		
		// Insert Default user for the website, but It can change
		// the default user is admin and the password is aietarlac
		$default_user = 'admin';
		$default_password = sha1('admin');
		
		$insert_default_user = "INSERT IGNORE INTO users (username, password, priv, status, recovery, dateReg)
			VALUES (
			'$default_user',
			'$default_password',
			'Admin',
			'Active',
			'tarlaccathedral',
			NOW()
			)";
		
		// Check if the default user is existing
		$check_default = "SELECT * FROM users WHERE username = '$default_user' LIMIT 1";
		
		$result_check_default = $this->conn->query($check_default);
		
		if($result_check_default->num_rows > 0) {
			// At this point the default user is already created
			// Or maybe even modified by the user
		}
		else {
			// Statement/Script to write default user
			$idu = $this->conn->query($insert_default_user);
			
			if(!$idu) {
			echo "Default User Not Created! Try Reloading Page.";
			}
			
		}
		
		
	}


	// database/table for user login
	public function Log() {


		
	}

	// database/tables for chat
	public function Chat() {

		
		
	}
	
	
	// Database for Announcement
	public function create_announcement() {
		
		$create_announcement_table = "CREATE TABLE IF NOT EXISTING announcement (
			announcementID int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			atext varchar (255) NOT NULL,
			dateReg datetime NOT NULL,
			dateLastMod datetime NOT NULL
			)";
	
	}
	
	// End of Database Class
}