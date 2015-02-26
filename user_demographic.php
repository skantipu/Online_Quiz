<!DOCTYPE html>
<html lang="en-US">
  <head>
   <title>Online Quiz - Hint Design Types Study - User Demographics Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="local_style_sheet.css">
   <style>
      .container{
         margin: 5%;
         background-color: lavender;
         border-radius: 20px;
      }
      /*
       * Conditionally using an appropriate form control (radio or select) based on screen-size - Adaptive web design
       * Using radio control for small-screen devices is not a good choice as it can make the screen look cluttered with too many questions and choices
       * Also, purpose of using select dropdown control is to save screen space
       * Thus screen responds/adapts to using a particular form control based on screen size
       */
      /* Hide code with class big-screen (using radio control) for small screen devices */
      @media (max-width: 768px){
         .big-screen{
            display: none;
         }
      }
      /* Hide code with class small-screen (using dropdown select control) for big screen devices */
      @media (min-width: 769px){
         .small-screen{
            display: none;
         }
      }
   </style>
  </head>
  <body>     
   <form role="form" action="score_page.php" method="POST">
      <div class="container">
         <div class="big-screen">
            <div class="row" style = "padding: 15px;">
               <div class="col-sm-12">
                  <span class="question-font">You are almost there... Please answer a few questions about yourself before you finish the quiz.</span>
               </div>
               <div class="col-sm-10 col-sm-offset-1"><br>
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
                           <b>What do you feel about level of difficulty of questions in the quiz? </b><br>
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
                              <input type="radio" name="radio5" value="dont know">Do not know
                           </label>
                        </div>
                     </div>
                     <input type="hidden" name="screen_size" id="width" value="">
                     <br> 
                  </span>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-2 col-sm-offset-5">
                  <button class="btn btn-primary" id="btn_next" name="next">Finish the Quiz!</button><br><br>
               </div>
            </div>
         </div> <!-- closing tag of big-screen class code -->
         
         <!-- below code is activated when screen sizes are les than 768 px -->
         <div class="small-screen">
            <div class="row" style = "padding: 15px;">
               <div class="col-sm-12">
                  <span class="question-font">You are almost there... Please answer a few questions about yourself before you finish the quiz.</span>
               </div>
               <div class="col-sm-10 col-sm-offset-1"><br>
                  <div class="row">
                     <div class="col-sm-12">
                        <select name="radio1" class="form-control">
                           <option value="" selected="true" disabled>Please select your Gender</option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                           <option value="other">Other</option>
                           <option value="dnd">Do not want to disclose</option>
                        </select>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-sm-12">
                        <select name="radio2" class="form-control">
                           <option value="" selected="true" disabled>Please select your Age Group</option>
                           <option value="21 and below">21 and below</option>
                           <option value="22 to 34">22 to 34</option>
                           <option value="35 to 44">35 to 44</option>
                           <option value="45 to 54">45 to 54</option>
                           <option value="55 to 64">55 to 64</option>
                           <option value="65 and above">65 and above</option>
                           <option value="dnd">Do not want to disclose</option>
                        </select>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-sm-12">
                        <select name="radio3" class="form-control">
                           <option value="" selected="true" disabled>How do you describe yourself?</option>
                           <option value="introverted">Introverted</option>
                           <option value="extroverted">Extroverted</option>
                           <option value="somewhere in between">Somewhere in between</option>
                           <option value="dont know">Do not know</option>
                           <option value="dnd">Do not want to disclose</option>
                        </select>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-sm-12">
                        <select name="radio4" class="form-control">
                           <option value="" selected="true" disabled>Highest level of education obtained or pursuing?</option>
                           <option value="school">High school or college</option>
                           <option value="bachelors">Bachelors</option>
                           <option value="masters">Masters</option>
                           <option value="doctorate">Doctorate</option>
                           <option value="others">Others</option>
                           <option value="dnd">Do not want to disclose</option>
                        </select>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-sm-12">
                        <select name="radio5" class="form-control">
                           <option value="" selected="true" disabled>Difficulty level of questions in the quiz?</option>
                           <option value="veryhard">Very hard</option>
                           <option value="hard">Hard</option>
                           <option value="medium">Medium</option>
                           <option value="easy">Easy</option>
                           <option value="dont know">Do not know</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-1 col-xs-offset-3">
                  <button class="btn btn-primary" id="btn_next" name="next">Finish the Quiz!</button><br><br>
               </div>
            </div>
         </div> <!--  closing tag of small-screen class -->
      </div> <!-- closing tag of container -->
   </form>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script>
         //since script is written at the end, it will be executed after doc finishes loading
         $('#width').val($( window ).width());
   </script>
  </body>
</html>

