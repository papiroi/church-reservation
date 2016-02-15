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
		// Secure Hashed Algorithm 1 used for password

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
	
	// Function to Create reservation table if it is not existing
	public function reservation() {
	
		$create_reservation = "CREATE TABLE IF NOT EXISTS reservation (
			reservationID int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
			reserv_num varchar(12) NOT NULL,
			event_type varchar(15) NOT NULL,
			reserv_date date NOT NULL,
			reserv_time varchar(5) NOT NULL,
			username varchar(60) NOT NULL,
			type varchar(15) NOT NULL,
			status varchar(15) NOT NULL,
			confirmation varchar(15) NOT NULL,
			date_reserved datetime NOT NULL
			
		)";
	
	
		$crq = $this->conn->query($create_reservation);
		
		if($crq == true) {
			//nothing to do here
			//Success creating reservation table in database
		}
		else {
			echo "Error Code: Reserv101";
			exit();
		}
	}
	
	// Database for Announcement
	public function create_announcement() {
		
		$create_announcement_table = "CREATE TABLE IF NOT EXISTS announcement (
			announcementID int(11) PRIMARY KEY NOT NULL,
			atext varchar(255) NOT NULL,
			dateReg datetime NOT NULL,
			dateLastMod datetime NOT NULL
			)";
	
		$cat = $this->conn->query($create_announcement_table);
		
		
		// Error Checking for Creating Announcement Table
		if(!$cat) {
			exit("Database Script Error: 2");
		}
		
		$insert_dummy = "INSERT INTO announcement
			(atext, announcementID)
			VALUES('Dummy Announcement!',1)
		";
		
		$insert_dummy_dat = $this->conn->query($insert_dummy);
		
	}


	// database/table for user login
	public function Log() {


		
	}

	// database/tables for chat
	public function Chat() {

		$create_chat_table = "CREATE TABLE IF NOT EXISTS chat (
			chatID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			message varchar(300) NOT NULL,
			username varchar(60) NOT NULL,
			reference varchar(10) NOT NULL,
			dateReg datetime NOT NULL
			)";
			
		$cct = $this->conn->query($create_chat_table);

		if(!$cct) {
			exit("Database Script Error: 3");
		}
	}
	
	
	// End of Database Class
}