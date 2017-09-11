<?php

include_once("global_functions.php");
connect_to_database();

if(!$_POST['sale'])
{	
	echo "Elements marked with asterisk need to be filled out <br/><br/><br/>";
	echo "<table border=\"0\" cellspacing=\"4\" cellpadding=\"3\">\n";
	echo "<form method=\"post\" enctype=\"multipart/form-data\" action=\"account.php\">\n";
	echo "<tr><td colspan=\"2\" align=\"center\"> <span style=\" color: green\" >Create New Sale </span></td></tr>\n";
	
	echo "<tr><td>*Item Name</td><td><input type=\"text\"  name=\"name\"></td></tr>\n";
	echo "<tr><td>*Condition</td><td><select name=\"con\">
			<option value=\"\"> </option>
			<option value=\"poor\"> poor</option>
			<option value=\"scratched\"> scratched</option>
			<option value=\"dirty\"> dirty</option>
			<option value=\"slightly worn\"> slightly worn</option>
			<option value=\"good\"> good</option>
			<option value=\"like new\"> like new</option>
			<option value=\"never opened\"> never opened</option>
			</select></td></tr>\n";
	echo "<tr><td>*Category</td><td><select name=\"cat\">
			<option value=\"\"> </option>
			<option value=\"books\"> books</option>
			<option value=\"electronics\"> electronics</option>
			<option value=\"furniture\"> furniture</option>
			<option value=\"utensils/dishes\"> utensils/dishes</option>
			<option value=\"misc\"> misc</option>
			</select></td></tr>\n";
	echo "<tr><td>*Use Bidding</td><td> <input type=\"radio\" name=\"bid\" value=1 /> No </td></tr>\n";
	echo "<tr><td></td><td><input type=\"radio\" name=\"bid\" value=2 /> Yes </td></tr>\n";
	echo "<tr><td>Other information</td><td><textarea type=\"text\" name=\"other\"></textarea></td></tr>\n";
	echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2097152\">";
	echo "<tr><td>Picture of Item(2mb max)</td><td><input name=\"userfile\" type=\"file\" id=\"userfile\"></td></tr>\n";
	echo "<tr><td>Discription</td><td><textarea type=\"text\" name=\"discription\"></textarea></td></tr>\n";
	
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"sale\" value=\"Submit\"></td></tr>\n";
	echo "</form></table>\n";

	
}
else
{




$errors= array();

if($tmpName)
{
	$pic_url= "uploaded_images/".($_SESSION['user']+33).md5(time().$_FILES['userfile']['name']);
	
	if(0<$_FILES['userfile']['error'])
		$errors[]="there was an error uploading the file";
		
	if (!exif_imagetype($tmpName))
		$errors[]= "picture file is not a valid type";
}
	
	
if($pic_size>2097152)
	$errors[]="the picture exceeds 15 megabytes!";
	
if(!in_range($con,2,16))
	$errors[]="this condition is not valid!";

if(!in_range($item_name,4,64))
	$errors[]="the name must be between 4 and 64 characters";

if($cat!="books" and $cat!="electronics" and $cat!="furniture" and $cat!="utensils/dishes" and $cat!="misc")
	$errors[]="a valid category was not selected";

--$bid;
if($bid!=1 and $bid!=0)
	$errors[]="you must select whether or not the sale will be a bid";

	
if(!output_errors($errors,"the following errors have occured when creating this sale: "))
{
	if($tmpName)
		move_uploaded_file($tmpName,$pic_url);
	
	$sql = "INSERT INTO `sales`
			(`picture`,`item_name`,`sender_username`,`sender_id`,`discription`,`other`,`condition`,`pic_size`,`category`,`bid`)
				VALUES ('".$pic_url."','".$item_name."','".$_SESSION['username']."','".$_SESSION['user']."','".$dis."','".$other."','".$con."','".$pic_size."','".$cat."','".$bid."')";
				
	$res = mysql_query($sql) or die(mysql_error());
	
	echo "You have succesfully created a sale!";
}


}

?>