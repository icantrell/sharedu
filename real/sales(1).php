<?php

include_once("global_functions.php");
connect_to_database();

$sale=$_POST['selected_sale'];
if($_POST['delete'])
 {
	delete_sale($_POST['delete']);
 }

$sql= "SELECT * FROM `sales` WHERE `sender_id`= '". $_SESSION['user']."'";
$res= mysql_query($sql) or die(mysql_error());





if(!mysql_numrows($res)==0)
{
	echo " <div id=\"messages\">";
	//text box start
	echo "<div style=\"height:500px;width:250px;font:16px/26px Georgia, Garamond, Serif; overflow:auto;\">".
	"<span style=\" color: green\" > &nbsp Sales:</span> <br>";
	//form start
	echo "<form action=\"account.php\" method=\"post\"> ";
	for($i=mysql_numrows($res)-1; $i>=0; --$i)
	{
				//button start
		$x=$i+1;
		echo "<button name=\"selected_sale\" value= $x type=\"submit\"> ";
		
		echo "Item: <span style=\" color: blue\" >".mysql_result($res,$i,"Item_name"). "<br>";
		
		echo "</button><br>";
	}
	echo "</form> </div> ";
	//form end then text box end
}
else
	echo "You currently have no active sales!";

echo " </div> <div id=\"message\">
	
<div style=\"height:500px;width:600px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;\">";

if($sale)
{
	--$sale;
	
	display_sale($res,$sale);
	
	++$sale;
}

echo "</div>";

if($sale)
{
	--$sale;
	echo "
	 <form action=\"account.php\" method=\"post\"> 
	 <button name=\"delete\" value=\"".mysql_result($res,$sale,"id")."\" type=\"submit\"> delete sale
	 </button> </from>";
 }
 echo "</div>";

?>