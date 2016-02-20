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
    <nav class="navbar navbar-default" role="navigation">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>My Reservations<span class="caret"></span></strong></a>
					
						<ul class="dropdown-menu">
							<li class="menu-dropdown"><a href="reservation.php">Scheduling and Reservation Form</a></li>
							<li><a href="status.php">Reservations</a></li>
						</ul>
					</li>
                    <li>
                        <a href="index.php">
						<span class="glyphicon glyphicon-home"></span> 
						<strong>Home</strong>
						</a>
                    </li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Messages
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
                    <li>
                        <a href="gallery.php"><strong>Gallery</strong></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Services<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<li class="menu-dropdown"><a href="services.php#baptism">Baptism</a></li>
							
							<li><a href="services.php#confirmation">Confirmation</a></li>
							
							<li><a href="services.php#funeral">Funeral</a></li>
							
							<!-- Start Submenu -->
							
							<li>
							
								<a href="services.php#seminars">Seminars</a>
								<ul>
									<li class="sub-menu1"><a href="services.php#forconfirmation">For Confirmation</a></li>
									
									<li class="sub-menu1"><a href="services.php#forwedding">For Wedding</a></li>
								</ul>
								
							</li>
							
							<!-- End of Submenu -->
							
							<li><a href="services.php#wedding">Wedding</a></li>
							
						</ul>
                    </li>
                    <li>
                        <a href="about.php"><strong>About</strong></a>
                    </li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>
						<u>
							<?php echo $username;?>
						</u><span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li class="menu-dropdown">
								<a href="update.php">Update Details</a>
							</li>
							<li>
								<a href="changepass.php">Change Password</a>
							</li>
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
	