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
      if(isset($_POST['next']))
      {
        include 'config.php';
        $con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
        if (mysqli_connect_errno()) // Check connection
        {
           echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sex = $_POST['radio1'];
        $age = $_POST['radio2'];
        $personality = $_POST['radio3'];
        $education = $_POST['radio4'];
        $id=$_SESSION['s_id'];
        $result = mysqli_query($con,"UPDATE session_tbl SET gender='$sex',age_group='$age',personality_type='$personality',education='$education' where id=$id;");
        if(! $result )
        {
           die('Could not update data in metric_tbl. ' . mysql_error());
        }
        mysqli_close();
        header('Location: /hint/score_page.php');
      }
   ?>
     
   <form role="form" action="<?php $_PHP_SELF ?>" method="POST">
      <div class="container" style="margin: 5%; background-color: lavender; border-radius: 20px">
         <div class="row" style = "padding: 15px;">
            <div class="col-sm-12">
               <span class="question-font">You are almost there... Please answer a few questions about yourself before you finish the quiz.</span>
            </div>
            <div class="col-sm-10 col-sm-offset-1" style="font-size: medium;"><br>
            <span class="radio-font1">
               <div class="row">
                  <div class="col-sm-12">
                     <b>Select your Gender: </b><br>
                     <label class="radio-inline">
                        <input type="radio" name="radio1" value="male">Male
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio1" value="female">Female
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio1" value="other">Other
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio1" value="dnd">Do not want to disclose
                     </label>
                  </div>
               </div><br>
               <div class="row">
                  <div class="col-sm-12">
                     <b>Select your Age Group: </b><br>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="21 and below">21 and below
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="22 to 34">22 to 34
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="35 to 44">35 to 44 
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="45 to 54">45 to 54 
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="55 to 64">55 to 64 
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="65 and above">65 and above
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio2" value="dnd">Do not want to disclose
                     </label>
                  </div>
               </div><br>
               <div class="row">
                  <div class="col-sm-12">
                     <b>How do you describe yourself? </b><br>
                     <label class="radio-inline">
                        <input type="radio" name="radio3" value="introvered">Introverted
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio3" value="extroverted">Extroverted
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio3" value="somewhere in between">Somewhere in between
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio3" value="dont know">Do not know
                     </label>
                      <label class="radio-inline">
                        <input type="radio" name="radio3" value="dnd">Do not want to disclose
                     </label>
                  </div>
               </div><br>
               <div class="row">
                  <div class="col-sm-12">
                     <b>What is your highest level of education obtained or pursuing? </b><br>
                     <label class="radio-inline">
                        <input type="radio" name="radio4" value="school">High school or college
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio4" value="bachelors">Bachelors
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio4" value="masters">Masters
                     </label>
                      <label class="radio-inline">
                        <input type="radio" name="radio4" value="doctorate">Doctorate
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio4" value="others">Others
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio4" value="dnd">Do not want to disclose
                     </label>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-sm-1 col-sm-offset-4">
                     <button class="btn btn-primary" id="btn_next" name="next">Finish the Quiz!</button><br><br>
                  </div>
               </div>
            </span>
            </div>
         </div>
      </div>
   </form>
   
   
   
    <!-- 
      <div class="container" style="text-align:center;">
         <div class="row" style="margin-top: 10%">
            <div class="col-sm-8 col-sm-offset-2" style="border-radius: 20px; background-color: lavender;"><br>
               <span class="question-font" style="margin: 20px;">You are almost there... Please answer a few questions about yourself before you finish the quiz.<br><br>
                  <div class="col-sm-5 col-sm-offset-4">
                     <select name="gender" class="form-control">
                        <option value="" selected="true" disabled>Please select your Gender</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                        <option value="o">Other</option>
                        <option value="dnd">Do not want to disclose</option>
                     </select>
                  </div>
                  <br>
                  <div class="col-sm-5 col-sm-offset-4" style="margin-top: 10px;">
                     <select name="age" class="form-control">
                        <option value="" selected="true" disabled>Please select your Age Group</option>
                        <option value="21 and under">21 and Under</option>
                        <option value="22 to 34">22 to 34</option>
                        <option value="35 to 44">35 to 44</option>
                        <option value="45 to 54">45 to 54</option>
                        <option value="55 to 64">55 to 64</option>
                        <option value="65 and Over">65 and Over</option>
                        <option value="dnd">Do not want to disclose</option>
                     </select>
                  </div>
                  <br>
                  <div class="col-sm-5 col-sm-offset-4" style="margin-top: 10px;">
                     <select name="personality" class="form-control">
                        <option value="" selected="true" disabled>Please select your Personality Type</option>?</option>
                        <option value="i">Introverted</option>
                        <option value="e">Extroverted</option>
                        <option value="sbw">Somewhere in between</option>
                        <option value="dnd">Do not want to disclose</option>
                     </select>
                  </div>
               </span>
               <div class="col-sm-1 col-sm-offset-5">
                  <br><button class="btn btn-primary" id="btn_next" name="next">Finish the Quiz!</button><br><br>
               </div>
            </div>
         </div>
      </div>
   </form>  -->
  </body>
</html>

