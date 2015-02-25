<!DOCTYPE html>
<html>
  <head>
   <title>Online Quiz - Hint Design Types Study - User Demographics Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="local_style_sheet.css">
  </head>
  <body>     
   <form role="form" action="score_page.php" method="POST">
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
               </div><br>
               <div class="row">
                  <div class="col-sm-12">
                     <b>What do you feel about level of difficulty of questions? </b><br>
                     <label class="radio-inline">
                        <input type="radio" name="radio5" value="veryhard">Very hard
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio5" value="hard">Hard
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio5" value="medium">Medium
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio5" value="easy">Easy
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="radio5" value="dnd">Do not know
                     </label>
                  </div>
               </div>
               <input type="hidden" name="screen_size" id="width" value="">
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script>
         //since script is written at the end, it will be executed after doc finishes loading
         $('#width').val($( window ).width());
   </script>
  </body>
</html>

