<section class="exam_data border-bottom" id="exam_dtls">
   <div class="container ">
      <div class="row py-3 justify-content-between">
         <div class="col-lg-6 col-md-6 align-self-center">
            <ul class="nav nav-pills">
               <li class="active "><a data-toggle="pill" href="#" class='font-weight-bold'>Free Mock Test</a></li>
            </ul>
         </div>
         <div class="col-lg-6 col-md-6 align-self-center">
            <p class='text-right font-weight-bold mb-0'>Welcome to ConceptLibrary</p>
         </div>
      </div>
   </div>
</section>
<section class="question_data my-3 " style="height:100vh;">
   <div class="container">
      <div class="row py-3" id='question_data'>
         <div class="col-lg-8 col-md-6 col-12">
            <div class="question_container_count d-flex justify-content-between w-50 my-2">
               <div>Total Questions : <span id='question_count'><?php echo count($question); ?></span></div>
               <div class="current_question">Question : <span id="current_question"></span></div>
            </div>
            <div class="quiz-container" id="quiz">
               <div class="quiz-header">
                  <h2 id="question" class="text-dark">Question is loading...</h2>
                  <ul class="list-unstyled mx-3">
                     <li>
                        <input type="radio" name="answer" id="a" class="answer text-dark" value="a" />
                        <label for="a" id="a_text">Answer...</label>
                     </li>
                     <li>
                        <input type="radio" name="answer" id="b" class="answer text-dark" value="b" />
                        <label for="b" id="b_text">Answer...</label>
                     </li>
                     <li>
                        <input type="radio" name="answer" id="c" class="answer text-dark" value="c" />
                        <label for="c" id="c_text">Answer...</label>
                     </li>
                     <li>
                        <input type="radio" name="answer" id="d" class="answer text-dark" value="d" />
                        <label for="d" id="d_text">Answer...</label>
                     </li>
                  </ul>
               </div>
               <button class='btn btn-secondary'>Cancel</button>

               <button id="submit" class='btn btn-info'>Next</button>

            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-12">
            <div class="diff_type_notation_area_outer">
               <div class="diff_type_notation_area_inner">
                  <div class="notation_type_description">
                     <div class="notation_typeDiv d-flex justify-content-evenly leftdiv_notation m-1">
                        <span class="answered answeredCount" id="answered">0</span> <span
                           class="type_title align-self-center answeredLabel longtext-hide"
                           title="Answered">Answered</span>
                     </div>
                     <div class="notation_typeDiv d-flex justify-content-evenly m-1">
                        <span class="not_answered notAnsweredCount" id="unanswered"></span> <span
                           class="type_title align-self-center notAnsweredLabel longtext-hide"
                           title="Not Answered">UnAnswered</span>
                     </div>
                     <div class="clear"></div>
                     <div class="notation_typeDiv d-flex justify-content-evenly leftdiv_notation m-1">
                        <span class="not_visited notVisitedCount"
                           id="notvisited"><?php echo count($question) - 1; ?></span> <span
                           class="type_title align-self-center notVisitedLabel longtext-hide" title="Not Visited">Not
                           Visited</span>
                     </div>
                     <div class="clear"></div>
                     <!-- <div class="notation_typeDiv answered_review_container review_mark" id="" style="display: none;">
                                    <span class="review_marked markedReviewCount" id="">0</span>
                                    <span class="type_title markedAndAnsweredLabel" id="" title="Answered &amp; Marked for Review (will be considered for evaluation)">Answered &amp; Marked for Review (will be considered for evaluation)</span>
                                    </div>
                                    <div class="notation_typeDiv answered_review_container review_answer" id="">
                                    <span class="review_answered markedAnsweredCount" id="">0</span>
                                    <span class="type_title markedAndAnsweredLabel" id="" title="Answered &amp; Marked for Review (will be considered for evaluation)">Answered &amp; Marked for Review (will be considered for evaluation)</span>
                                    </div> -->
                     <div style="clear: both;" class="clear"></div>
                  </div>
               </div>
            </div>
         </div>


      </div>
      <div class="row" id="result_data" style='display:none;'>
         <div class="col-lg-12 col-md-12 col-12">
            <div class="result_container_table">
               <div class="table-responsive">

                  <table class="table table-bordered">

                     <thead>

                        <tr style="background: #01bf1d;color: #FFF;">

                           <th style="text-align: center">Total Questions </th>

                           <th style="text-align: center">Attempted</th>

                           <th style="text-align: center"> Correct Answer </th>

                           <th style="text-align: center"> Wrong Answer</th>

                           <th style="text-align: center"> UnAttempted</th>

                           <th style="text-align: center"> TotalScore </th>

                        </tr>

                     </thead>

                     <tbody>

                        <tr style="background:#000;color:#FFF;">

                           <td style="text-align: center;"><?php echo count($question); ?></td>

                           <td class="text-primary " id="attempted" style="text-align: center;"></td>

                           <td class="text-success " id="correct_answer" style="text-align: center"><b>0</b></td>

                           <td class="text-danger " id="wrong_answer" style="text-align: center"><b>8</b></td>

                           <td class="text-warning" id="un_attempted" style="text-align: center"><b>2</b></td>

                           <td class="text-info" id="total_score" style="text-align: center"></td>

                        </tr>

                     </tbody>

                  </table>

               </div>
               <div class="more_container">
                  <p>For More :</p>
                  <a href="https://www.youtube.com/channel/UC-Xm2AjuiY9Izk4hVBUBbtQ" class="btn btn-danger"> Watch our
                     Youtube Videos</a>
                  <a href="<?= base_url('/login/register') ?>" class="btn btn-primary"> Register Now</a>
               </div>
            </div>

         </div>
      </div>
      
   </div>
   </div>


   <!-- Modal -->

   <div class="section_result py-4" style="height:100vh; display: none;">
      <div class="container">

      </div>
   </div>
   </div>



</section>

<script src="https://www.youtube.com/iframe_api"></script>
<script>
   const quizData = <?php echo $json_question; ?>;
   const quiz = document.getElementById("quiz");
   const answerElements = document.querySelectorAll(".answer");
   const questionElement = document.getElementById("question");
   const a_text = document.getElementById("a_text");
   const b_text = document.getElementById("b_text");
   const c_text = document.getElementById("c_text");
   const d_text = document.getElementById("d_text");
   const submitButton = document.getElementById("submit");
   const question_count_badge = document.getElementById('current_question');
   const question_not_answered = document.getElementById('notvisited');
   const question_answered = document.getElementById('answered');
   const question_notanswered = document.getElementById('unanswered');

   let currentQuiz = 0;
   let score = 0;
   let answeredCount = 0;
   let unanswered = 0;
   let correct_answer = 0;
   let wrong_answer = 0;

   question_notanswered.innerText = unanswered;

   const deselectAnswers = () => {
      answerElements.forEach((answer) => (answer.checked = false));
   };

   const getSelected = () => {
      let answer;
      answerElements.forEach((answerElement) => {
         if (answerElement.checked) answer = answerElement.id;
      });
      return answer;
   };

   const loadQuiz = () => {
      deselectAnswers();
      const currentQuizData = quizData[currentQuiz];
      questionElement.innerHTML = currentQuizData.question;
      a_text.innerText = currentQuizData.option_1;
      b_text.innerText = currentQuizData.option_2;
      c_text.innerText = currentQuizData.option_3;
      d_text.innerText = currentQuizData.option_4;
      question_count_badge.innerText = currentQuiz + 1;
      question_not_answered.innerText = quizData.length - answeredCount;
   };

   const showResult = () => {

   };

   loadQuiz();

   submitButton.addEventListener("click", () => {
      const answer = getSelected();

      if (answer) {
         if (answer === quizData[currentQuiz].correct_answer) score += parseInt(quizData[currentQuiz].mark);
         answeredCount++;
         correct_answer++;
         question_answered.innerText = answeredCount;
         question_not_answered.innerText = quizData.length - answeredCount;
         if (answer != quizData[currentQuiz].correct_answer) {
            wrong_answer++;
            score -= parseInt(quizData[currentQuiz].negative_mark);
         }
      }

      if (answer === undefined) {
         if (currentQuiz < quizData.length) {
            unanswered++;
         }
         question_notanswered.innerText = unanswered;
      }

      currentQuiz++;

      if (currentQuiz < quizData.length) {
         loadQuiz();
      } else {
         document.getElementById('total_score').innerHTML = score;
         document.getElementById('attempted').innerHTML = answeredCount;
         document.getElementById('correct_answer').innerHTML = correct_answer;
         document.getElementById('un_attempted').innerHTML = unanswered;
         document.getElementById('wrong_answer').innerHTML = wrong_answer;
         document.getElementById('question_data').style.display = 'none';
         document.getElementById('result_data').style.display = 'block';
      }

      if (currentQuiz == quizData.length - 1) {
         submitButton.innerText = 'Submit';
      }
   });

</script>