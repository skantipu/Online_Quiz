
<?php
   session_start();
   include 'config.php';
   $con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
   if (mysqli_connect_errno()) // Check connection
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
  
   $session_id = session_id();
   $ip1 = $_SERVER['REMOTE_ADDR'];
   $ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
   
   $result = mysqli_query($con,"select variant from session_tbl order by session_date desc limit 1;");
   if(! $result )
   {
      die('Could not update data in session_tbl (session id value). ' . mysql_error());
   }
   $row = mysqli_fetch_array($result);
   $variant = $row['variant'];
   $variant = $variant % 3 + 1;
   $result = mysqli_query($con,"INSERT INTO session_tbl (session, ip_remote_address, ip_proxy_address, variant) VALUES ('$session_id','$ip1','$ip2',$variant);");
   if(! $result )
   {
      die('Could not update data in session_tbl (session id value). ' . mysql_error());
   }
   //retrieving last inserted id field in session_tbl
   $result = mysqli_query($con,"select id from session_tbl where id=LAST_INSERT_ID();");
   $row = mysqli_fetch_array($result);
   $_SESSION['s_id']=$row['id'];
   header('Location: variant'.$variant.'_demo.html');   
 ?>
