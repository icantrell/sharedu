<?php include_once("classes.php"); session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>




<body>


<div id="container">

	
	<?php include("header.php"); ?>
	<div id="content">
	<?php
	

	if ($_SESSION['user']) {
		session_destroy();
		echo "You have successfully logged out!\n";
	} else {
		echo "You must be logged in to logout!\n";
	}

	?>
	</div>
	<?php include("ads.html");?>

</div>
</body>


</html>