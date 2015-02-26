<!DOCTYPE html>
<html lang="en-US">
  <head>
	 <title>Online Quiz - Hint Design Types Study</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="local_style_sheet.css">
  </head>

  <body>
	<?php
      session_start();
		
		include 'config.php';
		
      //Execute below when Next button is pressed
      if(isset($_POST['next']))
      {
			include 'process_question.php';      
      }
		
		function get_next_question_description()
		{
			global $con;
			$q_no = $_SESSION['question_array'][$_SESSION['question_count']];
			$result = mysqli_query($con,"SELECT * from question_tbl where q_id = $q_no;");
			if(! $result )
			{
				die('Could not retrieve further questions ' . mysql_error());
			}
			$row = mysqli_fetch_array($result);
			return array($q_no, $row['q_desc']);
			//if more than one value to be returned, you can return an array (return array($a,$b);) and capture returned data using list() 
		}
		
		/*
		 * Retrieve the next question from the shuffled sliced array $_SESSION['question_array']
		 */
		list($q_no, $q_desc) = get_next_question_description();
        
   ?>
    <div class="container" style="text-align:center;">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4"><br>
          <span id="heading">Online Quiz</span>
        </div>
        <div class="col-sm-2 col-sm-offset-2"><br><br>
          <h5>
            <a href="signout.php" title="Sign Out" style="color: blue"> Sign Out   
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </h5>
        </div>
      </div>
      <form role="form" action="<?php $_PHP_SELF ?>" method="POST">
        <div class="row question-content">
          <div class="col-sm-12">
          <?php
            echo "<span class='question-font'>";
            echo "Question ";
            echo $_SESSION['question_count']+1;
            echo "</span>";
            echo "<br><br>";
            echo "<span class='question-desc-font'>";
            echo $q_desc;
            echo "</span>";
            $result = mysqli_query($con,"select o.o_desc from question_tbl q inner join question_option_tbl qo on q.q_id=qo.q_id inner join option_tbl o on qo.o_id=o.o_id 
                      where q.q_id=$q_no;");
            if(! $result )
            {
               die('Could not fetch data. ' . mysql_error());
            }
            $id=1;
            while($row = mysqli_fetch_array($result))
            {
          ?>
              <div class="radio">
                <label>
                  <input type="radio" class="radio-font" name="radios" id="<?php echo "radios".$id;?>" value="<?php echo $row['o_desc'];?>">
                    <?php
                      echo '<span class="radio-font">';
                      echo $row['o_desc'];
                      echo '</span>';
                      $id++;
                    ?>
                </label>
              </div>
          <?php
            } 
          ?>
          </div>
        </div>
        
        <?php
          //Showing two hints from the database for a question
          $result = mysqli_query($con,"SELECT h.h_desc from question_tbl q inner join question_hint_tbl qh on q.q_id=qh.q_id inner join hint_tbl h
                                 on h.h_id=qh.h_id where qh.q_id=$q_no;");
          $data=array();
          while($row = mysqli_fetch_array($result)){
            $data[]=$row['h_desc'];
          }
        ?>
        <div class="row" style="margin-top:3px;">
          <div class="col-sm-6 hint-content-1" style="opacity: 0.4;">
            <div id="hint1">
              <?php echo $data[0];?>
            </div>
            <div id="btn1DIV">
              <button type="button" id="btn1" class="btn btn-warning" disabled>Show Hint 1</button>
            </div>
          </div>
          <div class="col-sm-6 hint-content-2">
            <div id="hint2">
              <?php echo $data[1];?>
            </div>
            <div id="btn2DIV">
              <button type="button" id="btn2" class="btn btn-warning" disabled>Show Hint 2</button>
            </div>
          </div>
        </div>
        
        <br>
        <div class="row">
          <div class="col-sm-12">
            <button class="btn btn-primary" id="btn_next" name="next">Next</button>
          </div>
        </div>
		  <!-- record timing information collected using jQuery using form hidden input fields and post it to the server when Next button is pressed  -->
        <input type="hidden" name="time_question" id="timeid" value="">  <!--recording time for every question -->
        <input type="hidden" name="time_hint1" id="hint1id" value="">
        <input type="hidden" name="time_hint2" id="hint2id" value="">         
      </form>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        var time_start=$.now();
		  var time_disable_1=<?php echo $time_hint_disable_1;?>;
		  var time_disable_2=<?php echo $time_hint_disable_2;?>;
        $('#hint1').hide();
        $('#hint2').hide();
		  setTimeout(function() {
			 $('#btn1').removeAttr("disabled"); //do something after 5 (time_disable) sec
			 $('.hint-content-1').css('opacity','1'); 
		  }, time_disable_1);
        $('#btn1').click(function(){
          var time_hint1=$.now();    //record time when 'Show Hint 1' button is clicked in time_hint1 variable
          var time_hint1_sec = (time_hint1 - time_start)/1000;
          $('#hint1id').val(time_hint1_sec);  //assign that value to form's hidden input field so that we can save in db
          $('#btn1').attr('disabled',true); //disable the 'Show Hint 1' button so that further click times are not recorded - add attribute 'disabled'
          $('#hint1').show();  //trigger event of showing text of hint 1
          setTimeout(function() {
				$('#btn2').removeAttr("disabled"); //do something after 2 (time_disable) sec
				$('.hint-content-2').css('opacity','1'); 
			 }, time_disable_2);
        });
        $('#btn2').click(function(){
          var time_hint2=$.now();
          var time_hint2_sec = (time_hint2 - time_start)/1000;
          $('#hint2id').val(time_hint2_sec);
          $('#btn2').attr('disabled',true);
          $('#hint2').show();
          });
        $('#btn_next').click(function(){
          var time_end=$.now();
          var time_question = (time_end - time_start)/1000;  //milliseconds to sec conversion
          $('#timeid').val(time_question);
          });
      });
    </script>
  </body>
</html>
