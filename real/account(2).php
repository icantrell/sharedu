<?php include_once("classes.php"); session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title> SC Share</title>
<link href="main_style.css" rel="stylesheet" type="text/css" />

<head>
<script type="text/javascript">
function loadNav()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("account_content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",'".$_GET['nav']."',true);
xmlhttp.send();
}
</script>
</head>

</head>



<body>


<div id="container">

	
	<?php include("header.php"); ?>
	<div id="content">
	
	
	<?php
	if($_SESSION['user'])
	{
	include_once("ui_functions.php");	
	
	//nav bar
	echo "
		<div id=\"account_nav\">
			<form action=\"account.php\" method=\"get\" >
			
			<div class=\"vert\">
			<ul>
			<li>Welcome &nbsp;".$_SESSION['username']."
			<li><button name=\"nav\" type=\"submit\" value=\"compose.php\" onclick=\"loadNav()\" > new message </button></li>
			<li><button name=\"nav\" type=\"submit\" value=\"mailbox.php\" onclick=\"loadNav()\" > mailbox </button></li>
			<li><button name=\"nav\" type=\"submit\"  value=\"info.php\" onclick=\"loadNav()\" > account info </button></li>
			<li><button name=\"nav\" type=\"submit\"  value=\"sales.php\" onclick=\"loadNav()\" > current sales </button></li>
			<li><button name=\"nav\" type=\"submit\"  value=\"create_sale.php\" onclick=\"loadNav()\" > new sale </button></li>
			</ul>
			</div>
			
			</form>
		</div>";
		
		//account content
		echo "<div id=\"account_content\">";
		
		
		include_once("info.php");
		
			
		echo "	
		</div>
	";
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