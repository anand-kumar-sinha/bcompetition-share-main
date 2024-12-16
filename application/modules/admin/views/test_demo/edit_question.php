<?php
if (isset($TestDetail)) {
    $id = $TestDetail->id;
    $test_title = $TestDetail->test_title;
    $test_type = $TestDetail->test_type;
    $test_time = $TestDetail->test_time;
    $exam_detail = $TestDetail->exam_detail;

    $prize_pool_amount = $TestDetail->prize_pool_amount;
    $join_amount = $TestDetail->join_amount;
    $number_of_slot = $TestDetail->number_of_slot;
    $point_system = $TestDetail->point_system;
    $status = $TestDetail->status;
    $mode = 'Edit';
} else {
    $id = '';
    $test_title = '';
    $test_type = '';
    $test_time = '';
    $exam_detail = '';
    $prize_pool_amount = '';
    $join_amount = '';
    $number_of_slot = '';
    $point_system = '';
    $status = '';
    $mode = 'Add';
}
if (isset($TestSectionDetail)) {
    $section_count = count($TestSectionDetail);
} else {
    $TestSectionDetail = array();
    $section_count = 1;
}

if (isset($TestSectionQuestionDetail)) {
    
} else {
    $TestSectionQuestionDetail = array();
}
?>


<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title"><?php echo $mode;?> Test</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Test">Test List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode;?> Test</li>
						<li class="breadcrumb-item active"><?php echo $test_title;?> </li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Category_Form" method="post" action="<?php echo base_url(); ?>admin/Test/action" enctype="multipart/form-data" novalidate="novalidate">
                            <div class="row">
							<?php
							//print_r($TestDetail);
                                                        //  echo "====================";
							//print_r($TestSectionDetail);
                                                       // echo "====================";
							//print_r($TestSectionQuestionDetail);

							?>
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-sm " type="button" style="background-color: #2182CF; border-color: #2182CF;" data-toggle="dropdown" aria-haspopup="true" style="margin-right: 5px;" aria-expanded="true"><i class="mdi mdi-plus"> </i> Import Questions</button>
                                    <div class="dropdown-menu dropdown-menu-right" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-placement="top-end" x-out-of-boundaries="">
                                            <a class="dropdown-item" onclick="openPDFImporter()">by PDF</a>
                                            <!-- <a class="dropdown-item" data-toggle="modal" data-target="#importQuestionText">by Copying Text</a> -->
                                            <a class="dropdown-item" data-toggle="modal" data-target="#importQuestionExcel" >from an Excel sheet</a>
                                            <!-- <a class="dropdown-item" data-toggle="modal" data-target="#importQuestionDocx">from Docx</a> -->
                                    </div>
                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#addSection"><i class="fa fa-plus"></i> Create Section</button>
                                    <button class="btn btn-primary btn-sm" type="button" onclick="newQuestionBtn()"><i class="fa fa-plus"></i> Create Questions</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
							
                                <!--<div class="col-md-9">
                                    <input type="hidden" id="sectionCount" value="1">
                                    <div id="SectionMainDiv">
                                    </div>
                                </div>-->
								
								
                                <div class="col-md-9">
                                    <input type="hidden" id="sectionCount" value="<?php echo $section_count; ?>">
                                    
                                    <?php if (!empty($TestSectionDetail)) { ?>
                                        <?php foreach ($TestSectionDetail as $row) { ?>
                                            <div id="">
                                                <div id=""> 
                                                    <hr>

                                                    
                                                    <b style="font-size: 20px;" id="" value="" ><span id="section_name_span_<?php echo $row->id; ?>"><?php echo $row->section_name; ?></span></b>
                                                    <button class="btn btn-warning waves-effect waves-light btn-sm" type="button" onclick="editSectionName('<?php echo $row->id; ?>', '<?php echo $row->section_name; ?>')"><i class="fas fa-edit"></i> </button>
                                                    <button onclick="deleteSectionBtn('<?php echo $row->id; ?>')" class="btn btn-danger waves-effect waves-light btn-sm" style="margin-right: 5px;" type="button"><i class="fa fa-trash"></i> </button>
                                                                                    
                                                    <hr>

                                                     <?php if (!empty($TestSectionQuestionDetail)) { ?>
                                                                <?php foreach ($TestSectionQuestionDetail as $row_question) { ?>
                                                    <?php if($row->id == $row_question->section_id ) { ?>

                                                                    <div class="row col-sm-12  " id="">
                                                                        <div id="" class="card col-sm-12" style="padding-left: 0; padding-right: 0; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                                                            <div class="card-header" style="padding: .5rem .8rem;">
                                                                                <div class="float-left" style="margin-top:8px">
                                                                                    <span class="mdi mdi-cursor-move" aria-hidden="true" style="cursor:move; cursor:-webkit-grabbing"> </span>
                                                                                    <b>Question</b>
                                                                                </div>
                                                                                <button class="btn btn-warning waves-effect waves-light float-right btn-sm" type="button" onclick="editQuestionBtn(1, 1)"><i class="fas fa-edit"></i> </button>
                                                                                <button class="btn btn-danger waves-effect waves-light float-right btn-sm" style="margin-right: 5px;" type="button" onclick="deleteQuestionBtn(1, 1)"><i class="fa fa-trash"></i> 
                                                                                </button>
                                                                            </div>
                                                                            <div class="card-body img-small">
                                                                                <span id="question_html_1_1">
                                                                                    <p> </p>
                                                                                    <p> <?php echo $row_question->question ; ?></p>
                                                                                    <p></p>
                                                                                </span>
                                                                                <p id="html_ans_type_1_1">Answer Type: Single choice is correct</p>
                                                                                <p id="correct_ans_html_1_1">Correct Answer: <?php echo $row_question->radio_correct_ans ; ?></p>
                                                                                <p id="correct_mark_html_1_1">Correct Marking: <?php echo $row_question->marking_correct ; ?>; Incorrect Marking: <?php echo $row_question->marking_incorrect ; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                    
                                                    
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    
                                    <div id="SectionMainDiv">
                                    </div>
                                    
                                </div>
								
                                <div class="col-md-3">
                                    <div class="card col-sm-12" style="padding-left: 0; padding-right: 0; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                        <div class="card-header" style="padding: .5rem .8rem;">
                                           <div class="float-left" style="margin-top:8px">
                                              <b>Test Details</b> 
                                           </div>
                                        </div>
                                        <div id="test_details_card" class="card-body">
                                            <div style="margin-bottom: 10px">
                                                <label>Test title:</label>
                                                <input type="text" class="form-control" id="test_title" name="test_title" value="<?php echo $test_title; ?>">
                                                <p id="test_title_err" style="color:brown; display: none;">Please enter the title</p>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Exam Detail:</label>
                                                <textarea class="form-control" id="exam_detail" name="exam_detail"><?php echo $exam_detail; ?></textarea>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Select Test Type</label>
                                                <select class="form-control" required="" id="test_type" name="test_type">
                                                    <option value="Mock Test" <?php if($test_type == "Mock Test"){ echo ' selected'; }?> >Mock Test</option>
                                                    <option value="Quiz" <?php if($test_type == "Quiz"){ echo ' selected'; }?> >Quiz</option>
                                                    <option value="Last Year" <?php if($test_type == "Last Year"){ echo ' selected'; }?> >Last Year</option>
                                                   <!-- <option value="3">Live Test</option> -->
                                                </select>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Total time in minutes:</label>
                                                <input type="number" class="form-control" id="test_time" name="test_time" min="0" value="<?php echo $test_time; ?>">
                                                <p id="test_title_err" style="color:brown; display: none;">Please enter the time</p>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Prize Pool Amount:</label>
                                                <input type="number" class="form-control" id="prize_pool_amount" name="prize_pool_amount" min="0" value="<?php echo $prize_pool_amount; ?>"> 
                                            </div>
                                            
                                            <div style="margin-bottom: 10px">
                                                <label>Join Amount:</label>
                                                <input type="number" class="form-control" id="join_amount" name="join_amount" min="0" value="<?php echo $join_amount; ?>">
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Number of Slot:</label>
                                                <input type="number" class="form-control" id="number_of_slot" name="number_of_slot" min="0" value="<?php echo $number_of_slot; ?>"> 
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Point System:</label>
                                                <input type="text" class="form-control" id="point_system" name="point_system" value="<?php echo $point_system; ?>"> 
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <div id="CashPrizeDiv">
                                                    <input type="hidden" id="cash_price_count" value="1">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label>Rank:</label>
                                                            <input type="text" class="form-control" id="cash_prize_rank" name="cash_prize_rank[]" placeholder="1-10"> 
                                                        </div>
                                                        <div class="col-md-5">
                                                             <label>Amount:</label>
                                                            <input type="number" class="form-control" id="cash_prize_amount" name="cash_prize_amount[]" min="0"> 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <span style="margin-top: 30px;margin-left: -15px;" class="btn btn-primary btn-sm" onclick="AddMoreCashPrice()"><i class="fa fa-plus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" onclick="CancelData();">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

<div id="AddQuestionDiv">
    
</div>

<!-- content -->
<div id="addSection" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New Section</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtFirstNameBilling"> Section Name<span class="error">*</span></label>
                            <input id="section_name" name="section_name" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" onclick="AddSectionAction();" class="btn btn-primary waves-effect waves-light">Create</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="EditSectionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Section</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <div class="modal-body">
                <input id="update_section_id" name="update_section_id" type="hidden" value="" class="form-control">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtFirstNameBilling"> Section Name <span class="error">*</span></label>
                            <input id="update_section_name" name="update_section_name" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" onclick="updateSectionNamePost();" class="btn btn-primary waves-effect waves-light">Update</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="Editsection" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Section</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <div class="modal-body">
                <input id="edit_section_id" name="edit_section_id" type="hidden" value="" class="form-control">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtFirstNameBilling"> Section Name <span class="error">*</span></label>
                            <input id="edit_section_name" name="edit_section_name" type="text" value="" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" onclick="EditSectionAction();" class="btn btn-primary waves-effect waves-light">Create</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="importQuestionPDF" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Import Questions through PDF</h5>
          </div>
          <div class="modal-body" style="padding-left: 30px; padding-right: 30px;">
             <div class="form-group row" id="div-pdf-upload">
                <label for="example-text-input" class="col-sm-3 col-form-label">Select file (PDF
                Only)</label>
                <div class="col-sm-9">
                   <button type="button" id="upload-button"
                      class="float-right btn-block btn btn-success btn-sm" style="background-color: #2182CF;border-color: #2182CF;">Upload PDF</button>
                   <input type="file" id="file-to-upload" accept="application/pdf" style="display: none;" />
                </div>
             </div>
             <div class="form-group row">
                <div class="col-sm-12" id="previews"
                   style="margin-bottom: 10px; height: 200px;overflow-x: auto;display: inline-block;white-space: nowrap;">
                </div>
             </div>
             <div class="col-sm-12" id="pdfcontrols" style="display: none;">
                <button class="btn btn-success btn-sm" style="background-color: #2182CF; border-color: #2182CF;" id="pdf-prev">Previous
                Page</button>
                <button class="btn btn-success btn-sm" style="background-color: #2182CF; border-color: #2182CF;" id="pdf-next">Next
                Page</button>
                <button class="btn btn-success btn-sm waves-effect waves-light" id="nextbtn" 
                   onclick="nextques()"
                   style="position: fixed;left: 24%;bottom: 6%;z-index: 999;background-color: #2182CF; border-color: #2182CF;"><span
                   class=" mdi mdi-skip-next"> </span> Next</button>
                <button class="btn btn-success btn-sm waves-effect waves-light" id="undobtn" disabled="true"
                   onclick="undoques()"
                   style="position: fixed;left: 18%;bottom: 6%;z-index: 980;background-color: #2182CF; border-color: #2182CF;"><span
                   class="mdi mdi-undo-variant"> </span> Undo</button>
                <div id="page-count-container" class="float-right" style="display: none">Page <span
                   id="pdf-current-page"></span> of <span id="pdf-total-pages"></span></div>
             </div>
             <div class="col-sm-12">
                <div id="page-loader" style="display: none">Loading page . . . </div>
                <div id="pdf-loader" style="display: none;">Loading document . . . </div>
                <canvas id="pdf-canvas" width="1000"></canvas>
                <div id="current-page-preview-div">
                   <img id="current-page-preview" src="" style="max-width: 100%;">
                </div>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-sm" style="background-color: #fff;border-color: #006df0;" onclick="closePDFImporter()">Cancel</button>
             <button type="button" onclick="importQuestionsPDF()" class="btn btn-success btn-sm" style="background-color: #2182CF; border-color: #2182CF;"
                id="importquestionscontbtn">Continue</button>
          </div>
       </div>
    </div>
 </div>

<div class="modal fade" id="importQuestionPDF2" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Import Questions </h5>
             <button type="button" class="btn btn-secondary" onclick="reshowImporter()">Can't scroll down?</button>
          </div>
          <div class="modal-body" style="padding-left: 30px;">
             <div class="col-sm-12 row"
                style="padding: 10px; border: solid; border-color: #626ed4; border-radius: 10px; padding-bottom: 20px;">
                <p class="col-sm-12"><b>Master Settings: </b> Any changes made here will overwrite the
                   properties in all the questions below.
                </p>
                <div id="div_q_type_pdf_m" class="col-sm-4">
                   <label class="col-sm-12">Select Question Type</label>
                   <select class="form-control" required id="new_q_type_pdf_m"
                      onchange="qTypeToggle(this, 1, '_pdf_m')">
                      <option value="n" selected="true">Normal Question</option>
                      <option value="p">Paragraph Type Question</option>
                      <option value="s">Subquestion for a paragraph</option>
                   </select>
                </div>
                <div id="div_a_type_pdf_m" class="col-sm-4">
                   <label class="col-sm-12">Select Answer Type</label>
                   <select class="form-control" required id="new_a_type_pdf_m"
                      onchange="aTypeToggle(this, 1, '_pdf_m')">
                      <option value="mcqs" selected="true">MCQ (Only one is correct)</option>
                      <option value="mcqm">MCQ (More than one is correct)</option>
                      <option value="fib">Fill in the blank/Numerical answer</option>
                   </select>
                </div>
                <div id="div_a_choice_count_pdf_m" class="col-sm-4">
                   <label class="col-sm-12">Select Number of choices:</label>
                   <select class="form-control" required id="new_a_choice_count_pdf_m"
                      onchange="choicesToggle(this, 1, '_pdf_m')">
                      <option value="2">2 Choices (A. B.)</option>
                      <option value="3">3 Choices (A. B. C.)</option>
                      <option value="4" selected="true">4 Choices (A. B. C. D.)</option>
                      <option value="5">5 Choices (A. B. C. D. E.)</option>
                      <option value="6">6 Choices (A. B. C. D. E. F.)</option>
                   </select>
                </div>
                <div id="div_a_mcq_correct_pdf_m" class="col-sm-4">
                   <label class="col-sm-12">Select Correct Answer:</label>
                   <div id="div_mcqm_pdf_m" class=" col-sm-12 btn-group btn-group-toggle"
                      data-toggle="buttons" style="display: none">
                      <label class="btn btn-outline-primary active" id="choice_a_cb_pdf_m"
                         onclick="togglechoiceMaster('choice_a_cb', 1)">
                      <input type="checkbox" checked=""> A
                      </label>
                      <label class="btn btn-outline-primary" id="choice_b_cb_pdf_m"
                         onclick="togglechoiceMaster('choice_b_cb', 1)">
                      <input type="checkbox"> B
                      </label>
                      <label class="btn btn-outline-primary" id="choice_c_cb_pdf_m"
                         onclick="togglechoiceMaster('choice_c_cb', 1)">
                      <input type="checkbox"> C
                      </label>
                      <label class="btn btn-outline-primary" id="choice_d_cb_pdf_m"
                         onclick="togglechoiceMaster('choice_d_cb', 1)">
                      <input type="checkbox"> D
                      </label>
                      <label class="btn btn-outline-primary" id="choice_e_cb_pdf_m"
                         onclick="togglechoiceMaster('choice_e_cb', 1)" style="display: none">
                      <input type="checkbox"> E
                      </label>
                      <label class="btn btn-outline-primary" id="choice_f_cb_pdf_m"
                         onclick="togglechoiceMaster('choice_f_cb', 1)" style="display: none">
                      <input type="checkbox"> F
                      </label>
                   </div>
                   <div id="div_mcqs_pdf_m" class="col-sm-12 btn-group btn-group-toggle"
                      data-toggle="buttons">
                      <label class="btn btn-outline-primary active" id="choice_a_radio_pdf_m"
                         onclick="togglechoiceMaster('choice_a_radio', 1)">
                      <input type="radio" checked=""> A
                      </label>
                      <label class="btn btn-outline-primary" id="choice_b_radio_pdf_m"
                         onclick="togglechoiceMaster('choice_b_radio', 1)">
                      <input type="radio"> B
                      </label>
                      <label class="btn btn-outline-primary" id="choice_c_radio_pdf_m"
                         onclick="togglechoiceMaster('choice_c_radio', 1)">
                      <input type="radio"> C
                      </label>
                      <label class="btn btn-outline-primary" id="choice_d_radio_pdf_m"
                         onclick="togglechoiceMaster('choice_d_radio', 1)">
                      <input type="radio"> D
                      </label>
                      <label class="btn btn-outline-primary" id="choice_e_radio_pdf_m"
                         onclick="togglechoiceMaster('choice_e_radio', 1)" style="display: none">
                      <input type="radio"> E
                      </label>
                      <label class="btn btn-outline-primary" id="choice_f_radio_pdf_m"
                         onclick="togglechoiceMaster('choice_f_radio', 1)" style="display: none">
                      <input type="radio"> F
                      </label>
                   </div>
                </div>
                <div id="div_a_fill_pdf_m" style="display: none" class="col-sm-4">
                   <label class="col-sm-12">Enter Correct Answer:</label>
                   <input type="text" class="form-control" id="new_a_fill_pdf_m"
                      onkeyup="togglefibMaster('new_a_fill', 1)">
                   <p id="new_a_fill_err" style="color:brown; display: none;">Please select a valid
                      choice
                   </p>
                </div>
                <div id="div_a_marking_pdf_m" class="col-sm-4">
                   <label class="col-sm-12">Marking:</label>
                   <select class="form-control col-sm-6 float-left"
                      onchange="togglecmarkingeMaster('new_a_marking_correct', 1)"
                      style="background-color: rgb(185, 244, 185);" required
                      id="new_a_marking_correct_pdf_m">
                      <option value="0.25" >+0.25</option>
                      <option value="0.50" >+0.50</option>
                      <option value="0.75" >+0.75</option>
                      <option value="1" selected="true">+1</option>
                      <option value="2">+2</option>
                      <option value="3">+3</option>
                      <option value="4">+4</option>
                      <option value="8">+8</option>
                   </select>
                   <select class="form-control col-sm-5 float-right"
                      onchange="toggleimarkingMaster('new_a_marking_incorrect', 1)"
                      style="margin-left: 10px;background-color: rgb(255, 158, 152);" required
                      id="new_a_marking_incorrect_pdf_m">
                      <option value="0" selected="true">0</option>
                      <option value="0.25">-0.25</option>
                      <option value="0.33">-0.33</option>
                      <option value="0.50">-0.50</option>
                      <option value="0.75">-0.75</option>
                      <option value="1">-1</option>
                      <option value="2">-2</option>
                      <option value="3">-3</option>
                      <option value="4">-4</option>
                   </select>
                </div>
                <div id="div_mcqm_marking_pdf_m" class="col-sm-4" style="display: none">
                   <label class="col-sm-12">Marking:</label>
                   Marking is fixed and well as following:
                   <ul>
                      <li>+4 - If all the correct choices are selected</li>
                      <li>+3 - If all the four options are correct but only three options are chosen
                      </li>
                      <li>+2 - If three or more options are correct but only two options are chosen,
                         both of which are correct options.
                      </li>
                      <li>+1 - If two or more options are correct but only one option is chosen and it
                         is a correct option
                      </li>
                      <li>-1 - For all other cases</li>
                   </ul>
                </div>
                <div id="div_a_lang_pdf_m" class="col-sm-4">
                   <label class="col-sm-12">Select Answer Type</label>
                   <select class="form-control" required id="new_a_lang_pdf_m"
                      onchange="togglelangMaster('new_a_lang', 1)">
                      <option value="english" selected="true">English</option>
                      <option value="hindi">हिंदी</option>
                      <option value="marathi">मराठी</option>
                      <option value="punjabi">ਪੰਜਾਬੀ</option>
                      <option value="kannada">ಕನ�?ನಡ</option>
                      <option value="malyalam">മലയാളം</option>
                      <option value="tamil">தமிழ�?</option>
                      <option value="telegu">తెల�?గ�?</option>
                      <option value="arabic">Arabic</option>
                      <option value="french">French</option>
                      <option value="spanish">Spanish</option>
                      <option value="german">German</option>
                      <option value="russia">Russian</option>
                   </select>
                </div>
                <div style="display: none;">
                   <label class="col-sm-12">Select question category:</label>
                   <div class="col-sm-6 float-left">
                      <label>Select subject:</label>
                      <select class="form-control" required id="ques_cat_master_1" onchange='handle_cat(1, "ques_cat")'>
                         <option selected disabled>---------</option>
                         <option value="new">Create New</option>
                         <option disabled>-- Already created --</option>
                      </select>
                   </div>
                   <div class="col-sm-6 float-left">
                      <label>Select unit/chapter:</label>
                      <select class="form-control" required id="ques_cat_master_2" disabled onchange='handle_cat(2, "ques_cat")'>
                         <option selected disabled>---------</option>
                         <option value="new">Create new unit/chapter</option>
                         <option disabled>-- Already created --</option>
                      </select>
                   </div>
                   <div class="col-sm-6 float-left" style="margin-bottom: 15px">
                      <label>Select a topic:</label>
                      <select class="form-control" required id="ques_cat_master_3" disabled onchange='handle_cat(3, "ques_cat")'>
                         <option selected disabled>---------</option>
                         <option value="new">Create new topic</option>
                         <option disabled>-- Already created --</option>
                      </select>
                   </div>
                   <div class="col-sm-6 float-left" style="margin-bottom: 15px">
                      <label>Select a sub-topic:</label>
                      <select class="form-control" required id="ques_cat_master_4" disabled onchange='handle_cat(4, "ques_cat")'>
                         <option selected disabled>---------</option>
                         <option value="new">Create new sub-topic</option>
                         <option disabled>-- Already created --</option>
                      </select>
                   </div>
                </div>
             </div>
             <hr>
             <div id="parsedPDFQuestions" class="col-sm-12" style="padding-left: 0; padding-right: 0">
             </div>
          </div>
          <div class="modal-footer" >
             <button type="button" id="go-back-to-text" onclick="goBacktoText()" class="float-left btn btn-sm"  >Go Back</button>
             <button type="button" class="btn btn-sm" data-dismiss="modal" style="background-color: #fff;border-color: #006df0;">Cancel</button>
             <select class="form-control col-sm-3" id="import_section">
                <option selected value="" required>Select Section</option>
             </select>
             <button type="button" onclick="importQuestionsPDF3()" id="pdf-import-3" class="btn btn-success btn-sm" style="background-color: #2182CF; border-color: #2182CF;">Import</button>
          </div>
       </div>
    </div>
 </div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/admin/quill/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/quill/pdf.worker.js"></script>
<style>
    .error {
        color: red;
    }
</style>
<script>
    
    
function editSectionName(section_id, section_name) {
   
    var section_name=$('#section_name_span_'+section_id).text();
    
    //var section_name = $("#section_name_"+section_id).val();
    $("#update_section_name").val(section_name);
    $("#update_section_id").val(section_id);
    $('#EditSectionModal').modal('show');
}

function updateSectionNamePost() {
    var update_section_id = $("#update_section_id").val();
    var update_section_name = $("#update_section_name").val();
   
    $('#EditSectionModal').modal('hide');
    $("#update_section_name").val('');
    $("#update_section_id").val('');
    
    $("#section_name_span_"+update_section_id).html(update_section_name);
    
     $.ajax({
        url: "<?php echo base_url() . "admin/Test/update_section"; ?>",
        method: "POST",
        data: {
            section_name: update_section_name,
            section_id: update_section_id,
//            sectionCount: sectionCount
        },
        success: function(data) {
            $('#SectionMainDiv').append(data);
            $('#addSection').modal('hide');
            $("#section_name").val('');
            var sectionCountNew = parseInt(sectionCount) + 1;
            $("#sectionCount").val(sectionCountNew);
        }
    });
         
}
function AddSectionAction() {
    var section_name = $("#section_name").val();
    var sectionCount = $("#sectionCount").val();
    var section_id = '';
    $.ajax({
        url: "<?php echo base_url() . "admin/Test/edit_add_section"; ?>",
        method: "POST",
        data: {
            section_name: section_name,
            section_id: section_id,
            sectionCount: sectionCount
        },
        success: function(data) {
            $('#SectionMainDiv').append(data);
            $('#addSection').modal('hide');
            $("#section_name").val('');
            var sectionCountNew = parseInt(sectionCount) + 1;
            $("#sectionCount").val(sectionCountNew);
        }
    });
}

function newQuestionBtn() {
    var mode = "Add";
    var question_id = '';
//    var section_name = $("input[name='section_name[]']").map(function(){return $(this).val();}).get();
    var section_name = $(".section_name").map(function() {  return $(this).val(); }).get().join(', ');    
    var section_id = $(".section_id").map(function() {  return $(this).val(); }).get().join(', ');    
//    var section_id = $("input[name='section_id[]']").map(function(){return $(this).val();}).get();

    var box_question = '';
    var box_ans_type = '';
    var box_select_language = '';
    var box_new_a_marking_correct = '';
    var new_a_marking_incorrect = '';
    var new_a_answer_description = '';
    var box_question_type = '';
    var box_ans_type = '';
    var new_a_choice_count = '4';
    var box_text_radio_ans_a = '';
    var box_text_radio_ans_b = '';
    var box_text_radio_ans_c = '';
    var box_text_radio_ans_d = '';
    var box_text_radio_ans_e = '';
    var box_text_radio_ans_f = '';
    var box_chk_multi_answer_a = '';
    var box_chk_multi_answer_b = '';
    var box_chk_multi_answer_c = '';
    var box_chk_multi_answer_d = '';
    var box_chk_multi_answer_e = '';
    var box_chk_multi_answer_f = '';
    var box_new_a_fill = '';
    var box_radio_correct_ans = '';
    var box_correct_ans_chk = '';
    var box_correct_ans_fill = '';

    $.ajax({
        url: "<?php echo base_url() . "admin/Test/edit_add_question"; ?>",
        method: "POST",
        data: {
            mode: mode, 
            question_id: question_id, 
            section_name: section_name, 
            section_id: section_id, 
            box_question: box_question,  
            box_ans_type: box_ans_type,  
            box_select_language: box_select_language,  
            box_new_a_marking_correct: box_new_a_marking_correct,  
            new_a_marking_incorrect: new_a_marking_incorrect,  
            new_a_answer_description: new_a_answer_description, 
            box_question_type: box_question_type, 
            box_ans_type: box_ans_type, 
            new_a_choice_count: new_a_choice_count, 
            box_text_radio_ans_a : box_text_radio_ans_a,
            box_text_radio_ans_b : box_text_radio_ans_b,
            box_text_radio_ans_c : box_text_radio_ans_c,
            box_text_radio_ans_d : box_text_radio_ans_d,
            box_text_radio_ans_e : box_text_radio_ans_e,
            box_text_radio_ans_f : box_text_radio_ans_f,
            box_chk_multi_answer_a : box_chk_multi_answer_a,
            box_chk_multi_answer_b : box_chk_multi_answer_b,
            box_chk_multi_answer_c : box_chk_multi_answer_c,
            box_chk_multi_answer_d : box_chk_multi_answer_d,
            box_chk_multi_answer_e : box_chk_multi_answer_e,
            box_chk_multi_answer_f : box_chk_multi_answer_f,
            box_new_a_fill : box_new_a_fill,
            box_radio_correct_ans : box_radio_correct_ans,
            box_correct_ans_chk : box_correct_ans_chk,
            box_correct_ans_fill : box_correct_ans_fill,
        },
        success: function(data) {
            $('#AddQuestionDiv').html(data);
            $('#AddQuestionModel').modal('show');
        }
    });
}

function editSectionBtn(section_id) {
    var section_name = $("#section_name_"+section_id).val();
    $("#edit_section_name").val(section_name);
    $("#edit_section_id").val(section_id);
//    $("#section_title_"+section_id).text(section_name);
//    $("#section_title_"+section_id).val(section_name);
    $('#Editsection').modal('show');
}

function EditSectionAction() {
    var section_id = $("#edit_section_id").val();
    var section_name = $("#edit_section_name").val();
    $("#section_title_"+section_id).text(section_name);
    $("#section_name_"+section_id).val(section_name);
    $('#Editsection').modal('hide');
    $("#edit_section_name").val('');
    $("#edit_section_id").val('');
         
}
function deleteSectionBtn(section_id) {
    $("#section_"+section_id).remove();
}



function AddSectionQuestion() {
    var section_id = $('#popup_section_id option:selected').val();
    var section_question_count = $("#section_question_count_"+section_id).val();
    var section_question_countTemp = parseInt(section_question_count) + 1;
    $("#section_question_count_"+section_id).val(section_question_countTemp);
    
    
    var question = $("#question").val();
    var popup_mode = $("#popup_mode").val();
   
    var ans_type = $("#new_ans_type").val();
    var new_a_marking_correct = $("#new_a_marking_correct").val();
    var select_language = $("#select_language").val();
    var new_a_marking_correct = $("#new_a_marking_correct").val();
    var new_a_marking_incorrect = $("#new_a_marking_incorrect").val();
    var answer_description = $("#answer_description").val();
    var question_type = $("#question_type").val();
    var new_a_choice_count = $("#new_a_choice_count").val();
     
    var text_radio_ans_a = $("#text_radio_ans_a").val();
    var text_radio_ans_b = $("#text_radio_ans_b").val();
    var text_radio_ans_c = $("#text_radio_ans_c").val();
    var text_radio_ans_d = $("#text_radio_ans_d").val();
    var text_radio_ans_e = $("#text_radio_ans_e").val();
    var text_radio_ans_f = $("#text_radio_ans_f").val();
    var chk_multi_answer_a = $("#chk_multi_answer_a").val();
    var chk_multi_answer_b = $("#chk_multi_answer_b").val();
    var chk_multi_answer_c = $("#chk_multi_answer_c").val();
    var chk_multi_answer_d = $("#chk_multi_answer_d").val();
    var chk_multi_answer_e = $("#chk_multi_answer_e").val();
    var chk_multi_answer_f = $("#chk_multi_answer_f").val();
     
     
    if(ans_type == "mcqs"){
        var ansType = "Single choice is correct";
        var correct_ans = $('input[name="radio_answer"]:checked').val();
        var correct_ans_valtemp = $("#text_radio_ans_"+correct_ans).val();
        var correct_ans_val = correct_ans_valtemp.replace("<p>", "").replace("</p>", "");
        var correct_ans_chk = "";
        var correct_ans_fill = "";
    } else if(ans_type == "mcqm"){
        var ansType = "MCQ (More than one is correct)"; 
        var correct_ans_chk = $.map($('input[name="chk_multi_answer"]:checked'), function(c){return c.value; });
        var searchIDs = $('input[name="chk_multi_answer"]:checked').map(function(){ return $(this).val(); }).get();
         
        var correct_ans_fill = "";
        var correct_ans = "";
        var correct_ans_val = "";
    } else {
        var ansType = "Fill in the blank/Numerical answer";
        var correct_ans_fill = $('#new_a_fill').val();
        var correct_ans_valtemp = '';
        var correct_ans = "";
        var correct_ans_chk = "";
        var correct_ans_val = correct_ans_valtemp.replace("<p>", "").replace("</p>", "");
    } 
    var new_a_fill = $('#new_a_fill').val();
    var popup_question_id = $('#popup_question_id').val();
    var html = '';
    html += '<div id="question_id_'+section_id+'_'+section_question_countTemp+'" class="card col-sm-12" style="padding-left: 0; padding-right: 0; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)" id="29622">';
        html += '<input type="hidden" name="" id="box_section_id_'+section_id+'_'+section_question_countTemp+'" value="'+section_id+'">';
        html += '<input type="hidden" name="question_type['+section_id+'][]" id="box_question_type_'+section_id+'_'+section_question_countTemp+'" value="'+question_type+'">';
        html += '<input type="hidden" name="question['+section_id+'][]" id="box_question_'+section_id+'_'+section_question_countTemp+'" value="'+question+'">';
        html += '<input type="hidden" name="ans_type['+section_id+'][]" id="box_ans_type_'+section_id+'_'+section_question_countTemp+'" value="'+ans_type+'">'; 
        html += '<input type="hidden" name="language['+section_id+'][]" id="box_select_language_'+section_id+'_'+section_question_countTemp+'" value="'+select_language+'">';
        html += '<input type="hidden" name="marking_correct['+section_id+'][]" id="box_new_a_marking_correct_'+section_id+'_'+section_question_countTemp+'" value="'+new_a_marking_correct+'">';
        html += '<input type="hidden" name="marking_incorrect['+section_id+'][]" id="new_a_marking_incorrect_'+section_id+'_'+section_question_countTemp+'" value="'+new_a_marking_incorrect+'">';
        html += '<input type="hidden" name="answer_description['+section_id+'][]" id="new_a_answer_description_'+section_id+'_'+section_question_countTemp+'" value="'+answer_description+'">';
        html += '<input type="hidden" name="choice_count['+section_id+'][]" id="new_a_choice_count_'+section_id+'_'+section_question_countTemp+'" value="'+new_a_choice_count+'">';
        html += '<input type="hidden" name="radio_ans_a['+section_id+'][]" id="box_text_radio_ans_a_'+section_id+'_'+section_question_countTemp+'" value="'+text_radio_ans_a+'">';
        html += '<input type="hidden" name="radio_ans_b['+section_id+'][]" id="box_text_radio_ans_b_'+section_id+'_'+section_question_countTemp+'" value="'+text_radio_ans_b+'">';
        html += '<input type="hidden" name="radio_ans_c['+section_id+'][]" id="box_text_radio_ans_c_'+section_id+'_'+section_question_countTemp+'" value="'+text_radio_ans_c+'">';
        html += '<input type="hidden" name="radio_ans_d['+section_id+'][]" id="box_text_radio_ans_d_'+section_id+'_'+section_question_countTemp+'" value="'+text_radio_ans_d+'">';
        html += '<input type="hidden" name="radio_ans_e['+section_id+'][]" id="box_text_radio_ans_e_'+section_id+'_'+section_question_countTemp+'" value="'+text_radio_ans_e+'">';
        html += '<input type="hidden" name="radio_ans_f['+section_id+'][]" id="box_text_radio_ans_f_'+section_id+'_'+section_question_countTemp+'" value="'+text_radio_ans_f+'">';
        html += '<input type="hidden" name="chk_multi_answer_a['+section_id+'][]" id="box_chk_multi_answer_a_'+section_id+'_'+section_question_countTemp+'" value="'+chk_multi_answer_a+'">';
        html += '<input type="hidden" name="chk_multi_answer_b['+section_id+'][]" id="box_chk_multi_answer_b_'+section_id+'_'+section_question_countTemp+'" value="'+chk_multi_answer_b+'">';
        html += '<input type="hidden" name="chk_multi_answer_c['+section_id+'][]" id="box_chk_multi_answer_c_'+section_id+'_'+section_question_countTemp+'" value="'+chk_multi_answer_c+'">';
        html += '<input type="hidden" name="chk_multi_answer_d['+section_id+'][]" id="box_chk_multi_answer_d_'+section_id+'_'+section_question_countTemp+'" value="'+chk_multi_answer_d+'">';
        html += '<input type="hidden" name="chk_multi_answer_e['+section_id+'][]"id="box_chk_multi_answer_e_'+section_id+'_'+section_question_countTemp+'" value="'+chk_multi_answer_e+'">';
        html += '<input type="hidden" name="chk_multi_answer_f['+section_id+'][]" id="box_chk_multi_answer_f_'+section_id+'_'+section_question_countTemp+'" value="'+chk_multi_answer_f+'">';
        html += '<input type="hidden" name="new_a_fill['+section_id+'][]" id="box_new_a_fill_'+section_id+'_'+section_question_countTemp+'" value="'+new_a_fill+'">';
        html += '<input type="hidden" name="radio_correct_ans['+section_id+'][]" id="box_radio_correct_ans_'+section_id+'_'+section_question_countTemp+'" value="'+correct_ans+'">';
        html += '<input type="hidden" name="correct_ans_chk['+section_id+'][]" id="box_correct_ans_chk_'+section_id+'_'+section_question_countTemp+'" value="'+correct_ans_chk+'">';
        html += '<input type="hidden" name="correct_ans_fill['+section_id+'][]" id="box_correct_ans_fill_'+section_id+'_'+section_question_countTemp+'" value="'+correct_ans_fill+'">';
        html += '<div class="card-header" style="padding: .5rem .8rem;">';
            html += '<div class="float-left" style="margin-top:8px">';
                html += '<span class="mdi mdi-cursor-move" aria-hidden="true" style="cursor:move; cursor:-webkit-grabbing"> </span>';
                html += '<b>Question</b>';
            html += '</div>';
            html += '<button class="btn btn-warning waves-effect waves-light float-right btn-sm" type="button" onclick="editQuestionBtn('+section_id+','+section_question_countTemp+')"><i class="fas fa-edit"></i> </button>';
            html += '<button class="btn btn-danger waves-effect waves-light float-right btn-sm" style="margin-right: 5px;" type="button" onclick="deleteQuestionBtn('+section_id+','+section_question_countTemp+')"><i class="fa fa-trash"></i> </button>';
        html += '</div>';
        html += '<div class="card-body img-small">';
            html += '<span id="question_html_'+section_id+'_'+section_question_countTemp+'"><p> '+question+'</p></span>';
            html += '<p id="html_ans_type_'+section_id+'_'+section_question_countTemp+'">Answer Type: '+ansType+'</p>'; 
            if(ans_type == "mcqs"){
                html += '<p id="correct_ans_html_'+section_id+'_'+section_question_countTemp+'">Correct Answer: '+correct_ans+' ('+correct_ans_val+')</p>';
            } else if(ans_type == "mcqm"){ 
                html +='<div id="correct_ans_html_'+section_id+'_'+section_question_countTemp+'">';
                for(var i=0; i<searchIDs.length; i++){
                       var correct_ans_chk_val = $("#chk_multi_answer_"+correct_ans_chk[i]).val();
                    html += '<p >Correct Answer: '+correct_ans_chk[i]+' ('+correct_ans_chk_val+')</p>';
                }
                html +='</div>';
            } else {
                html += '<p id="correct_ans_html_'+section_id+'_'+section_question_countTemp+'">Correct Answer: '+correct_ans_fill+'</p>';
            }
            html += '<p id="correct_mark_html_'+section_id+'_'+section_question_countTemp+'">Correct Marking: '+new_a_marking_correct+'; Incorrect Marking: '+new_a_marking_incorrect+'</p>';
        html += '</div>';
    html += '</div>';
    $("#section_"+section_id+"_questions").append(html);
   
    $('#AddQuestionModel').modal('show');
    
    $(".card-block").text('');
    $('#radio_ans_a').prop('checked', false); // Unchecks it
    $('#radio_ans_b').prop('checked', false); // Unchecks it
    $('#radio_ans_c').prop('checked', false); // Unchecks it
    $('#radio_ans_d').prop('checked', false); // Unchecks it
    $('#radio_ans_e').prop('checked', false); // Unchecks it
    $('#radio_ans_f').prop('checked', false); // Unchecks it
    $('#multi_answer_a').prop('checked', false); // Unchecks it
    $('#multi_answer_b').prop('checked', false); // Unchecks it
    $('#multi_answer_c').prop('checked', false); // Unchecks it
    $('#multi_answer_d').prop('checked', false); // Unchecks it
    $('#multi_answer_e').prop('checked', false); // Unchecks it
    $('#multi_answer_f').prop('checked', false); // Unchecks it
    
} 


function EditSectionQuestion() {
    var section_id = $('#popup_section_id option:selected').val();
     var popup_question_id = $('#edit_popup_question_id').val();
//    var section_question_count = $("#section_question_count_"+section_id).val();
    var section_question_countTemp = popup_question_id;
//    $("#section_question_count_"+section_id).val(section_question_countTemp);
    
    
    var question = $("#question").val();
    var popup_mode = $("#popup_mode").val();
   
    var ans_type = $("#new_ans_type").val();
    var new_a_marking_correct = $("#new_a_marking_correct").val();
    var select_language = $("#select_language").val();
    var new_a_marking_correct = $("#new_a_marking_correct").val();
    var new_a_marking_incorrect = $("#new_a_marking_incorrect").val();
    var answer_description = $("#answer_description").val();
    var question_type = $("#question_type").val();
    var new_a_choice_count = $("#new_a_choice_count").val();
     
    var text_radio_ans_a = $("#text_radio_ans_a").val();
    var text_radio_ans_b = $("#text_radio_ans_b").val();
    var text_radio_ans_c = $("#text_radio_ans_c").val();
    var text_radio_ans_d = $("#text_radio_ans_d").val();
    var text_radio_ans_e = $("#text_radio_ans_e").val();
    var text_radio_ans_f = $("#text_radio_ans_f").val();
    var chk_multi_answer_a = $("#chk_multi_answer_a").val();
    var chk_multi_answer_b = $("#chk_multi_answer_b").val();
    var chk_multi_answer_c = $("#chk_multi_answer_c").val();
    var chk_multi_answer_d = $("#chk_multi_answer_d").val();
    var chk_multi_answer_e = $("#chk_multi_answer_e").val();
    var chk_multi_answer_f = $("#chk_multi_answer_f").val();
     
     
    if(ans_type == "mcqs"){
        var ansType = "Single choice is correct";
        var correct_ans = $('input[name="radio_answer"]:checked').val();
        var correct_ans_valtemp = $("#text_radio_ans_"+correct_ans).val();
        var correct_ans_val = correct_ans_valtemp.replace("<p>", "").replace("</p>", "").replace("<br>", "");
        var correct_ans_chk = "";
        var correct_ans_fill = "";
    } else if(ans_type == "mcqm"){
        var ansType = "MCQ (More than one is correct)"; 
        var correct_ans_chk = $.map($('input[name="chk_multi_answer"]:checked'), function(c){return c.value; });
        var searchIDs = $('input[name="chk_multi_answer"]:checked').map(function(){ return $(this).val(); }).get();
         
        var correct_ans_fill = "";
        var correct_ans = "";
        var correct_ans_val = "";
    } else {
        var ansType = "Fill in the blank/Numerical answer";
        var correct_ans_fill = $('#new_a_fill').val();
        var correct_ans_valtemp = '';
        var correct_ans = "";
        var correct_ans_chk = "";
        var correct_ans_val = correct_ans_valtemp.replace("<p>", "").replace("</p>", "").replace("<br>", "");
    } 
    var new_a_fill = $('#new_a_fill').val();
   
   
   $('#box_section_id_'+section_id+'_'+section_question_countTemp).val(section_id);
   $('#box_question_type_'+section_id+'_'+section_question_countTemp).val(question_type);
   $('#box_question_'+section_id+'_'+section_question_countTemp).val(question);
   $('#box_ans_type_'+section_id+'_'+section_question_countTemp).val(ans_type);
   $('#box_select_language_'+section_id+'_'+section_question_countTemp).val(select_language);
   $('#box_new_a_marking_correct_'+section_id+'_'+section_question_countTemp).val(new_a_marking_correct);
   $('#new_a_marking_incorrect_'+section_id+'_'+section_question_countTemp).val(new_a_marking_incorrect);
   $('#new_a_answer_description_'+section_id+'_'+section_question_countTemp).val(answer_description);
   $('#new_a_choice_count_'+section_id+'_'+section_question_countTemp).val(new_a_choice_count);
   $('#box_text_radio_ans_a_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_a);
   $('#box_text_radio_ans_b_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_b);
   $('#box_text_radio_ans_c_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_c);
   $('#box_text_radio_ans_c_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_c);
   $('#box_text_radio_ans_d_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_d);
   $('#box_text_radio_ans_d_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_d);
   $('#box_text_radio_ans_e_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_e);
   $('#box_text_radio_ans_f_'+section_id+'_'+section_question_countTemp).val(text_radio_ans_f);
   $('#box_chk_multi_answer_a_'+section_id+'_'+section_question_countTemp).val(chk_multi_answer_a);
   $('#box_chk_multi_answer_b_'+section_id+'_'+section_question_countTemp).val(chk_multi_answer_b);
   $('#box_chk_multi_answer_c_'+section_id+'_'+section_question_countTemp).val(chk_multi_answer_c);
   $('#box_chk_multi_answer_d_'+section_id+'_'+section_question_countTemp).val(chk_multi_answer_d);
   $('#box_chk_multi_answer_e_'+section_id+'_'+section_question_countTemp).val(chk_multi_answer_e);
   $('#box_chk_multi_answer_f_'+section_id+'_'+section_question_countTemp).val(chk_multi_answer_f);
   $('#box_new_a_fill_'+section_id+'_'+section_question_countTemp).val(new_a_fill);
   $('#box_radio_correct_ans_'+section_id+'_'+section_question_countTemp).val(correct_ans);
   $('#box_correct_ans_chk_'+section_id+'_'+section_question_countTemp).val(correct_ans_chk);
   $('#box_correct_ans_fill_'+section_id+'_'+section_question_countTemp).val(correct_ans_fill);
   
   $('#question_html_'+section_id+'_'+section_question_countTemp).text(question);
   $('#html_ans_type_'+section_id+'_'+section_question_countTemp).text('Answer Type: '+ansType);
   
     if(ans_type == "mcqs"){
         $('#correct_ans_html_'+section_id+'_'+section_question_countTemp).text('Correct Answer: '+correct_ans+' ('+correct_ans_val+')');
    } else if(ans_type == "mcqm"){ 
      
        var html ='';
        for(var i=0; i<searchIDs.length; i++){
               var correct_ans_chk_val = $("#chk_multi_answer_"+correct_ans_chk[i]).val();
            html += '<span>Correct Answer: '+correct_ans_chk[i]+' ('+correct_ans_chk_val+')</span>';
        }
        $('#correct_ans_html_'+section_id+'_'+section_question_countTemp).html(html);
//            html += '<p id="correct_ans_html_'+section_id+'_'+section_question_countTemp+'">Correct Answer 1: '+correct_ans_chk[i]+' (123)</p>';
        
    } else {
        $('#correct_ans_html_'+section_id+'_'+section_question_countTemp).text('Correct Answer: '+correct_ans_fill);
    }
    $('#correct_mark_html_'+section_id+'_'+section_question_countTemp).text('Correct Marking: '+new_a_marking_correct+'; Incorrect Marking: '+new_a_marking_incorrect);
//    html += '<p id="correct_mark_html_'+section_id+'_'+section_question_countTemp+'">Correct Marking: '+new_a_marking_correct+'; Incorrect Marking: '+new_a_marking_incorrect+'</p>';

   
//        html += '<div class="card-header" style="padding: .5rem .8rem;">';
//            html += '<div class="float-left" style="margin-top:8px">';
//                html += '<span class="mdi mdi-cursor-move" aria-hidden="true" style="cursor:move; cursor:-webkit-grabbing"> </span>';
//                html += '<b>Question</b>';
//            html += '</div>';
//            html += '<button class="btn btn-warning waves-effect waves-light float-right btn-sm" type="button" onclick="editQuestionBtn('+section_id+','+section_question_countTemp+')"><i class="fas fa-edit"></i> </button>';
//            html += '<button class="btn btn-danger waves-effect waves-light float-right btn-sm" style="margin-right: 5px;" type="button" onclick="deleteQuestionBtn('+section_id+','+section_question_countTemp+')"><i class="fa fa-trash"></i> </button>';
//        html += '</div>';
//        html += '<div class="card-body img-small">';
//            html += '<span id="29622_html"><p> '+question+'</p></span>';
//            html += '<p id="29622_type">Answer Type: '+ansType+'</p>'; 
//            if(ans_type == "mcqs"){
//                html += '<p id="29622_ans">Correct Answer: '+correct_ans+' ('+correct_ans_val+')</p>';
//            } else if(ans_type == "mcqm"){ 
//                for(var i=0; i<searchIDs.length; i++){
//                    html += '<p id="29622_ans">Correct Answer 1: '+correct_ans_chk[i]+' (123)</p>';
//                }
//            } else {
//                html += '<p id="29622_ans">Correct Answer: '+correct_ans_fill+'</p>';
//            }
//            html += '<p id="29622_mark">Correct Marking: '+new_a_marking_correct+'; Incorrect Marking: '+new_a_marking_incorrect+'</p>';
//        html += '</div>';
//    html += '</div>';
  
    $('#EditQuestionModel').modal('hide');
}
function deleteQuestionBtn(section_id, section_question_countTemp) {
    $("#question_id_"+section_id+"_"+section_question_countTemp).remove();
}



function editQuestionBtn(section_id, section_question_countTemp) {
     
    var mode = "Edit"; 
    var section_name = $(".section_name").map(function() {  return $(this).val(); }).get().join(', ');
    var box_question = $("#box_question_"+section_id+"_"+section_question_countTemp).val();
    var box_ans_type = $("#box_ans_type_"+section_id+"_"+section_question_countTemp).val();
    var box_select_language = $("#box_select_language_"+section_id+"_"+section_question_countTemp).val();
    var box_new_a_marking_correct = $("#box_new_a_marking_correct_"+section_id+"_"+section_question_countTemp).val();
    var new_a_marking_incorrect = $("#new_a_marking_incorrect_"+section_id+"_"+section_question_countTemp).val();
    var new_a_answer_description = $("#new_a_answer_description_"+section_id+"_"+section_question_countTemp).val();
    var box_question_type = $("#box_question_type_"+section_id+"_"+section_question_countTemp).val();
    var box_ans_type = $("#box_ans_type_"+section_id+"_"+section_question_countTemp).val();
    var new_a_choice_count = $("#new_a_choice_count_"+section_id+"_"+section_question_countTemp).val();
    var box_text_radio_ans_a = $("#box_text_radio_ans_a_"+section_id+"_"+section_question_countTemp).val();
    var box_text_radio_ans_b = $("#box_text_radio_ans_b_"+section_id+"_"+section_question_countTemp).val();
    var box_text_radio_ans_c = $("#box_text_radio_ans_c_"+section_id+"_"+section_question_countTemp).val();
    var box_text_radio_ans_d = $("#box_text_radio_ans_d_"+section_id+"_"+section_question_countTemp).val();
    var box_text_radio_ans_e = $("#box_text_radio_ans_e_"+section_id+"_"+section_question_countTemp).val();
    var box_text_radio_ans_f = $("#box_text_radio_ans_f_"+section_id+"_"+section_question_countTemp).val();
    var box_chk_multi_answer_a = $("#box_chk_multi_answer_a_"+section_id+"_"+section_question_countTemp).val();
    var box_chk_multi_answer_b = $("#box_chk_multi_answer_b_"+section_id+"_"+section_question_countTemp).val();
    var box_chk_multi_answer_c = $("#box_chk_multi_answer_c_"+section_id+"_"+section_question_countTemp).val();
    var box_chk_multi_answer_d = $("#box_chk_multi_answer_d_"+section_id+"_"+section_question_countTemp).val();
    var box_chk_multi_answer_e = $("#box_chk_multi_answer_e_"+section_id+"_"+section_question_countTemp).val();
    var box_chk_multi_answer_f = $("#box_chk_multi_answer_f_"+section_id+"_"+section_question_countTemp).val();
    var box_new_a_fill = $("#box_new_a_fill_"+section_id+"_"+section_question_countTemp).val();
    var box_correct_ans = $("#box_correct_ans_"+section_id+"_"+section_question_countTemp).val();
    var box_radio_correct_ans = $("#box_radio_correct_ans_"+section_id+"_"+section_question_countTemp).val();
    var box_correct_ans_chk = $("#box_correct_ans_chk_"+section_id+"_"+section_question_countTemp).val();
    var box_correct_ans_fill = $("#box_correct_ans_fill_"+section_id+"_"+section_question_countTemp).val();
     
     
    $.ajax({
        url: "<?php echo base_url() . "admin/Test/edit_add_question"; ?>",
        method: "POST",
        data: {
            mode: mode, 
            section_name: section_name, 
            section_id: section_id, 
            question_id: section_question_countTemp,  
            box_question: box_question,  
            box_ans_type: box_ans_type,  
            box_select_language: box_select_language,  
            box_new_a_marking_correct: box_new_a_marking_correct,  
            new_a_marking_incorrect: new_a_marking_incorrect,  
            new_a_answer_description: new_a_answer_description,  
            box_question_type: box_question_type,  
            box_ans_type: box_ans_type,  
            new_a_choice_count: new_a_choice_count, 
            box_text_radio_ans_a : box_text_radio_ans_a,
            box_text_radio_ans_b : box_text_radio_ans_b,
            box_text_radio_ans_c : box_text_radio_ans_c,
            box_text_radio_ans_d : box_text_radio_ans_d,
            box_text_radio_ans_e : box_text_radio_ans_e,
            box_text_radio_ans_f : box_text_radio_ans_f,
            box_chk_multi_answer_a : box_chk_multi_answer_a,
            box_chk_multi_answer_b : box_chk_multi_answer_b,
            box_chk_multi_answer_c : box_chk_multi_answer_c,
            box_chk_multi_answer_d : box_chk_multi_answer_d,
            box_chk_multi_answer_e : box_chk_multi_answer_e,
            box_chk_multi_answer_f : box_chk_multi_answer_f,
            box_new_a_fill : box_new_a_fill,
            box_radio_correct_ans : box_radio_correct_ans,
            box_correct_ans_chk : box_correct_ans_chk,
            box_correct_ans_fill : box_correct_ans_fill,
             
        },
        success: function(data) {
            $('#AddQuestionDiv').html(data);
            $('#EditQuestionModel').modal('show');
        }
    });
    
}


</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Category_Form").validate({
                // Specify the validation rules
                rules: {
                    test_title: "required",
                    test_time: "required",
                    
                },

                // Specify the validation error messages
                messages: {
                    test_title: "Please enter test title",
                    test_time: "Please enter test time",
                     
                }

            });

        });
    });

function AddMoreCashPrice(){
    alert(123); 
    var cash_price_count = $("#cash_price_count").val();
    var cash_price_countNew = parseInt(cash_price_count) + 1;
    $("#cash_price_count").val(cash_price_countNew);
    var html = '';
        html += '<div class="row" id="CashPrice'+cash_price_countNew+'" style="margin-top: 8px;">';
            html += '<div class="col-md-5">';
                html += '<input type="text" class="form-control" id="point_system" name="point_system" placeholder="1 - 10">'; 
            html += '</div>';
            html += '<div class="col-md-5">'; 
                html += '<input type="number" class="form-control" id="point_system" name="point_system" min="0">'; 
            html += '</div>';
            html += '<div class="col-md-2">';
                html += '<span style="margin-left: -15px;" class="btn btn-danger btn-sm" onclick="RemoveMoreCashPrice('+cash_price_countNew+')"><i class="fa fa-minus"></i></span>';
            html += '</div>';
        html += '</div>';
    $("#CashPrizeDiv").append(html);
}
function RemoveMoreCashPrice(cash_price_countNew){
    $("#CashPrice"+cash_price_countNew).remove();
}

/*Start : PDFImporter*/
 function openPDFImporter() {
    $("#importquestionscontbtn").html("Continue");
    $("#importquestionscontbtn").attr("disabled", false);
    $("#previews").empty();
    $("#importQuestionPDF").modal("show");
}
$("#upload-button").on('click', function () {
    $("#file-to-upload").trigger('click');
});


  
/*End : PDFImporter*/
</script>