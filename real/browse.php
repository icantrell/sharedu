<?php include_once("classes.php"); session_start();?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
include("constants.php");









echo "

<body>


<div id=\"container\">

	
	"; include_once("header.php"); echo "
	<div id=\"content\">
		<div id=\"search\">
		Search for available items
		<form action=\"browse.php\" method=\"get\" onsubmit=\"getRows()\">
			Item Name
			<input type=\"text\" name=\"name\" /> <br>
			
			Seller Name
			<input type=\"text\" name=\"seller_name\" /> <br>
			
			Category
			<select name=\"cat\">
			<option value=\"\">any </option>
			<option value=\"books\"> books</option>
			<option value=\"electronics\"> electronics</option>
			<option value=\"furniture\"> furniture</option>
			<option value=\"utensils/dishes\"> utensils/dishes</option>
			<option value=\"misc\"> misc</option>
			</select><br>
			
			Condition
			<select name=\"con\">
			<option value=\"\">any </option>
			<option value=\"poor\"> poor</option>
			<option value=\"scratched\"> scratched</option>
			<option value=\"dirty\"> dirty</option>
			<option value=\"slightly worn\"> slightly worn</option>
			<option value=\"good\"> good</option>
			<option value=\"like new\"> like new</option>
			<option value=\"never opened\"> never opened</option>
			</select><br>
			
			<input type=\"submit\" name=\"search\" value=\"search\" />
			
		</form>
		</div>
		";
		
		
		include("display_search.php");
		echo "</div>"; // not sure where this one starts (but this here fixes the problem)		
		
		
		
		?>
		
	</div>
	<?php include("ads.html");?>

</div>
</body>


</html>