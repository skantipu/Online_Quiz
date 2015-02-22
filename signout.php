<?php
   session_start();
?>
<!DOCTYPE html>
<html>
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="local_style_sheet.css">
  </head>
  
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12"><br><br>
					<span class="score-font">You have signed out in the middle of the test.<br> We're sorry to see you leave...Hope to see you back! <br>
					<?php
						session_regenerate_id();
						session_destroy();
					?>
				</div>
			</div>
		</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>
