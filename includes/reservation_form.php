<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
	
/*
* Getting Inputs in Reservation Form
* Checking if the date trying to reserve is available or not
*/
if(isset($_POST['eventtype']) && !empty($_POST['eventtype'])) {
	
	// Setting the Values in Input Form
	$event_type = $_POST['eventtype'];
	$event_date = date('y-m-d', strtotime($_POST['dateselect']));
	$event_time = $_POST['timeselect'];
	
	$username = $_SESSION['username'];
	
	// Search for Conflict on the event they are trying to reserve
	$search_record = "SELECT * FROM reservation WHERE date=''";
	
	
	// Reserve Number Generator
	$reserv_num = "";
	
	// Insert the reservation in database as record
	// Statement for Inserting New Reserved Records
	$add_reservation = "INSERT INTO reservation 
		(reserv_num, event_type, reserv_date, reserv_time, username, status, confirmation, date_reserved)
				VALUES ('$reserv_num','$event_type','$event_date','reserv_time','$username','Active','Confirmed',NOW())";
	
	$arq = $conn->query($add_reservation);
	
	if($arq == true) {
		
		echo "<script>";
		echo "alert('Event is Reserved!')";
		echo "</script>";
		
	}
}	
	
?>

<div class="row">
	<div class="col-md-5">
		<div class="center-div">
			<h3 class="white-text">Reservee: <U><?php echo $username; ?></u></h3>
			<h2 class="white-text">Reservation Form:</h2>

			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

				<label for="eventtype">Select Event:</label>
				<select id="eventtype" name="eventtype" class="form-control" required autofocus>
					<option value="">Select Event</option>
					<option value="baptism">Baptism</option>
					<option value="wedding">Wedding</option>
					<option value="funeral">Funeral</option>
				</select>

				<br/>
				
				<label for="dateselect">Select Date:</label> <b><i>mm-dd-yyy</i></b>
				<input type="date" id="dateselect" name="dateselect" class="form-control" required/>
				
				<br/>
				
				<label for="timeselect">Select Starting Time:</label> <b><i>hh:mm am/pm</i></b>
				<input type="time" id="timeselect" name="timeselect" class="form-control" required/>
				
				
				<br/>
				
				<input type="submit" value="Reserve Now!" class="btn btn-success"/>
				
				&nbsp;&nbsp;&nbsp;
				
				<input type="reset" value="Clear Inputs" class="btn btn-primary"/>
			</form> 
			<br/>
			<a href="index.php" title="Cancel Reservation">Cancel</a>
			
		</div>
	</div>
	<div class="col-md-7"></div>
</div>