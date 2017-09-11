<?php

include_once("global_functions.php");
connect_to_database();


if(!$_POST['reciever'])
{

	echo "
	<form action=\"account.php\" method=\"post\">
		<div class=\"vert\">
		<ul>
		<li>username </li>
		<li><textarea name=\"reciever\" rows=1 cols=20>".$_GET['reciever']."</textarea> </li>
		<li>title </li>
		<li><textarea name=\"title\" rows=1 cols=20>".$_GET['title']."</textarea> </li>
		<li>message </li>
		<li><textarea name=\"new_message\" rows=13 cols=100></textarea> </li>
		<li><button  type=\"submit\"  value=\"submit\">send</button> </li>
		</ul>
		</div>
	</form>
	";
	
	
}

else
{

	$reciever=protect($_POST['reciever']);
	$title= protect($_POST['title']);
	$message= protect($_POST['new_message']);


	$errors= array();
	
	$reciever_id=user_exists($reciever);
	
	if(!$reciever_id)
		$errors[]= "username(recieving username) does not exist";
		
	
	if($title){
		
		if(!in_array(strlen($title),range(0,32)))
		$errors[]= "title must not exceed 32 characters";
	}

	if(!$message or $message=="new message:")
		$errors[]= "something needs to be written in the \"new message\" box";
		
	if(output_errors($errors, "the following errors have occurred when sending the message:"))
	{
		echo "
		<form action=\"account.php\" method=\"post\">
			<div class=\"vert\">
			<ul>
			<li><textarea name=\"reciever\" rows=1 cols=20>".$reciever." </textarea>
			<li><textarea name=\"title\" rows=1 cols=20>".$title."</textarea>
			<li><textarea name=\"new_message\" rows=13 cols=115>".$message."</textarea> </li>
			<li><button  type=\"submit\"  value=\"submit\">send</button>
			</ul>
			</div>
		</form>
		";
	}
	else
	{
		$sql4 = "INSERT INTO `pms`
                    (`sender_id`,`reciever_id`,`title`,`message`,`sender_name`)
                    VALUES ('".$_SESSION['user']."','".$reciever_id."','".$title."','".$message."','".$_SESSION['username']."')";
					
		$res4 = mysql_query($sql4) or die(mysql_error());
		increment_messages($reciever_id);
		increment_new_messages($reciever_id);
		echo "<p style=\" green \" > Your message was successfully sent! </p>";
	}
	
	
}

?>