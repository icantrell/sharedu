<?php

	$id= $_POST['content'];
	include_once("global_functions.php");
	connect_to_database();
	
	$sql= "SELECT * FROM `sales` WHERE `id`= '".$id."'";
	$res= mysql_query($sql) or die(mysql_error());
	
	echo "<div style=\"height:500px;width:600px;font:16px/26px Georgia, Garamond, Serif;overflow:auto;\">";
	
	echo "<span style=\" color: green\" > Item Name: </span>".mysql_result($res,0,"Item_name")."<br> 
	<span style=\" color: green\"> Owner: </span>".mysql_result($res,0,"sender_username")."<br>
	<span style=\" color: green\"> Category: </span>".mysql_result($res,0,"category")."<br>
	<span style=\" color: green\"> Time Created: </span>".mysql_result($res,0,"time")."<br>
	<span style=\" color: green\"> Condition: </span>".mysql_result($res,0,"condition")."<br>
	<br><span style=\" color: green\"> Discription: </span> <br>".mysql_result($res,0,"discription")."<br>
	<br><span style=\" color: green\"> Other Comments: </span> <br>".mysql_result($res,0,"other")."<br>
	";
	if(mysql_result($res,0,"picture"))
		echo "<br><span style=\" color: green\"> Picture: </span> <br> <img src=".mysql_result($res,0,"picture")." width=\"570\" height=\"570\" />";
		
		
	echo "
	 <button name=\"delete\" value=\"".mysql_result($res,0,"id")."\" type=\"submit\"> delete sale </button>";
		
	echo "</div>";
?>