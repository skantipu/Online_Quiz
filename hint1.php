<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="local_style_sheet.css">
  </head>

  <body>
    <?php
      session_start();
      
      //Update the count of questions shown to the user in a session variable. If it is not set, set it to 0.  
      if(!isset($_SESSION['questions_answered']))
      {
         $_SESSION['questions_answered'] = 0;
      }
      else
      {
        $_SESSION['questions_answered']++;
      }
      
      
      //Establish database connection
      include 'config.php';
      $con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
      // Check for connection error
      if (mysqli_connect_errno()) 
      {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      
      //Execute below when Next button is pressed
      if(isset($_POST['next']))
      {
			 $prev_q_no = $_SESSION['question_array'][$_SESSION['questions_answered']-1]; //submitted question number
			 
			 //retrieve answer details for that question and compare with the submitted answer
			 $result = mysqli_query($con,"SELECT o.o_desc FROM question_answer_tbl qa INNER JOIN option_tbl o ON qa.a_id = o.o_id WHERE qa.q_id = $prev_q_no;");
          $row = mysqli_fetch_array($result);
		
         //Calculate score of the answered question and update score in a session variable
         if($row['o_desc'] == $_POST['radios'])
         {
            $db_q_score=1;
            if(!isset($_SESSION['score']))
            {
               $_SESSION['score'] = 1;
            }
            else
            {
               $_SESSION['score']++;
            }
         }
         else
         {
            $db_q_score=0;
         }
         
         //Collect form data using PHP superglobal $_POST
			//Sanitize user input before collecting - first check if data is numeric (. is allowed), if numeric, then have data as is and if not numeric (bad data), then replace data with 0. Then sanitize the value by escaping any special characters (\,',",etc);
         $db_time_q_sec = mysqli_real_escape_string($con, (is_numeric($_POST['time_question']) ? $_POST['time_question'] : 0));
         $db_time_hint1_sec = mysqli_real_escape_string($con, (is_numeric($_POST['time_hint1']) ? $_POST['time_hint1'] : 0));
         $db_time_hint2_sec = mysqli_real_escape_string($con, (is_numeric($_POST['time_hint2']) ? $_POST['time_hint2'] : 0));
         $db_s_id = $_SESSION['s_id'];
         $question_series_number = $_SESSION['questions_answered']; //has the order sequence number of the question (1,2,3 or 4)
      
         //Insert submitted question's metric details into the metrics_tbl
         $result = mysqli_query($con,"INSERT INTO metrics_tbl VALUES ($db_s_id, $prev_q_no, 1, $db_q_score, '$db_time_q_sec', '$db_time_hint1_sec', '$db_time_hint2_sec', $question_series_number);");
         //Note: single quotes for time fields are important, if not null values will not be accepted
         if(! $result )
         {
            die('Could not update data in metric_tbl. ' . mysql_error());
         }  
        
         //Check if the number of questions shown to the user equals our predetermined $quantity stored in config.php file. If so, redirect to user demographic page
         if($_SESSION['questions_answered']==$quantity)
         {
           mysqli_close();
           header('Location: /hint/user_demographic.php');
         }
         
         //Retrieve the next question from the shuffled sliced array $_SESSION['question_array']
         $q_no = $_SESSION['question_array'][$_SESSION['questions_answered']];
         $result = mysqli_query($con,"SELECT * from question_tbl where q_id=$q_no;");
         if(! $result )
         {
            die('Could not retrieve further questions ' . mysql_error());
         }
         $row = mysqli_fetch_array($result);
         
      } //end of IF block
  
      //Execute else block code when page is loaded for the first time. It executes only once.
      else  
      {
         //This block selects a random subset of questions from the question_tbl. For this we store ids of all questions in an array and shuffle it.
         //Then slice the array based on the number of questions to be asked in the test stored in the $quantity variable initialized in config.php file 
      
         $result = mysqli_query($con,"SELECT q_id from question_tbl;"); 
         $numbers = array();  //create an empty array
         while($row=mysqli_fetch_array($result))
         {
            $numbers[]=$row['q_id'];  //initialize array with retrieved question id from the question_tbl
         }
         shuffle($numbers);
         
         // $_SESSION['question_array']  session variable has the subset of shuffled array of questions
         $_SESSION['question_array'] = array_slice($numbers, 0, $quantity); 
         
         // $q_no below has the first question id (or id at 0th location from the sliced array) since $_SESSION['questions_answered'] is 0 below
         $q_no = $_SESSION['question_array'][$_SESSION['questions_answered']]; 
         
         //Retrieve question description for the $q_no
         $result = mysqli_query($con,"SELECT q_desc from question_tbl where q_id = $q_no;");
         $row = mysqli_fetch_array($result);
         if(! $result )
         {
            die('Could not fetch data. ' . mysql_error());
         }
      } //end of ELSE block
        
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
            echo $_SESSION['questions_answered']+1;
            echo "</span>";
            echo "<br><br>";
            echo "<span class='question-desc-font'>";
            echo $row['q_desc'];
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
          //Showing two hints from the database for questions
          $result = mysqli_query($con,"SELECT h.h_desc from question_tbl q inner join question_hint_tbl qh on q.q_id=qh.q_id inner join hint_tbl h
                                 on h.h_id=qh.h_id where qh.q_id=$q_no;");
          $data=array();
          while($row = mysqli_fetch_array($result)){
            $data[]=$row['h_desc'];
          }
        ?>
        <div class="row" style="margin-top:3px;">
          <div class="col-sm-6 hint-content-1">
            <div id="hint1">
              <?php echo $data[0];?>
            </div>
            <div id="btn1DIV">
              <button type="button" id="btn1" class="btn btn-warning">Show Hint 1</button>
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
        <input type="hidden" name="time_question" id="timeid" value="">  <!--recording time for every question -->
        <input type="hidden" name="time_hint1" id="hint1id" value="">
        <input type="hidden" name="time_hint2" id="hint2id" value="">   
      </form>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        var time_start=$.now();
        $('#hint1').hide();
        $('#hint2').hide();
        $('#btn1').click(function(){
          var time_hint1=$.now();    //record time when 'Show Hint 1' button is clicked in time_hint1 variable
          var time_hint1_sec = (time_hint1 - time_start)/1000;
          $('#hint1id').val(time_hint1_sec);  //assign that value to form's hidden input field so that we can save in db
          $('#btn1').attr('disabled',true); //disable the 'Show Hint 1' button so that further click times are not recorded - add attribute 'disabled'
          $('#hint1').show();  //trigger event of showing text of hint 1
          $('#btn2').removeAttr('disabled');  //trigger event of enabling 'Show Hint 2' buttton
          $('.hint-content-2').css('opacity','1');  //trigger event of making background have opacity 1 - looks enabled
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
