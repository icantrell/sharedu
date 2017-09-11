<?php
	include_once("constants.php");
	
	function new_mail()
	{
		if($_SESSION['user'])
		{
			$sql="SELECT * FROM `users` WHERE `id` = ".$_SESSION['user'];
			$res= mysql_query($sql) or die(mysql_error());
			return mysql_result($res,0,"new_messages");
		}
		
		return null;

	}
	
	function number_messages()
	{
		if($_SESSION['user'])
		{
			$sql="SELECT * FROM `users` WHERE `id` = ".$_SESSION['user'];
			$res= mysql_query($sql) or die(mysql_error());
			return$res= mysql_query($sql) or die(mysql_error()); mysql_result($res,0,"messages");
		}
		
		return null;
	}
	
	function increment_messages($id)
	{
		if($id)
		{
			$sql="UPDATE `users` SET `messages`= `messages`+1 WHERE `id`=".$id;
			$res= mysql_query($sql) or die(mysql_error());
		}
	}
	
	function increment_new_messages($id)
	{
		if($id)
		{
			$sql="UPDATE `users` SET `new_messages`= `new_messages`+1 WHERE `id`=".$id;
			$res= mysql_query($sql) or die(mysql_error());
		}
	}
	
	function decrement_messages($id)
	{
		if($id)
		{
			$sql="UPDATE `users` SET `messages`= `messages`-1 WHERE `id`=".$id;
			$res= mysql_query($sql) or die(mysql_error());
		}
	}
	
	function decrement_new_messages($id)
	{
		if($id)
		{
			$sql="UPDATE `users` SET `new_messages`= `new_messages`-1 WHERE `id`=".$id;
			$res= mysql_query($sql) or die(mysql_error());
		}
	}
?>