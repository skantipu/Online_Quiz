<!DOCTYPE html>
<html>
	<?php
	  session_start();
	  include 'config.php';
	  $con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
	  if (mysqli_connect_errno()) // Check connection
	  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	  $sex = mysqli_real_escape_string($con, $_POST['radio1']);
	  $age = mysqli_real_escape_string($con, $_POST['radio2']);
	  $personality = mysqli_real_escape_string($con, $_POST['radio3']);
	  $education = mysqli_real_escape_string($con, $_POST['radio4']);
	  $difficulty = mysqli_real_escape_string($con, $_POST['radio5']);
	  $width = mysqli_real_escape_string($con, $_POST['screen_size']);
	  $id = $_SESSION['s_id'];
	  $result = mysqli_query($con,"UPDATE session_tbl SET gender='$sex',age_group='$age',personality_type='$personality',education='$education', level_of_difficulty='$difficulty', screen_size='$width' where id=$id;");
	  if(! $result )
	  {
		  die('Could not update data in metric_tbl. ' . mysql_error());
	  }
	  mysqli_close();
  ?>
  <head>
	<title>Online Quiz - Hint Design Types Study - Score Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="local_style_sheet.css">
  </head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12" style="text-align:center;"><br><br>
					<span class="score-font">Thank you for taking our quiz! <br> We very much appreciate it!<br>
					<br>If you would like to see your score, click below. </span><br><br>
					<button class="btn btn-info" id="scorebutton">Show Score</button><br>
					<div id="score">
						<span id="score-font-sub">Your score is <?php echo (!isset($_SESSION['score'])?0:$_SESSION['score'])?> point(s) out of <?php echo $quantity;?>.</span>
					</div>
					<?php
						//regenrate id and destroy current session
						session_regenerate_id();
						session_destroy();	
					?>				
				</div>
			</div>
		</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	 <script>
		$(document).ready(function(){
			$('#score').hide();
			$('#scorebutton').click(function(){
				$('#score').show();
				$('#scorebutton').attr('disabled',true);
			});
		});
	 </script>
  </body>
</html>
