<?php include_once("classes.php"); session_start();


include_once("constants.php");
include_once("global_functions.php");
connect_to_database();

$message=$_GET['selected_message'];
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
	for($i=mysql_numrows($res)-1; $i>=0; --$i)
	{
		//button start
		echo "<button onclick=\"loadContent(". mysql_result($res,$i,"id").",'message','show_message.php');\" > ";
		if(mysql_result($res,$i,"new"))
			echo "title: <span style=\" color: blue\" >". mysql_result($res,$i,"title")."</span> <br> 
			from: <span style=\" color: blue\" >".mysql_result($res,$i,"sender_name")."</span>
			<span style=\" color: #FF9900\" > new! </span>";
		else
			echo "title: <span style=\" color: blue\" >". mysql_result($res,$i,"title")."</span> <br> 
			from: <span style=\" color: blue\" > ".mysql_result($res,$i,"sender_name")."</span>";
			
		echo "</button><br>";
	}
	echo "</div> ";
	//text box end
}
else
	echo "Your mailbox is currently empty!";

echo " </div> <div id=\"message\"> ";


echo "</div>";
 
 
 

?>