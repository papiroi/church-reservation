<?php
	
				/*
				* Function to Mark and Display the Date that has Reservations
				*/
				//$conn and $day as argument in this function to complete the operation
				function getDateReserve($conn, $day, $month) {
					
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
				$month_num = 05; //set the month here for example january is 1
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
			<caption class="white-text"><strong><?php echo $month_name . " " . $year;?>&nbsp;<button class="btn btn-primary" onclick="june();">Next Month</button></strong></caption>
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

						echo "<td onclick='showEvent($day);' id='day" . $day;
						//This function Highlights the date with reservation in green
						if(getDateReserve($conn,$day,$month_num)) {
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