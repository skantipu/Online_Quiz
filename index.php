
<?php
   session_start();
   
   include 'config.php';  //has code for db connection and initializes various global variables
  
   function log_session_details()
   {
      global $con; //global variables are not automatically available inside functions. You need to declare them global inside functions to access them
      $session_id = session_id();  //create a session id
      
      $ip1 = $_SERVER['REMOTE_ADDR']; //$ip1 has the ip-address of the user. Logging it helps us to filter out bad data caused by robots or malicious users
      $ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
      
      /* Server will have to evenly distribute available 3 variants among all incoming requests
       * For this, it retrieves last assigned variant to a user from db, and computes the next variant to be assigned by adding +1 in a cyclic fashion.
       */
      $result = mysqli_query($con,"select variant from session_tbl order by session_date desc limit 1;");
      if(! $result )
      {
         die('Could not update select variant from session_tbl. ' . mysql_error());
      }
      $row = mysqli_fetch_array($result);
      
      $variant = $row['variant'];
      $variant = $variant % 3 + 1;
      $_SESSION['variant'] = $variant;
     
      /*
       *Insert session id, ip address, variant to be assigned
       *in the sesion_tbl;
       */
      $result = mysqli_query($con,"INSERT INTO session_tbl (session, ip_remote_address, ip_proxy_address, variant) VALUES ('$session_id','$ip1','$ip2',$variant);");
      if(! $result )
      {
         die('Could not update data in session_tbl (session id value). ' . mysql_error());
      }
      
      //Retrieving last inserted id field in session_tbl
      $result = mysqli_query($con,"select id from session_tbl where id=LAST_INSERT_ID();");
      if(! $result )
      {
         die('Could not retrieve last inserted session_id from session_tbl. ' . mysql_error());
      }
      $row = mysqli_fetch_array($result);
      $_SESSION['s_id']=$row['id'];  
   }

   function create_shuffled_question_array()
   {
      global $con; //You cannot access $con defined outside this function unless you declare global $con here. Vari
      $result = mysqli_query($con,"SELECT q_id from question_tbl;"); 
      $numbers = array();  //create an empty array
      while($row=mysqli_fetch_array($result))
      {
         $numbers[]=$row['q_id'];  //initialize array with retrieved question id from the question_tbl
      }
      shuffle($numbers);
      
      //Slice the shuffled questions array according to specified $quantity. $quantity, defined in config.php denotes number of questions to be shown in the test
      $_SESSION['question_array'] = array_slice($numbers, 0, $quantity);
      
      //keeps track of number of questions shown so far. If it reaches $quantity, we'll have to redirect page to user_demographic.php
      $_SESSION['question_count'] = 0; 
   }
   
   /*
    * Logs various session related info like session_id, ip address of the user, and variant assigned to the current request in session_tbl
    */
   log_session_details();
   
   /*
    * Creates a random set of questions (depending on $quantity specified in config.php) for the current test session
    */
   create_shuffled_question_array();
   
   /*
    * Redirects current page to the corresponding variant demo page
    * Note that you cannot access $variant directly below as local variables defined inside functions will be destroyed after function is returned.
    * To use any local variable outside function scope, you can return that variable and use it outside function.
    * However, in the below case, since it is a session variable, it is alive throughout the entire session in any page unless session is destroyed 
    */
   header('Location: variant'.$_SESSION['variant'].'_demo.html');
   
 ?>
