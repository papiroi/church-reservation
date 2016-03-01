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
		
		if($type == 'Ordinary') {
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
					VALUES ('$reserv_num','$event_type','$event_date','$event_time','$username','Active','$type','NC',NOW())";
		
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
			<h2 class="white-text">Reservation Form:</h2>
			<!-- 
			Reservation
			-->
			
				<label for="eventtype">Select Event:</label>
				<select id="eventtype" name="eventtype" class="form-control" required autofocus title="Select an Event!">
					<option value="">Select Event</option>
					<option value="Baptism">Baptism</option>
					<option value="Confirmation">Confirmation</option>
					<option value="Funeral">Funeral</option>
					<option value="For Confirmation">Seminar For Confirmation</option>
					<option value="For Wedding">Seminar For Wedding</option>
					<option value="Wedding">Wedding</option>
				</select>
				<br/>
				<!-- Baptism Type Special or Ordinary -->
				<!-- If Ordinary, the time will be 11:30am to 12:00pm on the date you selected -->
				<!-- If Special, you can choose the time slot when you want, if available -->
				
				<select id="bap-type" name="bap-type" class="form-control">
					<option value="Special">Special</option>
					<option value="Ordinary">Ordinary</option>
				</select>
				
				<br/>
				
				<label id="lblpriest" for="priest">Priest: </label>
				<select id="priest" name="priest" class="form-control">
					<option value="Any">Any</option>
					<option value="1">Priest 1</option>
					<option value="2">Priest 2</option>
					<option value="3">Priest 3</option>
				</select>
				
				<br/>
				
				<label for="dateselect">Select Date:</label>
				<input type="text" id="dateselect" name="dateselect" class="form-control" required/>
				
				
				
				<br/>
				
				<label id="lbltimeselect" for="timeselect">Select Starting Time:</label>
				<select id="timeselect" name="timeselect" class="form-control">
				
					<option value="">Select Time</option>
					<option value="1">8:00am</option>
					<option value="2">9:00am</option>
					<option value="3">10:00am</option>
					<option value="4">11:00am</option>
					<option value="5">12:00pm</option>
					<option value="6">1:00pm</option>
					<option value="7">2:00pm</option>
					<option value="8">3:00pm</option>
					<option value="9">4:00pm</option>
					<option value="10">5:00pm</option>
					
				</select>
				
				
				<br/>
				
				<input type="button" value="Reserve Now!" onclick="return viewReservation();" class="btn btn-success"/>
				
				&nbsp;&nbsp;&nbsp;
				
				<input type="button" value="Clear Input" onclick="clearInput();" class="btn btn-primary"/>
				
				
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
				$current_month =  date("m");
				
				if($current_month == 1) {
					include "calendar/january.php";
				}
				else if($current_month == 2) {
					include "calendar/february.php";
				}
				else if($current_month == 3) {
					include "calendar/march.php";
				}
				else if($current_month == 4) {
					include "calendar/april.php";
				}
				else if($current_month == 5) {
					include "calendar/may.php";
				}
				else if($current_month == 6) {
					include "calendar/june.php";
				}
				else if($current_month == 7) {
					include "calendar/july.php";
				}
				else if($current_month == 8) {
					include "calendar/august.php";
				}
				else if($current_month == 9) {
					include "calendar/september.php";
				}
				else if($current_month == 10) {
					include "calendar/october.php";
				}
				else if($current_month == 11) {
					include "calendar/november.php";
				}
				else if($current_month == 12) {
					include "calendar/december.php";
				}
			?>
			</div>
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
		</div>
	</div>
</div>

		
<div id="review">
	<div id="review-content">
		<table class="table">
		<caption><h2 class="modal-text text-center">Summary</h2></caption>
		<tr>
			<td>
				<label for="event_review">Event: </label>
			</td>
			<td>
				<input type="input" id="event_review" name="event_review" class="ui-input-text" readonly/>
				<input type="hidden" id="bap-type_review" name="bap-type_review" readonly/>

			</td>
		</tr>
		<tr>
			<td>
				<label for="priest_review">Priest: </label>
			</td>
			<td>
				<input type="input" id="priest_review" name="priest_review" class="ui-input-text" readonly/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="date_review">Date: </label>
			</td>
			<td>
				<input type="input" id="date_review" name="date_review" class="ui-input-text" readonly/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="time_review">Time: </label>
			</td>
			<td>
				<input type="input" id="time_review" name="time_review" class="ui-input-text" readonly/>
			</td>
		</tr>
		<tr>
			<td>
				<input type="button" onclick="eventSubmit();" class="btn btn-primary" value="Confirm Submit"/>
			</td>
			<td>
				<button class="btn btn-default" onclick="closeReview();">Close</button>
			</td>
		</tr>
		</table>
	</div>
</div>


<div id="hidden_div">

</div>