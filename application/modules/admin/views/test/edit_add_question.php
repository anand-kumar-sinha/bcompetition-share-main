<?php if($mode == "Add") { ?>
<div id="AddQuestionModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add Question</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <!--<form class="offloadingImages"  id="offloadingImages" method="post" action="#" enctype="multipart/form-data">--> 
            <div class="modal-body">
                
                <input id="popup_mode" name="mode" type="hidden" value="<?php echo $mode;?>" class="form-control">
                <input id="add_popup_question_id" name="question_id" type="hidden" value="<?php echo $question_id;?>" class="form-control">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="">Select Section</label>
                            <select class="form-control" id="popup_section_id">
                                <?php $uniQueI=0; foreach ($section_name as $key=>$_section_name) { $uniQueI++;
                                    $section_Id = $uniQueI;
                                    ?>
                                <option value="<?php echo trim($section_Id);?>"><?php echo $_section_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="">Select Question Type</label>
                            <select class="form-control" required="" id="question_type" onchange="QuestionType(this.value)">
                               <option value="NormalQuestion" <?php if($box_question_type == "NormalQuestion"){ echo "selected";}?>>Normal Question</option>
                               <option value="ParagraphTypeQuestion" <?php if($box_question_type == "ParagraphTypeQuestion"){ echo "selected";}?>>Paragraph Type Question</option>
                               <option value="Subquestion" <?php if($box_question_type == "Subquestion"){ echo "selected";}?>>Subquestion for a paragraph</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtFirstNameBilling">  Enter your Question (with choices)/Paragraph  <span class="error">*</span></label>
                                <textarea id="question" name="question" class="form-control summernote"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row notParaQue" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Answer Type</label>
                            <select class="form-control" required="" id="new_ans_type" onchange="AnswerType(this.value)">
                                <option value="mcqs" <?php if($box_ans_type == "mcqs"){echo "selected";}?> >MCQ (Only one is correct)</option>
                                <option value="mcqm" <?php if($box_ans_type == "mcqm"){echo "selected";}?>>MCQ (More than one is correct)</option>
                                <option value="fib" <?php if($box_ans_type == "fib"){echo "selected";}?>>Fill in the blank/Numerical answer</option>
                            </select>
                        </div>
                    </div>
                    <div class="row notParaQue" id="MultipleChoiceOption"  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Number of choices:</label>
                            <select class="form-control" required="" id="new_a_choice_count" onchange="CreateAnswer(this.value)">
                               <option value="2" <?php if($new_a_choice_count=="2") { echo "selected";}?>>2 Choices (A. B.)</option>
                               <option value="3" <?php if($new_a_choice_count=="3") { echo "selected";}?>>3 Choices (A. B. C.)</option>
                               <option value="4" <?php if($new_a_choice_count=="4") { echo "selected";}?>>4 Choices (A. B. C. D.)</option>
                               <option value="5" <?php if($new_a_choice_count=="5") { echo "selected";}?>>5 Choices (A. B. C. D. E.)</option>
                               <option value="6" <?php if($new_a_choice_count=="6") { echo "selected";}?>>6 Choices (A. B. C. D. E. F.)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="FillAns" style="display: none;margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Enter Correct Answer:</label>
                            <input type="text" class="form-control" id="new_a_fill" value="<?php echo $box_new_a_fill;?>">
                        </div>
                    </div>
                    <div class="row notParaQue" id="RadioBtnDivMain"  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Correct Answer:</label>
                            <div id="RadioBtnDiv">
                                <div class="row">
                                    <div class="col-md-12 r_option_1" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_a" name="radio_answer" class="custom-control-input radio_answer" value="a" <?php if($box_radio_correct_ans == "a"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_a">A</label>&nbsp;&nbsp;
                                            <textarea class="form-control summernote radio_ans_a" id="text_radio_ans_a"><?php echo $box_text_radio_ans_a;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_2" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_b" name="radio_answer" class="custom-control-input radio_answer" value="b" <?php if($box_radio_correct_ans == "b"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_b">B</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_b" id="text_radio_ans_b"><?php echo $box_text_radio_ans_b;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_3" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_c" name="radio_answer" class="custom-control-input radio_answer" value="c" <?php if($box_radio_correct_ans == "c"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_c">C</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_c" id="text_radio_ans_c"><?php echo $box_text_radio_ans_c;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_4" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_d" name="radio_answer" class="custom-control-input radio_answer" value="d" <?php if($box_radio_correct_ans == "d"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_d">D</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_d" id="text_radio_ans_d"><?php echo $box_text_radio_ans_d;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_5" style="margin-top: 5px; display: none;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_e" name="radio_answer" class="custom-control-input radio_answer" value="e" <?php if($box_radio_correct_ans == "e"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_e">E</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_e" id="text_radio_ans_e"><?php echo $box_text_radio_ans_e;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_6" style="margin-top: 5px; display: none;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_f" name="radio_answer" class="custom-control-input radio_answer" value="f" <?php if($box_radio_correct_ans == "f"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_f">F</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_f" id="text_radio_ans_f"><?php echo $box_text_radio_ans_f;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row notParaQue" id="CheckoxDivMain"  style="display: none;margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Correct Answer:</label>
                            <div id="CheckoxDiv">
                                <div class="row">
                                    <div class="col-md-12 chk_option_1" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_a" type="checkbox" value="a" <?php if(in_array('a', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_a">A</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_a multi_answer" id="chk_multi_answer_a"><?php echo $box_chk_multi_answer_a;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_2" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_b" type="checkbox" value="b" <?php if(in_array('b', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_b">B</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_b multi_answer" id="chk_multi_answer_b"><?php echo $box_chk_multi_answer_b;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_3" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_c" type="checkbox" value="c" <?php if(in_array('c', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_c">C</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_c multi_answer" id="chk_multi_answer_c"><?php echo $box_chk_multi_answer_c;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_4" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_d" type="checkbox" value="d" <?php if(in_array('d', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_d">D</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_d multi_answer" id="chk_multi_answer_d"><?php echo $box_chk_multi_answer_d;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_5" style="margin-top: 5px;display: none;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_e" type="checkbox" value="e" <?php if(in_array('e', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_e">E</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_e multi_answer" id="chk_multi_answer_e"><?php echo $box_chk_multi_answer_e;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_6" style="margin-top: 5px;display: none;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_f" type="checkbox" value="f" <?php if(in_array('f', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_f">F</label>
                                            <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_f multi_answer" id="chk_multi_answer_f"><?php echo $box_chk_multi_answer_f;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label  class="">Marking:</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" style="background-color: rgb(185, 244, 185);" required="" id="new_a_marking_correct">
                                <option value="0.20" <?php if($box_new_a_marking_correct == "0.20"){ echo "selected";}?>>+0.20</option>
                                <option value="0.25" <?php if($box_new_a_marking_correct == "0.25"){ echo "selected";}?>>+0.25</option>
                                <option value="0.50" <?php if($box_new_a_marking_correct == "0.50"){ echo "selected";}?>>+0.50</option>
                                <option value="0.75" <?php if($box_new_a_marking_correct == "0.75"){ echo "selected";}?>>+0.75</option>
                                <option value="1" <?php if($box_new_a_marking_correct == "1"){ echo "selected";}?>selected="true">+1</option>
                                <option value="2" <?php if($box_new_a_marking_correct == "2"){ echo "selected";}?>>+2</option>
                                <option value="3" <?php if($box_new_a_marking_correct == "3"){ echo "selected";}?>>+3</option>
                                <option value="4" <?php if($box_new_a_marking_correct == "4"){ echo "selected";}?>>+4</option>
                                <option value="8" <?php if($box_new_a_marking_correct == "8"){ echo "selected";}?>>+8</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" style="background-color: rgb(255, 158, 152);" required="" id="new_a_marking_incorrect">
                                <option value="0" <?php if($new_a_marking_incorrect == "0"){ echo "selected";}?>>0</option>
                                <option value="0.20" <?php if($new_a_marking_incorrect == "0.20"){ echo "selected";}?>>-0.20</option>
                                <option value="0.25" <?php if($new_a_marking_incorrect == "0.25"){ echo "selected";}?>>-0.25</option>
                                <option value="0.33" <?php if($new_a_marking_incorrect == "0.33"){ echo "selected";}?>>-0.33</option>
                                <option value="0.50" <?php if($new_a_marking_incorrect == "0.50"){ echo "selected";}?>>-0.50</option>
                                <option value="0.75" <?php if($new_a_marking_incorrect == "0.75"){ echo "selected";}?>>-0.75</option>
                                <option value="1" <?php if($new_a_marking_incorrect == "1"){ echo "selected";}?>>-1</option>
                                <option value="2" <?php if($new_a_marking_incorrect == "2"){ echo "selected";}?>>-2</option>
                                <option value="3" <?php if($new_a_marking_incorrect == "3"){ echo "selected";}?>>-3</option>
                                <option value="4" <?php if($new_a_marking_incorrect == "4"){ echo "selected";}?>>-4</option>
                             </select>
                        </div>
                        <div class="col-md-12" id="CheckoxMarking"  style="display: none;">
                            <label class="">Marking:</label>
                            <p>Marking is fixed and well as following:</p>
                            <ul>
                                <li>+4 - If all the correct choices are selected</li>
                                <li>+3 - If all the four options are correct but only three options are chosen</li>
                                <li>+2 - If three or more options are correct but only two options are chosen, both of which are
                                   correct options.
                                </li>
                                <li>+1 - If two or more options are correct but only one option is chosen and it is a correct
                                   option
                                </li>
                                <li>-1 - For all other cases</li>
                            </ul>
                        </div> 
                    </div>
                    <div class="row" id=""  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class=""> Select Language </label>
                            <select class="form-control" required="" id="select_language">
                                <option value="english" <?php if($box_select_language == "english"){ echo "selected";}?>>English</option>
                                <option value="hindi" <?php if($box_select_language == "hindi"){ echo "selected";}?>>hindi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtFirstNameBilling">   Answer Description (If any?) <span class="error">*</span></label>
                            <textarea id="answer_description" name="answer_description" type="text" value="" class="form-control summernote"><?php echo $new_a_answer_description;?></textarea>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" onclick="AddSectionQuestion();" class="btn btn-primary waves-effect waves-light">Create</button>
                <!--<button  type="submit" class="btn btn-primary waves-effect waves-light">Create</button>-->
            </div>
            <!--</form>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php } else { ?>
<div id="EditQuestionModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Question</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <!--<form class="offloadingImages"  id="offloadingImages" method="post" action="#" enctype="multipart/form-data">--> 
            <div class="modal-body">
                
                <input id="popup_mode" name="mode" type="hidden" value="<?php echo $mode;?>" class="form-control">
                <input id="edit_popup_question_id" name="question_id" type="hidden" value="<?php echo $question_id;?>" class="form-control">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="">Select Section</label>
                            <select class="form-control" id="popup_section_id">
                                <?php foreach ($section_name as $key=>$_section_name) {
                                    $section_Id = $section_idArray[$key];
                                    ?>
                                <option value="<?php echo trim($section_Id);?>"><?php echo $_section_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="">Select Question Type</label>
                            <select class="form-control" required="" id="question_type" onchange="QuestionType(this.value)">
                               <option value="NormalQuestion" <?php if($box_question_type == "NormalQuestion"){ echo "selected";}?>>Normal Question</option>
                               <option value="ParagraphTypeQuestion" <?php if($box_question_type == "ParagraphTypeQuestion"){ echo "selected";}?>>Paragraph Type Question</option>
                               <option value="Subquestion" <?php if($box_question_type == "Subquestion"){ echo "selected";}?>>Subquestion for a paragraph</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtFirstNameBilling">  Enter your Question (with choices)/Paragraph  <span class="error">*</span></label>
                                <textarea id="question" name="question"  value="" class="form-control summernote"><?php echo $box_question;?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row notParaQue" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Answer Type</label>
                            <select class="form-control" required="" id="new_ans_type" onchange="AnswerType(this.value)">
                                <option value="mcqs" <?php if($box_ans_type == "mcqs"){echo "selected";}?> >MCQ (Only one is correct)</option>
                                <option value="mcqm" <?php if($box_ans_type == "mcqm"){echo "selected";}?>>MCQ (More than one is correct)</option>
                                <option value="fib" <?php if($box_ans_type == "fib"){echo "selected";}?>>Fill in the blank/Numerical answer</option>
                            </select>
                        </div>
                    </div>
                    <div class="row notParaQue" id="MultipleChoiceOption"  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Number of choices:</label>
                            <select class="form-control" required="" id="new_a_choice_count" onchange="CreateAnswer(this.value)">
                               <option value="2" <?php if($new_a_choice_count=="2") { echo "selected";}?>>2 Choices (A. B.)</option>
                               <option value="3" <?php if($new_a_choice_count=="3") { echo "selected";}?>>3 Choices (A. B. C.)</option>
                               <option value="4" <?php if($new_a_choice_count=="4") { echo "selected";}?>>4 Choices (A. B. C. D.)</option>
                               <option value="5" <?php if($new_a_choice_count=="5") { echo "selected";}?>>5 Choices (A. B. C. D. E.)</option>
                               <option value="6" <?php if($new_a_choice_count=="6") { echo "selected";}?>>6 Choices (A. B. C. D. E. F.)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="FillAns" style="display: none;margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Enter Correct Answer:</label>
                            <input type="text" class="form-control" id="new_a_fill" value="<?php echo $box_new_a_fill;?>">
                        </div>
                    </div>
                    <div class="row notParaQue" id="RadioBtnDivMain"  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Correct Answer:</label>
                            <div id="RadioBtnDiv">
                                <div class="row">
                                    <div class="col-md-12 r_option_1" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_a" name="radio_answer" class="custom-control-input" value="a" <?php if($box_radio_correct_ans == "a"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_a">A</label>&nbsp;&nbsp;
                                            <textarea class="form-control summernote radio_ans_a" id="text_radio_ans_a"><?php echo $box_text_radio_ans_a;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_2" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_b" name="radio_answer" class="custom-control-input" value="b" <?php if($box_radio_correct_ans == "b"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_b">B</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_b" id="text_radio_ans_b"><?php echo $box_text_radio_ans_b;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_3" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_c" name="radio_answer" class="custom-control-input" value="c" <?php if($box_radio_correct_ans == "c"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_c">C</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_c" id="text_radio_ans_c"><?php echo $box_text_radio_ans_c;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_4" style="margin-top: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_d" name="radio_answer" class="custom-control-input" value="d" <?php if($box_radio_correct_ans == "d"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_d">D</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_d" id="text_radio_ans_d"><?php echo $box_text_radio_ans_d;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_5" style="margin-top: 5px; display: none;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_e" name="radio_answer" class="custom-control-input" value="e" <?php if($box_radio_correct_ans == "e"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_e">E</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_e" id="text_radio_ans_e"><?php echo $box_text_radio_ans_e;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 r_option_6" style="margin-top: 5px; display: none;">
                                        <div class="custom-control custom-radio custom-control-inline" style="width: 100%;">
                                            <input type="radio" id="radio_ans_f" name="radio_answer" class="custom-control-input" value="f" <?php if($box_radio_correct_ans == "f"){ echo "checked";}?>>
                                            <label class="custom-control-label" for="radio_ans_f">F</label>&nbsp;&nbsp;
                                             <textarea class="form-control summernote radio_ans_f" id="text_radio_ans_f"><?php echo $box_text_radio_ans_f;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row notParaQue" id="CheckoxDivMain"  style="display: none;margin-top: 10px;">
                        <div class="col-md-12">
                            <label class="">Select Correct Answer:</label>
                            <div id="CheckoxDiv">
                                <div class="row">
                                    <div class="col-md-12 chk_option_1" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_a" type="checkbox" value="a" <?php if(in_array('a', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_a">A</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_a" id="chk_multi_answer_a"><?php echo $box_chk_multi_answer_a;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_2" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_b" type="checkbox" value="b" <?php if(in_array('b', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_b">B</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_b" id="chk_multi_answer_b"><?php echo $box_chk_multi_answer_b;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_3" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_c" type="checkbox" value="c" <?php if(in_array('c', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_c">C</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_c" id="chk_multi_answer_c"><?php echo $box_chk_multi_answer_c;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_4" style="margin-top: 5px;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_d" type="checkbox" value="d" <?php if(in_array('d', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_d">D</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_d" id="chk_multi_answer_d"><?php echo $box_chk_multi_answer_d;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_5" style="margin-top: 5px;display: none;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_e" type="checkbox" value="e" <?php if(in_array('e', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_e">E</label>
                                             <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_e" id="chk_multi_answer_e"><?php echo $box_chk_multi_answer_e;?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 chk_option_6" style="margin-top: 5px;display: none;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input multi_answer" name="chk_multi_answer" id="multi_answer_f" type="checkbox" value="f" <?php if(in_array('f', $box_correct_ans_chk)){ echo "checked";}?>>
                                            <label class="custom-control-label" for="multi_answer_f">F</label>
                                            <textarea name="text_multi_answer[]" class="form-control summernote multi_answer_f" id="chk_multi_answer_f"><?php echo $box_chk_multi_answer_f;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label  class="">Marking:</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" style="background-color: rgb(185, 244, 185);" required="" id="new_a_marking_correct">
                                <option value="0.20" <?php if($box_new_a_marking_correct == "0.20"){ echo "selected";}?>>+0.20</option>
                                <option value="0.25" <?php if($box_new_a_marking_correct == "0.25"){ echo "selected";}?>>+0.25</option>
                                <option value="0.50" <?php if($box_new_a_marking_correct == "0.50"){ echo "selected";}?>>+0.50</option>
                                <option value="0.75" <?php if($box_new_a_marking_correct == "0.75"){ echo "selected";}?>>+0.75</option>
                                <option value="1" <?php if($box_new_a_marking_correct == "1"){ echo "selected";}?>selected="true">+1</option>
                                <option value="2" <?php if($box_new_a_marking_correct == "2"){ echo "selected";}?>>+2</option>
                                <option value="3" <?php if($box_new_a_marking_correct == "3"){ echo "selected";}?>>+3</option>
                                <option value="4" <?php if($box_new_a_marking_correct == "4"){ echo "selected";}?>>+4</option>
                                <option value="8" <?php if($box_new_a_marking_correct == "8"){ echo "selected";}?>>+8</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" style="background-color: rgb(255, 158, 152);" required="" id="new_a_marking_incorrect">
                                <option value="0" <?php if($new_a_marking_incorrect == "0"){ echo "selected";}?>>0</option>
                                <option value="0.20" <?php if($new_a_marking_incorrect == "0.20"){ echo "selected";}?>>-0.20</option>
                                <option value="0.25" <?php if($new_a_marking_incorrect == "0.25"){ echo "selected";}?>>-0.25</option>
                                <option value="0.33" <?php if($new_a_marking_incorrect == "0.33"){ echo "selected";}?>>-0.33</option>
                                <option value="0.50" <?php if($new_a_marking_incorrect == "0.50"){ echo "selected";}?>>-0.50</option>
                                <option value="0.75" <?php if($new_a_marking_incorrect == "0.75"){ echo "selected";}?>>-0.75</option>
                                <option value="1" <?php if($new_a_marking_incorrect == "1"){ echo "selected";}?>>-1</option>
                                <option value="2" <?php if($new_a_marking_incorrect == "2"){ echo "selected";}?>>-2</option>
                                <option value="3" <?php if($new_a_marking_incorrect == "3"){ echo "selected";}?>>-3</option>
                                <option value="4" <?php if($new_a_marking_incorrect == "4"){ echo "selected";}?>>-4</option>
                             </select>
                        </div>
                        <div class="col-md-12" id="CheckoxMarking"  style="display: none;">
                            <label class="">Marking:</label>
                            <p>Marking is fixed and well as following:</p>
                            <ul>
                                <li>+4 - If all the correct choices are selected</li>
                                <li>+3 - If all the four options are correct but only three options are chosen</li>
                                <li>+2 - If three or more options are correct but only two options are chosen, both of which are
                                   correct options.
                                </li>
                                <li>+1 - If two or more options are correct but only one option is chosen and it is a correct
                                   option
                                </li>
                                <li>-1 - For all other cases</li>
                            </ul>
                        </div> 
                    </div>
                    <div class="row" id=""  style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label class=""> Select Language </label>
                            <select class="form-control" required="" id="select_language">
                                <option value="english" <?php if($box_select_language == "english"){ echo "selected";}?>>English</option>
                                <option value="hindi" <?php if($box_select_language == "hindi"){ echo "selected";}?>>hindi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtFirstNameBilling">   Answer Description (If any?) <span class="error">*</span></label>
                            <textarea id="answer_description" name="answer_description" type="text" value="" class="form-control summernote"><?php echo $new_a_answer_description;?></textarea>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" onclick="EditSectionQuestion();" class="btn btn-primary waves-effect waves-light">Update</button>
                <!--<button  type="submit" class="btn btn-primary waves-effect waves-light">Create</button>-->
            </div>
            <!--</form>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php }?>
<style>
#CheckoxDiv .card {
  position: relative;
  width: 98%;
  float: right;
}

@font-face {
    font-family: 'Kruti-Dev';
    src: url('<?php echo base_url();?>assets/admin/fonts/KrutiDev010.woff2') format('woff2'),
        url('<?php echo base_url();?>assets/admin/fonts/KrutiDev010.woff') format('woff');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

.note-editing-area {  
    font-size: 20px !important; 
    text-align: left !important; 
     
}
</style>
<!--<script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>-->
<script>
<?php if($mode="Edit") { ?>
    QuestionType('<?php echo $box_question_type;?>');
<?php } ?>
setTimeout(function(){
    $(function () {
    // Summernote
    var gArrayFonts = ['Amethysta','Poppins','Poppins-Black','Kruti-Dev'];

    $('.summernote').summernote({
        fontNames: gArrayFonts,
        fontNamesIgnoreCheck: gArrayFonts,
        okButton: 'OK'
    }); 
//    $('.summernote').summernote({
//        lang: 'ko-KR' // default: 'en-US'
//    }); 
  })
// ClassicEditor.create( document.querySelector( '#question' ), {});
// ClassicEditor.create( document.querySelector( '#answer_description' ), { });
// ClassicEditor.create( document.querySelector( '.radio_ans_a' ), { });
// ClassicEditor.create( document.querySelector( '.radio_ans_b' ), { });
// ClassicEditor.create( document.querySelector( '.radio_ans_c' ), { });
// ClassicEditor.create( document.querySelector( '.radio_ans_d' ), { });
// ClassicEditor.create( document.querySelector( '.radio_ans_e' ), { });
// ClassicEditor.create( document.querySelector( '.radio_ans_f' ), { });
// ClassicEditor.create( document.querySelector( '.multi_answer_a' ), { });
// ClassicEditor.create( document.querySelector( '.multi_answer_b' ), { });
// ClassicEditor.create( document.querySelector( '.multi_answer_c' ), { });
// ClassicEditor.create( document.querySelector( '.multi_answer_d' ), { });
// ClassicEditor.create( document.querySelector( '.multi_answer_e' ), { });
// ClassicEditor.create( document.querySelector( '.multi_answer_f' ), { });

}, 500); //Time before execution


    function QuestionType(question_type){
         var new_ans_type = $("#new_ans_type").val();
        if(question_type == "ParagraphTypeQuestion"){
            $(".notParaQue").css("display","none");
            $("#FillAns").css("display","none");
        } else {
             $(".notParaQue").css("display","block");
             $("#FillAns").css("display","block");
            AnswerType(new_ans_type);
        }

        
    }
    function AnswerType(answer_type){
        var no_of_ans = $("#new_a_choice_count").val();
         
        if(answer_type == "mcqs"){
            $("#FillAns").css("display","none");
            $("#CheckoxDivMain").css("display","none");
            $("#CheckoxMarking").css("display","none");
            $("#RadioBtnDivMain").css("display","block");
            $("#MultipleChoiceOption").css("display","block");
        }  else if(answer_type == "mcqm"){
           $("#FillAns").css("display","none");
            $("#CheckoxDivMain").css("display","block");
            $("#CheckoxMarking").css("display","block");
            $("#MultipleChoiceOption").css("display","block");
            $("#RadioBtnDivMain").css("display","none");
        } else {
            $("#FillAns").css("display","block");
            $("#CheckoxDivMain").css("display","none");
            $("#CheckoxMarking").css("display","none");
            $("#RadioBtnDivMain").css("display","none");
            $("#MultipleChoiceOption").css("display","none");
        }
        CreateAnswer(no_of_ans);
    }
    
    function CreateAnswer(no_of_ans){
        var new_ans_type = $("#new_ans_type").val();
        if(new_ans_type == "mcqs") {
            if(no_of_ans == 1){
                $(".r_option_1").css("display","block");
                $(".r_option_2").css("display","none");
                $(".r_option_3").css("display","none");
                $(".r_option_4").css("display","none");
                $(".r_option_5").css("display","none");
                $(".r_option_5").css("display","none");
            } else if(no_of_ans == 2){
                $(".r_option_1").css("display","block");
                $(".r_option_2").css("display","block");
                $(".r_option_3").css("display","none");
                $(".r_option_4").css("display","none");
                $(".r_option_5").css("display","none");
                $(".r_option_6").css("display","none");
            } else if(no_of_ans == 3){
                $(".r_option_1").css("display","block");
                $(".r_option_2").css("display","block");
                $(".r_option_3").css("display","block");
                $(".r_option_4").css("display","none");
                $(".r_option_5").css("display","none");
                $(".r_option_6").css("display","none");
            } else if(no_of_ans == 4){
                $(".r_option_1").css("display","block");
                $(".r_option_2").css("display","block");
                $(".r_option_3").css("display","block");
                $(".r_option_4").css("display","block");
                $(".r_option_5").css("display","none");
                $(".r_option_6").css("display","none");
            } else if(no_of_ans == 5){
                $(".r_option_1").css("display","block");
                $(".r_option_2").css("display","block");
                $(".r_option_3").css("display","block");
                $(".r_option_4").css("display","block");
                $(".r_option_5").css("display","block");
                $(".r_option_6").css("display","none");
            } else if(no_of_ans == 6){
                $(".r_option_1").css("display","block");
                $(".r_option_2").css("display","block");
                $(".r_option_3").css("display","block");
                $(".r_option_4").css("display","block");
                $(".r_option_5").css("display","block");
                $(".r_option_6").css("display","block");
            }
        } else if(new_ans_type == "mcqm"){
            if(no_of_ans == 1){
                $(".chk_option_1").css("display","block");
                $(".chk_option_2").css("display","none");
                $(".chk_option_3").css("display","none");
                $(".chk_option_4").css("display","none");
                $(".chk_option_5").css("display","none");
                $(".chk_option_6").css("display","none");
            } else if(no_of_ans == 2){
                $(".chk_option_1").css("display","block");
                $(".chk_option_2").css("display","block");
                $(".chk_option_3").css("display","none");
                $(".chk_option_4").css("display","none");
                $(".chk_option_5").css("display","none");
                $(".chk_option_6").css("display","none");
            } else if(no_of_ans == 3){
                $(".chk_option_1").css("display","block");
                $(".chk_option_2").css("display","block");
                $(".chk_option_3").css("display","block");
                $(".chk_option_4").css("display","none");
                $(".chk_option_5").css("display","none");
                $(".chk_option_6").css("display","none");
            } else if(no_of_ans == 4){
                $(".chk_option_1").css("display","block");
                $(".chk_option_2").css("display","block");
                $(".chk_option_3").css("display","block");
                $(".chk_option_4").css("display","block");
                $(".chk_option_5").css("display","none");
                $(".chk_option_6").css("display","none");
            } else if(no_of_ans == 5){
                $(".chk_option_1").css("display","block");
                $(".chk_option_2").css("display","block");
                $(".chk_option_3").css("display","block");
                $(".chk_option_4").css("display","block");
                $(".chk_option_5").css("display","block");
                $(".chk_option_6").css("display","none");
            } else if(no_of_ans == 6){
                $(".chk_option_1").css("display","block");
                $(".chk_option_2").css("display","block");
                $(".chk_option_3").css("display","block");
                $(".chk_option_4").css("display","block");
                $(".chk_option_5").css("display","block");
                $(".chk_option_6").css("display","block");
            }  
        } else {
            
        }
    }
    
 




</script>
