<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  </head>
  <?php
		include 'config.php';
		if(isset($_POST['submit']))
		{
			$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
			if (mysqli_connect_errno()) // Check connection
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			$q=mysqli_real_escape_string($con,$_POST['question']);  //if $q=what's up --- now it becomes what\'s up
			$o1=mysqli_real_escape_string($con,$_POST['option1']);
			$o2=mysqli_real_escape_string($con,$_POST['option2']);
			$a=$_POST['answer'];
			$h1=mysqli_real_escape_string($con,$_POST['hint1']);
			$h2=mysqli_real_escape_string($con,$_POST['hint2']);
			if(isset($_POST['option3']))
			{
				if(isset($_POST['option4']))
				{
					$o3=mysqli_real_escape_string($con,$_POST['option3']);
					$o4=mysqli_real_escape_string($con,$_POST['option4']);
					
					//inserting question in db
					$result = mysqli_query($con,"INSERT INTO question_tbl (q_desc) VALUES ('$q');");
					if(! $result )
					{
						die('Could not update data in question_tbl. ' . mysql_error());
					}
					$result = mysqli_query($con,"select q_id from question_tbl where q_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$qid = $row['q_id'];  //has question id of inserted row in db
					
					//inserting option 1 in db
					$result = mysqli_query($con,"INSERT INTO option_tbl (o_desc) VALUES ('$o1');");
					if(! $result )
					{
						die('Could not update data in option_tbl (option 1). ' . mysql_error());
					}
					$result = mysqli_query($con,"select o_id from option_tbl where o_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$oid_1 = $row['o_id'];
					
					//inserting option 2 in db
					$result = mysqli_query($con,"INSERT INTO option_tbl (o_desc) VALUES ('$o2');");
					if(! $result )
					{
						die('Could not update data option_tbl (option 2) ' . mysql_error());
					}
					$result = mysqli_query($con,"select o_id from option_tbl where o_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$oid_2 = $row['o_id'];
					
					//inserting option 3 in db
					$result = mysqli_query($con,"INSERT INTO option_tbl (o_desc) VALUES ('$o3');");
					if(! $result )
					{
						die('Could not update data option_tbl (option 3). ' . mysql_error());
					}
					$result = mysqli_query($con,"select o_id from option_tbl where o_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$oid_3 = $row['o_id'];
					
					//inserting option 4 in db
					$result = mysqli_query($con,"INSERT INTO option_tbl (o_desc) VALUES ('$o4');");
					if(! $result )
					{
						die('Could not update data option_tbl (option 4). ' . mysql_error());
					}
					$result = mysqli_query($con,"select o_id from option_tbl where o_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$oid_4 = $row['o_id'];
					
				//	echo $qid." ".$oid_1." ".$oid_2." ".$oid_3." ".$oid_4;
					//inserting into question_option_tbl
					$result = mysqli_query($con,"INSERT INTO question_option_tbl values ($qid,$oid_1),($qid,$oid_2),($qid,$oid_3),($qid,$oid_4);");
					if(! $result )
					{
						die('Could not update data in question_option_tbl. ' . mysql_error());
					}
					
					//inserting into hint_tbl
					//inserting hint1 in db
					$result = mysqli_query($con,"INSERT INTO hint_tbl (h_desc) VALUES ('$h1');");
					if(! $result )
					{
						die('Could not update data in hint tbl 1. ' . mysql_error());
					}
					$result = mysqli_query($con,"select h_id from hint_tbl where h_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$hid_1 = $row['h_id'];
					
					//inserting hint2 in db
					$result = mysqli_query($con,"INSERT INTO hint_tbl (h_desc) VALUES ('$h2');");
					if(! $result )
					{
						die('Could not update data in hint tbl 2 ' . mysql_error());
					}
					$result = mysqli_query($con,"select h_id from hint_tbl where h_id=LAST_INSERT_ID();");
					$row = mysqli_fetch_array($result);
					$hid_2 = $row['h_id'];
					
					//inserting into question_hint_tbl
					$result = mysqli_query($con,"INSERT INTO question_hint_tbl values ($qid,$hid_1),($qid,$hid_2);");
					if(! $result )
					{
						die('Could not update data in question_hint_tbl ' . mysql_error());
					}
					
					
				//inserting into question_answer_tbl
					$text="oid_".$a;   //to match wiht an option
				//	echo $text." ".$$text." ";
					ob_start();   //output buffering - it does not print next statment and keeps it in buffer  $$text has option id of oid_1 or oid_2 ...depending on right answer
					echo $$text;  
					$test = ob_get_clean();
				//	echo $test;
					$result = mysqli_query($con,"INSERT INTO question_answer_tbl values ($qid,$test);");
					if(! $result )
					{
						die('Could not update data in question_answer_tbl. ' . mysql_error());
					}
				}
			}
			$message = "Updated data successfully!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
      
  ?>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12" style="text-align:center;">
					<h2>
						Add question details to the database
					</h2>
				</div>
			</div>
			<div class="row" style="margin-top:5em;">
				<form class="form-horizontal" role="form" action="<?php $_PHP_SELF ?>" method="POST">
					<div class="form-group">
					  <label for="question" class="col-sm-2 control-label">Question</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="question" placeholder="Enter Question - Required" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="option1" class="col-sm-2 control-label">Option 1</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="option1" placeholder="Enter Option 1 - Required" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="option2" class="col-sm-2 control-label">Option 2</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="option2" placeholder="Enter Option 2 - Required" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="option3" class="col-sm-2 control-label">Option 3</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="option3" placeholder="Enter Option 3 - Optional">
					  </div>
					</div>
					<div class="form-group">
					  <label for="option4" class="col-sm-2 control-label">Option 4</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="option4" placeholder="Enter Option 4 - Optional">
					  </div>
					</div>
					<div class="form-group">
					  <label for="answer" class="col-sm-2 control-label">Answer</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="answer" placeholder="Enter 1 if 'Option 1' is the right answer, 2 if 'Option 2' is the right answer ... (Allowed input values - 1,2,3 or 4)  - Required" pattern="[1-4]{1}" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="hint1" class="col-sm-2 control-label">Hint 1</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="hint1" placeholder="Enter Hint 1 - Required" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="hint2" class="col-sm-2 control-label">Hint 2</label>
					  <div class="col-sm-10">
						 <input type="text" class="form-control" name="hint2" placeholder="Enter Hint 2 - Required" required>
					  </div>
					</div>
					<div class="form-group">
					  <div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default" name="submit">Submit</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  </body>
</html>
