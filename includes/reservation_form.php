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
	
	
		// Search or Select for Active reservation for a user
		// if there are active reservation for an event, 
		// the user will not be able to resreve another
		$select_user_events = "SELECT * FROM reservation WHERE username = '$username' AND event_type = '$event_type' AND status = 'Active' AND reserv_date >= CURRENT_DATE()";
		$select_user_events_query = $conn -> query($select_user_events);
		
	if($select_user_events_query->num_rows > 0) {
			
		echo "<script>alert('You have another pending reservation on this event!');</script>";
		
	}
	else {
	
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
}	
	
?>

<div class="row">
	<div class="col-md-5">
		<div class="center-div">
			<h2 class="white-text">Reservation Form:</h2>
			<p class="white-text">All Fields are Required</p>
			<!-- 
			Reservation
			-->
			<form action="reserv_summ.php" method="post" autocomplete="off">
				<label for="eventtype">Select Event:</label>
				<select id="eventtype" name="eventtype" class="form-control" value="<?php echo @$event; ?>" required autofocus title="Select an Event!">
					<option value="">Select Event</option>
					
					<!-- Load List of Events -->
					<?php
						
						$select_events = "SELECT * FROM events ORDER BY name ASC";
						$select_events_query = $conn->query($select_events);
						
						if($select_events_query->num_rows > 0) {
							while($e_row = $select_events_query->fetch_assoc()) {
								
								echo "<option value='" . $e_row['code'] . "'>" . $e_row['name'] . "</option>";
							
							}
						
						}
						else {
						
							echo "<option><i>No Events Lists Found!!!</i></option>";
							
						}
					
					?>
					<!-- End of Loading List of Events -->
					
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
				<select id="priest" name="priest" value="<?php echo @$priest; ?>" class="form-control">
					<option value="">Any</option>
					<?php
						$select_priests = "SELECT * FROM priests";
						$spq = $conn->query($select_priests);
						
						while($p_row = $spq -> fetch_assoc()) {
						
							echo "<option vavlue='" . $p_row['priestID'] . "'>" . $p_row['name'] . "</option>";
						
						}
					?>
				</select>
				
				<br/>
				
				<!-- Default Date Select -->
				<label for="dateselect">Select Date:</label>
				<input type="text" id="dateselect" name="dateselect" value="<?php echo @$edate; ?>" class="form-control" />
				
				
				<!-- Date Select for Confirmation -->
				<!---<label for="dateselect">Select Date: Confirmation</label>-->
				<input type="text" id="dateselect2" name="dateselect2" value="<?php echo @$edate; ?>" class="form-control" />
				
				
				<!-- Date Select for Seminars -->
				<!--<label for="dateselect">Select Date: Seminars</label>-->
				<input type="text" id="dateselect3" name="dateselect3" value="<?php echo @$edate; ?>" class="form-control" />
				
				<br/>
				
				<!-- Date Select / Date Picker for Wedding 2 months -->
				<input type="text" id="dateselect4" name="dateselect4" value="<?php echo @$edate; ?>" class="form-control"/>

				<label id="lbltimeselect" for="timeselect">Select Starting Time:</label>
				<select id="timeselect" name="timeselect" value="<?php echo @$etime; ?>" class="form-control">
				
					<option value="">Select Time</option>
					<option value="1">8:00am</option>
					<option value="2">9:00am</option>
					<option value="3">10:00am</option>
					<option value="4">11:00am</option>
					<!--<option value="5">12:00pm</option>-->
					<option value="6">1:00pm</option>
					<option value="7">2:00pm</option>
					<option value="8">3:00pm</option>
					<option value="9">4:00pm</option>
					<option value="10">5:00pm</option>
					
				</select>
				<select id="timeselect2" name="timeselect2" value="<?php echo @$etime; ?>" class="form-control">
				
					<option value="">Select Time</option>
					<option value="1">8:00am to 12:00pm</option>
					<option value="6">1:00pm to 5:00pm</option>
					
				</select>
				
				<br/>
				
				<input type="submit" value="Reserve Now!" class="btn btn-success"/>
				
				&nbsp;&nbsp;&nbsp;
				
				<input type="reset" value="Clear Input" onclick="clearInput();" class="btn btn-primary"/>
				
			</form>
				
			<br/>
			
		</div>

	</div>
	<div class="col-md-7">
		<div class="center-div calendar">
			<!-- Start of Month Calendar -->
			<!-- Start of Month Calendar -->
			<!-- Start of Month Calendar -->
			<!-- Start of Month Calendar -->
			<div id="calendar" class="">
			<?php
				if(isset($_GET['month'])) {
					
					$month = $_GET['month'];
					
					if($month == 1) {
						include_once "calendar/january.php";
					}
					else if($month == 2) {
						include_once "calendar/february.php";
					}
					else if($month == 3) {
						include_once "calendar/march.php";
					}
					else if($month == 4) {
						
						include_once "calendar/april.php";
						
					}
					else if($month == 5) {
						
						include_once "calendar/may.php";
						
					}
					else if($month == 6) {
						
						include_once "calendar/june.php";
						
					}
					else if($month == 7) {
						
						include_once "calendar/july.php";
						
					}
					else if($month == 8) {
						
						include_once "calendar/august.php";
						
					}
					else if($month == 9) {
						
						include_once "calendar/september.php";
						
					}
					else if($month == 10) {
						
						include_once "calendar/october.php";
						
					}
					else if($month == 11) {
						
						include_once "calendar/november.php";
						
					}
					else if($month == 12) {
						
						include_once "calendar/december.php";
						
					}
					
				}
				else {
					
					$current_month = date('m');
					
					if($current_month == 1) {
						
						include_once "calendar/january.php";
						
					}
					else if($current_month == 2) {
						
						include_once "calendar/february.php";
						
					}
					else if($current_month == 3) {
						
						include_once "calendar/march.php";
						
					}
					else if($current_month == 4) {
						
						include_once "calendar/april.php";
						
					}
					else if($current_month == 5) {
						
						include_once "calendar/may.php";
						
					}
					else if($current_month == 6) {
						
						include_once "calendar/june.php";
						
					}
					else if($current_month == 7) {
						
						include_once "calendar/july.php";
						
					}
					else if($current_month == 8) {
						
						include_once "calendar/august.php";
						
					}
					else if($current_month == 9) {
						
						include_once "calendar/september.php";
						
					}
					else if($current_month == 10) {
						
						include_once "calendar/october.php";
						
					}
					else if($current_month == 11) {
						
						include_once "calendar/november.php";
						
					}
					else if($current_month == 12) {
						
						include_once "calendar/december.php";
						
					}
					
					
					
					
				}
			
			?>
			<ul>
			<li><h4>
			<div style="height: 20px; width: 20px; background-color: #ff0000; padding: 2px; display: inline-block;"></div>
			<small><span class="white-text">on the Date Means, the Date is Full</span></small></h4></li>
			<li><h4>
			<div style="height: 20px; width: 20px; background-color: #00ff00; padding: 2px; display: inline-block;"></div>
			<small><span class="white-text">on the Date Means, the Date has Reservation But not Full. You Can click the Date to show the Reservation</span></small></h4></li>
			<?php
				
				$select_cal_label = "SELECT * FROM cal_label";
				$scl_query = $conn -> query($select_cal_label);
				
				if($scl_query -> num_rows > 0) {
					
					while ($c_row = $scl_query->fetch_assoc()) {
						
						echo "<li><h4><small><span class='white-text'>" . $c_row['content'] . "</span></small></h4></li>";
						
					}
					echo "</ul>";
					
				}
				else {
					
					echo "";
					
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
		</tr>
		</table>
	</div>
</div>


<div id="hidden_div">

</div>

<div id="pending_status_div">

	<div id="pending_status_div_message">
		
		<h2 class="text-center">You have active pending reservation in this event.</h2>
	
	</div>
	
</div>