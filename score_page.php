<?php
   session_start();
	include 'config.php';
?>
<!DOCTYPE html>
<html>
  <head>
	<title>Results</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="local_style_sheet.css">
  </head>
  
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12" style="text-align:center;"><br><br>
					<h1>You have reached the end of the quiz. <br> We very much appreciate your time in attempting our quiz.<br> Thank you!!!</h1>
					<br><h2>If you would like to see your score, click below. </h2>
					<button class="btn btn-info" id="scorebutton">Show Score</button>
					<div id="score">
						<h3>Your score is <?php echo (!isset($_SESSION['score'])?0:$_SESSION['score'])?> point(s) out of <?php echo $quantity;?>.</h3>
					</div>
					<?php
						session_regenerate_id();
						session_destroy();	
					?>				
				<!--	<br><br><br><br>
					<h3>To start the quiz again, click here <a href="index.php">Start Again </a></h3>  -->
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
