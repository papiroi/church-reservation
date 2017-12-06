<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* include connection string
*/
	include "includes/connect.php";
	
	$unread = '0';
	
	$count_unread = "SELECT * FROM cached_msg WHERE receiver='admin' AND status='0'";
	$q_count_unread = $conn->query($count_unread);
	
	if($q_count_unread->num_rows > 0) {
		$unread = $q_count_unread->num_rows;
	}
	
	
/*
* This is a navigation bar to in admin menu nav bar
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
				<a class="navbar-brand hidden-lg hidden-md" href="#">Admin Menu</a>
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
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Reservation<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
						
							<li>
								<a href="reservations.php"><strong>Request Reservations</strong></a>
							</li>
							<li>
								<a href="confirmed_reserve.php"><strong>Confirmed Reservations</strong></a>
							</li>
							<li>
								<a href="archive.php"><strong>Archive</strong></a>
							</li>
							<!--<li><a href="search.php"><strong>Search Reservations</strong></a></li>-->
							
						</ul>
                    </li>
					
					<li>
						<a href="report.php"><strong>Report</strong></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Messages
						<span class="label label-danger label-as-badge"><?php echo $unread; ?></span>
						<span class="caret"></span></strong></a>
					
						<ul class="dropdown-menu">
							<li class="menu-dropdown"><a href="compose_message.php"><strong>Compose Message</strong></a></li>
							<li><a href="inbox.php"><strong>Inbox
							<span class="label label-danger label-as-badge"><?php echo $unread; ?></span></strong></a></li>
							<li><a href="sent_messages.php"><strong>Sent Items</strong></a></li>
							<li><a href="draft.php"><strong>Draft</strong></a></li>
						</ul>
					</li><li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Add<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li>
								<a href="add_priests.php"><strong>Priest</strong></a>
								<a href="add_event.php"><strong>Event</strong></a>
								<a href="add_form.php"><strong>Form</strong></a>
								<a href="add_about.php"><strong>About</strong></a>
								<a href="add_limit.php"><strong>User Limitations</strong></a>
								<a href="add_cal_label.php"><strong>Calendar Label</strong></a>
								
							</li>
							
							
						</ul>
                    </li>
					</li><li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Edit<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li>
								<a href="priest.php"><strong>Priests</strong></a>
								<a href="events.php"><strong>Events</strong></a>
								<a href="abouts.php"><strong>Abouts</strong></a>
								<a href="forms.php"><strong>Forms</strong></a>
								<a href="userlimit.php"><strong>User Limitaitons</strong></a>
								<a href="callabel.php"><strong>Calendar Label</strong></a>
								<!-- Start in this line of this script continue -->
							</li>
							<li>
								<a href="edit_announcement.php"><strong>Edit Announcement</strong></a>
							</li>
							<li>
							
							</li>
							
							
						</ul>
                    </li>
					</li><li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Delete<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li>
								<a href="dpriest.php"><strong>Priests</strong></a>
								<a href="devent.php"><strong>Events</strong></a>
								<a href="dform.php"><strong>Form</strong></a>
								<a href="dabout.php"><strong>About</strong></a>
								<a href="duserlimit.php"><strong>User Limitation</strong></a>
								<a href="del_cal_label.php"><strong>Calendar Label</strong></a>
								
							</li>
							
							
						</ul>
                    </li>
					
					<li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Certificates<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li>
								<a href="../forms/marriage.pdf" target="_blank"><strong>Marriage Certificate</strong></a>
								<a href="../forms/bapc.pdf" target="_blank"><strong>Birth Certificate</strong></a>
								<a href="../forms/gmc.pdf" target="_blank"><strong>Good Moral Certificate</strong></a>
							</li>
							
							
						</ul>
                    </li>

					<li class="dropdown">
                        <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Accounting<span class="caret"></span></strong></a>
						
						<ul class="dropdown-menu">
							<li>
								<a href="accounts.php"><strong>Accounts</strong></a>
								<a href="vouchers.php"><strong>Vouchers</strong></a>
								<a href="../forms/gmc.pdf" target="_blank"><strong>Income Statement</strong></a>
							</li>
							
							
						</ul>
                    </li>
					
					<li id="user-position" class="dropdown">
						<a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong>Admin<span class="caret"></span></strong></a>
						<ul class="dropdown-menu">
							<!--<li><a href="update.php"><strong>Update Details</strong></a></li>-->
							<li><a href="add_recovery.php"><strong>Add Recovery Question</strong></a></li>
							<li><a href="del_recovery.php"><strong>Delete Recovery Question</strong></a></li>
							<li><a href="changepass.php"><strong>Change Password</strong></a></li>
							<li class="divider"></li>
							<li><a href="?s=logout"><strong>Logout</strong></a></li>
						</ul>
					</li>
				
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	