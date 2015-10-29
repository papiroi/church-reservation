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
    <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
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
                    <li>
                        <a href="index.php"><strong>Home</strong></a>
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
					<li>
						<a href="login.php"><strong>Login</strong></a>
					</li>
					<li>
						<a href="register.php"><strong>Register</strong></a>
					</li>
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	