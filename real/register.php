<?php include_once("classes.php"); session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<body>

<div id="container">
	<?php include("header.php")?>
	<div id="content">
	
	<?php
	if(!$_SESSION['user'])
	{	
		include_once("constants.php");
		include_once "global_functions.php";
		
		connect_to_database();
		
		
		
		echo "Elements marked with asterisk need to be filled out <br/><br/><br/>";
		echo "<table border=\"0\" cellspacing=\"3\" cellpadding=\"3\">\n";
		echo "<form method=\"post\" action=\"register.php\">\n";
		echo "<tr><td colspan=\"2\" align=\"center\">Registration Form</td></tr>\n";
		echo "<tr><td>*Username</td><td><input type=\"text\" value=\"".$_POST['username']."\" name=\"username\"></td></tr>\n";
		echo "<tr><td>*Password</td><td><input type=\"password\"  name=\"password\"></td></tr>\n";
		echo "<tr><td>*Confirm</td><td><input type=\"password\"   name=\"passconf\"></td></tr>\n";
		echo "<tr><td>*E-Mail</td><td><input type=\"text\"   value=\"".$_POST['email']."\"  name=\"email\"></td></tr>\n";
		echo "<tr><td>Name</td><td><input type=\"text\"   value=\"".$_POST['name']."\"  name=\"name\"></td></tr>\n";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Register\"></td></tr>\n";
		echo "</form></table>\n";
		if($_POST['submit']){
		
			//still need sql injection checks and filters
			$user = protect($_POST['username']);
			$pass = protect($_POST['password']);
			$confirm = protect($_POST['passconf']);
			$email = protect($_POST['email']);
			$name = protect($_POST['name']);
			$user_ip= ip2long($_SERVER['REMOTE_ADDR']);
			
			
			
			//check for errors
			$errors = array();
			
			if(!$user){
				$errors[] = "Username is not defined!";
			}
			
			if(!$pass){
				$errors[] = "Password is not defined!";
			}
			
			if($pass){
				if(!$confirm){
					$errors[] = "Confirmation password is not defined!";
				}
			}
			
			if(!$email){
				$errors[] = "E-mail is not defined!";
			}
			
			
			if($user){
				if(!ctype_alnum($user)){
					$errors[] = "Username can only contain numbers and letters!";
				}
				
				$range = range(4,32);
				if(!in_array(strlen($user),$range)){
					$errors[] = "Username must be between 4 and 32 characters!";
				}
			}
			
			if($pass && $confirm){
				if($pass != $confirm){
					$errors[] = "Passwords do not match!";
				}
			}
			
			if($email){
				$checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
				if(!preg_match($checkemail, $email)){
					$errors[] = "E-mail is not valid, must be a valid address (name@server.tld)!";
				}
			}
			
			if($name){
				$range2 = range(2,64);
				if(!in_array(strlen($name),$range2)){
					$errors[] = "Your name must be between 2 and 64 characters!";
				}
			}
			
			if($pass){
				$range3 = range(4,32);
				if(!in_array(strlen($pass),$range3)){
					$errors[] = "Your password must be between 4 and 32 characters!";
				}
			}
			
			if($user){
				
					if(user_exists($user)){
						$errors[] = "The username you supplied is already in use!";
					}
			}
			
			if($email){
				$sql2 = "SELECT * FROM `users` WHERE `email`='".$email."'";
				$res2 = mysql_query($sql2) or die(mysql_error());
				
					if(mysql_num_rows($res2) > 0){
						$errors[] = "The e-mail address you supplied is already in use of another user!";
					}
			}
			
		
			if(!output_errors($errors,"the following errors occured when filling out the registration form:")){
				$sql4 = "INSERT INTO `users`
						(`username`,`password`,`email`,`name`,`user_ip`)
						VALUES ('".$user."','".md5($pass)."','".$email."','".$name."','".$user_ip."')";
				$res4 = mysql_query($sql4) or die(mysql_error());
				echo "<br>You have successfully registered with the username <b>".$user."</b>!". "<br> click here to login: <a href=\"login.php\"> login </a>";
			}
		}
	}
	else
		echo"<font size=\"5\" face=\"arial\" color=\"red\">You can not register, as you are already logged in to an account! </font>";
	
	
	//end register form
	?>
	
	</div>
	<?php include("ads.html")?>
</div>

</body>
</html>