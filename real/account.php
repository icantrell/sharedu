<?php include_once("classes.php"); session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>


<head>
<script src="js/lib/prototype.js" type="text/javascript"></script>
<script src="js/src/scriptaculous.js" type="text/javascript"></script>
<script src="load.js" type="text/javascript"></script>
</head>



<body>


<div id="container">

	
	<?php include("header.php"); ?>
	<div id="content">
	
	
	<?php
	if($_SESSION['user'])
	{
	include_once("ui_functions.php");	
	include_once("global_functions.php");
	
	connect_to_database();
	
	//message info
	$reciever=protect($_POST['reciever']);
	$title= protect($_POST['title']);
	$message= protect($_POST['new_message']);
	
	//item info
	$cat=protect($_POST['cat']);
	$con=protect($_POST['con']);
	$item_name=protect($_POST['name']);
	$dis=protect($_POST['discription']);
	$bid=protect($_POST['bid']);
	$other=protect($_POST['other']);
	$pic_size=protect($_FILES['userfile']['size']);
	$tmpName  = $_FILES['userfile']['tmp_name'];
	
	
	//nav bar
	echo "
		<div id=\"account_nav\">
			
			
			<div class=\"vert\">
			<ul>
			<li>Welcome &nbsp;".$_SESSION['username']."</li>";?>
			<li><button onclick="loadContent(1,'account_content','account_nav.php');" > new message </button></li>
			<li><button onclick="loadContent(2,'account_content','account_nav.php');" > mailbox </button></li>
			<li><button onclick="loadContent(3,'account_content','account_nav.php');" > account info </button></li>
			<li><button onclick="loadContent(4,'account_content','account_nav.php');" > current sales </button></li>
			<li><button onclick="loadContent(5,'account_content','account_nav.php');" > new sale </button></li>
			</ul>
			</div>
			
			
		</div>
		<?php
		$flag=true;
		//if the user is sending a message
		if($reciever)
		{
			$flag=false;
		}
		
		//if the user is creating a sale
		else if($item_name)
		{
			$flag=false;
		}
		
		//if none of those are happening be normal
		if($flag)
		{
			//account content
			echo "<div id=\"account_content\" class=\"account_content\">";
			
			
			include_once("info.php");
			
				
			echo "
			<p id=\"mainAreaLoading\" class=\"mainAreaLoading\" style=\"display: none\">

			<span style=\"position: relative; top: 100px; left: 100px\">
				<img src=\"images/ajaxLoad.gif\" align=\"center\">
				Loading...
			</span>
			</div>
			
		";
		}
	}
	
	else
	echo "you are not currently logged in! to login click here:  <a href=\"login.php\"> login </a> <br>
	Or if you have not made an account click here to register <a href=\"register.php\"> register </a>";
	?>
	
	</div>
	
	<?php include("ads.html");?>

</div>
</body>


</html>