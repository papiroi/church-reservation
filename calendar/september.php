<?php
	
				/*
				* Function to Mark and Display the Date that has Reservations
				*/
				//$conn and $day as argument in this function to complete the operation
				function getDateReserve($conn, $day, $current_month) {
					
					$current_year = date("y");
					
					$select_all_dates = "SELECT * FROM reservation WHERE confirmation = 'Confirmed'";
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
				* Functio to get determine the maximum number of reservation per day (10)
				*/
				function maxCountLimit($conn, $day, $current_month) {
					
				
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
									$r_date = $date_reserved_year . "-" . $date_reserved_month . "-" . $date_reserved_day;
									
									$select_date = "SELECT * FROM reservation WHERE reserv_date = '$r_date'";
									$select_date_query = $conn->query($select_date);
									
									$r_count = $select_date_query -> num_rows;
									
									if($r_count >= 10) {
										return true;
									}
									else {
										return false;
									}
								}
								
							}
							else {
								return false;
								
							}
							
							
						}
					}
					
				}
				
				// Function to Get Wedding Reservations for a day
				function maxWeddingReservation($conn, $day, $month) {
					
					$event = 'Wedding';
					
					$date = date("Y") . "-" . $month . "-" . $day;
					
					$select_wed = "SELECT * FROM reservation WHERE reserv_date = '$date' AND event_type = '$event'";
					$select_wed_query = $conn->query($select_wed);
					
					if($select_wed_query -> num_rows >= 2) {
						
						$select_rem_time = "SELECT * FROM reservation WHERE reserv_date = '$date' AND reserv_time = '5'";
						$srt_query = $conn->query($select_rem_time);
						
						if($srt_query -> num_rows > 0) {
							return true;
						}
						else {
							return false;
						}
						
					}
					else {
						
						return false;
						
					}
					
				}
				
				
				/*
				* Lines of Code to Display Current Month Calendar
				*/
				$day_num=date("j"); //If today is September 29, $day_num=29
				$month_num = 9; //set the month here for example january is 1
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
			<caption class="white-text"><strong>
			<a href="reservation.php?month=08" class="btn btn-primary">&lt;&lt;</a>
			<?php echo $month_name . " " . $year;?>&nbsp;
			<a href="reservation.php?month=10" class="btn btn-primary">&gt;&gt;</a>
			</strong></caption>
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

						echo "<td onclick='showEvent($day,$month_num);' id='day" . $day;
						//This function Highlights the date with reservation in green
						if(getDateReserve($conn,$day,$month_num)) {
							if(maxCountLimit($conn, $day, $month_num)) {
								echo "' bgcolor='#ff0000'>"; //highlight TODAY in red
								echo "<a href='javascript: void(0)' class='white-text' title='Click to View Schedule'>$day</a></td>";
							}
							else if(maxWeddingReservation($conn, $day ,$month_num) ) {
								
								echo "' bgcolor='#ff0000'>"; //highlight TODAY in red
								echo "<a href='javascript: void(0)' class='white-text' title='Full Schedule. Clickto View Schedule'>$day</a></td>";
								
							}
							else {
								echo "' bgcolor='#00ff00'>"; //highlight TODAY in green
								echo "<a href='javascript: void(0)' class='white-text' title='Click to View Schedule'>$day</a></td>";
							}
						}
						else {
							echo "'><a href='javascript: void(0)' class='white-text' title='Click to View Schedule'>$day</a></td>";
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