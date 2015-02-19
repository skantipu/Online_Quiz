<?php
   session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  </head>
  
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>You have signed out in the middle of the test. We're sorry to see you leave :( </h1>
					<h1>You score till now is <?php echo (!isset($_SESSION['score'])?0:$_SESSION['score'])?>.</h1>
					<?php
						session_regenerate_id();
						session_destroy();
					?>
				<!--	<h2><a href="index.php">Start Again </a></h2> -->
				</div>
			</div>
		</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>
