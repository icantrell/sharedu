<?php

$id= $_POST['content'];
echo "<div style=\"height:300px;width:600px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;\">";
include_once("global_functions.php");
connect_to_database();

$sql= "SELECT * FROM `pms` WHERE `id`= '".$id."'";
$res= mysql_query($sql) or die(mysql_error());

if(mysql_numrows($res))
{

	echo "<span style=\" color: green\" > From: </span>". mysql_result($res,0,"sender_name")."<br> 
	<span style=\" color: green\"> Title: </span>". mysql_result($res,0,"title")."<br>
	<span style=\" color: green\"> Time Sent: </span>". mysql_result($res,0,"time")."<br>
	<span style=\" color: #663300\"> Message: </span> <br><br>". mysql_result($res,0,"message");
	//select the message
	
	
	//if new message do this
	if( mysql_result($res,0,"new"))
	{
		$query= " UPDATE `pms` SET `new`='".false."' WHERE `id` = ". mysql_result($res,0,"id");
		mysql_query($query) or die(mysql_error());
		decrement_new_messages($_SESSION['user']->uid());
	}
	
	echo "<br><br> <button value=\"".mysql_result($res,$message,"id")."\" > delete message </button> ";
		
}

echo "</div>";
?>
