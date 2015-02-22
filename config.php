<?php
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_NAME', 'quiz');
	
	$quantity = 7; //number of questions in the quiz;
	
	//HINT DESIGN 3
	$hints_global_count = 5; //number of allowed hints to use in Hint Design 3
	
	//HINT DESIGN 2 
	$time_hint_disable_1 = 20000; //time in millisec after which hint button 1 enables in Hint Design 2 (20 sec)
	$time_hint_disable_2 = 14000;  //after how much time should Hint button 2 is enabled after Hint button 1 is clicked in millisec in Hint Design 2
	
	/*
	HINT DESIGN 1 - on demand (showing hint buttons all the time)
	HINT DESIGN 2 - showing hint button after certain time (ex: 5 sec) ($time_hint_disable)
	HINT DESIGN 3 - showing only certain predertimend number of hints ($hints_global_count)
	*/
?>