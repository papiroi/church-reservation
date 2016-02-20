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
	
	$type = $_POST['bap-type'];
	
	$username = $_SESSION['username'];
	
	//Set if the Baptism Type is Regular
	//The time will be automatically 11:30am on the day chosen
	
	if($type=='Regular') {
		
		$event_time = "8";
		
	}
	
		// Reserve Number Generator
		// Reference Number Serve as alternative ID for the
		// reserved schedule
		function generateRandomString($length = 10) {
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		$reserv_num = generateRandomString();
	
	
	// Search for Conflict on the event they are trying to reserve
	// If there are similar record that the users are trying to reserve
	// the system will automatically prevent it, to avoid conflict in reserved schedules
	$search_record = "SELECT * FROM reservation WHERE reserv_date='$event_date' AND reserv_time='$event_time'";
	
	$srq = $conn->query($search_record);
	
	if(@$srq->num_rows > 0) {
		
		if($type == 'Regular') {
			// Insert the reservation in database as record
			// Statement for Inserting New Reserved Records
			$add_reservation = "INSERT INTO reservation 
				(reserv_num, event_type, reserv_date, reserv_time, username, status, type, confirmation, date_reserved)
						VALUES ('$reserv_num','$event_type','$event_date','$event_time','$username','Active','$type','Confirmed',NOW())";
			
			$arq = $conn->query($add_reservation);
			
			if($arq == true) {
				
				echo "<script>";
				echo "alert('Successfully Reserved!')";
				echo "</script>";
				
			}
			else {
				
				echo "<script>";
				echo "alert('Error in Reserving Event!')";
				echo "</script>";
				
			}
		}
		else {
			echo "<script>";
			echo "alert('The Date and Time has a Conflict!!!')";
			echo "</script>";
		}
	}
	else {
		
		// Insert the reservation in database as record
		// Statement for Inserting New Reserved Records
		$add_reservation = "INSERT INTO reservation 
			(reserv_num, event_type, reserv_date, reserv_time, username, status, type, confirmation, date_reserved)
					VALUES ('$reserv_num','$event_type','$event_date','$event_time','$username','Active','$type','Confirmed',NOW())";
		
		$arq = $conn->query($add_reservation);
		
		if($arq == true) {
			
			echo "<script>";
			echo "alert('Successfully Reserved!')";
			echo "</script>";
			
		}
		else {
			
			echo "<script>";
			echo "alert('Error in Reserving Event!')";
			echo "</script>";
			
		}
	}
}	
	
?>

<div class="row">
	<div class="col-md-5">
		<div class="center-div">
			<h3 class="white-text">Reservee: <U><?php echo $username; ?></u></h3>
			<h2 class="white-text">Reservation Form:</h2>
			<!-- 
			Form for Reservation
			This form is used to reserve schedules
			Type of Event to reserve
			Date of Event
			Time to start
			-->
			<form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

				<label for="eventtype">Select Event:</label>
				<select id="eventtype" name="eventtype" class="form-control" required autofocus>
					<option value="">Select Event</option>
					<option value="Baptism">Baptism</option>
					<option value="Confirmation">Confirmation</option>
					<option value="Funeral">Funeral</option>
					<option value="For Confirmation">Seminar For Confirmation</option>
					<option value="For Wedding">Seminar For Wedding</option>
					<option value="Wedding">Wedding</option>
				</select>
				<br/>
				<!-- Baptism Type Special or Regular -->
				<!-- If Regular, the time will be 11:30am to 12:00pm on the date you selected -->
				<!-- If Special, you can choose the time slot when you want, if available -->
				
				<select id="bap-type" name="bap-type" class="form-control">
					<option value="Special">Special</option>
					<option value="Regular">Regular</option>
				</select>
				
				<br/>
				
				<label for="dateselect">Select Date:</label>
				<input type="text" id="dateselect" name="dateselect" class="form-control" required/>
				
				
				
				<br/>
				
				<label id="lbltimeselect" for="timeselect">Select Starting Time:</label>
				<select id="timeselect" name="timeselect" class="form-control" >
				
					<option value="">Select Time</option>
					<option value="1">8:00am</option>
					<option value="2">8:30am</option>
					<option value="3">9:00am</option>
					<option value="4">9:30am</option>
					<option value="5">10:00am</option>
					<option value="6">10:30am</option>
					<option value="7">11:00am</option>
					<option value="8">11:30am</option>
					<option value="9">12:00pm</option>
					<option value="10">1:00pm</option>
					<option value="11">1:30pm</option>
					<option value="12">2:00pm</option>
					<option value="13">2:30pm</option>
					<option value="14">3:00pm</option>
					<option value="15">3:30pm</option>
					<option value="16">4:00pm</option>
					<option value="17">4:30pm</option>
					<option value="18">5:00pm</option>
					
				</select>
				
				
				<br/>
				
				<input type="submit" value="Reserve Now!" class="btn btn-success"/>
				
				&nbsp;&nbsp;&nbsp;
				
				<input type="reset" value="Clear Input" onclick="" class="btn btn-primary"/>
			</form> 
			<br/>
			
		</div>
	</div>
	<div class="col-md-7">
		<div class="center-div">
			<!-- Start of Month Calendar -->
			<!-- Start of Month Calendar -->
			<!-- Start of Month Calendar -->
			<!-- Start of Month Calendar -->
			<div id="calendar" class="calendar">
			<?php
				require "calendar.php";
			?>
			</div>
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
		</div>
	</div>
</div>