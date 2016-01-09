<?php
	if(! isset($_SESSION['code'])) {

		exit("Direct Script Not Allowed!");

	}

/*
* This is a navigation bar to display if,
* it has no user logged in on website
*
*/

?>	

	<!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Scheduling &amp; Reservation<span class="caret"></span></strong></a>
					
						<ul class="dropdown-menu">
							<li class="menu-dropdown"><a href="reservation.php">Scheduling and Reservation Form</a></li>
							<li><a href="#">Reservation Status</a></li>
						</ul>
					</li>
                    <li>
                        <a href="index.php">
						<span class="glyphicon glyphicon-home"></span> 
						<strong>Home</strong>
						</a>
                    </li>
                    <li>
                        <a href="services.php"><strong>Services</strong></a>
                    </li>
                    <li>
                        <a href="contact.php"><strong>Contact</strong></a>
                    </li>
                    <li>
                        <a href="about.php"><strong>About</strong></a>
                    </li>
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	