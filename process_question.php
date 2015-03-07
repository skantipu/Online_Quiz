<?php

   /*
    * Increment count of number of questions shown to the user so far in the test
    */
   $_SESSION['question_count']++;
   $prev_q_no = $_SESSION['question_array'][$_SESSION['question_count']-1]; //submitted question number
   
   function get_correct_answer($prev_q_no)
   {
      global $con;
      $result = mysqli_query($con,"SELECT o.o_desc FROM question_answer_tbl qa INNER JOIN option_tbl o ON qa.a_id = o.o_id WHERE qa.q_id = $prev_q_no;");
      if(! $result )
      {
         die('Could not retrieve answer ' . mysql_error());
      }
      $row = mysqli_fetch_array($result);
      $answer = $row['o_desc'];
      return $answer;
   }
   
   function get_score($answer)
   {
      if($answer == $_POST['radios'])
      {
         $score=1;
         if(!isset($_SESSION['total_score']))
         {
            $_SESSION['total_score'] = 1;
         }
         else
         {
            $_SESSION['total_score']++;
         }
      }
      else
      {
         $score=0;
      }
      return $score;
   }
   
   function log_data()
   {
      global $score,$con,$prev_q_no; //to refer global variable declared outside function 
      $db_time_q_sec = mysqli_real_escape_string($con, (is_numeric($_POST['time_question']) ? $_POST['time_question'] : 0));
      $db_time_hint1_sec = mysqli_real_escape_string($con, (is_numeric($_POST['time_hint1']) ? $_POST['time_hint1'] : 0));
      $db_time_hint2_sec = mysqli_real_escape_string($con, (is_numeric($_POST['time_hint2']) ? $_POST['time_hint2'] : 0));
      $db_s_id = $_SESSION['s_id'];
      $question_series_number = $_SESSION['question_count']; //has the order/sequence number of the question shown (1,2,3 or 4)
      $variant = $_SESSION['variant'];
      
      $result = mysqli_query($con,"INSERT INTO metrics_tbl VALUES ($db_s_id, $prev_q_no, $variant, $score, '$db_time_q_sec', '$db_time_hint1_sec', '$db_time_hint2_sec', $question_series_number);");
      //Note: single quotes for time fields are important, if not null values will not be accepted
      if(! $result )
      {
         die('Could not update data in metric_tbl. ' . mysql_error());
      }
   }
   
   function redirect_user_demographic()
   {
      global $quantity;
      if($_SESSION['question_count']==$quantity)
      {
        mysqli_close();
        header('Location: /hint/user_demographic.php');
      }
   }
   
   /*
    * Retrieves the correct answer for the submitted question from the database (passed in as parameter)
    */
    $answer = get_correct_answer($prev_q_no);
   
   /*
    * get_score():
    * It compares the answer of the participant with the correct answer (passed in as argument) and
    * updates the score for that question accordingly. This score (1/0) will be returned and collected in $score variable
    * as $score will be accessed in log_data(). Local data of the function is destroyed once the function is returned.
    * Also, get_score() maintains a total score session variables to display at the end of the quiz.
    */
   $score = get_score($answer);
   
   /*
    * log_data():
    * Logs the posted form data in the db (collects data using PHP superglobal $_POST)
    * Sanitizes user input before collecting
    *    It first checks if data (time_question, time_hint1, time_hint2) is numeric (. is allowed)
    *    If numeric, then have data as is and if not numeric (bad data), then replace data with 0.
    *    Then sanitize the data using 'mysqli_real_escape_string()' - it escapes any special characters (\,',",etc);
    */
   log_data();
   
   /*
    * redirect_user_demographic():
    * Checks if the number of questions shown to the user equals our predetermined $quantity stored in config.php file
    * If so, redirect to user demographic page
    */
   redirect_user_demographic();
   
?>