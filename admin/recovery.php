<?php
	//error_reporting(0);


/*
* This part of the script will set a session varaible for security purposes
* To avoid direct scripting
*/
	session_start();
	
	$_SESSION['code'] = 1;


include_once "includes/connect.php";

/*
* Include the basepath file
* in the constant BASE
*/
	include "basepath.php";

	if(isset($_POST['answer']) && !empty($_POST['answer'])) {

		$qid = $_POST['qid'];
		$answer = $_POST['answer'];

		$select = "SELECT * FROM recovery WHERE qID = '$qid'";
		$select_query = $conn->query($select);

		while($row = $select_query->fetch_assoc()) {

			if($answer == $row['answer']) {

				$select_admin = "SELECT * FROM users WHERE username = 'admin'";
				$sa_query = $conn->query($select_admin);

				while($ra = $sa_query->fetch_assoc()){
					$pass = $ra['password'];
				}
				header("Location: passrec.php?pass=$pass");
			}
			else {

				$message = "Error!";

			}

		}

	}
	else {
		$select_rand = "SELECT * FROM recovery ORDER BY RAND() LIMIT 1";
		$sr_query = $conn->query($select_rand);

		if($sr_query->num_rows > 0) {
			while($r = $sr_query -> fetch_assoc()) {
				$question = $r['question'];
				$qid = $r['qID'];

			}
		}
		else {
			echo "<script>";
			echo "alert('No Recovery Question Found!');";
			echo "window.location.href='index.php';";
			echo "</script>";
		}
	}


?>


<!DOCTYPE html>
<html class="full" lang="en-US">
<head>
	<title>Admin Panel</title>

<?php
	
	include "includes/head_include.php";

?>

	<!-- Custome Background for Services Offered Page -->
	<link rel="stylesheet" href="../css/background-image.css" />

</head>
<body>
	<div class="container">
		
		<div class="row">
			
			<div class="col-md-6 col-md-offset-3">
			<h1 class="white-text text-center">Password Recovery</h1>

			<div class="messages">
			<?php
				echo @$message; 
			?>
			<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
				<label>Question:</label>
				<h3><?php echo @$question; ?></h3>
				<br/>
				<input type="hidden" name="qid" value="<?php echo @$qID; ?>" />
				<label>Answer:</label>
				<input type="password" name="answer" class="form-control"  placeholder="Enter Secret Answer" required autofocus/>
				<br/>
				<div class="text-center">
				<input type="submit" value="Send" class="btn btn-primary"/>
				</div>
			</form>
			
			</div>
			</div>
		</div>
	</div>


<?php
	
	require "includes/footer.php";

?>