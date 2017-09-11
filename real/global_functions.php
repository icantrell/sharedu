<?php
//scramble (encryption)
//ban

function connect_to_database()
{	
    $db=mysql_connect(localhost,"root","") or die(mysql_error());
	mysql_select_db("scshare",$db) or die( mysql_error());
}

function user_exists($username)
{
	//use protect before using this function!
	$sql = "SELECT * FROM `users` WHERE `username`='".$username."'";
	$res = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res) == 0)
	{
		return NULL;
	}
	else
	{
		return mysql_result($res,0,"id");
	}
}

function in_range($string,$start,$end)
{
	$range= range($start,$end);
	if(in_array(strlen($string),$range))
		return true;
	else
		return false;
}

function delete_sale($id)
{
	$sql= "SELECT * FROM `sales` WHERE `id`=".$id;
	$res=mysql_query($sql) or die(mysql_error());
	
	if(mysql_result($res,0,'picture'))
		unlink(mysql_result($res,0,'picture'));
	
	$query= " DELETE FROM `sales` WHERE `id` = ".$id;
	mysql_query($query) or die(mysql_error());
}


function output_errors($errors,$string)
{
if(count($errors) > 0)
{
	echo "<br>".$string."<br>";
			
            foreach($errors AS $error){
                echo "<span style=\" color: red \"<b>" .$error . "</b> </span><br>\n";
            }
			echo "<br>\n";
			
	return true;
}

else

	return false;
}

//detect_attack
function protect($string) 
{
return mysql_real_escape_string( strip_tags(trim( $string)));
}

function display_sale($res, $index)
{
	echo "<span style=\" color: green\" > Item Name: </span>".mysql_result($res,$index,"Item_name")."<br> 
	<span style=\" color: green\"> Owner: </span>".mysql_result($res,$index,"sender_username")."<br>
	<span style=\" color: green\"> Category: </span>".mysql_result($res,$index,"category")."<br>
	<span style=\" color: green\"> Time Created: </span>".mysql_result($res,$index,"time")."<br>
	<span style=\" color: green\"> Condition: </span>".mysql_result($res,$index,"condition")."<br>
	<br><span style=\" color: green\"> Discription: </span> <br>".mysql_result($res,$index,"discription")."<br>
	<br><span style=\" color: green\"> Other Comments: </span> <br>".mysql_result($res,$index,"other")."<br>
	";
	if(mysql_result($res,$index,"picture"))
		echo "<br><span style=\" color: green\"> Picture: </span> <br> <img src=".mysql_result($res,$index,"picture")." width=\"570\" height=\"570\" />";
}

?>