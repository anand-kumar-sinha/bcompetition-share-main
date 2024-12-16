<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');      
    }
      
   
    public function test_list() {

        
        extract($this->input->post()); // convert array to variable -- php function //
      
        if(isset($category_id) && isset($auth_token) && isset($auth_id)){
           
            $studentData['tableName'] = "student";  
            $studentData['condtion'] = "id = ".$auth_id." AND device_id ='".$auth_token."'";
            $StudentDataCount = $this->SystemModel->tableRowCount($studentData); 
        

            if($StudentDataCount > 0){ 
                $StudentDetail = $this->SystemModel->getOne($studentData);  
 
//                $CategoryTestData['tableName'] = "apply_test";  
//                $CategoryTestData['condtion'] = "category_id = ".$category_id;
//                $CategoryTestCount = $this->SystemModel->tableRowCount($CategoryTestData); 
//                 
//                if($CategoryTestCount > 0){
//                    $CategoryTestList = $this->SystemModel->getAll($CategoryTestData); 
                $Today = date("Y-m-d");
                $TodayTime = date("h:i:s");
               // $condition1 = " AND te.is_deleted = 0";
                if($status !=''){
                    if($status == 0){
                        $condition1 = " AND ap.publish_at > '".$Today."'";
                        $testCondition = '';
                    } else if($status == 1){
                        $condition1 = " AND ap.publish_at = '".$Today."'";
                        $testCondition = '';
                        
                    } else if($status == 2){
                        $condition1 = " AND ap.publish_at < '".$Today."'";
                        $testCondition = '';
                    }  
                } else {
                   $condition1 = "";  
                //    $testCondition = " AND ap.status = 'Published & On-Going'";
                $testCondition = "";
                }
                $testCondition = " AND ap.status != 'Deleted'";
                 
                
                    if($category_id == 0) {
                        $PublishOnGoingTestData['select'] = 'te.*, ap.*,cat.category_name';
                        $PublishOnGoingTestData['tableName'] = "test te"; 
                        $PublishOnGoingTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id');
                        $PublishOnGoingTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id');
                        $PublishOnGoingTestData['condtion'] = "1=1 ".$condition1." AND te.is_deleted = 0";
                        $AllPublishOnGoingTest  = $this->SystemModel->getAll($PublishOnGoingTestData);
                    } else {
                        $PublishOnGoingTestData['select'] = 'te.*,ap.*, cat.category_name';
                        $PublishOnGoingTestData['tableName'] = "test te"; 
                        $PublishOnGoingTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id');
                        $PublishOnGoingTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id');
                        $PublishOnGoingTestData['condtion'] = "ap.category_id=".$category_id.$condition1." AND te.is_deleted = 0 ".$testCondition."";
                        $AllPublishOnGoingTest  = $this->SystemModel->getAll($PublishOnGoingTestData); 
                    }

                  
                
                    if(count($AllPublishOnGoingTest) > 0 ){
                        $PublishOnGoingTestDatatempArray = array();
                       
                        if($is_subscription == 1){ 
                            foreach ($AllPublishOnGoingTest as $Pkey => $Pvalue) {

                                $checkSub = $this->SystemModel->checkSub($Pvalue->test_id, $auth_id);
                               
                                if(empty($checkSub)){
                                    unset($AllPublishOnGoingTest[$Pkey]);
                                }
                            }
                        }
                        
                       
                        $i=0;
                        foreach ($AllPublishOnGoingTest as $_AllPublishOnGoingTest){

                          if($_AllPublishOnGoingTest->status != "Un-Published" ){

                         

                           

                            $student_test_subscriptionData['tableName'] = "student_test_subscription";  
                            $student_test_subscriptionData['condtion'] = "status = 1 AND student_id = ".$auth_id." AND test_id =".$_AllPublishOnGoingTest->test_id;
                            $student_test_subscriptionCount = $this->SystemModel->tableRowCount($student_test_subscriptionData); 

                            $SlotData['tableName'] = "student_test_subscription";  
                            $SlotData['condtion'] = "test_id =".$_AllPublishOnGoingTest->test_id;
                            $SlotDataCount = $this->SystemModel->tableRowCount($SlotData); 

                            if($student_test_subscriptionCount !=0){
                                $_AllPublishOnGoingTest->is_subscription = true;
                            } else {
                                $_AllPublishOnGoingTest->is_subscription = false;
                            }

                            $remain_number_of_slot = $_AllPublishOnGoingTest->number_of_slot - $SlotDataCount;
                            $_AllPublishOnGoingTest->remain_number_of_slot = (string)$remain_number_of_slot;


                            $student_attempt_testData['tableName'] = "student_attempt_test";  
                            $student_attempt_testData['condtion'] = "student_id = ".$auth_id." AND test_id =".$_AllPublishOnGoingTest->test_id." AND category_id=".$_AllPublishOnGoingTest->category_id;
                            $student_attempt_testDataCount = $this->SystemModel->tableRowCount($student_attempt_testData); 

                            if($student_attempt_testDataCount !=0){
                                $_AllPublishOnGoingTest->is_attempt_test = true;
                            } else {
                                $_AllPublishOnGoingTest->is_attempt_test = false;
                            }

//                            if($_AllPublishOnGoingTest->number_of_attempts !=0 ){
//                                if($student_attempt_testDataCount <= $_AllPublishOnGoingTest->number_of_attempts){
//                                    $_AllPublishOnGoingTest->is_attempt_test = false;
//                                    if($_AllPublishOnGoingTest->number_of_attempts !=0) {
//                                        $remain_number_of_attempts = $_AllPublishOnGoingTest->number_of_attempts - $student_attempt_testDataCount;
//                                        $_AllPublishOnGoingTest->remain_number_of_attempts = (string)$remain_number_of_attempts;
//                                    } else {
//                                        $_AllPublishOnGoingTest->remain_number_of_attempts = 'unlimited';
//                                    }
//                                } else {
//                                    $_AllPublishOnGoingTest->is_attempt_test = true;
//                                    $_AllPublishOnGoingTest->remain_number_of_attempts = "0";
//                                }
//                            } else {
//                                $_AllPublishOnGoingTest->is_attempt_test = false;
////                                $_AllPublishOnGoingTest->remain_number_of_attempts = 'unlimited';
//                            }

                            $PubOnGoingQue['select'] = 'tsq.*, SUM(marking_correct) as TotalMarks';
                            $PubOnGoingQue['tableName'] = "test_section_question tsq";
                            $PubOnGoingQue['condtion'] = "tsq.test_id=".$_AllPublishOnGoingTest->test_id;
                            $TotalQuestion = $this->SystemModel->getAll($PubOnGoingQue);

                            $totalPubOnGoingQue['select'] = 'tsq.*, ';
                            $totalPubOnGoingQue['tableName'] = "test_section_question tsq";
                            $totalPubOnGoingQue['condtion'] = "tsq.test_id=".$_AllPublishOnGoingTest->test_id;
                            $TotalQuestionCount = $this->SystemModel->getAll($totalPubOnGoingQue);

                            $_AllPublishOnGoingTest->TotalQuestion = (string)count($TotalQuestionCount);
                            $_AllPublishOnGoingTest->TotalMarks = $TotalQuestion[0]->TotalMarks;
                            $PublishOnGoingTestDatatempArray[$i] = $_AllPublishOnGoingTest;  

                            $TestCashPrize['tableName'] = "test_cash_prize";
                            $TestCashPrize['condtion'] = "test_id=".$_AllPublishOnGoingTest->test_id;
                            $AllCashPriceRank = $this->SystemModel->getAll($TestCashPrize);
                            $PublishOnGoingTestDatatempArray[$i]->cash_price_rank = $AllCashPriceRank;

                            $i++;
                        }

                        }
                        $AllPublishOnGoingTest = $PublishOnGoingTestDatatempArray;

                        $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'Test Available',
                            'data'      => $AllPublishOnGoingTest
                        );
                    
                } else {
                    $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Test Available',
                        'data'      => null
                    );
                }
            } else {
                $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Student Available',
                    'data'      => null
                );
            }
        } else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please fill all required field',
                   'data'      => Null
            );
        }
        
        
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function test_question_list(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($test_id)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                   
                $TestmodelData['tableName'] = "test";        
                $TestmodelData['condtion'] = "id=" . $test_id;
                $TestmodelDataresult = $this->SystemModel->tableRowCount($TestmodelData);
                if($TestmodelDataresult > 0){
                    
                        $TestDetails = $this->SystemModel->getOne($TestmodelData);
                       
                        $TestSectionmodelData['tableName'] = "test_section";        
                        $TestSectionmodelData['condtion'] = "test_id=" . $test_id." AND is_deleted=1";
                        $TestSectionModelDataResult = $this->SystemModel->tableRowCount($TestSectionmodelData);
                        if($TestSectionModelDataResult > 0){
                            $AllTestSection = $this->SystemModel->getAll($TestSectionmodelData);
                            $tempArray = array();
                            $i=0;
                            
                            $tempArray['test_detail'] = array($TestDetails);
                            foreach ($AllTestSection as $_AllTestSection){
                                $tempArray['section_list'][$i] = (array)$_AllTestSection;  
                                $TestSectionQueData['tableName'] = "test_section_question";
                                $TestSectionQueData['condtion'] = "section_id=".$_AllTestSection->id." AND is_deleted=1";
                                $QuestionList  = $this->SystemModel->getAll($TestSectionQueData); 
                                $TempQuestionArray = array();
                                    $j=0;
                                    foreach ($QuestionList as $_QuestionList){
                                        $TempQuestionArray[$j]['id'] = $_QuestionList->id;
//                                        $TempQuestionArray->question_type = $_QuestionList->question_type;
                                        if($_QuestionList->ans_type == "mcqs"){
                                             $TempQuestionArray[$j]['correct_ans'] = $_QuestionList->radio_correct_ans;
                                            if($_QuestionList->choice_count == 1){
//                                                $TempQuestionArray[$j]['ans_a'] = $_QuestionList->radio_ans_a;
                                                $TempQuestionArray[$j]['ans'][] = array(
                                                    'ans_a'=>$_QuestionList->radio_ans_a,
                                                    'ans_b'=>'',
                                                    'ans_c'=>'',
                                                    'ans_d'=>'',
                                                    'ans_f'=>'',
                                                    'ans_e'=>'',
                                                );
                                            } else if($_QuestionList->choice_count == 2){
//                                                $TempQuestionArray[$j]['ans_a'] = $_QuestionList->radio_ans_a;
//                                                $TempQuestionArray[$j]['ans_b'] = $_QuestionList->radio_ans_b;
                                                $TempQuestionArray[$j]['ans'][] = array(
                                                    'ans_a'=>$_QuestionList->radio_ans_a,
                                                    'ans_b'=>$_QuestionList->radio_ans_b,
                                                    'ans_c'=>'',
                                                    'ans_d'=>'',
                                                    'ans_f'=>'',
                                                    'ans_e'=>'',
                                                );
                                            } else if($_QuestionList->choice_count == 3){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->radio_ans_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->radio_ans_b;
//                                                  $TempQuestionArray[$j]['ans_c'] = $_QuestionList->radio_ans_c;
                                                  $TempQuestionArray[$j]['ans'][] = array(
                                                    'ans_a'=>$_QuestionList->radio_ans_a,
                                                    'ans_b'=>$_QuestionList->radio_ans_b,
                                                    'ans_c'=>$_QuestionList->radio_ans_c,
                                                    'ans_d'=>'',
                                                    'ans_f'=>'',
                                                    'ans_e'=>'',
                                                );
                                            } else if($_QuestionList->choice_count == 4){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->radio_ans_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->radio_ans_b;
//                                                  $TempQuestionArray[$j]['ans_c'] = $_QuestionList->radio_ans_c;
//                                                  $TempQuestionArray[$j]['ans_d'] = $_QuestionList->radio_ans_d;
                                                  $TempQuestionArray[$j]['ans'][] = array(
                                                    'ans_a'=>$_QuestionList->radio_ans_a,
                                                    'ans_b'=>$_QuestionList->radio_ans_b,
                                                    'ans_c'=>$_QuestionList->radio_ans_c,
                                                    'ans_d'=>$_QuestionList->radio_ans_d,
                                                    'ans_f'=>'',
                                                    'ans_e'=>'',
                                                );
                                            } else if($_QuestionList->choice_count == 5){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->radio_ans_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->radio_ans_b;
//                                                  $TempQuestionArray[$j]['ans_c'] = $_QuestionList->radio_ans_c;
//                                                  $TempQuestionArray[$j]['ans_d'] = $_QuestionList->radio_ans_d;
//                                                  $TempQuestionArray[$j]['ans_e'] = $_QuestionList->radio_ans_e;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->radio_ans_a,
                                                        'ans_b'=>$_QuestionList->radio_ans_b,
                                                        'ans_c'=>$_QuestionList->radio_ans_c,
                                                        'ans_d'=>$_QuestionList->radio_ans_d,
                                                        'ans_e'=>$_QuestionList->radio_ans_e,
                                                    );
                                            } else if($_QuestionList->choice_count == 6){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->radio_ans_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->radio_ans_b;
//                                                  $TempQuestionArray[$j]['ans_c'] = $_QuestionList->radio_ans_c;
//                                                  $TempQuestionArray[$j]['ans_d'] = $_QuestionList->radio_ans_d;
//                                                  $TempQuestionArray[$j]['ans_e'] = $_QuestionList->radio_ans_e;
//                                                  $TempQuestionArray[$j]['ans_f'] = $_QuestionList->radio_ans_f;
                                                  $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->radio_ans_a,
                                                        'ans_b'=>$_QuestionList->radio_ans_b,
                                                        'ans_c'=>$_QuestionList->radio_ans_c,
                                                        'ans_d'=>$_QuestionList->radio_ans_d,
                                                        'ans_f'=>$_QuestionList->radio_ans_e,
                                                        'ans_e'=>$_QuestionList->radio_ans_f,
                                                    );
                                            }
                                            
                                        } else if($_QuestionList->ans_type == "mcqm"){
                                            $TempQuestionArray[$j]['correct_ans'] = $_QuestionList->correct_ans_chk;
                                            if($_QuestionList->choice_count == 1){
//                                                $TempQuestionArray[$j]['ans_a'] = $_QuestionList->chk_multi_answer_a;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                    'ans_a'=>$_QuestionList->chk_multi_answer_a,
                                                    'ans_b'=>'',
                                                    'ans_c'=>'',
                                                    'ans_d'=>'',
                                                    'ans_f'=>'',
                                                    'ans_e'=>'',
                                                );
                                            } else if($_QuestionList->choice_count == 2){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->chk_multi_answer_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->chk_multi_answer_b;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->chk_multi_answer_a,
                                                        'ans_b'=>$_QuestionList->chk_multi_answer_b,
                                                        'ans_c'=>'',
                                                        'ans_d'=>'',
                                                        'ans_f'=>'',
                                                        'ans_e'=>'',
                                                    );
                                            } else if($_QuestionList->choice_count == 3){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->chk_multi_answer_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->chk_multi_answer_b;
//                                                  $TempQuestionArray[$j]['ans_c'] = $_QuestionList->chk_multi_answer_c;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->chk_multi_answer_a,
                                                        'ans_b'=>$_QuestionList->chk_multi_answer_b,
                                                        'ans_c'=>$_QuestionList->chk_multi_answer_c,
                                                        'ans_d'=>'',
                                                        'ans_f'=>'',
                                                        'ans_e'=>'',
                                                    );
                                            } else if($_QuestionList->choice_count == 4){
//                                                  $TempQuestionArray[$j]['ans_a'] = $_QuestionList->chk_multi_answer_a;
//                                                  $TempQuestionArray[$j]['ans_b'] = $_QuestionList->chk_multi_answer_b;
//                                                  $TempQuestionArray[$j]['ans_c'] = $_QuestionList->chk_multi_answer_c;
//                                                  $TempQuestionArray[$j]['ans_d'] = $_QuestionList->chk_multi_answer_d;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->chk_multi_answer_a,
                                                        'ans_b'=>$_QuestionList->chk_multi_answer_b,
                                                        'ans_c'=>$_QuestionList->chk_multi_answer_c,
                                                        'ans_d'=>$_QuestionList->chk_multi_answer_d,
                                                        'ans_f'=>'',
                                                        'ans_e'=>'',
                                                    );
                                            } else if($_QuestionList->choice_count == 5){
//                                                    $TempQuestionArray[$j]['ans_a'] = $_QuestionList->chk_multi_answer_a;
//                                                    $TempQuestionArray[$j]['ans_c'] = $_QuestionList->chk_multi_answer_b;
//                                                    $TempQuestionArray[$j]['ans_c'] = $_QuestionList->chk_multi_answer_c;
//                                                    $TempQuestionArray[$j]['ans_d'] = $_QuestionList->chk_multi_answer_d;
//                                                    $TempQuestionArray[$j]['ans_e'] = $_QuestionList->chk_multi_answer_e;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->chk_multi_answer_a,
                                                        'ans_b'=>$_QuestionList->chk_multi_answer_b,
                                                        'ans_c'=>$_QuestionList->chk_multi_answer_c,
                                                        'ans_d'=>$_QuestionList->chk_multi_answer_d,
                                                        'ans_f'=>$_QuestionList->chk_multi_answer_e,
                                                        'ans_e'=>'',
                                                    );
                                            } else if($_QuestionList->choice_count == 6){
                                                    $TempQuestionArray[$j]['ans_a'] = $_QuestionList->chk_multi_answer_a;
                                                    $TempQuestionArray[$j]['ans_b'] = $_QuestionList->chk_multi_answer_b;
                                                    $TempQuestionArray[$j]['ans_c'] = $_QuestionList->chk_multi_answer_c;
                                                    $TempQuestionArray[$j]['ans_d'] = $_QuestionList->chk_multi_answer_d;
                                                    $TempQuestionArray[$j]['ans_e'] = $_QuestionList->chk_multi_answer_e;
                                                    $TempQuestionArray[$j]['ans_f'] = $_QuestionList->chk_multi_answer_f;
                                                    $TempQuestionArray[$j]['ans'][] = array(
                                                        'ans_a'=>$_QuestionList->chk_multi_answer_a,
                                                        'ans_b'=>$_QuestionList->chk_multi_answer_b,
                                                        'ans_c'=>$_QuestionList->chk_multi_answer_c,
                                                        'ans_d'=>$_QuestionList->chk_multi_answer_d,
                                                        'ans_f'=>$_QuestionList->chk_multi_answer_e,
                                                        'ans_e'=>$_QuestionList->chk_multi_answer_f,
                                                    );
                                            }
                                        } else {
                                            $TempQuestionArray[$j]['new_a_fill'] = $_QuestionList->new_a_fill;
                                            $TempQuestionArray[$j]['correct_ans'] = $_QuestionList->correct_ans_fill;
                                            $TempQuestionArray[$j]['ans'] = array( );
                                        }
                                        
                                        $TempQuestionArray[$j]['question_type'] = $_QuestionList->question_type;
                                        $TempQuestionArray[$j]['question'] = $_QuestionList->question;
                                        $TempQuestionArray[$j]['ans_type'] = $_QuestionList->ans_type;
                                        $TempQuestionArray[$j]['language'] = $_QuestionList->language;
                                        $TempQuestionArray[$j]['marking_correct'] = $_QuestionList->marking_correct;
                                        $TempQuestionArray[$j]['marking_incorrect'] = $_QuestionList->marking_incorrect;
                                        $TempQuestionArray[$j]['answer_description'] = $_QuestionList->answer_description;
                                        $TempQuestionArray[$j]['choice_count'] = $_QuestionList->choice_count;
//                                        array_push($TempQuestionArray, $_QuestionList->question_type);
                                        $j++;
                                    }
                                
                                $tempArray['section_list'][$i]['question_list'] = $TempQuestionArray;
                                $j++;
                                $i++;
                            }
                        } else {
                            $tempArray['test_detail'] = array($TestDetails);
                            $tempArray['section_list'][$i]= array();
                            $tempArray['section_list'][$i]['question_list'] = array();
                        }
                        
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Test Question List',
                        'data'      => $tempArray
                    );
                } else {
                        
                    $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Test Available',
                        'data'      => null
                    );
                }

            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Student Available',
                    'data'      => null
                );
            }
        } else {
            $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'Please Fill all require field',
                    'data'      => null
                );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    
     public function student_attempt_test(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($test_id) && isset($question_id) && isset($ans) && isset($total_time)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."'  AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                $StudentAttemptTestData['tableName'] = "student_attempt_test";  
                $StudentAttemptTestData['data'] = array(     
                                                    'student_id'    => $auth_id,
                                                    'test_id'    => $test_id, 
                                                    'category_id'    => $category_id, 
                                                    'total_time'    => $total_time, 
                                                    'created'  => date('Y-m-d h:i:s'),

                );
                $StudentAttemptTestDataresult = $this->SystemModel->insertData($StudentAttemptTestData);
                $attempt_test_id = $this->SystemModel->lastInsertId();

                $StudentAttemptTestQuestionAnsData['tableName'] = "student_attempt_test_question_ans";  
                $question_idArray = explode(',', $question_id);
                $ansArray = explode(',', $ans);
                foreach ($question_idArray as $key=>$_question_idArray){
                    $StudentAttemptTestQuestionAnsData['data'] = array(     
                                                    'attempt_test_id'    => $attempt_test_id,
                                                    'question_id'    => $_question_idArray,
                                                    'ans'    => $ansArray[$key],
                                                    'created'  => date('Y-m-d h:i:s'),

                    );
                    $StudentAttemptTestQuestionAnsresult = $this->SystemModel->insertData($StudentAttemptTestQuestionAnsData);
                    $transaction_id = $this->SystemModel->lastInsertId();
                }
                 
                /* Start: Auto Result Publist */
                $ApplyTestCatData['tableName'] = "apply_test";
                $ApplyTestCatData['condtion'] = "test_id=" . $test_id." AND category_id=".$category_id;
                $ApplyTestCatDataResult = $this->SystemModel->tableRowCount($ApplyTestCatData);
                if($ApplyTestCatDataResult > 0){ 
                     $this->test_winer_list_auto();
                    $ApplyTestCatDetail = $this->SystemModel->getOne($ApplyTestCatData);
                    if($ApplyTestCatDetail->result_auto_publish == '1'){
                        $TestData['tableName'] = "test";        
                        $TestData['condtion'] = "id=" . $test_id;
                        $TestDetail = $this->SystemModel->getOne($TestData);

                                $test_cash_prizeData['tableName'] = "test_cash_prize";        
                                $test_cash_prizeData['condtion'] = "test_id=" . $test_id;
                                $test_cash_prizeresult = $this->SystemModel->tableRowCount($test_cash_prizeData);


                                $StudentAttemptTestData1 = $this->SystemModel->directQuery('SELECT `sat`.*, `st`.`name` as `student_name`
                                                                                            FROM `student_attempt_test` `sat`
                                                                                            LEFT JOIN `student` `st` ON `st`.`id`=`sat`.`student_id`
                                                                                            WHERE `sat`.`test_id` = '.$test_id.' AND `sat`.`category_id` = '.$category_id.'
                                                                                            ORDER BY `sat`.`get_mark` DESC, `sat`.`total_time` ASC');  


                                $tempArray = array();
                                $i=0;
                                $UniqueI=0;
                                foreach ($StudentAttemptTestData1 as $_StudentAttemptTestData){ $UniqueI++;

                                    $_StudentAttemptTestData['rank'] = $UniqueI;
                                    $_StudentAttemptTestData['cash_prize'] = 0;
                                    if($test_cash_prizeresult > 0){
                                        $test_cash_prizeList = $this->SystemModel->getAll($test_cash_prizeData);

                                        foreach ($test_cash_prizeList as $_test_cash_prizeList){

                                            $MultipleRank = explode('-',$_test_cash_prizeList->cash_prize_rank);
                                            if(isset($MultipleRank[1])){
                                                if($UniqueI  <= $MultipleRank[1] && $MultipleRank[0] <= $UniqueI){
                                                    $_test_cash_prizeList->cash_prize_rank.'--'.$_test_cash_prizeList->cash_prize_amount;
                                                    $_StudentAttemptTestData['cash_prize'] = $_test_cash_prizeList->cash_prize_amount;
                                                } 
                                            } else if($_test_cash_prizeList->cash_prize_rank == $UniqueI){
        //                                        echo $_test_cash_prizeList->cash_prize_rank.'--'.$_test_cash_prizeList->cash_prize_amount;
                                                $_StudentAttemptTestData['cash_prize'] = $_test_cash_prizeList->cash_prize_amount;
                                            } else {
        //                                        $_StudentAttemptTestData['cash_prize'] = 0;
                                            }
        //                                      echo $cash_prize;
        //                                      echo "<br>";
                                        }

                                    }

                                    $tempArray[$i] = $_StudentAttemptTestData;  
                                    $i++;
                                }

                                foreach ($tempArray as $_tempArray){
                                    $Update_student_attempt_testData['tableName'] = "student_attempt_test";    
                                    $Update_student_attempt_testData['data'] = array(  
                                                                'cash_prize'    => $_tempArray['cash_prize'],
                                                                'rank'    => $_tempArray['rank'],
                                            );
                                    $Update_student_attempt_testData['condtion'] = "id=" . $_tempArray['id'];
                                    $result213 = $this->SystemModel->updateData($Update_student_attempt_testData);
                                }
                        $ApplyTestCatData['tableName'] = "apply_test";
                        $ApplyTestCatData['data'] = array( 
                            'result_publish' => "true",
                            'updated' => date('Y-m-d H:i:s')
                        );
                        $ApplyTestCatData['condtion'] = "test_id=" . $test_id." AND category_id=".$category_id;
                        $result = $this->SystemModel->updateData($ApplyTestCatData);
                    }
                }
                /* End: Auto Result Publist */
                
                
                
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Test Submitted Successfully',
                    'data'      => array($CustomerOldDetail)
                );

            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Student Available',
                    'data'      => null
                );
            }
        } else {
            $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'Please Fill all require field',
                    'data'      => null
                );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function student_test_subscription(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($test_id) && isset($transaction_number) && isset($join_amount)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                
                if($payment_mode == "Online"){
                    $StudentTestSubscriptionData['tableName'] = "student_test_subscription";   
                $StudentTestSubscriptionData['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'test_id'    => $test_id,
                                                'transaction_number'    => $transaction_number,
                                                'payment_type'    => "Online",
                                                'join_amount'    => $join_amount,
                                                'created'  => date('Y-m-d h:i:s'),
                                                'create_date'  => date('Y-m-d')

                );
                $result = $this->SystemModel->insertData($StudentTestSubscriptionData);
                $transaction_id = $this->SystemModel->lastInsertId();

                $StudentTestSubscriptionData['condtion'] = "id=" . $transaction_id;
                $StudentTestSubscription = $this->SystemModel->getOne($StudentTestSubscriptionData);
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Subscribe Sucessfully',
                    'data'      => array($StudentTestSubscription)
                );

                }else{

                    $getLeve1StatusInfo = $this->SystemModel->getLeve1StatusInfo($auth_id);
                    if($join_amount <= $getLeve1StatusInfo->wallet_amount){


                    $StudentTestSubscriptionData['tableName'] = "student_test_subscription";   
                $StudentTestSubscriptionData['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'test_id'    => $test_id,
                                                'transaction_number'    => $transaction_number,
                                                'payment_type'    => "Wallet",
                                                'join_amount'    => $join_amount,
                                                'created'  => date('Y-m-d h:i:s'),
                                                'create_date'  => date('Y-m-d')

                );
                $result = $this->SystemModel->insertData($StudentTestSubscriptionData);
                $transaction_id = $this->SystemModel->lastInsertId();

                  $modelDatass['tableName'] = "test";
                $modelDatass['condtion']  = "id=" . $test_id . "";
                $UserDetailss = $this->SystemModel->getOne($modelDatass);


                 $studentinfo['tableName'] = "student";
                $studentinfo['condtion']  = "id=" . $auth_id . "";
                $studentinfodata = $this->SystemModel->getOne($studentinfo);
                $finalStudentAMount = $studentinfodata->wallet_amount - $join_amount;
                 $stuData = ['wallet_amount'=>number_format((float)$finalStudentAMount, 2, '.', '')];
                     $this->SystemModel->updateStudWal($stuData, $auth_id);

                $student_wallet_historyData['tableName'] = "student_wallet_history";   
                $student_wallet_historyData['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'wallet_amount'    => $join_amount,
                                                'transaction_number'    => $UserDetailss->test_title.' - Test',
                                                'old_wallet_amount' => $finalStudentAMount,
                                                'transaction_type'    => "Debit",
                                                'status'    => "Completed",
                                                'created'  => date('Y-m-d h:i:s'),
                                                'create_date'  => date('Y-m-d')

                );
                $result = $this->SystemModel->insertData($student_wallet_historyData);
                $StudentTestSubscriptionData['condtion'] = "id=" . $transaction_id;
                $StudentTestSubscription = $this->SystemModel->getOne($StudentTestSubscriptionData);
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Subscribe Sucessfully',
                    'data'      => array($StudentTestSubscription)
                );

                      }else{
                        $jsonArray = array(
                            'status'    => 0,
                            'message'   => 'Insufficient amount in your wallet, Please top-up your wallet balance',
                            'data'      => null
                        );
                 }

                }


                
                     
                
            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Student Available',
                    'data'      => null
                );
            }
        } else {
            $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'Please Fill all require field',
                    'data'      => null
                );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
   
    
     public function test_winer_list_auto(){
        extract($this->input->post()); // convert array to variable -- php function //
//        if(isset($auth_id) && isset($auth_token)){
            
//            $modelData['tableName'] = "student";        
//            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
//            $result = $this->SystemModel->tableRowCount($modelData);

//            if ($result > 0) {
//                
//                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
//                $TestData['tableName'] = "test";        
//                $TestData['condtion'] = "id=" . $test_id;
//                $Testresult = $this->SystemModel->tableRowCount($TestData);
//                if($Testresult > 0){
//                    $TestDetail = $this->SystemModel->getOne($TestData);
                     
                    $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name';   
                    $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
                    $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
//                    $student_attempt_test_Data['condtion'] = "sat.test_id=" . $test_id. " AND sat.category_id=".$category_id;
                    $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);
                    
//                    $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
//                    $student_attempt_test_Data['condtion'] = "id=".$category_id;
//                    $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);
                     
                    $tempArray = array();
                    $i=0;
                    foreach ($StudentAttemptTestData  as $_StudentAttemptTestData){
                        $tempArray[$i] = (array)$_StudentAttemptTestData;
                        
                        $student_attempt_test_QAData['tableName'] = "student_attempt_test_question_ans ";    
                        $student_attempt_test_QAData['condtion'] = "attempt_test_id=" . $_StudentAttemptTestData->id;
                        $StudentAttemptTestQAData = $this->SystemModel->getAll($student_attempt_test_QAData);
                        $j=0;
                        $totalCorrectMark = 0;
                        $totalInCorrectMark = 0;
                        $totalMark = 0;
                         
                        $TotalCorrenctAns = 0;
                        $TotalWrongAns = 0;
                        $TotalSkippedAns = 0;
                        $TotalMarkForReviewAns = 0;
                        foreach ($StudentAttemptTestQAData as $_StudentAttemptTestQAData) {
                            $tempArray[$i]['student_atempt'][$j] = (array)$_StudentAttemptTestQAData;
                          
                            
                            $test_section_questionData['tableName'] = "test_section_question";        
                            $test_section_questionData['condtion'] = "id=" . $_StudentAttemptTestQAData->question_id;
                            $test_section_questionDetail = $this->SystemModel->getOne($test_section_questionData);
                            
                              $tempArray[$i]['student_atempt'][$j]['marking_correct'] = $test_section_questionDetail->marking_correct;
                              $tempArray[$i]['student_atempt'][$j]['marking_incorrect'] = $test_section_questionDetail->marking_incorrect;
                             
                            $marking_correct = $test_section_questionDetail->marking_correct;
                            $incorrect_marking = $test_section_questionDetail->marking_incorrect;
                            $totalMark = $totalMark + $marking_correct;
                                    
                           
                            
//                            echo $_StudentAttemptTestQAData->ans;
                            if($_StudentAttemptTestQAData->ans !="0" && $_StudentAttemptTestQAData->ans !="1"){
                                 
                                if($test_section_questionDetail->ans_type == "mcqs"){
                                    $correctOption = strtoupper($test_section_questionDetail->radio_correct_ans);
                                    if($correctOption == $_StudentAttemptTestQAData->ans){
                                        $totalCorrectMark = $totalCorrectMark + $marking_correct;
                                        $tempArray[$i]['student_atempt'][$j]['student_ans'] = "true"; 
                                        $TotalCorrenctAns = $TotalCorrenctAns + 1;
                                    } else {
                                        $totalInCorrectMark = $totalInCorrectMark + $incorrect_marking;
                                        $tempArray[$i]['student_atempt'][$j]['student_ans'] = "false";
                                        $TotalWrongAns = $TotalWrongAns + 1;
                                    }
                                    $tempArray[$i]['student_atempt'][$j]['correct_ans'] = $correctOption;
                                } else if($test_section_questionDetail->ans_type == "mcqm"){
                                    $correctOptionTemp = strtoupper($test_section_questionDetail->correct_ans_chk);
                                    $correctOption = str_replace(",","#",$correctOptionTemp);
                                    
                                    if($correctOption == $_StudentAttemptTestQAData->ans){
                                        $totalCorrectMark = $totalCorrectMark + $marking_correct;
                                        $tempArray[$i]['student_atempt'][$j]['student_ans'] = "true";
                                        $TotalCorrenctAns = $TotalCorrenctAns + 1;
                                    } else {
                                        $totalInCorrectMark = $totalInCorrectMark + $incorrect_marking;
                                        $tempArray[$i]['student_atempt'][$j]['student_ans'] = "false";
                                        $TotalWrongAns = $TotalWrongAns + 1; 
                                    }
                                    $tempArray[$i]['student_atempt'][$j]['correct_ans'] = $correctOption;
                                } else {
                                    $correctOption = $test_section_questionDetail->correct_ans_fill;
                                    if($correctOption == $_StudentAttemptTestQAData->ans){
                                        $totalCorrectMark = $totalCorrectMark + $marking_correct;
                                         $tempArray[$i]['student_atempt'][$j]['student_ans'] = "true";
                                         $TotalCorrenctAns = $TotalCorrenctAns + 1;
                                    } else {
                                        $totalInCorrectMark = $totalInCorrectMark + $incorrect_marking;
                                        $tempArray[$i]['student_atempt'][$j]['student_ans'] = "false";
                                        $TotalWrongAns = $TotalWrongAns + 1;
                                    }
                                    $tempArray[$i]['student_atempt'][$j]['correct_ans'] = $correctOption;
                                }
                            } else if($_StudentAttemptTestQAData->ans == 0) {
                                $TotalSkippedAns = $TotalSkippedAns+1;
                            } else if($_StudentAttemptTestQAData->ans == 1) {
                                $TotalMarkForReviewAns = $TotalMarkForReviewAns + 1;
                            }
                            $j++;
                        }
                        
                            
                        $tempArray[$i]['totalCorrectMark'] = $totalCorrectMark;
                        $tempArray[$i]['totalInCorrectMark'] = $totalInCorrectMark;
                        $tempArray[$i]['TotalGetMark'] = $totalCorrectMark - $totalInCorrectMark;
                        $tempArray[$i]['TotalCorrenctAns'] = $TotalCorrenctAns;
                        $tempArray[$i]['TotalWrongAns'] = $TotalWrongAns;
                        $tempArray[$i]['TotalSkippedAns'] = $TotalSkippedAns;
                        $tempArray[$i]['TotalMarkForReviewAns'] = $TotalMarkForReviewAns;
                        $tempArray[$i]['totalMark'] = $totalMark;
                        $i++;
                    }
                     
                    foreach ($tempArray as $_tempArray){
                        $Update_student_attempt_testData['tableName'] = "student_attempt_test";    
                        $Update_student_attempt_testData['data'] = array(  
                                                    'total_correct_mark'    => $_tempArray['totalCorrectMark'],
                                                    'total_in_correct_mark'    => $_tempArray['totalInCorrectMark'],
                                                    'get_mark'    => $_tempArray['TotalGetMark'],
                                                    'total_mark'    => $_tempArray['totalMark'],
                                                    'total_correnct_ans'    => $_tempArray['TotalCorrenctAns'],
                                                    'total_wrong_ans'    => $_tempArray['TotalWrongAns'],
                                                    'total_skipped_ans'    => $_tempArray['TotalSkippedAns'],
                                                    'total_mark_for_review'    => $_tempArray['TotalMarkForReviewAns'],
                                );
                        $Update_student_attempt_testData['condtion'] = "id=" . $_tempArray['id'];
                        $result = $this->SystemModel->updateData($Update_student_attempt_testData);
                    }
                     
                    
//                    $jsonArray = array(
//                        'status'    => 1,
//                        'message'   => 'Subscribe Sucessfully',
//                        'data'      => $tempArray
//                    );
//                } else {
//                    $jsonArray = array(
//                        'status'    => 1,
//                        'message'   => 'No Test Available',
//                        'data'      => null
//                    );
//                }
//            } else {
//
//               $jsonArray = array(
//                    'status'    => 0,
//                    'message'   => 'No Student Available',
//                    'data'      => null
//                );
//            }
//        } else {
//            $jsonArray = array(
//                    'status'    => 0,
//                    'message'   => 'Please Fill all require field',
//                    'data'      => null
//                );
//        }
//        $jsonString = json_encode($jsonArray);
//        echo $jsonString;
//        die;
    }
    
    public function test_winer_list(){
        extract($this->input->post()); // convert array to variable -- php function //
        $this->test_winer_list_auto();
        if(isset($auth_id) && isset($auth_token)){
             
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                
                if($test_id !=0){
                    $TestData['select'] = 'tst.*,at.winer_list_publish, at.result_publish'; 
                    $TestData['tableName'] = "test tst";         
                    $TestData['join'][] = array('tableName' => 'apply_test at', 'condtion' => 'at.test_id=tst.id', 'type'=>'left');
                    $TestData['condtion'] = "tst.id=" . $test_id." AND at.category_id=".$category_id;
                    $Testresult = $this->SystemModel->tableRowCount($TestData);
                    if($Testresult > 0){
                        $TestDetail = $this->SystemModel->getOne($TestData);
                       
                        $test_cash_prizeData['tableName'] = "test_cash_prize";        
                        $test_cash_prizeData['condtion'] = "test_id=" . $test_id;
                        $test_cash_prizeresult = $this->SystemModel->tableRowCount($test_cash_prizeData);


                        $StudentAttemptTestData = $this->SystemModel->directQuery('SELECT `sat`.*, `st`.`name` as `student_name`
                                                                                    FROM `student_attempt_test` `sat`
                                                                                    LEFT JOIN `student` `st` ON `st`.`id`=`sat`.`student_id`
                                                                                    WHERE `sat`.`test_id` = '.$test_id.' AND `sat`.`category_id` = '.$category_id.'
                                                                                    ORDER BY `sat`.`get_mark` DESC, `sat`.`total_time` ASC');  


    //                    $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name';   
    //                    $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
    //                    $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
    //                    $student_attempt_test_Data['condtion'] = "sat.test_id=" . $test_id. " AND sat.category_id=".$category_id." ORDER BY sat.total_correct_mark DESC, sat.total_time ASC";
    ////                    $student_attempt_test_Data['order'][0] = "sat.total_correct_mark";
    ////                    $student_attempt_test_Data['order'][1] = "DESC";
    ////                    $student_attempt_test_Data['order'][2] = "sat.total_time";
    ////                    $student_attempt_test_Data['order'][3] = "ASC";
    //                    $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);
    //                    echo $this->SystemModel->getLastQuery();
                        $tempArray = array();
                        $i=0;
                        $UniqueI=0;
                        foreach ($StudentAttemptTestData as $_StudentAttemptTestData){ $UniqueI++;
                            $_StudentAttemptTestData['rank'] = $UniqueI;
                            $_StudentAttemptTestData['cash_prize'] = 0;
                            if($test_cash_prizeresult > 0){
                                $test_cash_prizeList = $this->SystemModel->getAll($test_cash_prizeData);
                                
                                foreach ($test_cash_prizeList as $_test_cash_prizeList){

                                    $MultipleRank = explode('-',$_test_cash_prizeList->cash_prize_rank);
                                    if(isset($MultipleRank[1])){
                                        if($UniqueI <= $MultipleRank[1] && $MultipleRank[0] <= $UniqueI){
                                            $_StudentAttemptTestData['cash_prize'] = $_test_cash_prizeList->cash_prize_amount;
                                        } 
                                    } else if($_test_cash_prizeList->cash_prize_rank == $UniqueI){
                                        $_StudentAttemptTestData['cash_prize'] = $_test_cash_prizeList->cash_prize_amount;
                                    } else {
//                                        $_StudentAttemptTestData['cash_prize'] = 0;
                                    }
                                }
                            }

                            $tempArray[$i] = $_StudentAttemptTestData;  
                            $i++;
                        }
                       
                        foreach ($tempArray as $_tempArray){
                            $Update_student_attempt_testData['tableName'] = "student_attempt_test";    
                            $Update_student_attempt_testData['data'] = array(  
                                                        'cash_prize'    => $_tempArray['cash_prize'],
                                                        'rank'    => $_tempArray['rank'],
                                    );
//                            $Update_student_attempt_testData['condtion'] = "id=" . $_tempArray['id'];
//                            $result213 = $this->SystemModel->updateData($Update_student_attempt_testData);
                        } 
                        if(count($tempArray) > 0){
                            $TestDetail = array($TestDetail);
                        } else {
                            $TestDetail = array();
                        }
                        $data['test_detail'] = $TestDetail;
                        $data['student_detail'] = (array)$tempArray;
                        $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'Student Winer List',
                            'data'      => array($data)
                        );
                    } else {
                        $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'No Test Available',
                            'data'      => null
                        );
                    }
                } else {
                    $TestData['select'] = 'tst.*,at.winer_list_publish, at.result_publish'; 
                    $TestData['tableName'] = "test tst";         
                    $TestData['join'][] = array('tableName' => 'apply_test at', 'condtion' => 'at.test_id=tst.id', 'type'=>'left');
                    $TestData['condtion'] = "tst.status='Created' AND at.category_id=".$category_id;
//                    $TestData['tableName'] = "test";        
//                    $TestData['condtion'] = "status='Created'";
                    $TestDetail = $this->SystemModel->getAll($TestData);
                   
                    $TempArrayTest = array();
                    $j = 0;
                    foreach ($TestDetail as $_TestDetail){
                        if($_TestDetail->result_publish == "true"){

                       
                        $test_cash_prizeData['tableName'] = "test_cash_prize";        
                        $test_cash_prizeData['condtion'] = "test_id=" . $_TestDetail->id;
                        $test_cash_prizeresult = $this->SystemModel->tableRowCount($test_cash_prizeData);


                        $StudentAttemptTestData = $this->SystemModel->directQuery('SELECT `sat`.*, `st`.`name` as `student_name`
                                                                                    FROM `student_attempt_test` `sat`
                                                                                    LEFT JOIN `student` `st` ON `st`.`id`=`sat`.`student_id`
                                                                                    WHERE `sat`.`test_id` = '.$_TestDetail->id.' AND `sat`.`category_id` = '.$category_id.'
                                                                                    ORDER BY `sat`.`get_mark` DESC, `sat`.`total_time` ASC');  


    //                    $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name';   
    //                    $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
    //                    $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
    //                    $student_attempt_test_Data['condtion'] = "sat.test_id=" . $test_id. " AND sat.category_id=".$category_id." ORDER BY sat.total_correct_mark DESC, sat.total_time ASC";
    ////                    $student_attempt_test_Data['order'][0] = "sat.total_correct_mark";
    ////                    $student_attempt_test_Data['order'][1] = "DESC";
    ////                    $student_attempt_test_Data['order'][2] = "sat.total_time";
    ////                    $student_attempt_test_Data['order'][3] = "ASC";
    //                    $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);
    //                    echo $this->SystemModel->getLastQuery();
                        $tempArray = array();
                        $i=0;
                        $UniqueI=0;
                        foreach ($StudentAttemptTestData as $_StudentAttemptTestData){ $UniqueI++;
                            $_StudentAttemptTestData['rank'] = $UniqueI;
                            $_StudentAttemptTestData['cash_prize'] = 0;
                            if($test_cash_prizeresult > 0){
                                $test_cash_prizeList = $this->SystemModel->getAll($test_cash_prizeData);
                                foreach ($test_cash_prizeList as $_test_cash_prizeList){

                                    $MultipleRank = explode('-',$_test_cash_prizeList->cash_prize_rank);
                                    if(isset($MultipleRank[1])){
                                        if($UniqueI <= $MultipleRank[1] && $MultipleRank[0] <= $UniqueI){
                                            $_StudentAttemptTestData['cash_prize'] = $_test_cash_prizeList->cash_prize_amount;
                                        } 
                                    } else if($_test_cash_prizeList->cash_prize_rank == $UniqueI){
                                        $_StudentAttemptTestData['cash_prize'] = $_test_cash_prizeList->cash_prize_amount;
                                    } else {
//                                        $_StudentAttemptTestData['cash_prize'] = 0;
                                    }
                                }
                            }

                            $tempArray[$i] = $_StudentAttemptTestData;  
                            $i++;
                        }

                        foreach ($tempArray as $_tempArray){
                            $Update_student_attempt_testData['tableName'] = "student_attempt_test";    
                            $Update_student_attempt_testData['data'] = array(  
                                                        'cash_prize'    => $_tempArray['cash_prize'],
                                                        'rank'    => $_tempArray['rank'],
                                    );
//                            $Update_student_attempt_testData['condtion'] = "id=" . $_tempArray['id'];
//                            $result213 = $this->SystemModel->updateData($Update_student_attempt_testData);
                        }
                        if(count($tempArray) > 0){
                            $data[$j]['test_detail'] = array($_TestDetail);
                            $data[$j]['student_detail'] = (array)$tempArray;
                        } else {
                            $data[$j]['test_detail'] = array();
                            $data[$j]['student_detail'] = array();
                        }
                        $j++;
                        }

                    }
                    
                    
                        $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'Student Winer List',
                            'data'      => $data
                        );
                }
            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Student Available',
                    'data'      => null
                );
            }
        } else {
            $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'Please Fill all require field',
                    'data'      => null
                );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    

    
}

