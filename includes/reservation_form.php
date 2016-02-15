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
	
	// Search for Conflict on the event they are trying to reserve
	// If there are similar record that the users are trying to reserve
	// the system will automatically prevent it, to avoid conflict in reserved schedules
	$search_record = "SELECT * FROM reservation WHERE reserv_date='$event_date' AND reserv_time='$event_time'";
	
	$srq = $conn->query($search_record);
	
	if(@$srq->num_rows > 0) {
		
		echo "<script>";
		echo "alert('The Date and Time has a Conflict!!!')";
		echo "</script>";
		
	}
	else {
		
		
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
				
				<label for="dateselect">Select Date:</label><b><i>yyyy-mm-dd</i></b><i>format for Firefox</i>
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
				/*
				* Function to Mark and Display the Date that has Reservations
				*/
				//$conn and $day as argument in this function to complete the operation
				function getDateReserve($conn, $day) {
					$current_month = date("m");
					$current_year = date("y");
					
					$select_all_dates = "SELECT * FROM reservation";
					$q_seleect_all_dates = $conn->query($select_all_dates);
					
					if($q_seleect_all_dates->num_rows > 0) {
						while($q_row = $q_seleect_all_dates->fetch_assoc()) {
							$date_reserved = strtotime($q_row['reserv_date']);
							$date_reserved_month = date('m',$date_reserved);
							$date_reserved_year = date('y',$date_reserved);
							$date_reserved_day = date('d',$date_reserved);
							
							if($date_reserved_month == $current_month && $date_reserved_year == $current_year) {
								
								if($day == $date_reserved_day) {
									return true;
								}
								else {
									echo ".";
								}
								
							}
							else {
								echo "false";
								
							}
							
							
						}
					}
				}
				
				/*
				* Lines of Code to Display Current Month Calendar
				*/
				$day_num=date("j"); //If today is September 29, $day_num=29
				$month_num = date("m"); //If today is September 29, $month_num=9
				$year = date("Y"); //4-digit year
				$date_today = getdate(mktime(0,0,0,$month_num,1,$year)); //Returns array of date info for 1st day of this month
				$month_name = $date_today["month"]; //Example: "September" - to label the Calendar
				$first_week_day = $date_today["wday"]; //"wday" is 0-6, 0 being Sunday. This is for day 1 of this month

				$cont = true;
				$today = 27; //The last day of the month must be >27, so start here
				
				while (($today <= 32) && ($cont)) //At 32, we have to be rolling over to the next month
				{
					//Iterate through, incrementing $today
					//Get the date information for the (hypothetical) date $month_num/$today/$year
					$date_today = getdate(mktime(0,0,0,$month_num,$today,$year));
					
					//Once $date_today's month ($date_today["mon"]) rolls over to the next month, we've found the $lastday
					if ($date_today["mon"] != $month_num)
					{
						$lastday = $today - 1; //If we just rolled over to the next month, need to subtract 1 to get our $lastday
						$cont = false; //This kicks us out of the while loop
					}
					$today++;
				}
			?>
				
			<table class="table table-bordered">
			<caption class="white-text"><strong><?php echo $month_name . " " . $year;?></strong></caption>
			<tr align=left><th>Su</th><th>M</th><th>Tu</th><th>W</th><th>Th</th><th>F</th><th>Sa</th></tr>
			<?php

				$day = 1; //This variable will track the day of the month
				$wday = $first_week_day; //This variable will track the day of the week (0-6, with Sunday being 0)
				$firstweek = true; //Initialize $firstweek variable so we can deal with it first
				
				while ( $day <= $lastday) //Iterate through all days of the month
				{
					if ($firstweek) //Special case - first week (remember we initialized $first_week_day above)
					{
						echo "<tr align=center>";
						for ($i=1; $i<=$first_week_day; $i++)
						{
							echo "<td> </td>"; //Put a blank cell for each day until you hit $first_week_day
						}
						$firstweek = false; //Great, we're done with the blank cells
					}
					if ($wday==0) //Start a new row every Sunday
						echo "<tr align=center>";

						echo "<td id='day" . $day;
						//This function Highlights the date with reservation in green
						if(getDateReserve($conn,$day)) {
							echo "' bgcolor='green'>"; //highlight TODAY in green
							echo "<a href='#' class='white-text' title='Click to View Schedule'>$day</a></td>";
						}
						else {
							echo "'><a href='#' class='white-text' title='Click to View Schedule'>$day</a></td>";
						}
						if ($wday==6)
							echo "</tr>"; //If today is Saturday, close this row

						$wday++; //Increment $wday
						$wday = $wday % 7; //Make sure $wday stays between 0 and 6 (so when $wday++ == 7, this will take it back to 0)
						$day++; //Increment $day
				}


				while($wday <=6 ) //Until we get through Saturday
				{
				echo "<td> </td>"; //Output an empty cell
				$wday++;
				}
				echo "</tr></table>";
			?>
			</div>
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
			<!-- End of Month Calendar -->
		</div>
	</div>
</div>