<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
/*
* Login Class
* This class contains all the methods or functions what will
* use in loggin in a user in the website
*/

class Login {

	// Variables that will use in logging in a user
	//
	
	public $username;
	public $password;
	public $conn;
	
	public function __construct($c, $u, $p) {
	
		$this->username = $u;
		$this->password = $p;
		$this->conn = $c;
	
	}
	
	public function login() {
	
		$username_query = "SELECT * FROM users WHERE username = '$this->username' LIMIT 1";
		$username_query_result = $this->conn->query($username_query);
		
		if($username_query_result->num_rows > 0) {
		
			while($row_user = $username_query_result->fetch_object()) {
				//echo $row_user->firstname;
				
				if($this->password == $row_user->password) {
					//Set the value of username Session Variable
					$_SESSION['username'] = $row_user->username;
					
					// Close String Connection
					$this->conn->close();
					
					header('Location: index.php');
				}
				else {
					return "<div class='error-message'>Username or Password is Invalid!</div>";
				}
			}

		}
		else {
			return "<div class='error-message'>Username or Password is Invalid!</div>";
		}
	
	}
}

?>