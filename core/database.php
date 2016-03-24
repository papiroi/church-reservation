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
			priest varchar(100) NOT NULL,
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



	// database/tables for chat
	public function Messages() {

		$create_messages_table = "CREATE TABLE IF NOT EXISTS messages (
			MessageID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			convID varchar(10) NOT NULL,
			Content varchar(300) NOT NULL,
			sender varchar(60) NOT NULL,
			receiver varchar(10) NOT NULL,
			dateSent datetime NOT NULL,
			status varchar(1) NOT NULL,
			category varchar(10) NOT NULL
			)";
			
		$cmt = $this->conn->query($create_messages_table);

		if(!$cmt) {
			exit("Database Script Error: 3");
		}
	}
	
	
	// Records of the priests
	public function priests() {
	
		$create_priests_table = "CREATE TABLE IF NOT EXISTS priests (
			priestID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			name varchar(200) NOT NULL,
			sched varchar(100) NOT NULL,
			dateCreated datetime NOT NULL
		)";
		
		$create_priests_table_query = $this->conn->query($create_priests_table);
		
		if(!$create_priests_table_query)
			exit("p Error:1");
	
	
	}
	
	
	// Records for Events
	public function events() {
	
		$create_event_table = "CREATE TABLE IF NOT EXISTS events (
			eventID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			code varchar(50) NOT NULL,
			name varchar(50) NOT NULL,
			dateMod datetime NOT NULL
		)";
		
		$cet_query = $this->conn->query($create_event_table);
		
		if(!$cet_query)
			exit("Event: Errror!");
			
		// Create Events
		
		$select_event = "SELECT * FROM events";
		$select_events_query = $this->conn->query($select_event);
		
		if($select_events_query->num_rows > 0) {
		
		}
		else {
			$c_baptism = "INSERT IGNORE INTO events (code, name, dateMod)
				VALUES(
				'Baptism',
				'Baptism',
				NOW()
				)";
			$c_b_query = $this->conn->query($c_baptism);	
			
			$c_confirm = "INSERT IGNORE INTO events (code, name, dateMod)
				VALUES(
				'Confirmation',
				'Confirmation',
				NOW()
				)";
			$c_c_query = $this->conn->query($c_confirm);
			
			$c_funeral = "INSERT IGNORE INTO events (code, name, dateMod)
				VALUES(
				'Funeral',
				'Funeral',
				NOW()
				)";
			$c_f_query = $this->conn->query($c_funeral);
			
			$c_for_conf = "INSERT IGNORE INTO events (code, name, dateMod)
				VALUES(
				'For Confirmation',
				'Seminar For Confirmation',
				NOW()
				)";
			$c_f_c_query = $this->conn->query($c_for_conf);
			
			$c_for_wed = "INSERT IGNORE INTO events (code, name, dateMod)
				VALUES(
				'For Wedding',
				'Seminar For Wedding',
				NOW()
				)";
			$c_f_w_query = $this->conn->query($c_for_wed);
		
			$c_wedding = "INSERT IGNORE INTO events (code, name, dateMod)
				VALUES(
				'Wedding',
				'Wedding',
				NOW()
				)";
			$c_w = $this->conn->query($c_wedding);
		}
		
	
	}
	
	// Method to create about table in database
	public function about() {

		$create_about = "CREATE TABLE IF NOT EXISTS about (
			aboutID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			code varchar(50) NOT NULL,
			title varchar(50) NOT NULL,
			description varchar(500) NOT NULL,
			dateMod datetime NOT NULL
		)";
		
		$create_about_query =  $this->conn->query($create_about);
		
		if(!$create_about_query) {
			exit("About Error.");
		}
		
		
		// Create intial content
		$select_about = "SELECT * FROM about";
		$select_about_query = $this->conn->query($select_about);
		
		if($select_about_query->num_rows > 0) {
		
		
		}
		else {
		
			$a_history = "INSERT IGNORE INTO about (code, title, description, dateMod)
				VALUES(
				'history',
				'History of Cathedral',
				'History not available.',
				NOW()
				)";
			$a_h = $this->conn->query($a_history);
			
			$a_diocese = "INSERT IGNORE INTO about (code, title, description, dateMod)
				VALUES(
				'diocese',
				'Diocese of Tarlac',
				'Details not available.',
				NOW()
				)";
			$a_a = $this->conn->query($a_diocese);
			
			$a_orgchart = "INSERT IGNORE INTO about (code, title, description, dateMod)
				VALUES(
				'orgchart',
				'Organizational Chart',
				'Information not available.',
				NOW()
				)";
			$a_o = $this->conn->query($a_orgchart);
			
			$a_mass = "INSERT IGNORE INTO about (code, title, description, dateMod)
				VALUES(
				'masssched',
				'Mass Schedule',
				'Schedules of Mass.',
				NOW()
				)";
			$a_m = $this->conn->query($a_mass);
		
		
		}
		
	}

	// End of Database Class
}