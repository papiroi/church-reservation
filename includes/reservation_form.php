<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}
	
?>

<div class="row">
	<div class="col-md-5">
		<div class="center-div">
			<h3 class="white-text">Reservee: <U><?php echo $username; ?></u></h3>
			<h2 class="white-text">Reservation Form:</h2>

			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

				<label for="event-type">Select Event:</label>
				<select id="event-type" name="event-type" class="form-control">
					<option value="">Select Event</option>
					<option value="baptism">Baptism</option>
					<option value="wedding">Wedding</option>
					<option value="funeral">Funeral</option>
				</select>

				<br/>
				
				<label for="date-select">Select Date:</label>
				<input type="date" id="date-select" name="date-select" class="form-control"/>
				
				<br/>
				
				<label for="time-select">Select Starting Time:</label>
				<input type="time" id="time-select" name="time-select" class="form-control"/>
				
				
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