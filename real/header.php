<div id="header">
	
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title> SharEDU</title>
		<link href="main_style.css" rel="stylesheet" type="text/css" />
		</head>
		
		
		<div class="title_name">
		<font size="5"><h1 > SharEDU</h1></font>
		</div>
		
		<div class="hlinks">
		<ul>
			<li><a href="index.php" > Home</a></li>
			<li><a href="account.php" > Account</a></li>
			<li><a href="register.php" > Register</a></li>
			<li><a href="browse.php" > Browse</a></li>
			<li><a href="about_us.php" > About Us</a></li>			
		</ul>
		</div>
		
		<div class="login">
		
		<?php 
		
		
		if(!$_SESSION['user'])
			echo "<a href=\"login.php\" > Login</a>";
			
		else
		{
			echo"<p>"."Currently logged in as <span style= \" color: green\"> ". $_SESSION['user']->username()."</span></p>";
			echo "<a href=\"logout.php\" > Logout</a>";
		}
			
		?>
		
		</div>
		
	</div>