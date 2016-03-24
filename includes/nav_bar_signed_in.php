<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* include connection string
*/
	include "includes/connect.php";
	
	$unread = '0';
	
	$count_unread = "SELECT * FROM messages WHERE receiver='$username' AND status='0'";
	$q_count_unread = $conn->query($count_unread);
	
	if($q_count_unread->num_rows > 0) {
		$unread = $q_count_unread->num_rows;
	}

/*
* This is a navigation bar to display if,
* it has no user logged in on website
*
*/

?>	

	<!-- Navigation -->
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand hidden-lg hidden-md hidden-sm" href="javascript: void(0)">Menu</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">
						<span class="glyphicon glyphicon-home"></span> 
						<strong>Home</strong>
						</a>
                    </li>
					<li class="dropdown">
						<a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>My Reservations<span class="caret"></span></strong></a>
					
						<ul class="dropdown-menu">
							<li class="menu-dropdown"><a href="reservation.php">Scheduling and Reservation Form</a></li>
							<li><a href="status.php">Reservations</a></li>
							<li><a href="archive.php">Archive</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Messages
						<span class="label label-danger label-as-badge"><?php echo $unread; ?></span>
						<span class="caret"></span></strong></a>
					
						<ul class="dropdown-menu">
							<li class="menu-dropdown"><a href="compose_message.php">Compose Message</a></li>
							<li><a href="inbox.php">Inbox
							<span class="label label-danger label-as-badge"><?php echo $unread; ?></span></a></li>
							<li><a href="sent_messages.php">Sent Items</a></li>
							<li><a href="draft.php">Draft</a></li>
						</ul>
					</li>
                    <li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Services<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<li class="menu-dropdown"><a href="services.php?services=baptism">Baptism</a></li>
							
							<li><a href="services.php?services=confirmation">Confirmation</a></li>
							
							<li><a href="services.php?services=funeral">Funeral</a></li>
							
							<!-- Start Submenu -->
							
							<li>
								
								<a href="javascript: void(0)">Seminars</a>
								<ul>
									<li class="sub-menu1"><a href="services.php?services=forconfirmation">For Confirmation</a></li>
									
									<li class="sub-menu1"><a href="services.php?services=forwedding">For Wedding</a></li>
								</ul>
								
							</li>
							
							<!-- End of Submenu -->
							
							<li><a href="services.php?services=wedding">Wedding</a></li>
							
						</ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>About<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<!--
							<li class=""><a href="about.php?about=history">History of Cathedral</a></li>
							
							<li><a href="about.php?about=diocese">Diocese of Tarlac</a></li>
							
							<li><a href="about.php?about=orgchart">Organizational Chart</a></li>
							
							<li><a href="about.php?about=masssched">Mass Schedule</a></li>
							
							<li><a href="about.php?about=priestsched">Priest Schedule</a></li>
							-->
							<?php
							
								$select_about = "SELECT * FROM about ORDER BY title ASC";
								$select_about_query = $conn->query($select_about);
								
								while ($a_row = $select_about_query->fetch_assoc()) {
								
									echo "<li><a href='about.php?about=" . $a_row['code'] . "'>" . $a_row['title'] . "</a></li>";
								
								}
							
							?>
						</ul>
                    </li>
					
					<li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Form Downloads<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<li class="menu-dropdown"><a href="forms/wedding.pdf" target="_blank">Requirement Form(For Wedding)</a></li>
							
							<li><a href="forms/bap.pdf" target="_blank">Requirement Form(Baptism - No Birth Certificate)</a></li>
							
							
						</ul>
                    </li>
					
					<li class="dropdown" id="user-position">
						<a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>
						<u>
							<?php echo getFirstName($username,$conn);?>
						</u><span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li class="menu-dropdown">
								<a href="update.php">Update My Info</a>
							</li>
							<li>
								<a href="changepass.php">Change Password</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php">Logout</a>
							</li>
						
						</ul>
						
					</li>
					
					
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<?php
	function getFirstName($username,$conn) {
		
		$select_user = "SELECT firstName FROM users WHERE username='$username' LIMIT 1";
		$select_user_query = $conn -> query($select_user);
		
		while($row_q = $select_user_query->fetch_assoc()) {
		
			$firstname = $row_q['firstName'];
		
		}
		
		return $firstname;
	
	}

?>