<?php
	
	switch($_POST['content']){
	
		case 1: 
			include("compose.php");
			break;
		case 2: 
			include("mailbox.php");
			break;
		case 3: 
			include("info.php");
			break;
		case 4: 
			include("sales.php");
			break;
		case 5: 
			include("create_sale.php");
			break;
			
		default:
			include("info.php");
			break;
			}
	
?>