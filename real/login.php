<?php session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>




<body>


<div id="container">

	
	
	<?php include("header.php"); ?>
	<div id="content">
	
	<?php 
	
	include_once "global_functions.php";
	include_once "classes.php";
	
	connect_to_database();
	
	
	echo "<title>Login</title>\n";

	if ($_SESSION['user']) {
		echo "You are already logged in, if you wish to log out, please <a href=\"./logout.php\">click here</a>!\n";
	} else {

		if (!$_POST['submit']) {
			echo "<table border=\"0\" cellspacing=\"3\" cellpadding=\"3\">\n";
			echo "<form method=\"post\" action=\"./login.php\">\n";
			echo "<tr><td>Username</td><td><input type=\"text\" name=\"username\"></td></tr>\n";
			echo "<tr><td>Password</td><td><input type=\"password\" name=\"password\"></td></tr>\n";
			echo "<tr><td colspan=\"2\" align=\"right\"><input type=\"submit\" name=\"submit\" value=\"Login\"></td></tr>\n";
			echo "</form></table>\n";
			
		}else {
			$user = protect($_POST['username']);
			$pass = protect($_POST['password']);
			
				if($user && $pass){
					$sql = "SELECT id FROM `users` WHERE `username`='".$user."'";
					$res = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($res) > 0){
						$sql2 = "SELECT id FROM `users` WHERE `username`='".$user."' AND `password`='".md5($pass)."'";
						$res2 = mysql_query($sql2) or die(mysql_error());
						if(mysql_num_rows($res2) > 0){
							$row = mysql_fetch_assoc($res2);
							$_SESSION['user'] = new user($row['id']);							
							
							echo "You have successfully logged in as " . $_SESSION['user']->username() . "<br><br><a href=\"./account.php\">Click here to go to your account page</a>\n";
						}else {
							echo "Username and password combination are incorrect!\n";
						}
					}else {
						echo "The username you supplied does not exist!\n";
					}
				}else {
					echo "You must supply both the username and password field!\n";
				}
		}

	}
	
	?>
	
	</div>
	<?php include("ads.html");?>

</div>
</body>


</html>