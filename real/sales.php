<?php include_once("classes.php"); session_start();

include_once("global_functions.php");
connect_to_database();

$sale=$_POST['selected_sale'];
if($_POST['delete'])
 {
	delete_sale($_POST['delete']);
 }

$sql= "SELECT * FROM `sales` WHERE `sender_id`= '". $_SESSION['user']->uid()."'";
$res= mysql_query($sql) or die(mysql_error());





if(!mysql_numrows($res)==0)
{
	echo " <div id=\"messages\">";
	//text box start
	echo "<div style=\"height:500px;width:250px;font:16px/26px Georgia, Garamond, Serif; overflow:auto;\">".
	"<span style=\" color: green\" > &nbsp Sales:</span> <br>";

	for($i=mysql_numrows($res)-1; $i>=0; --$i)
	{
		//button start
		echo "<button onclick=\"loadContent(". mysql_result($res,$i,"id").",'message','display_sale.php');\"> ";
		
		echo "Item: <span style=\" color: blue\" >".mysql_result($res,$i,"Item_name"). "<br>";
		
		echo "</button><br>";
	}
	echo "</div> ";
	//text box end
}
else
	echo "You currently have no active sales!";

echo " </div> <div id=\"message\">";
	
echo "</div>";

?>