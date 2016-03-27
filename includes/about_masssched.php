			<div class="text-center">
			<h3 class="white-text">Weekly Mass Schedule</h3>
			<div class="row">
			<div class="col-md-6 col-md-offset-3">
			
			<?php
				$select_sched = "SELECT * FROM mass WHERE schedID = '1' LIMIT 1";
				$select_sched_query = $conn->query($select_sched);
				
				if($select_sched_query->num_rows > 0) {
					
					while($prow = $select_sched_query->fetch_assoc()) {
					
						echo "<div class='col-md-6'>";
						echo "<strong>Monday</strong><br/>";
						echo $prow['monday'] . "<br/>";
						echo "<strong>Tuesday</strong><br/>";
						echo $prow['tuesday'] . "<br/>";
						echo "<strong>Wednesday</strong><br/>";
						echo $prow['wednesday'] . "<br/>";
						echo "</div>";
						
						echo "<div class='col-md-6'>";
						echo "<strong>Thursday</strong><br/>";
						echo $prow['thursday'] . "<br/>";
						echo "<strong>Friday</strong><br/>";
						echo $prow['friday'] . "<br/>";
						echo "<strong>Saturday</strong><br/>";
						echo $prow['saturday'] . "<br/>";
						echo "</div>";
						
						echo "<strong>Sunday</strong><br/>";
						echo $prow['sunday'] . "<br/>";
					}
					
				}
				else {
				
					echo "<h3 class='white-text'>No Information Found!</h3>";
					
				}
			
			?>
			</div>
			</div>