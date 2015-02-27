<?php

	define('DB_SERVER', 'localhost');
	define('DB_USER', 'XXXX');
	define('DB_PASSWORD', 'XXXX');
	define('DB_NAME', 'XXXX');
	
	//Establish db connection
	$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
	   // Check for connection error
	   if (mysqli_connect_errno()) 
	   {
	      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	   }
		
	//Initialize global variables
		
	$quantity = 7; //number of questions in the quiz;
		
	//HINT DESIGN 3
	$hints_global_count = 7; //number of allowed hints to use in Hint Variant 3
		
	//HINT DESIGN 2 
	$time_hint_disable_1 = 20000; //time in millisec after which hint button 1 enables in Hint Variant 2 (20 sec)
	$time_hint_disable_2 = 40000;  //after how much time should Hint button 2 is enabled after Hint button 1 is clicked in millisec in Hint Variant 2
	
	/*
	HINT DESIGN 1 - on demand (showing hint buttons all the time)
	HINT DESIGN 2 - showing hint button after certain time (ex: 5 sec) ($time_hint_disable)
	HINT DESIGN 3 - showing only certain predertimend number of hints ($hints_global_count)
	*/

?>

