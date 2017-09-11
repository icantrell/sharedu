<?php
$selected=$_GET['selected'];
if($_GET['search'] or $selected)
{
	echo "<div id=\"sales\">";
	
	include_once("global_functions.php");
	connect_to_database();
	
	if(!$selected)
	{
		$flag=true;
		$con=protect($_GET['con']);
		$cat=protect($_GET['cat']);
		$key=protect($_GET['name']);
		$seller=protect($_GET['seller_name']);
		
		if($con)
			$con="AND `condition` = '".$con."'";
			
		if($cat)
			$cat="AND `category` = '".$cat."'";
			
		if($seller)
			$seller="AND `sender_username` LIKE '%".$seller."%'";
			
		if($key)
			$key="AND `item_name` LIKE '%".$key."%'";
		
		if(!$con and !$cat and !$key and !$seller)
			$flag=false;
			
		if($flag)
		{
			$sql="SELECT * FROM `sales` WHERE".$key.$seller.$cat.$con;
			$sql=preg_replace('/AND/','',$sql,1);
			$res= mysql_query($sql) or die(mysql_error());
			
			
			$i=mysql_numrows($res)-1;
		}
		
			
		if($i>=0 and $flag)
		{
			//text box start
			echo "<div style=\"height:500px;width:700px;font:16px/26px Georgia, Garamond, Serif; overflow:auto;\">".
			"<span style=\" color: green\" > &nbsp Sales:</span> <br>";
			//form start
			echo "<form action=\"browse.php\" method=\"get\"> ";
			for(; $i>=0; --$i)
			{
				echo "<button name=\"selected\" value=".mysql_result($res,$i,"id")." type=\"submit\">";
				
				echo "Item: <span style=\" color: blue\" >".mysql_result($res,$i,"Item_name")."</span>".
					"&nbsp &nbsp Condition: <span style=\" color: blue\" >".mysql_result($res,$i,"condition")."</span>".
					"&nbsp &nbsp Time created: <span style=\" color: blue\" >".mysql_result($res,$i,"time")."</span>".
					"&nbsp &nbsp Owner: <span style=\" color: blue\" >".mysql_result($res,$i,"sender_username")."</span> <br>";
				
				echo "</button><br>";
			}
			
		echo "</form> </div>";
		}
		else
		{
			echo "no active sales were found with the sepecified criteria.";
		}
		
	
	
		echo "</div>";	
	}
	
	
	else
	{
		echo "<div id=\"sale\">";
		$sql="SELECT * FROM `sales` WHERE `id` = '".$selected."'";
		$res= mysql_query($sql) or die(mysql_error());
		if(mysql_numrows($res)>0)
			display_sale($res,0);
	}
	
	//form end then text box end
	
	echo " </div>";

	
	
	
		
}		

?>