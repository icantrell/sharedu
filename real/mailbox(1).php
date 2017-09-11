<?php 

include_once("constants.php");
include_once("global_functions.php");
connect_to_database();

$message=$_POST['selected_message'];
if($_POST['delete'])
 {
	$query= " DELETE FROM `pms` WHERE `id` = ".$_POST['delete'];
	mysql_query($query) or die(mysql_error());
	decrement_messages($_SESSION['user']->uid());
 }

$sql= "SELECT * FROM `pms` WHERE `reciever_id`= '". $_SESSION['user']->uid()."'";
$res= mysql_query($sql) or die(mysql_error());





if(!mysql_numrows($res)==0)
{
	echo " <div id=\"messages\">";
	//text box start
	echo "<div style=\"height:500px;width:250px;font:16px/26px Georgia, Garamond, Serif; overflow:auto;\">".
	"<span style=\" color: green\" > &nbsp Messages:</span> <br>";
	//form start
	echo "<form action=\"account.php\" method=\"post\"> ";
	for($i=mysql_numrows($res)-1; $i>=0; --$i)
	{
		//button start
		$x=$i+1;
		echo "<button name=\"selected_message\" value= $x type=\"submit\"> ";
		if(mysql_result($res,$i,"new"))
			echo "title: <span style=\" color: blue\" >". mysql_result($res,$i,"title")."</span> <br> 
			from: <span style=\" color: blue\" >".mysql_result($res,$i,"sender_name")."</span>
			<span style=\" color: #FF9900\" > new! </span>";
		else
			echo "title: <span style=\" color: blue\" >". mysql_result($res,$i,"title")."</span> <br> 
			from: <span style=\" color: blue\" > ".mysql_result($res,$i,"sender_name")."</span>";
			
		echo "</button><br>";
	}
	echo "</form> </div> ";
	//form end then text box end
}
else
	echo "Your mailbox is currently empty!";

echo " </div> <div id=\"message\">

<div style=\"height:300px;width:600px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;\">";



if($message)
{
	--$message;
	echo "<span style=\" color: green\" > From: </span>".mysql_result($res,$message,"sender_name")."<br> 
	<span style=\" color: green\"> Title: </span>".mysql_result($res,$message,"title")."<br>
	<span style=\" color: green\"> Time Sent: </span>".date(mysql_result($res,$message,"time"))."<br>
	<span style=\" color: #663300\"> Message: </span> <br><br>".mysql_result($res,$message,"message");
	//select the message
	
	
	//if new message do this
	if(mysql_result($res,$message,"new"))
	{
		$query= " UPDATE `pms` SET `new`='".false."' WHERE `id` = ".mysql_result($res,$message,"id");
		mysql_query($query) or die(mysql_error());
		decrement_new_messages($_SESSION['user']->uid());
	}
		
	
	++$message;
}

echo "</div>";

if($message)
{
	--$message;
	echo "
	 <form action=\"account.php\" method=\"post\"> 
	 <button name=\"delete\" value=\"".mysql_result($res,$message,"id")."\" type=\"submit\"> delete message
	 </button> </from>";
 }
 echo "</div>";
 
 
 

?>