<?php
if (isset($BOMDetail)) {
    $id = $BOMDetail->id;
    $part_cost = $BOMDetail->part_cost;
    $part_id = $BOMDetail->part_id;
    $customer_id = $BOMDetail->customer_id;
    $material_grade_id = $BOMDetail->material_grade_id;
    $status = $BOMDetail->status;
    $BOMPartDetail = $BOMDetail->BOMPartDetail;
    $BOMOperationDetail = $BOMDetail->BOMOperationDetail;
    $mode          = 'Edit';
} else {
    $id = '';
    $part_cost = '';
    $part_id = '';
    $customer_id = '';
    $material_grade_id = '';
    $status = '';
    $BOMPartDetail = '';
    $BOMOperationDetail = '';
    $mode      = 'Add';
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
                                <div class="col-md-9">
                                    <input type="hidden" id="sectionCount" value="1">
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
                                                <input type="text" class="form-control" id="test_title" name="test_title">
                                                <p id="test_title_err" style="color:brown; display: none;">Please enter the title</p>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Exam Detail:</label>
                                                <textarea class="form-control" id="exam_detail" name="exam_detail"></textarea>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Select Test Type</label>
                                                <select class="form-control" required="" id="test_type" name="test_type">
                                                    <option value="Mock Test" selected="true">Mock Test</option>
                                                    <option value="Quiz">Quiz</option>
                                                    <option value="Last Year">Last Year</option>
                                                   <!-- <option value="3">Live Test</option> -->
                                                </select>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Total time in minutes:</label>
                                                <input type="number" class="form-control" id="test_time" name="test_time" min="0">
                                                <p id="test_title_err" style="color:brown; display: none;">Please enter the time</p>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Prize Pool Amount:</label>
                                                <input type="number" class="form-control" id="prize_pool_amount" name="prize_pool_amount" min="0"> 
                                            </div>
                                            
                                            <div style="margin-bottom: 10px">
                                                <label>Join Amount:</label>
                                                <input type="number" class="form-control" id="join_amount" name="join_amount" min="0"> 
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Number of Slot:</label>
                                                <input type="number" class="form-control" id="number_of_slot" name="number_of_slot" min="0"> 
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <label>Point System:</label>
                                                <input type="text" class="form-control" id="point_system" name="point_system"> 
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
//function EditSectionQuestion(question_id) {
//    
////    var section_name = $("input[name='section_name[]']").map(function(){return $(this).val();}).get();
//    var section_name = $(".section_name").map(function() {  return $(this).val(); }).get().join(', ');    
//    var section_id = $(".section_id").map(function() {  return $(this).val(); }).get().join(', ');    
////    var section_id = $("input[name='section_id[]']").map(function(){return $(this).val();}).get();
//    $.ajax({
//        url: "<?php echo base_url() . "admin/Test/edit_add_question"; ?>",
//        method: "POST",
//        data: {
//            question_id: question_id, 
//            section_name: section_name, 
//            section_id: section_id, 
//        },
//        success: function(data) {
//            $('#AddQuestionDiv').html(data);
//            $('#AddQuestionModel').modal('show');
//        }
//    });
//    
//}

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
//    alert(123); 
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






//	 var q_editor, desc_editor, all_test_tags, all_ques_tags;
//    window.onload = function () {
//		
//		new Sortable(document.getElementById("section_1_questions"), {
//            animation: 150,
//            handle: '.mdi-cursor-move',
//            group: 'shared',
//            onEnd: function (/**Event*/evt) {
//                changeQuestionOrder(evt);
//            },
//            ghostClass: 'selected-card'
//        });
//        
//         Quill.register("modules/imageUploader", ImageUploader);
//		 
//		 q_editor = $('#new_q_editor', { theme: "snow", modules: { toolbar: custom_toolbar, imageUploader: server_upload } });
//        desc_editor = $('#desc_q_editor', { theme: "snow", modules: { toolbar: custom_toolbar, imageUploader: server_upload } });
//    }

//	function initEdit() {
//        let tdata = JSON.parse($("#quesData").html().trim());
//        $("#t_tags").val(tdata.tags).trigger('change');
//        let large = 1;
//        tdata.questions.map(o=>{
//            addDragtoQuestion(o.q_id._id, o.q_id.q_type);
//            if(o.sub_questions && o.sub_questions.length>0) {
//                o.sub_questions.map(p=>{
//                    questionsData.push(p);
//                    p=p._id;
//                });
//            }
//            questionsData.push(o.q_id);
//            o.q_id=o.q_id._id;
//            return;
//        });
//        tdata.un_q_ids.map(o=> {
//            questionsData.push(o);
//            o=o._id;
//            return;
//        });
//        tdata.sections.map(o=> {
//            if(o.id>large) large=o.id;
//            addDragtoSection(o.id);
//            return;
//        })
//        syncData=tdata;
//        nextSectionId = large+1;
//    }

//    var all_t_tags = [];
//
//    var syncData = {
//        questions: [],
//        sections: [{
//            id: 1,
//            name: "Section 1"
//        }],
//        un_q_ids: [],
//        publish_settings: {
//        }
//    };

//    var questionsData = [];
//
//    var nextSectionId = 2;

//    function addDragtoQuestion(id, t) {
//        if(t=="p") {
//            console.log(`sub_q_${id}`);
//            new Sortable(document.getElementById(`sub_q_${id}`), {
//                animation: 150,
//                handle: '.mdi-cursor-move',
//                group: {
//                    name: 'p_q',
//                    put: ['sub_q', 'p_q'],
//                    pull: 'p_q'
//                },
//                onEnd: function (/**Event*/evt) {
//                    changeQuestionOrder(evt);
//                },
//                ghostClass: 'selected-card'
//            });
//        }
//    }

//    function addDragtoSection(id) {
//        console.log(`section_${id}_questions`);
//        new Sortable(document.getElementById(`section_${id}_questions`), {
//            animation: 150,
//            handle: '.mdi-cursor-move',
//            group: 'shared',
//            onEnd: function (/**Event*/evt) {
//                changeQuestionOrder(evt);
//            },
//            ghostClass: 'selected-card'
//        });
//    }

//    async function createNewCatReq(term, type, id, from) {
//        let parent_id;
//        if(id==2 || id==3 || id==4) {
//            parent_id = $(`#${from}_${id-1}`).val();
//        }
//        return new Promise((resolve, reject) => {
//            let xhr = new XMLHttpRequest();
//            xhr.open("POST", "https://dashboard.funedulearn.com/tests/new_tag");
//            xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//            xhr.setRequestHeader("Content-Type", "application/json");
//            xhr.onload = () => {
//                if (xhr.status >= 200 && xhr.status < 300) {
//                    response = JSON.parse(xhr.response);
//                    resolve(response.new_tag);
//                } else {
//                    console.error("Can not contact server")
//                    resolve(false);
//                }
//            };
//            xhr.onerror = () => reject(xhr.statusText);
//            xhr.send(JSON.stringify({
//                name:term, 
//                type:type, 
//                level:id,
//                ... parent_id && {parent_id}
//            }));
//        });
//    }

//    async function createNewCat(id, from) {
//        $('#new_cat_input_err').hide();
//        if($('#new_cat_input').val()=="") {
//            $('#new_cat_input_err').html('Please enter a name.');
//            $('#new_cat_input_err').show();
//        } else { 
//            let new_tag = await createNewCatReq($('#new_cat_input').val(), from=="test_cat"?1:0, id , from);
//            if(new_tag) {
//                if(from=="test_cat") all_test_tags.push(new_tag);
//                else all_ques_tags.push(new_tag);
//                $(`#${from}_${id}`).append(`<option value="${new_tag._id}">${new_tag.name}</option>`);
//                $(`#${from}_${id}`).val(new_tag._id);
//                if(id==1) {
//                    $(`#${from}_2`).attr('disabled', false);
//                    $(`#${from}_3`).attr('disabled', true);
//                    $(`#${from}_4`).attr('disabled', true);
//                    update_cats([2,3,4], from);
//                } else if(id==2) {
//                    $(`#${from}_3`).attr('disabled', false);
//                    $(`#${from}_4`).attr('disabled', true);
//                    update_cats([3,4], from);
//                } else if(id==3) {
//                    $(`#${from}_4`).attr('disabled', false);
//                    update_cats([4], from);
//                }
//                $("#addNewCatModal").modal('hide');
//            } else {
//                $('#new_cat_input_err').html('Can not reach the server. Please check your internet connection and try again in a bit');
//                $('#new_cat_input_err').show();
//            }
//        }
//    }

//    async function handle_cat(id, from) {
//        if($(`#${from}_${id}`).val()=="new") {
//            let to_insert = ['0','subject','unit/chapter', 'topic', 'sub-topic'];
//            $("#addNewCatModalTitle").html(`Add new ${to_insert[id]}`);
//            $("#addNewCatBtn").attr('onclick', `createNewCat(${id}, '${from}')`);
//            $("#addNewCatModal").modal('show');
//        } else {
//            if(id==1) {
//                $(`#${from}_2`).attr('disabled', false);
//                $(`#${from}_3`).attr('disabled', true);
//                $(`#${from}_4`).attr('disabled', true);
//                update_cats([2,3,4], from);
//            } else if(id==2) {
//                $(`#${from}_3`).attr('disabled', false);
//                $(`#${from}_4`).attr('disabled', true);
//                update_cats([3,4], from);
//            } else if(id==3) {
//                $(`#${from}_4`).attr('disabled', false);
//                update_cats([4], from);
//            }
//        }
//    }

//    async function update_cats(ids, from) {
//        let to_insert = ['0','subject','unit/chapter', 'topic', 'sub-topic'];
//       
//        for(let i=0;i<ids.length;i++) {
//            let parent_id = $(`#${from}_${ids[i]-1}`).val();
//            let children = (from=="test_cat")?all_test_tags.filter(o=>o.parent_id==parent_id):all_ques_tags.filter(o=>o.parent_id==parent_id);
//            let options =`<option selected disabled>--------</option>
//                        <option value="new">Create new ${to_insert[ids[i]]}</option>
//                        <option disabled>-- Already created --</option>`;
//            for(let j=0;j<children.length;j++) {
//                options += `<option value="${children[j]._id}">${children[j].name}</option>`
//            }
//            $(`#${from}_${ids[i]}`).html(options);
//        }
//    }

//    async function createNewLabelReq(term, type) {
//        return new Promise((resolve, reject) => {
//            let xhr = new XMLHttpRequest();
//            xhr.open("POST", "https://dashboard.funedulearn.com/tests/new_tag");
//            xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//            xhr.setRequestHeader("Content-Type", "application/json");
//            xhr.onload = () => {
//                if (xhr.status >= 200 && xhr.status < 300) {
//                    response = JSON.parse(xhr.response);
//                    resolve(response.new_tag);
//                } else {
//                    console.log(xhr.response);
//                    reject(false);
//                }
//            };
//            xhr.onerror = () => reject(xhr.statusText);
//            xhr.send(JSON.stringify({name:term, type:type}));
//        });
//    }

   

//    async function createNewQuestion() {
//        if (validateQuestion()) {
//            let question = await syncNewQuestionPre();
//            syncQuestionLocal(question);
//            insertNewQuestionHTML(question);
//            $("#addQuestion").modal("hide");
//            clearNewQuestion();
//            syncTestPre();
//        }
//    }

//    function validateQuestion() {
//        $("#new_q_editor_err").hide();
//        $("#mcqm_err").hide();
//        $("#new_a_fill_err").hide();
//        res = true;
//        if ($("#new_q_type").val() == "") {
//            $("#new_q_editor_err").show();
//            res = false;
//        }
//        if ($("#new_q_editor .ql-editor").html() == "") {
//            res = false;
//        }
//        if ($("#new_a_type").val() == "mcqm" && $("#div_mcqm .active").length < 1) {
//            $("#mcqm_err").show();
//            res = false;
//        }
//        if ($("#new_a_type").val() == "fib" && $("#new_a_fill").val() == "") {
//            $("#new_a_fill_err").show();
//            res = false;
//        }
//        return res;
//		console.log("returned res = "+res);
//    }

//    async function syncNewQuestionPre(id) {
//        let ans;
//
//        if ($("#new_a_type").val() == "mcqm") {
//            ans = $("#div_mcqm .active").map(function (index) { return this.innerText.trim() }).get().join(",");
//        } else if ($("#new_a_type").val() == "mcqs") {
//            ans = $("#div_mcqs .active")[0].innerText.trim();
//        } else {
//            ans = $("#new_a_fill").val();
//        }
//
//        let body = {
//            q_type: $("#new_q_type").val(),
//            main_html: $("#new_q_editor .ql-editor").html(),
//            a_type: $("#new_a_type").val(),
//            choices: Number($("#new_a_choice_count").val()),
//            explanation_html: $("#desc_q_editor .ql-editor").html(),
//            answer: ans,
//            correct_marks: Number($("#new_a_marking_correct").val()),
//            incorrect_marks: Number($("#new_a_marking_incorrect").val()),
//			section_id:$( "#import_section_add_question" ).val(),
//            language: $("#new_a_lang").val()
//            
//        };
//
//        if (id) {
//            body._id = id;
//        }
//
//        console.log(body);
//
//        return await syncQuestionReq(body);
//    }

//    async function syncQuestionReq(body) {
//		var test_id = $("#test_id").val();
//        $("#savesuccess").html(`Syncing . . .`);
//        return new Promise((resolve, reject) => {
//            let xhr = new XMLHttpRequest();
//            xhr.open("POST", "edit_or_add_new_question.php");
//            xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//            xhr.setRequestHeader("Content-Type", "application/json");
//            xhr.onload = () => {
//                if (xhr.status >= 200 && xhr.status < 300) {
//                    response = JSON.parse(xhr.response);
//                    $("#savesuccess").html(`Last saved at: ${new Date().toTimeString().substr(0,8)}`);
//					syncData = response.test;
//					insertNewQuestionHTML(response.test);
//                    resolve(response.inserted_or_added_questions);
//                } else {
//                    console.log(xhr.response);
//                    reject(false);
//                }
//            };
//            xhr.onerror = () => reject(xhr.statusText);
//            xhr.send(JSON.stringify({updated_data : body,test:syncData,test_id:test_id}));
//        });
//    }

//    function syncTestPre() {
//        syncData.name = $("#test_title").val();
//        syncData.type = Number($("#test_type").val());
//        syncData.timing_type = 1;
//        syncData.total_time = Number($("#test_time").val());
//        /* syncData.tags = $('#t_tags').select2('data').map(o=>o.id); */
//        syncTestReq(syncData);
//    }

//    function syncTestReq(data) {
//		var test_id = $("#test_id").val();
//        if(data.total_time==0) {
//            data.total_time=10;
//        }
//        $("#savesuccess").html(`Syncing . . .`);
//        let xhr = new XMLHttpRequest();
//        xhr.open("POST", "add_or_edit_test.php");
//        xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//        xhr.setRequestHeader("Content-Type", "application/json");
//        xhr.onload = () => {
//            if (xhr.status >= 200 && xhr.status < 300) {
//                response = JSON.parse(xhr.response);
//				if(response.test_id != '')
//				{
//					$("#test_id").val(response.test_id);
//				}
//
//				if(response.initially_section1_created_or_not == 'yes')
//				{
//					$("#section_"+response.initially_created_section_id+"_id").val(response.initially_inserted_section_id);
//					
//					if(response.initially_created_section_name != '')
//					{
//						$("#section_"+response.initially_created_section_id+"_title").html(response.initially_created_section_name);
//					}
//					add_to_import_section();
//				}
//                $("#savesuccess").html(`Last saved at: ${new Date().toTimeString().substr(0,8)}`);
//                console.log(response);
//
//            } else {
//                console.log(xhr.response)
//            }
//        };
//        xhr.onerror = () => reject(xhr.statusText);
//        xhr.send(JSON.stringify({data:data,test_id:test_id}));
//    }

//    function syncQuestionLocal(question) {
//        if(question.q_type=="p" || question.q_type=="n") {
//            if (!syncData.questions) { syncData.questions = []; }   
//            syncData.questions.push({ q_id: question._id, s_id: 1 });
//        } else {
//            if(!syncData.un_q_ids) { syncData.un_q_ids=[]; } 
//            syncData.un_q_ids.push(question._id);
//        }
//        questionsData.push(question);
//    }



//    function insertNewQuestionHTML(question) {
//		console.log("question id = "+JSON.stringify(question));
//        let a_type;
//        if (question.a_type == "mcqm") {
//            a_type = "Multiple choices are correct"
//        }
//        if (question.a_type == "mcqs") {
//            a_type = "Single choice is correct"
//        }
//        if (question.a_type == "fib") {
//            a_type = "Fill in the blank"
//        }
//        let subquestions_div = `<div id="sub_q_${question._id}"> 
//        <div style="border: dashed; padding: 10px;" id="p_ph_${question._id}">You can drag and drop your subquestions here.</div> </div>`
//
//        let normal_div = `<p id="${question._id}_type">Answer Type: ${a_type}</p>
//            <p id="${question._id}_ans">Correct Answer: ${question.answer}</p>
//            <p id="${question._id}_mark">Correct Marking: ${question.correct_marks}; Incorrect Marking: ${question.incorrect_marks}</p>`;
//
//        let appendHTML = `
//            <div class="card col-sm-12" style="padding-left: 0; padding-right: 0; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)" id="${question._id}">
//            <div class="card-header" style="padding: .5rem .8rem;">
//            <div class="float-left" style="margin-top:8px">
//            <span class="mdi mdi-cursor-move" aria-hidden="true" style="cursor:move; cursor:-webkit-grabbing"> </span>
//            <b>Question</b> 
//            </div>
//            <button class="btn btn-warning waves-effect waves-light float-right" type="button" onclick="editQuestionBtn('${question._id}')" ><i class="fa fa-pencil"></i> </button>
//            <button class="btn btn-danger waves-effect waves-light float-right" style="margin-right: 5px;" type="button" onclick="deleteQuestionBtn('${question._id}')" ><i class="fa fa-trash"></i> </button>
//            </div>
//            <div class="card-body img-small">
//            <span id="${question._id}_html">${question.main_html}</span>
//            ${question.q_type=="p"? subquestions_div: normal_div}
//            </div>
//            </div>
//        `;
//        if(question.q_type=="p" || question.q_type=="n") {
//			
//			if(question.section_id != '')
//			{
//				
//				for(var k = 1 ; k<=nextSectionId;k++)
//				{
//					if(($("#section_"+k+"_id").val())== question.section_id)
//					{
//						console.log("if");
//						$("#section_"+k+"_questions").append(appendHTML);
//					}
//				}
//			}
//            
//        } else {
//            $("#section_subq_questions").append(appendHTML);
//            $("#section_subq").show();
//        }
//
//        addDragtoQuestion(question._id, question.q_type);
//    }

//    function createNewSection() {
//		
//		syncData.mode_sec = "add_section";
//		syncData.edit_section_name = $("#new_section_name_input").val();
//		syncData.changed_section_id = nextSectionId;
//		
//        if (validateSection()) {
//            syncData.sections.push({ name: $("#new_section_name_input").val(), id: nextSectionId });
//            insertNewSectionHTML($("#new_section_name_input").val(), nextSectionId);
//            nextSectionId++;
//            $("#addSection").modal("hide");
//            document.getElementById("new_section_name_input").value = "";
//            syncSectionPre(syncData);
//        }
//    }
//
//    function validateSection() {
//        $("#new_section_name_err").hide();
//        res = true;
//        if ($("#new_section_name_input").val() == "") {
//            $("#new_section_name_err").show();
//            res = false;
//        }
//        return res;
//    }

//    function insertNewSectionHTML(name, id) {
//        $("#space").append(`
//            <div id="section_${id}" class="col-sm-12">
//            <hr>
//            <b style="font-size: x-large;" id="section_${id}_title" value="">${name}</b>
//			<input type="hidden" name="section_${id}_id" id="section_${id}_id" value="">
//            <button class="btn btn-warning waves-effect waves-light" type="button" onclick="editSectionBtn('${id}')" ><i class="fa fa-pencil"></i> </button>
//            <button onclick="deleteSectionBtn('${id}')" class="btn btn-danger waves-effect waves-light" style="margin-right: 5px;" type="button" ><i class="fa fa-trash"></i> </button>
//            <hr>
//            <div class="row col-sm-9 float-left" id="section_${id}_questions">
//            </div>
//            </div>
//            `)
//
//        addDragtoSection(id);
//    }
//
//    function deleteSection(id) {
//		
//		check_section_saved_or_not = $("#section_"+id+"_id").val();
//		syncData.mode_sec = "delete_section";
//		syncData.changed_section_id = id;
//		syncData.delete_section_id = check_section_saved_or_not;
//		
//        let i = syncData.sections.findIndex(o => o.id == id);
//        $("#sectionDeleteWarning").modal("hide");
//        if (i > -1) {
//            syncData.sections.splice(i, 1);
//            $(`#section_${id}`).remove();
//			remove_from_import_section(id);
//            syncData.questions = syncData.questions.filter(o => o.s_id != id);
//			
//			syncSectionPre(syncData);
//			
//        }
//    }
//
//    function deleteSectionBtn(id) {
//        $("#sectionDeleteWarning").modal("show");
//        $("#delete_section_btn_confirm").attr("onclick", `deleteSection('${id}')`);
//    }
//
//    function deleteQuestionBtn(id) {
//        $("#questionDeleteWarning").modal("show");
//        $("#delete_question_btn_confirm").attr("onclick", `deleteQuestion('${id}')`);
//    }
//
//    function deleteQuestion(id) {
//        id = id.toString();
//        let i = questionsData.findIndex(o => o._id == id);
//		syncData.deleteQuestionId = id;
//        if (i > -1) {
//            if(questionsData[i].q_type=="s") {
//                let k = questionsData.findIndex(o=>o.sub_questions && o.sub_questions.includes(id))
//                if(k>-1) {
//                    let l = questionsData[k].sub_questions.indexOf(id);
//                    questionsData[k].sub_questions.splice(l,1); //remove from main q
//                    if(questionsData[k].sub_questions.length==0) {
//                        $(`#p_ph_${id}`).show();
//                    }
//                    syncQuestionReq(questionsData[k]);
//                    $(`#${id}`).remove();
//                } 
//                else {
//                    let m = syncData.un_q_ids.indexOf(id);
//                    if(m>-1) {
//                        syncData.un_q_ids.splice(m,1);
//                        syncTestQue(syncData);
//                        $(`#${id}`).remove();
//                        if(syncData.un_q_ids.length==0) {
//                            $("#section_subq").hide();
//                        }
//                    }
//                }
//            }
//                questionsData.splice(i, 1);
//                let j = syncData.questions.findIndex(o => o.q_id == id);
//                if (j > -1) {
//                    syncData.questions.splice(j, 1);
//                    $(`#${id}`).remove();
//                    syncTestQue(syncData);
//                }
//            
//        }
//        $("#questionDeleteWarning").modal("hide");
//    }
	
//	function syncTestQue(data) {
//        if(data.total_time==0) {
//            data.total_time=10;
//        }
//        $("#savesuccess").html(`Syncing . . .`);
//        let xhr = new XMLHttpRequest();
//        xhr.open("POST", "delete_question.php");
//        xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//        xhr.setRequestHeader("Content-Type", "application/json");
//        xhr.onload = () => {
//            if (xhr.status >= 200 && xhr.status < 300) {
//                response = JSON.parse(xhr.response);
//                syncData = response.test;
//                $("#savesuccess").html(`Last saved at: ${new Date().toTimeString().substr(0,8)}`);
//                console.log(response);
//
//            } else {
//                console.log(xhr.response)
//            }
//        };
//        xhr.onerror = () => reject(xhr.statusText);
//        xhr.send(JSON.stringify(data));
//    }


//    async function changeQuestionOrder(evt) {
//        if (evt.to == evt.from && evt.oldIndex == evt.newIndex) {
//            //do nothing
//        } else {
//            if (evt.to != evt.from) {
//                // section changed
//                if(evt.from.id=="section_subq_questions") {
//                    let i = syncData.un_q_ids.indexOf(evt.item.id);
//                    if(i>-1) {
//                        let j = questionsData.findIndex(o => o._id == evt.to.id.substr(6));
//                        if(j>-1) {
//                            if(!questionsData[j].sub_questions) {
//                                questionsData[j].sub_questions=[];
//                            }
//                            questionsData[j].sub_questions.splice(evt.newIndex, 0, syncData.un_q_ids[i]);
//                            let res = await syncQuestionReq(questionsData[j]);
//                            syncData.un_q_ids.splice(i, 1); //remove element
//                            syncTestPre();
//                            if(syncData.un_q_ids.length==0) {
//                                $("#section_subq").hide();
//                            }
//                            $(`#p_ph_${evt.to.id.substr(6)}`).hide();
//                            
//                        }
//                    }
//                }
//                else if(evt.from.id.substr(0,5)=="sub_q") {
//                    let from = questionsData.findIndex(o => o._id == evt.from.id.substr(6));
//                    let to = questionsData.findIndex(o => o._id == evt.to.id.substr(6));
//                    if(from >-1 && to>-1) {
//                        let i_index = questionsData[from].sub_questions.indexOf(evt.item.id);
//                        if(i_index>-1) {
//                            if(!questionsData[to].sub_questions) {
//                                questionsData[to].sub_questions=[];
//                            }
//                            if(questionsData[to].sub_questions.length==0) {
//                                $(`#p_ph_${evt.to.id.substr(6)}`).hide();
//                            }
//                            questionsData[to].sub_questions.splice(evt.newIndex, 0, questionsData[from].sub_questions[i_index]); //remove element
//                            let res = await syncQuestionReq(questionsData[to]);
//                            questionsData[from].sub_questions.splice(i_index, 1); //remove element
//                            let res2 = await syncQuestionReq(questionsData[from]);
//                            if(questionsData[from].sub_questions.length==0) {
//                                $(`#p_ph_${evt.from.id.substr(6)}`).show();
//                            }
//                        }
//                    }
//                }
//                else {
//                    let i = syncData.questions.findIndex(o => o.q_id == evt.item.id);
//                    if (i > -1) {
//                        syncData.questions[i].s_id = Number(evt.to.id[8]); //change section
//                        let item = syncData.questions[i];
//                        syncData.questions.splice(i, 1); //remove element
//                        syncData.questions.splice(evt.newIndex, 0, item); //insert element
//                    }
//                }
//            }
//            else {
//                if(evt.from.id.substr(0,5)=="sub_q")
//                {
//                    let i = questionsData.findIndex(o => o._id == evt.from.id.substr(6));
//                    if(i>-1) {
//                        let j = questionsData[i].sub_questions.indexOf(evt.item.id);
//                        if(j>-1) {
//                            let item = questionsData[i].sub_questions[j];
//                            questionsData[i].sub_questions.splice(j,1);
//                            questionsData[i].sub_questions.splice(evt.newIndex, 0, item);
//                            let res = await syncQuestionReq(questionsData[i]);
//                        }
//                    }
//
//                } else {
//
//                    // order changed
//                    let i = syncData.questions.findIndex(o => o.q_id == evt.item.id);
//                    if (i > -1) {
//                        let item = syncData.questions[i];
//                        syncData.questions.splice(i, 1); //remove element
//                        syncData.questions.splice(evt.newIndex, 0, item); //insert element
//                    }
//                }
//                syncTestPre();
//            }
//        }
//    }

//    function clearNewQuestion() {
//        $("#desc_q_editor .ql-editor").html(" ");
//        $("#new_q_editor .ql-editor").html(" ");
//    }
//
//    async function newQuestionBtn() {
//		
//        $("#new_question_confirm_btn").attr("onclick", "createNewQuestion()");
//        $("#new_question_confirm_btn").html("Create New Question");
//        
//		clearNewQuestion();
//		
//		let check_test_id = $("#test_id").val();
//		if(check_test_id == '')
//		{
//			let add_section = await editSectionName(1);
//		}
//		
//        $("#addQuestion").modal("show");
//    }
//
//    function editQuestionBtn(id) {
//        $("#new_question_confirm_btn").attr("onclick", `editQuestion('${id}')`);
//        $("#new_question_confirm_btn").html("Update");
//        let i = questionsData.findIndex(o => o._id == id);
//        if (i > -1) {
//            $("#new_q_type").val(questionsData[i].q_type);
//            if(false) q_editor.setContents(JSON.parse(questionsData[i].main_delta));
//            else {
//                $("#new_q_editor_parent").empty();
//                $("#new_q_editor_parent").html(`<div id="new_q_editor">${questionsData[i].main_html.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&')}</div>`);
//                new Quill(`#new_q_editor`, { theme: "snow", modules: { toolbar: custom_toolbar, imageUploader: server_upload } });
//            }
//            $("#new_a_type").val(questionsData[i].a_type);
//            $("#new_a_choice_count").val(questionsData[i].choices);
//            choicesToggle(document.getElementById("new_a_choice_count"), 0, '');
//            if(false) desc_editor.setContents(JSON.parse(questionsData[i].explanation_delta));
//            else {
//                $("#desc_q_editor_parent").empty();
//                $("#desc_q_editor_parent").html(`<div id="desc_q_editor">${questionsData[i].explanation_html?questionsData[i].explanation_html.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&'):""}</div>`);
//                new Quill(`#desc_q_editor`, { theme: "snow", modules: { toolbar: custom_toolbar, imageUploader: server_upload } });
//            }
//            $("#new_a_marking_correct").val(questionsData[i].correct_marks);
//            $("#new_a_marking_incorrect").val(questionsData[i].incorrect_marks);
//            $("#new_a_lang").val(questionsData[i].language);
//            if (questionsData[i].a_type == "mcqm") {
//                let ans = questionsData[i].answer.split(",");
//                $("#div_mcqm .btn").each(function (index) {
//                    if (ans.includes(this.innerText.trim())) $(this).addClass("active")
//                });
//            } else if (questionsData[i].a_type == "mcqs") {
//                $("#div_mcqs .btn").each(function (index) {
//                    if ("A" == this.innerText.trim()) $(this).removeClass("active")
//                    if (questionsData[i].answer == this.innerText.trim()) $(this).addClass("active")
//                });
//            } else if (questionsData[i].a_type == "fib") {
//                $("#new_a_fill").val(questionsData[i].answer)
//            }
//            $("#addQuestion").modal("show");
//        }
//    }

//    async function editQuestion(id) {
//        let i = questionsData.findIndex(o => o._id == id);
//
//        if (i > -1) {
//            let question = await syncNewQuestionPre(id)
//            if (question) {
//                questionsData[i] = question;
//                let a_type;
//                if (question.a_type == "mcqm") a_type = "Multiple choices are correct"
//                if (question.a_type == "mcqs") a_type = "Single choice is correct"
//                if (question.a_type == "fib") a_type = "Fill in the blank"
//                $(`#${id}_html`).html(question.main_html);
//                $(`#${id}_type`).html("Answer Type: " + a_type);
//                $(`#${id}_ans`).html("Correct Answer: " + question.answer);
//                $(`#${id}_mark`).html(`Correct marks: ${question.correct_marks}; Incorrect marks: ${question.incorrect_marks}`);
//                clearNewQuestion();
//
//            } else {
//                $("#error").show();
//            }
//        }
//        $("#addQuestion").modal("hide");
//    }
//
//    function editSectionBtn(id) {
//        $("#edit_section_btn_confirm").attr("onclick", `editSectionName('${id}')`);
//        $("#editSectionModal").modal("show");
//    }
//
//    function editSectionName(id) {
//		
//		check_section_saved_or_not = $("#section_"+id+"_id").val();
//		if(check_section_saved_or_not == '')
//		{
//			var check_inputted_or_not = $("#edit_section_name_input").val();
//			if(check_inputted_or_not != '')
//			{
//				syncData.mode_sec = "add_section";
//				syncData.edit_section_name = $("#edit_section_name_input").val();
//				syncData.changed_section_id = id;
//			}
//			else
//			{
//				syncData.edit_section_name = '';
//				syncData.changed_section_id = id;
//			}
//		}
//		else
//		{
//			syncData.mode_sec = "edit_section";
//			syncData.edit_section_name = $("#edit_section_name_input").val();
//			syncData.changed_section_id = id;
//			syncData.edit_section_id = check_section_saved_or_not;
//		}
//		
//        let i = syncData.sections.findIndex(o => o.id == id);
//        if (i > -1) {
//            syncData.sections[i].name = $("#edit_section_name_input").val();
//            $(`#section_${id}_title`).html($("#edit_section_name_input").val());
//            $("#edit_section_name_input").val("");
//            $("#editSectionModal").modal("hide");
//            syncSectionPre(syncData);
//        }
//    }
	
//	function syncSectionPre(data) {
//        if(data.total_time==0) {
//            data.total_time=10;
//        }
//		syncData.test_id = $("#test_id").val();
//        $("#savesuccess").html(`Syncing . . .`);
//        let xhr = new XMLHttpRequest();
//        xhr.open("POST", "add_or_edit_test_section.php");
//        xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//        xhr.setRequestHeader("Content-Type", "application/json");
//        xhr.onload = () => {
//            if (xhr.status >= 200 && xhr.status < 300) {
//                response = JSON.parse(xhr.response);
//                /* syncData = response.test; */
//				$("#test_id").val(response.test_id);
//				
//				if(response.mode_sec != 'delete_section')
//				{
//					$("#section_"+response.changed_section_id+"_id").val(response.inserted_or_updated_section_id);
//				}
//				
//				if(response.initially_section1_created_or_not == 'yes')
//				{
//					$("#section_"+response.initially_created_section_id+"_id").val(response.initially_inserted_section_id);
//					
//					if(response.initially_created_section_name != '')
//					{
//						$("#section_"+response.initially_created_section_id+"_title").html(response.initially_created_section_name);
//					}
//				}
//				syncData = response.test;
//				add_to_import_section();
//				
//                $("#savesuccess").html(`Last saved at: ${new Date().toTimeString().substr(0,8)}`);
//                console.log(response);
//
//            } else {
//                console.log(xhr.response)
//            }
//        };
//        xhr.onerror = () => reject(xhr.statusText);
//        xhr.send(JSON.stringify(data));
//    }


    // 


//    var __PDF_DOC,
//        __CURRENT_PAGE,
//        __TOTAL_PAGES,
//        __PAGE_RENDERING_IN_PROGRESS = 0,
//        __CANVAS = $('#pdf-canvas').get(0),
//        __CANVAS_CTX = __CANVAS.getContext('2d');
//
//
//    function showPDF(pdf_url) {
//        $("#pdf-loader").show();
//
//        PDFJS.getDocument({ url: pdf_url }).then(function (pdf_doc) {
//            __PDF_DOC = pdf_doc;
//            __TOTAL_PAGES = __PDF_DOC.numPages;
//
//            // Hide the pdf loader and show pdf container in HTML
//            $("#pdf-loader").hide();
//            $("#pdf-contents").show();
//            $("#pdf-total-pages").text(__TOTAL_PAGES);
//
//            // Show the first page
//            showPage(1);
//        }).catch(function (error) {
//            // If error re-show the upload button
//            $("#pdf-loader").hide();
//            $("#div-pdf-upload").show();
//
//            alert(error.message);
//        });
//    }
//
//    var cropper;
//    var pdfQuestionstoParse = [];
//    var pdfQuestions = [];
//    var pdfQuestionstoParseId;
//    var pdfQuestionstoParseIdDiv;
//    var pdfQuestionstoParseIdCrop;
//
//    function showPage(page_no) {
//        __PAGE_RENDERING_IN_PROGRESS = 1;
//        __CURRENT_PAGE = page_no;
//
//        // Disable Prev & Next buttons while page is being loaded
//        $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');
//        // While page is being rendered hide the canvas and show a loading message
//        $("#pdf-canvas").hide();
//        $("#page-loader").show();
//        $("#download-image").hide();
//        // Update current page in HTML
//        $("#pdf-current-page").text(page_no);
//        $("#page-count-container").show();
//        $("#pdfcontrols").show();
//
//        // Fetch the page
//        __PDF_DOC.getPage(page_no).then(function (page) {
//            // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
//            var scale_required = __CANVAS.width / page.getViewport(1).width;
//            if (cropper) cropper.destroy();
//
//            // Get viewport of the page at required scale
//            var viewport = page.getViewport(scale_required);
//
//            // Set canvas height
//            __CANVAS.height = viewport.height;
//
//            var renderContext = {
//                canvasContext: __CANVAS_CTX,
//                viewport: viewport
//            };
//
//            // Render the page contents in the canvas
//            page.render(renderContext).then(function () {
//                __PAGE_RENDERING_IN_PROGRESS = 0;
//
//                // Re-enable Prev & Next buttons
//                $("#pdf-next, #pdf-prev").removeAttr('disabled');
//
//                // Show the canvas and hide the page loader
//
//                $("#current-page-preview").attr("src", __CANVAS.toDataURL());
//                $("#page-loader").hide();
//                var el = document.getElementById('current-page-preview');
//
//                try {
//                    cropper = new Cropper(el, {
//                        zoomable: false,
//                        zoomOnTouch: false,
//                        zoomOnWheel: false,
//                        cropend(event) {
//
//                            cropper.getCroppedCanvas().toBlob((blob) => {
//
//                                var reader = new FileReader();
//                                reader.readAsDataURL(blob);
//                                reader.onloadend = function () {
//
//                                    var base64data = reader.result;
//                                    if (pdfQuestionstoParseIdDiv) {
//                                        $("#undobtn").attr("disabled", false);
//                                        let i = pdfQuestionstoParse.findIndex(o => o.id == pdfQuestionstoParseIdDiv);
//                                        pdfQuestionstoParse[i].imgs.push(base64data)
//                                        pdfQuestionstoParseIdCrop = Date.now();
//                                        $("#pdfdiv_" + pdfQuestionstoParse[i].id).append(`<img style="padding-bottom:10px; max-width: 100%; max-height: 140px;" src="${base64data}" id="pdfimg_${pdfQuestionstoParseIdCrop}">`)
//                                    }
//                                    else {
//                                        $("#undobtn").attr("disabled", true);
//                                        var ndiv = $(document.createElement('div'));
//                                        pdfQuestionstoParseIdDiv = Date.now();
//                                        pdfQuestionstoParse.push({ id: pdfQuestionstoParseIdDiv.toString(), imgs: [base64data] })
//                                        ndiv.html(`<div style=" display:grid; border: dashed; padding: 10px; margin: 10px;" id="pdfdiv_${pdfQuestionstoParseIdDiv}">
//                                            <img style="padding-bottom:10px; max-width: 100%; max-height: 140px;" src="${base64data}" id="pdfimg_${Date.now()}">
//                                            <button style="position: absolute;padding: 4px;" onclick="removeCroppedQuestion('${pdfQuestionstoParseIdDiv}')" class="btn btn-outline-danger waves-effect waves-light" type="button"><i class="fa fa-trash"></i> </button>
//                                            </div>`);
//                                        ndiv.css({ 'display': 'inline-block' });
//                                        ndiv.appendTo('#previews');
//
//                                    }
//                                }
//                            });
//
//                            this.cropper.clear();
//                        },
//                        ready() {
//
//                            this.cropper.clear();
//                        }
//                    });
//                }
//                catch (e) {
//
//
//                }
//            });
//        });
//    }

//    function removeCroppedQuestion(id) {
//        let i = pdfQuestionstoParse.findIndex(o => o.id == id);
//        if (i > -1) {
//            pdfQuestionstoParse.splice(i, 1);
//        }
//        $(`#pdfdiv_${id}`).remove();
//        pdfQuestionstoParseIdDiv=null;
//    }
//
//
//    $("#upload-button").on('click', function () {
//        $("#file-to-upload").trigger('click');
//    });
//
//    $("#pdf-prev").on('click', function () {
//        if (__CURRENT_PAGE != 1)
//            showPage(--__CURRENT_PAGE);
//    });
//
//    // Next page of the PDF
//    $("#pdf-next").on('click', function () {
//        if (__CURRENT_PAGE != __TOTAL_PAGES)
//            showPage(++__CURRENT_PAGE);
//    });
//
//    function resetPDFUploader() {
//        __PDF_DOC = null;
//        __CURRENT_PAGE = null;
//        __TOTAL_PAGES = null;
//        __PAGE_RENDERING_IN_PROGRESS = null;
//        cropper = null;
//        pdfQuestionstoParse = [];
//        pdfQuestionstoParseId = null;
//        pdfQuestionstoParseIdDiv = null;
//        pdfQuestionstoParseIdCrop = null;
//    }


    // When user chooses a PDF file
//    $("#file-to-upload").on('change', function () {
//        // Validate whether PDF
//        if (['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
//            alert('Error : Not a PDF');
//            return;
//        }
//
//        $("#div-pdf-upload").hide();
//        // Send the object url of the pdf
//        showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
//        $("#file-to-upload").val('');
//    });
//
//    function nextques() {
//        pdfQuestionstoParseIdDiv = null;
//        $("#undobtn").attr("disabled", true);
//    }
//
//    function undoques() {
//        let i = pdfQuestionstoParse.findIndex(o => o.id == pdfQuestionstoParseIdDiv);
//        if (i > -1) {
//            pdfQuestionstoParse[i].imgs.pop();
//        }
//        $("#pdfimg_" + pdfQuestionstoParseIdCrop).remove();
//        $("#undobtn").attr("disabled", true);
//    }
//
//    function deleteQuestionPDF(id) {
//        let i = pdfQuestions.findIndex(o => o.id == id);
//        if (i > -1) {
//            $(`#pdf_q_${id}`).remove();
//            pdfQuestions.splice(i, 1);
//        }
//    }
//
//    async function addPDFHTML(data) {
//        alert(123);
//        for (i = 0; i < data.length; i++) {
//            let html = "";
//            for (j = 0; j < data[i].imgs.length; j++) {
//                html += data[i].imgs[j];
//            }
//            let insertHTML = `<div class="row col-sm-12" id="pdf_q_${i + 1}" style="border: solid;border-width: thin;border-color: lightgray;padding-left: 0;border-radius: 10px;padding-right:0;padding-top: 20px;padding-bottom: 20px;">
//                <p class="col-sm-12"><b>Question ${i + 1} </b>
//                <!-- <button class="btn btn-danger waves-effect waves-light float-right" style="margin-right: 5px;" type="button" onclick="deleteQuestion(${i + 1})" ><i class="fa fa-trash"></i> </button> -->
//                </p>
//                <div id="div_q_editor_pdf_q_${i + 1}" class="col-sm-6" style="padding-left: 0; padding-right: 0">
//                <label class="col-sm-12" id="new_q_editor_label_pdf_q_${i + 1}">Your question (with choices) or Paragraph</label>
//                <div class="col-sm-12">
//                <div id="new_q_editor_pdf_q_${i + 1}">
//                ${html}
//                </div>
//                </div>
//                <p id="new_q_editor_err_pdf_q_${i + 1}" style="color:brown; display: none;">Please enter a question</p>
//                </div>
//                <div id="div_desc_editor_pdf_q_${i + 1}" style="margin-bottom: 15px" class="col-sm-6" style="padding-left: 0; padding-right: 0">
//                <label class="col-sm-12" id="desc_q_editor_label_pdf_q_${i + 1}">Answer Description (If any?)</label>
//                <div class="col-sm-12">
//                <div id="desc_q_editor_pdf_q_${i + 1}">
//
//                </div>
//                </div>
//                </div>
//                <div id="div_q_type_pdf_q_${i + 1}" class="col-sm-3">
//                <label class="col-sm-12">Select Question Type</label>
//                <select class="form-control" required id="new_q_type_pdf_q_${i + 1}" onchange="qTypeToggle(this, 0, '_pdf_q${i + 1}')">
//                <option value="n" selected="true">Normal Question</option>
//                <option value="p">Paragraph Type Question</option>
//                <option value="s">Subquestion for a paragraph</option>
//                </select>
//                </div>
//
//                <div id="div_a_type_pdf_q_${i + 1}" class="col-sm-3">
//                <label class="col-sm-12">Select Answer Type</label>
//                <select class="form-control" required id="new_a_type_pdf_q_${i + 1}" onchange="aTypeToggle(this, 0, '_pdf_q_${i + 1}')">
//                <option value="mcqs" selected="true">MCQ (Only one is correct)</option>
//                <option value="mcqm">MCQ (More than one is correct)</option>
//                <option value="fib">Fill in the blank/Numerical answer</option>
//                </select>
//                </div>
//
//                <div id="div_a_choice_count_pdf_q_${i + 1}" class="col-sm-3">
//                <label class="col-sm-12">Select Number of choices:</label>
//                <select class="form-control" required id="new_a_choice_count_pdf_q_${i + 1}" onchange="choicesToggle(this, 0, '_pdf_q_${i + 1}')">
//                <option value="2">2 Choices (A. B.)</option>
//                <option value="3">3 Choices (A. B. C.)</option>
//                <option value="4" selected="true">4 Choices (A. B. C. D.)</option>
//                <option value="5">5 Choices (A. B. C. D. E.)</option>
//                <option value="6">6 Choices (A. B. C. D. E. F.)</option>
//                </select>
//                </div>
//
//                <div id="div_a_mcq_correct_pdf_q_${i + 1}" class="col-sm-3">
//                <label class="col-sm-12">Select Correct Answer:</label>
//                <div id="div_mcqm_pdf_q_${i + 1}" class=" col-sm-12 btn-group btn-group-toggle" data-toggle="buttons" style="display: none">
//                <label class="btn btn-outline-primary active" id="choice_a_cb_pdf_q_${i + 1}"> 
//                <input type="checkbox" checked=""> A
//                </label>
//                <label class="btn btn-outline-primary" id="choice_b_cb_pdf_q_${i + 1}"> 
//                <input type="checkbox"> B
//                </label>
//                <label class="btn btn-outline-primary" id="choice_c_cb_pdf_q_${i + 1}"> 
//                <input type="checkbox"> C
//                </label>
//                <label class="btn btn-outline-primary" id="choice_d_cb_pdf_q_${i + 1}"> 
//                <input type="checkbox"> D
//                </label>
//                <label class="btn btn-outline-primary" id="choice_e_cb_pdf_q_${i + 1}" style="display: none"> 
//                <input type="checkbox"> E
//                </label>
//                <label class="btn btn-outline-primary" id="choice_f_cb_pdf_q_${i + 1}" style="display: none">
//                <input type="checkbox"> F
//                </label>
//                </div>
//                <p id="mcqm_err_pdf_q_${i + 1}" style="color:brown; display: none;">Please select at least one answer</p>
//                <div id="div_mcqs_pdf_q_${i + 1}" class="col-sm-12 btn-group btn-group-toggle" data-toggle="buttons">
//                <label class="btn btn-outline-primary active" id="choice_a_radio_pdf_q_${i + 1}"> 
//                <input type="radio" checked=""> A
//                </label>
//                <label class="btn btn-outline-primary" id="choice_b_radio_pdf_q_${i + 1}"> 
//                <input type="radio"> B
//                </label>
//                <label class="btn btn-outline-primary" id="choice_c_radio_pdf_q_${i + 1}"> 
//                <input type="radio"> C
//                </label>
//                <label class="btn btn-outline-primary" id="choice_d_radio_pdf_q_${i + 1}"> 
//                <input type="radio"> D
//                </label>
//                <label class="btn btn-outline-primary" id="choice_e_radio_pdf_q_${i + 1}" style="display: none"> 
//                <input type="radio"> E
//                </label>
//                <label class="btn btn-outline-primary" id="choice_f_radio_pdf_q_${i + 1}" style="display: none">
//                <input type="radio"> F
//                </label>
//
//                </div>
//                </div>
//
//                <div id="div_a_fill_pdf_q_${i + 1}" style="display: none" class="col-sm-3">
//                <label class="col-sm-12">Enter Correct Answer:</label>
//                <input type="text" class="form-control" id="new_a_fill_pdf_q_${i + 1}">
//                <p id="new_a_fill_err_pdf_q_${i + 1}" style="color:brown; display: none;">Please select a valid choice</p>
//                </div>
//
//                <div id="div_a_marking_pdf_q_${i + 1}" class="col-sm-3">
//                <label class="col-sm-12">Marking:</label>
//                <select class="form-control col-sm-6 float-left" style="background-color: rgb(185, 244, 185);" required id="new_a_marking_correct_pdf_q_${i + 1}">
//                <option value="0.25" >+0.25</option>
//                <option value="0.50" >+0.50</option>
//                <option value="0.75" >+0.75</option>
//                <option value="1" selected="true">+1</option>
//                <option value="2">+2</option>
//                <option value="3">+3</option>
//                <option value="4">+4</option>
//                <option value="8">+8</option>
//                </select>
//                <select class="form-control col-sm-5 float-right" style="margin-left: 10px;background-color: rgb(255, 158, 152);" required id="new_a_marking_incorrect_pdf_q_${i + 1}">
//                <option value="0" selected="true">0</option>
//                <option value="0.25">-0.25</option>
//                <option value="0.33">-0.33</option>
//                <option value="0.50">-0.50</option>
//                <option value="0.75">-0.75</option>
//                <option value="1">-1</option>
//                <option value="2">-2</option>
//                <option value="3">-3</option>
//                <option value="4">-4</option>
//                </select>
//                </div>
//
//                <div id="div_mcqm_marking_pdf_q_${i + 1}" style="display: none" class="col-sm-3">
//                <label class="col-sm-12">Marking:</label>
//                Marking is fixed and well as following:
//                <ul>
//                <li>+4 - If all the correct choices are selected</li>
//                <li>+3 - If all the four options are correct but only three options are chosen</li>
//                <li>+2 - If three or more options are correct but only two options are chosen, both of which are correct options.</li>
//                <li>+1 - If two or more options are correct but only one option is chosen and it is a correct option</li>
//                <li>-1 - For all other cases</li>
//                </ul>
//                </div>
//
//                <div id="div_a_lang_pdf_q_${i + 1}" class="col-sm-3">
//                <label class="col-sm-12">Select Answer Type</label>
//                <select class="form-control" required id="new_a_lang_pdf_q_${i + 1}">
//                <option value="english" selected="true">English</option>
//                <option value="hindi">हिंदी</option>
//                <option value="marathi">मराठी</option>
//                <option value="punjabi">ਪੰਜਾਬੀ</option>
//                <option value="kannada">ಕನ�?ನಡ</option>
//                <option value="malyalam">മലയാളം</option>
//                <option value="tamil">தமிழ�?</option>
//                <option value="telegu">తెల�?గ�?</option>
//                <option value="arabic">Arabic</option>
//                <option value="french">French</option>
//                <option value="spanish">Spanish</option>
//                <option value="german">German</option>
//                <option value="russia">Russian</option>
//                </select>
//                </div>
//
//                <div id="div_q_bank_choice_pdf_q_${i + 1}" style="display: none;" class="col-sm-3">
//                <label class="col-sm-12">Store in Question Bank?</label>
//                <select class="form-control" required id="new_q_bank_choice_pdf_q_${i + 1}">
//                <option value="Yes" selected="true">Yes</option>
//                <option value="No">No</option>
//                </select>
//                </div>
//
//                <div id="div_q_bank_cat_pdf_q_${i + 1}" style="display: none;" class="col-sm-3">
//                <label class="col-sm-12">Enter tags to filter for Question Bank:</label>
//                <select class="select2 form-control select2-multiple" id="a_tags_pdf_q_${i + 1}" multiple="multiple" multiple data-placeholder="Choose multiple choices">
//                ${$("#a_tags").html()}
//                </select>
//                <p id="new_q_bank_cat_err_pdf_q_${i + 1}" style="color:brown; display: none;">Please select a valid choice</p>
//                </div>
//                </div>`;
//            pdfQuestions.push({ id: i, html: html });
//            $("#parsedPDFQuestions").append(insertHTML);
//            $(`#new_q_editor_pdf_q_${i + 1}`, { theme: "snow", modules: { toolbar: custom_toolbar, imageUploader: server_upload } });
//            $(`#desc_q_editor_pdf_q_${i + 1}`, { theme: "snow", modules: { toolbar: custom_toolbar, imageUploader: server_upload } });
//        }
//        return true;
//    }
//
//    function aTypeToggle(el, type, id) {
//        if (type != 1) {
//            let val = el.value;
//            if (val == "mcqm") {
//                $(`#div_mcqs${id}`).hide();
//                $(`#div_mcqm${id}`).show();
//                $(`#div_a_fill${id}`).hide();
//                $(`#div_a_choice_count${id}`).show();
//                $(`#div_a_mcq_correct${id}`).show();
//                $(`#div_mcqm_marking${id}`).show();
//                choicesToggle(document.getElementById(`new_a_choice_count${id}`), 0, id);
//            } else if (val == `mcqs`) {
//                $(`#div_mcqs${id}`).show();
//                $(`#div_mcqm${id}`).hide();
//                $(`#div_a_fill${id}`).hide();
//                $(`#div_a_choice_count${id}`).show();
//                $(`#div_a_mcq_correct${id}`).show();
//                $(`#div_mcqm_marking${id}`).hide();
//                choicesToggle(document.getElementById(`new_a_choice_count${id}`), 0, id);
//            } else if (val == `fib`) {
//                $(`#div_a_fill${id}`).show();
//                $(`#div_a_choice_count${id}`).hide();
//                $(`#div_a_mcq_correct${id}`).hide();
//                $(`#div_mcqm_marking${id}`).hide();
//            }
//        } else {
//            aTypeToggle(document.getElementById(`new_a_type${id}`), 0, id);
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#new_a_type_pdf_q_${pdfQuestions[i].id + 1}`).val($(`#new_a_type${id}`).val());
//                aTypeToggle(document.getElementById(`new_a_type_pdf_q_${pdfQuestions[i].id + 1}`), 0, `_pdf_q_${pdfQuestions[i].id + 1}`);
//            }
//        }
//    }

//    function qTypeToggle(el, type, id) {
//        if (type == 0) {
//            let val = el.value;
//            if (val == "p") {
//                $(`#div_a_type${id}`).hide();
//                $(`#div_a_choice_count${id}`).hide();
//                $(`#div_a_mcq_correct${id}`).hide();
//                $(`#div_a_fill${id}`).hide();
//                $(`#div_desc_editor${id}`).hide();
//            } else if (val == "n" || val == "s") {
//                $(`#div_a_type${id}`).show();
//                $(`#div_a_marking${id}`).show();
//                $(`#div_desc_editor${id}`).show();
//                aTypeToggle(document.getElementById(`new_a_type${id}`), 0, id)
//                choicesToggle(document.getElementById(`new_a_choice_count${id}`), 0, id);
//            }
//        } else {
//            qTypeToggle(document.getElementById(`new_q_type${id}`), 0, id);
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#new_q_type_pdf_q_${pdfQuestions[i].id + 1}`).val($(`#new_q_type${id}`).val());
//                qTypeToggle(document.getElementById(`new_q_type_pdf_q_${pdfQuestions[i].id + 1}`), 0, `_pdf_q_${pdfQuestions[i].id + 1}`);
//            }
//        }
//
//    }
//
//    function choicesToggle(el, type, id) {
//        if (type == 0) {
//            let val = el.value;
//            let a_type = $(`#new_a_type${id}`).val();
//            if (a_type == "mcqm") {
//                $(`#div_mcqs${id}`).hide();
//                $(`#choice_a_cb${id}`).addClass("active");
//                $(`#choice_b_cb${id}`).removeClass("active");
//                $(`#choice_c_cb${id}`).removeClass("active");
//                $(`#choice_d_cb${id}`).removeClass("active");
//                $(`#choice_e_cb${id}`).removeClass("active");
//                $(`#choice_f_cb${id}`).removeClass("active");
//                if (val == "2") {
//                    $(`#choice_a_cb${id}`).show();
//                    $(`#choice_b_cb${id}`).show();
//                    $(`#choice_c_cb${id}`).hide();
//                    $(`#choice_d_cb${id}`).hide();
//                    $(`#choice_e_cb${id}`).hide();
//                    $(`#choice_f_cb${id}`).hide();
//                }
//                else if (val == "3") {
//                    $(`#choice_a_cb${id}`).show();
//                    $(`#choice_b_cb${id}`).show();
//                    $(`#choice_c_cb${id}`).show();
//                    $(`#choice_d_cb${id}`).hide();
//                    $(`#choice_e_cb${id}`).hide();
//                    $(`#choice_f_cb${id}`).hide();
//                }
//                else if (val == "4") {
//                    $(`#choice_a_cb${id}`).show();
//                    $(`#choice_b_cb${id}`).show();
//                    $(`#choice_c_cb${id}`).show();
//                    $(`#choice_d_cb${id}`).show();
//                    $(`#choice_e_cb${id}`).hide();
//                    $(`#choice_f_cb${id}`).hide();
//                }
//                else if (val == "5") {
//                    $(`#choice_a_cb${id}`).show();
//                    $(`#choice_b_cb${id}`).show();
//                    $(`#choice_c_cb${id}`).show();
//                    $(`#choice_d_cb${id}`).show();
//                    $(`#choice_e_cb${id}`).show();
//                    $(`#choice_f_cb${id}`).hide();
//                }
//                else if (val == "6") {
//                    $(`#choice_a_cb${id}`).show();
//                    $(`#choice_b_cb${id}`).show();
//                    $(`#choice_c_cb${id}`).show();
//                    $(`#choice_d_cb${id}`).show();
//                    $(`#choice_e_cb${id}`).show();
//                    $(`#choice_f_cb${id}`).show();
//                }
//            }
//            else if (a_type == "mcqs") {
//                $(`#div_mcqm_pdf_q_${id}`).hide();
//                $(`#choice_a_radio${id}`).addClass("active");
//                $(`#choice_b_radio${id}`).removeClass("active");
//                $(`#choice_c_radio${id}`).removeClass("active");
//                $(`#choice_d_radio${id}`).removeClass("active");
//                $(`#choice_e_radio${id}`).removeClass("active");
//                $(`#choice_f_radio${id}`).removeClass("active");
//                if (val == "2") {
//                    $(`#choice_a_radio${id}`).show();
//                    $(`#choice_b_radio${id}`).show();
//                    $(`#choice_c_radio${id}`).hide();
//                    $(`#choice_d_radio${id}`).hide();
//                    $(`#choice_e_radio${id}`).hide();
//                    $(`#choice_f_radio${id}`).hide();
//                }
//                else if (val == "3") {
//                    $(`#choice_a_radio${id}`).show();
//                    $(`#choice_b_radio${id}`).show();
//                    $(`#choice_c_radio${id}`).show();
//                    $(`#choice_d_radio${id}`).hide();
//                    $(`#choice_e_radio${id}`).hide();
//                    $(`#choice_f_radio${id}`).hide();
//                }
//                else if (val == "4") {
//                    $(`#choice_a_radio${id}`).show();
//                    $(`#choice_b_radio${id}`).show();
//                    $(`#choice_c_radio${id}`).show();
//                    $(`#choice_d_radio${id}`).show();
//                    $(`#choice_e_radio${id}`).hide();
//                    $(`#choice_f_radio${id}`).hide();
//                }
//                else if (val == "5") {
//                    $(`#choice_a_radio${id}`).show();
//                    $(`#choice_b_radio${id}`).show();
//                    $(`#choice_c_radio${id}`).show();
//                    $(`#choice_d_radio${id}`).show();
//                    $(`#choice_e_radio${id}`).show();
//                    $(`#choice_f_radio${id}`).hide();
//                }
//                else if (val == "6") {
//                    $(`#choice_a_radio${id}`).show();
//                    $(`#choice_b_radio${id}`).show();
//                    $(`#choice_c_radio${id}`).show();
//                    $(`#choice_d_radio${id}`).show();
//                    $(`#choice_e_radio${id}`).show();
//                    $(`#choice_f_radio${id}`).show();
//                }
//            }
//        } else {
//            choicesToggle(document.getElementById(`new_a_choice_count${id}`), 0, id);
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#new_a_choice_count_pdf_q_${pdfQuestions[i].id + 1}`).val($(`#new_a_choice_count${id}`).val());
//                choicesToggle(document.getElementById(`new_a_choice_count_pdf_q_${pdfQuestions[i].id + 1}`), 0, `_pdf_q_${pdfQuestions[i].id + 1}`);
//            }
//        }
//    }
//
//    async function closePDFImporter() {
//        $("#importQuestionPDF").modal("hide");
//        $("#importquestionscontbtn").html("Loading . . .");
//        $("#importquestionscontbtn").attr("disabled", true);
//        $("#parsedPDFQuestions").empty();
//        $("#previews").empty();
//        $("#current-page-preview-div").html(`<img id="current-page-preview" src="" style="max-width: 100%;">`);
//        $("#pdfcontrols").hide();
//        resetPDFUploader();
//        $("#div-pdf-upload").show();
//    }
//
//    async function importQuestionsPDF() {
//        $("#importquestionscontbtn").html("Loading . . .");
//        $("#importquestionscontbtn").attr("disabled", true);
//		
//		let check_test_id = $("#test_id").val();
//		if(check_test_id == '')
//		{
//			let add_section = await editSectionName(1);
//		}
//		
//        let result = await uploadPDFQuestions({ pdfQuestionstoParse });
//        if (result) {
//            $("#parsedPDFQuestions").empty();
//            await addPDFHTML(result);
//            $("#go-back-to-text").hide();
//            $("#importQuestionPDF").modal("hide");
//            setTimeout(function () {
//                $("#importQuestionPDF2").modal("show");
//            }, 500);
//
//            $("#previews").empty();
//            $("#current-page-preview-div").html(`<img id="current-page-preview" src="" style="max-width: 100%;">`);
//            $("#pdfcontrols").hide();
//            resetPDFUploader();
//            $("#div-pdf-upload").show();
//        } else {
//            $("error").show();
//            $("#importquestionscontbtn").html("Import");
//            $("#importquestionscontbtn").attr("disabled", false);
//        }
//    }
//
//    function reshowImporter() {
//        $("#importQuestionPDF2").modal("hide");
//        setTimeout(function () {
//                $("#importQuestionPDF2").modal("show");
//        }, 1000);
//    }
//
//    function togglefibMaster(id, type) {
//        if (type == 1) {
//            let val = $(`#${id}_pdf_m`).val();
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#${id}_pdf_q_${pdfQuestions[i].id + 1}`).val(val);
//            }
//        }
//    }
//
//    function togglecmarkingeMaster(id, type) {
//        if (type == 1) {
//            let val = $(`#${id}_pdf_m`).val()
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#${id}_pdf_q_${pdfQuestions[i].id + 1}`).val(val);
//            }
//        }
//    }
//
//
//    function toggleimarkingMaster(id, type) {
//        if (type == 1) {
//            let val = $(`#${id}_pdf_m`).val()
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#${id}_pdf_q_${pdfQuestions[i].id + 1}`).val(val);
//            }
//        }
//    }
//
//
//    function togglelangMaster(id, type) {
//        if (type == 1) {
//            let val = $(`#${id}_pdf_m`).val()
//            for (let i = 0; i < pdfQuestions.length; i++) {
//                $(`#${id}_pdf_q_${pdfQuestions[i].id + 1}`).val(val);
//            }
//        }
//    }

//    function togglechoiceMaster(id, type) {
//        if (type == 1) {
//            setTimeout(function () {
//                let val = $(`#${id}_pdf_m`).hasClass("active")
//                for (let i = 0; i < pdfQuestions.length; i++) {
//                    if (val) {
//                        $(`#${id}_pdf_q_${pdfQuestions[i].id + 1}`).click();
//                    } else {
//                        $(`#${id}_pdf_q_${pdfQuestions[i].id + 1}`).click();
//                    }
//                }
//            }, 500);
//        }
//    }

//    async function importQuestionsPDF3() {
//		
//		if($("#import_section" ).val() != '')
//		{
//			
//			let finalPDFQuestions = [];
//			$("#pdf-import-3").attr("disabled", true);
//			for (let i = 0; i < pdfQuestions.length; i++) {
//				let ans;
//				if ($(`#new_a_type_pdf_q_${pdfQuestions[i].id + 1}`).val() == "mcqm") {
//					ans = $(`#div_mcqm_pdf_q_${pdfQuestions[i].id + 1} .active`).map(function (index) { return this.innerText.trim() }).get().join(",");
//				} else if ($(`#new_a_type_pdf_q_${pdfQuestions[i].id + 1}`).val() == "mcqs") {
//					ans = $(`#div_mcqs_pdf_q_${pdfQuestions[i].id + 1} .active`)[0].innerText.trim();
//				} else {
//					ans = $(`#new_a_fill_pdf_q_${pdfQuestions[i].id + 1}`).val();
//				}
//
//				finalPDFQuestions.push({
//					q_type: $(`#new_q_type_pdf_q_${pdfQuestions[i].id + 1}`).val(),
//					main_html: $(`#new_q_editor_pdf_q_${pdfQuestions[i].id + 1} .ql-editor`).html(),
//					a_type: $(`#new_a_type_pdf_q_${pdfQuestions[i].id + 1}`).val(),
//					explanation_html: $(`#desc_q_editor_pdf_q_${pdfQuestions[i].id + 1} .ql-editor`).html(),
//					choices: Number($(`#new_a_choice_count_pdf_q_${pdfQuestions[i].id + 1}`).val()),
//					answer: ans,
//					correct_marks: Number($(`#new_a_marking_correct_pdf_q_${pdfQuestions[i].id + 1}`).val()),
//					incorrect_marks: Number($(`#new_a_marking_incorrect_pdf_q_${pdfQuestions[i].id + 1}`).val()),
//					section_id:$( "#import_section" ).val(),
//					language: $(`#new_a_lang_pdf_q_${pdfQuestions[i].id + 1}`).val()
//					//tags: $('#a_tags').select2('data').map(o=>o.id)
//				})
//			}
//	
//			let result = await syncMultipleQuestionsReq(finalPDFQuestions);
//			console.log("r0");
//			if (result) {
//				console.log("r1");
//				pdfQuestions=[];
//				importQuestionsPDF4(result);
//			} else {
//				$("#pdf-import-3").attr("disabled", false);
//			}
//		}
//		else
//		{
//			alert("Please select Section In Which you want to import Question");
//		}
//    }
//
//    async function importQuestionsPDF4(result) {
//		/* let id = document.getElementById("import_section").value; */
//        console.log("p4");
//        for (j = 0; j < result.length; j++) {
//            insertNewQuestionHTML(result[j]);
//            syncQuestionLocal(result[j]);
//            questionsData.push(result)
//        }
//        syncTestPre();
//        $("#pdf-import-3").attr("disabled", false);
//        $("#importQuestionPDF2").modal("hide");
//    }
//
//    async function syncMultipleQuestionsReq(data) {
//		
//		let updated_test_id = $("#test_id").val();
//		
//        return new Promise((resolve, reject) => {
//            let xhr = new XMLHttpRequest();
//            xhr.open("POST", "sync_questions.php");
//            xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//            xhr.setRequestHeader("Content-Type", "application/json");
//            xhr.onload = () => {
//                if (xhr.status >= 200 && xhr.status < 300) {
//                    response = JSON.parse(xhr.response);
//					syncData = response.test;
//                    console.log(response);
//                    resolve(response.test.questions)
//                } else {
//                    console.log(xhr.response)
//                    resolve(false);
//                }
//            };
//            xhr.onerror = () => resolve(false);
//            xhr.send(JSON.stringify({test_id:updated_test_id,questions: data ,test:syncData}));
//        });
//    }
//
//    async function uploadPDFQuestions(body) {
//        return new Promise((resolve, reject) => {
//            let xhr = new XMLHttpRequest();
//            xhr.open("POST", "<?php echo base_url() . "admin/Test/sync_images"; ?>");
//            xhr.setRequestHeader("adstrackid", $("#adstrackid").html());
//            xhr.setRequestHeader("Content-Type", "application/json");
//            xhr.onload = () => {
//                if (xhr.status >= 200 && xhr.status < 300) {
//                    response = JSON.parse(xhr.response);
//                    console.log(response);
//                    resolve(response.pdfQuestionstoParse);
//                } else {
//                    console.log(false);
//                    resolve(false);
//                }
//            };
//            xhr.onerror = () => resolve(false);
//            xhr.send(JSON.stringify(body));
//        });
//    }

//    async function openPDFImporter() {
//        $("#importquestionscontbtn").html("Continue");
//        $("#importquestionscontbtn").attr("disabled", false);
//        $("#previews").empty();
//        $("#importQuestionPDF").modal("show");
//    }
//
//    function toggleLanguage() {
//        document.getElementById("option1_label").style.display="none";
//        document.getElementById("option2_label").style.display="none";
//        document.getElementById("option3_label").style.display="none";
//        document.getElementById("option4_label").style.display="none";
//        document.getElementById("div_hindi").style.display="none";
//        let lang = document.getElementById("text_lang").value;
//
//        if(lang=="english") {
//            document.getElementById("option1_label").style.display="";
//        } else if(lang=="krutidev" || lang=="4c" || lang=="chanakya") {
//            document.getElementById("option2_label").style.display="";
//        } else if(lang=="nudi") {
//            document.getElementById("option3_label").style.display="";
//        } else if(lang=="eng_krutidev" || lang=="eng_4c" || lang=="eng_chanakya") {
//            document.getElementById("option4_label").style.display="";
//            document.getElementById("div_hindi").style.display="";
//        }
//    }
//
//
//
//    function preParseText() {
//        $("#go-back-to-text").attr("onclick", "goBacktoText()");
//        if(document.getElementById("text_lang").value=="krutidev") {
//            document.getElementById("direct_question").value=convert_kruti_to_unicode(document.getElementById("direct_question").value);
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            goFrontoText("text");
//        }
//        else if(document.getElementById("text_lang").value=="4c") {
//            document.getElementById("direct_question").value=convert_gandhi_to_unicode(document.getElementById("direct_question").value);
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            goFrontoText("text");
//        }
//        else if(document.getElementById("text_lang").value=="chanakya") {
//            document.getElementById("direct_question").value=convert_chanakya_to_unicode(document.getElementById("direct_question").value);
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            goFrontoText("text");
//        }
//        else if(document.getElementById("text_lang").value=="nudi") {
//            document.getElementById("direct_question").value=convert_nudi_to_unicode(document.getElementById("direct_question").value);
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            goFrontoText("text");
//        }
//        else if(document.getElementById("text_lang").value=="eng_krutidev") {
//            document.getElementById("direct_question_hi").value=convert_kruti_to_unicode(document.getElementById("direct_question_hi").value); 
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            let previewtext2 = parseText(document.getElementById("direct_question_hi").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            previewParsed2(previewtext2);
//            goFrontoText("text");
//        }
//        else if(document.getElementById("text_lang").value=="eng_4c") {
//            document.getElementById("direct_question_hi").value=convert_gandhi_to_unicode(document.getElementById("direct_question_hi").value); 
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            let previewtext2 = parseText(document.getElementById("direct_question_hi").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            previewParsed2(previewtext2);
//            goFrontoText("text");
//        }
//        else if(document.getElementById("text_lang").value=="eng_chanakya") {
//            document.getElementById("direct_question_hi").value=convert_chanakya_to_unicode(document.getElementById("direct_question_hi").value); 
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            let previewtext2 = parseText(document.getElementById("direct_question_hi").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            previewParsed2(previewtext2);
//            goFrontoText("text");
//        }
//        else {
//            let previewtext = parseText(document.getElementById("direct_question").value.replace(/\n/g, '<br>'));
//            previewParsed(previewtext);
//            goFrontoText("text");
//        }
//    }

//    async function processExcelQuestions() {
//        if($("#upload_excel").val()) {
//            $("#excel_file_error").hide();
//            $("#div_excel_errors").hide();
//            $("#excel_modal_btn").attr("disabled", true);
//            let result = await uploadExcelFile();
//            if(result.err) {
//                $("#excel_modal_btn").removeAttr("disabled");
//                $("#div_excel_errors").show();
//                $("#excel_errors").html(result.errors);
//            } else {
//                $("#go-back-to-text").attr("onclick", "goBacktoExcel()");
//                pdfQuestionstoParse=[];
//                for(let i=0;i<result.questions.length;i++) {
//                    if($("#upload_excel_lang").val()=="english") {
//                        pdfQuestionstoParse.push({id:i, imgs:[result.questions[i]]});
//                    }
//                    else if($("#upload_excel_lang").val()=="krutidev") {
//                        let uni_op = convert_kruti_to_unicode(result.questions[i])
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    } 
//                    else if($("#upload_excel_lang").val()=="4c") {
//                        let uni_op = convert_gandhi_to_unicode(result.questions[i])
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    } 
//                    else if($("#upload_excel_lang").val()=="chanakya") {
//                        let uni_op = convert_chanakya_to_unicode(result.questions[i])
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    } 
//                    else if($("#upload_excel_lang").val()=="nudi") {
//                        let uni_op = convert_nudi_to_unicode(result.questions[i]);
//                        uni_op = convert_to_english_numbers(uni_op);
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    }
//                }  
//                $("#excel_modal_btn").removeAttr("disabled");
//                goFrontoText("excel");
//            }
//        } else {
//            $("#excel_modal_btn").removeAttr("disabled");
//            $("#excel_file_error").show();
//            $("#div_excel_errors").hide();
//        }
//    }
//
//    async function uploadExcelFile() {
//        return new Promise((resolve, reject) => {
//            var formData = new FormData();
//            let id = document.getElementById("upload_excel");
//            formData.append("file", id.files[0]);
//            $.ajax({
//                url: "https://api2.funedulearn.com/tests/parse_excel",
//                type: "POST",
//                data: formData,
//                headers: {"adstrackid": $("#adstrackid").html()},
//                processData: false,
//                contentType: false,
//                success: function (data) {
//                    resolve(data);
//                },
//                error: function (data) {
//                    resolve({error:"Please check your internet connection"})
//                },
//            });
//        });
//    }
//
//    async function processdocxQuestions() {
//        if($("#upload_docx").val()) {
//            $("#docx_file_error").hide();
//            $("#div_docx_errors").hide();
//            $("#docx_modal_btn").attr("disabled", true);
//            let result = await uploaddocxFile();
//            if(result.err) {
//                $("#docx_modal_btn").removeAttr("disabled");
//                $("#div_docx_errors").show();
//                $("#docx_errors").html(result.errors);
//            } else {
//                $("#go-back-to-text").attr("onclick", "goBacktodocx()");
//                pdfQuestionstoParse=[];
//                for(let i=0;i<result.questions.length;i++) {
//                    pdfQuestionstoParse.push({id:i, imgs:[result.questions[i]]});
//                }  
//                $("#docx_modal_btn").removeAttr("disabled");
//                goFrontoText("docx");
//            }
//        } else {
//            $("#docx_modal_btn").removeAttr("disabled");
//            $("#docx_file_error").show();
//            $("#div_docx_errors").hide();
//        }
//    }
//
//    async function uploaddocxFile() {
//        return new Promise((resolve, reject) => {
//            var formData = new FormData();
//            let id = document.getElementById("upload_docx");
//            formData.append("file", id.files[0]);
//            $.ajax({
//                url: "https://api2.funedulearn.com/tests/parse_docx",
//                type: "POST",
//                data: formData,
//                headers: {"adstrackid": $("#adstrackid").html()},
//                processData: false,
//                contentType: false,
//                success: function (data) {
//                    resolve(data);
//                },
//                error: function (data) {
//                    resolve({error:"Please check your internet connection"})
//                },
//            });
//        });
//    }
//
//    function parseText(txt) {
//        document.getElementById("parsing_btn").innerHTML="Processing . . .";
//        document.getElementById("parsing_btn").setAttribute("disabled", "true");
//
//        d_arr=[];
//        
//        let i=1;
//        let b =0;
//        let textarr = [];
//        let lp;
//        try{
//            
//            while(true) {
//                let i1 = txt.indexOf(`${i}.`, lp);
//                let i2 = txt.indexOf(`${i+1}.`, lp);
//                if(i1>-1) {
//                    if(i2>-1) {
//                        lp=i2;
//                        textarr.push(txt.substring(i1, i2));
//                        i++;
//                        b=0;
//                    }
//                    else {
//                        console.log("here");
//                        console.log(txt.substring(i1, txt.length));
//                        i++;
//                        textarr.push(txt.substring(i1, txt.length));
//                        b=0;
//                    }
//                }
//                else {
//                    console.log("notfound");
//                    i++;
//                    b++;
//                }
//                if(b>100) break;
//            }
//            
//        return textarr;
//        }
//        catch(e) {
//            d_arr=[];
//            document.getElementById("parsing_btn").innerHTML="Preview";
//            document.getElementById("parsing_btn").removeAttribute("disabled");
//        }
//    }

//    var d_arr = [];
//
//    function previewParsed(textarr) {
//        pdfQuestionstoParse=[];
//        $("#parsedPDFQuestions").empty();
//        for(let k=0;k<textarr.length;k++) {
//            let ti = textarr[k].replace(/ {2,}/g,' ');
//            pdfQuestionstoParse.push({id:k, imgs:[ti]});
//        }
//        $("#go-back-to-text").show();
//        document.getElementById("parsing_btn").innerHTML="Auto-Detect Questions";
//        document.getElementById("parsing_btn").removeAttribute("disabled");
//    }
//
//    function goFrontoText(from) {
//        if(from=="text") {
//            $("#importQuestionText").modal("hide");
//        } else if(from=="excel") {
//            $("#importQuestionExcel").modal("hide");
//        } else if(from=="docx") {
//            $("#importQuestionDocx").modal("hide");
//        }
//        setTimeout(function () {
//                $("#importQuestionPDF2").modal("show");
//        }, 500); 
//        addPDFHTML(pdfQuestionstoParse);
//    }
//
//    function goBacktoText() {
//        $("#importQuestionPDF2").modal("hide");
//        setTimeout(function () {
//            $("#importQuestionText").modal("show");
//        }, 500);
//    }
//
//    function goBacktoExcel() {
//        $("#importQuestionPDF2").modal("hide");
//        setTimeout(function () {
//            $("#importQuestionExcel").modal("show");
//        }, 500);
//    }
//
//    function goBacktodocx() {
//        $("#importQuestionPDF2").modal("hide");
//        setTimeout(function () {
//            $("#importQuestionDocx").modal("show");
//        }, 500);
//    }
//
//    function previewParsed2(textarr) {
//        for(let k=0;k<textarr.length;k++) {
//            let ti = textarr[k].replace(/ {2,}/g,' ');
//            let i = pdfQuestionstoParse.findIndex(o=>o.id==k)
//            if(i>-1) {
//                pdfQuestionstoParse[i].imgs.push(ti);
//            }
//        }
//    }
//
//    function proceedParsed() {
//        console.log("1")
//        document.getElementById("err_save").style.display="none"
//        document.getElementById("succ_save").style.display="none"
//        let isValid = true;
//        $('#d_method_div').find( "input, textarea, select" ).each(function (index, value) {   
//            if ($(this).parsley().validate() !== true) isValid=false;
//        });
//        if(isValid) {
//            console.log("2")
//            sendParsedData();
//        } else document.getElementById("err_save").style.display="";
//    }
//
//
//    window.addEventListener("keydown", function(e){
//var selectedText = getSelectionText();
//if(e.keyCode === 16 && selectedText != "") {
//	e.preventDefault();
//      replaceSelectedText(strcon(selectedText));
//	}
//});
//
//function getSelectionText() {
//	var text = "";
//	if (window.getSelection) {
//		text = window.getSelection().toString();
//	} else if (document.selection && document.selection.type != "Control") {
//		text = document.selection.createRange().text;
//	}
//	return text;
//}
//
//function strcon(givenString) {
//	var a = givenString;
//	let hitext = convert_to_unicode(givenString);
//	return hitext;
//}
//
//function replaceSelectedText(text) {
//  var txtArea = document.activeElement;
//  console.log(txtArea);
//  if (txtArea.selectionStart != undefined) {
//  	var startPos = txtArea.selectionStart;
//    var endPos = txtArea.selectionEnd;
//    selectedText = txtArea.value.substring(startPos, endPos);
//    txtArea.value = txtArea.value.slice(0, startPos) + text + txtArea.value.slice(endPos);
//  }
//}
//
//
//
//function corrections(texttoconvert){
//    txt = texttoconvert;
//    txt = txt.replace(/’/g, "'");
//    return txt;
//}
//
//function add_to_import_section() {
//	
//		var option = document.createElement("option");
//		option.text = "Please Select Section";
//		option.value = "";
//		
//		var y = document.getElementById("import_section_add_question");
//		$('#import_section_add_question').empty();
//		y.add(option);
//		
//		var option_ = document.createElement("option");
//		option_.text = "Please Select Section";
//		option_.value = "";
//		
//		var x_ = document.getElementById("import_section");
//		$('#import_section').empty();
//		x_.add(option_);
//		
//		
//		/* var option2_ = document.createElement("option");
//		option2_.text = "Please Select Section";
//		option2_.value = "";
//		
//		var x2_ = document.getElementById("import_section_for_excel");
//		$('#import_section_for_excel').empty();
//		x2_.add(option2_); */
//		
//		var n;
//		for( n = 1 ; n <= nextSectionId; n++)
//		{
//			let section_id = $("#section_"+n+"_id").val();
//			let section_name  = $("#section_"+n+"_title").text();
//			if(section_id != '' && section_name != '')
//			{
//				var option = document.createElement("option");
//				option.text = section_name;
//				option.value = section_id;
//				
//				if(n == 1)
//				{
//				    option.selected  = "selected";
//				}
//				
//				y.add(option);
//				
//				var option_ = document.createElement("option");
//				option_.text = section_name;
//				option_.value = section_id;
//				
//				if(n == 1)
//				{
//				    option_.selected  = "selected";
//				}
//				
//				x_.add(option_);
//				
//				/* var option2_ = document.createElement("option");
//				option2_.text = section_name;
//				option2_.value = section_id;
//				
//				x2_.add(option2_); */
//				
//				
//			}
//		}
//        
//   }

//    function remove_from_import_section(id) {
//        $("#import_section").find(`[value="${id}"]`).remove();
//    }
	
	
//	async function processExcelQuestions() {
//        if($("#upload_excel").val()) {
//            $("#excel_file_error").hide();
//            $("#div_excel_errors").hide();
//            $("#excel_modal_btn").attr("disabled", true);
//			
//			let check_test_id = $("#test_id").val();
//			if(check_test_id == '')
//			{
//				let add_section = await editSectionName(1);
//			}
//		
//            let result = await uploadExcelFile();
//			result = JSON.parse(result);
//            if(result.err) {
//                $("#excel_modal_btn").removeAttr("disabled");
//                $("#div_excel_errors").show();
//                $("#excel_errors").html(result.errors);
//            } else {
//                $("#go-back-to-text").attr("onclick", "goBacktoExcel()");
//                pdfQuestionstoParse=[];
//                for(let i=0;i<result.questions.length;i++) {
//                    if($("#upload_excel_lang").val()=="english") {
//                        pdfQuestionstoParse.push({id:i, imgs:[result.questions[i]]});
//                    }
//                    else if($("#upload_excel_lang").val()=="krutidev") {
//                        let uni_op = convert_kruti_to_unicode(result.questions[i])
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    } 
//                    else if($("#upload_excel_lang").val()=="4c") {
//                        let uni_op = convert_gandhi_to_unicode(result.questions[i])
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    } 
//                    else if($("#upload_excel_lang").val()=="chanakya") {
//                        let uni_op = convert_chanakya_to_unicode(result.questions[i])
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    } 
//                    else if($("#upload_excel_lang").val()=="nudi") {
//                        let uni_op = convert_nudi_to_unicode(result.questions[i]);
//                        uni_op = convert_to_english_numbers(uni_op);
//                        pdfQuestionstoParse.push({id:i, imgs:[uni_op]});
//                    }
//                }  
//                $("#excel_modal_btn").removeAttr("disabled");
//                goFrontoText("excel");
//            }
//        } else {
//            $("#excel_modal_btn").removeAttr("disabled");
//            $("#excel_file_error").show();
//            $("#div_excel_errors").hide();
//        }
//    }
//
//    async function uploadExcelFile() {
//		
//        return new Promise((resolve, reject) => {
//            var formData = new FormData();
//			let test_id = document.getElementById("test_id").value;
//            let id = document.getElementById("upload_excel");
//            formData.append("file", id.files[0]);
//			formData.append("test_id", test_id);
//			formData.append("data",JSON.stringify({data:syncData}));
//			
//            $.ajax({
//                url: "parse_excel.php",
//                type: "POST",
//                data: formData,
//                headers: {"adstrackid": $("#adstrackid").html()},
//                processData: false,
//                contentType: false,
//                success: function (response) {
//                    resolve(response);
//                },
//                error: function (response) {
//                    resolve({error:"Please check your internet connection"})
//                },
//            });
//			
//			
//			
//        });
//    }
//	
//	function goBacktoExcel() {
//        $("#importQuestionPDF2").modal("hide");
//        setTimeout(function () {
//            $("#importQuestionExcel").modal("show");
//        }, 500);
//    }
//	
//	function goFrontoText(from) {
//        if(from=="text") {
//            $("#importQuestionText").modal("hide");
//        } else if(from=="excel") {
//            $("#importQuestionExcel").modal("hide");
//        } else if(from=="docx") {
//            $("#importQuestionDocx").modal("hide");
//        }
//        setTimeout(function () {
//                $("#importQuestionPDF2").modal("show");
//        }, 500); 
//        addPDFHTML(pdfQuestionstoParse);
//    }

/*End : PDFImporter*/
</script>