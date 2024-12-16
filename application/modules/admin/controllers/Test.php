<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');


        $adminData = $this->session->userdata('adminData');
        if (!isset($adminData)) {
            redirect('admin/Login');
        }
    }

    public function index()
    {
        $Today = date('Y-m-d');
        
        $CreatedTestData['tableName'] = "test";
        $CreatedTestData['condtion'] = "status='Created'";
        $AllCreatedTest = $this->SystemModel->getAll($CreatedTestData);
        
        $AllCreatedTesttempArray = new stdClass;
        $i=0;
        foreach ($AllCreatedTest as $_AllCreatedTest){
            $CreateTestQue['tableName'] = "test_section_question tsq";
            $CreateTestQue['condtion'] = "tsq.test_id=".$_AllCreatedTest->id." AND tsq.is_deleted=1";
            $TotalQuestion = $this->SystemModel->getAll($CreateTestQue);
            $_AllCreatedTest->TotalQuestion = count($TotalQuestion);
            $AllCreatedTesttempArray->$i = $_AllCreatedTest;  
            $i++;
        }
        $data['AllCreatedTest'] = $AllCreatedTesttempArray;
       
        
        $DeletedTestData['tableName'] = "test";
        $DeletedTestData['condtion'] = "status='Deleted'";
        $AllDeletedTest = $this->SystemModel->getAll($DeletedTestData);
        
        $AllDeletedTesttempArray = new stdClass;
        $i=0;
        foreach ($AllDeletedTest as $_AllDeletedTest){
            $DeletedTestQue['tableName'] = "test_section_question tsq";
            $DeletedTestQue['condtion'] = "tsq.test_id=".$_AllDeletedTest->id." AND tsq.is_deleted=1";
            $DeletedTotalQuestion = $this->SystemModel->getAll($DeletedTestQue);
            $_AllDeletedTest->TotalQuestion = count($DeletedTotalQuestion);
            $AllDeletedTesttempArray->$i = $_AllDeletedTest;  
            $i++;
        }
        $data['AllDeletedMainTest'] = $AllDeletedTesttempArray;
       
        
         
        $PublishOnGoingTestData['select'] = 'te.*,te.id as testId, ap.*,ap.id as appy_cate_id, cat.category_name';
        $PublishOnGoingTestData['tableName'] = "test te"; 
        $PublishOnGoingTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id', 'type'=>'left');
        $PublishOnGoingTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id', 'type'=>'left');
//        $PublishOnGoingTestData['condtion'] = "ap.publish_at='".$Today."' AND ap.status !='Un-Published'";
        $PublishOnGoingTestData['condtion'] = "ap.status ='Published & On-Going'";
        $AllPublishOnGoingTest  = $this->SystemModel->getAll($PublishOnGoingTestData); 
        
        $PublishOnGoingTestDatatempArray = new stdClass;
        $i=0;
        foreach ($AllPublishOnGoingTest as $_AllPublishOnGoingTest){
            $PubOnGoingQue['join'] = array();
            $PubOnGoingQue['tableName'] = "test_section_question tsq";
            $PubOnGoingQue['condtion'] = "tsq.test_id=".$_AllPublishOnGoingTest->testId." AND tsq.is_deleted=1";
            $TotalQuestion = $this->SystemModel->getAll($PubOnGoingQue);
            $_AllPublishOnGoingTest->TotalQuestion = count($TotalQuestion);
            $PublishOnGoingTestDatatempArray->$i = $_AllPublishOnGoingTest;  
            $i++;
        }
        $data['AllPublishOnGoingTest'] = $PublishOnGoingTestDatatempArray;
       
        
        $PublishUpCommingTestData['select'] = 'te.*,te.id as testId, ap.*,ap.id as appy_cate_id, cat.category_name';
        $PublishUpCommingTestData['tableName'] = "test te"; 
        $PublishUpCommingTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id', 'type'=>'left');
        $PublishUpCommingTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id', 'type'=>'left');
//        $PublishUpCommingTestData['condtion'] = "ap.publish_at >'".$Today."' AND ap.status !='Un-Published'";
        $PublishUpCommingTestData['condtion'] = "ap.status ='Published & Up-Coming'";
        $AllPublishUpCommingTest  = $this->SystemModel->getAll($PublishUpCommingTestData); 
        
        
        $AllPublishUpCommingTesttempArray = new stdClass;
        $J=0;
        foreach ($AllPublishUpCommingTest as $_AllPublishUpCommingTest){
            $PubupcomingQue['join'] = array();
            $PubupcomingQue['tableName'] = "test_section_question tsq";
            $PubupcomingQue['condtion'] = "tsq.test_id=".$_AllPublishUpCommingTest->testId." AND tsq.is_deleted=1";
            $TotalQuestion = $this->SystemModel->getAll($PubupcomingQue);
            $_AllPublishUpCommingTest->TotalQuestion = count($TotalQuestion);
            $AllPublishUpCommingTesttempArray->$J = $_AllPublishUpCommingTest;  
            $J++;
        }
        $data['AllPublishUpCommingTest'] = $AllPublishUpCommingTesttempArray;
       
        $UnPublishTestData['select'] = 'te.*,te.id as testId, ap.*,ap.id as appy_cate_id, cat.category_name';
        $UnPublishTestData['tableName'] = "test te"; 
        $UnPublishTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id', 'type'=>'left');
        $UnPublishTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id', 'type'=>'left');
        $UnPublishTestData['condtion'] = "ap.status ='Un-Published'";
        $AllUnPublishTest  = $this->SystemModel->getAll($UnPublishTestData); 
        
        
        $AllUnPublishTestTempArray = new stdClass;
        $i=0;
        foreach ($AllUnPublishTest as $_AllUnPublishTest){
            $UnPubtestQue['join'] = array();
            $UnPubtestQue['tableName'] = "test_section_question tsq";
            $UnPubtestQue['condtion'] = "tsq.test_id=".$_AllUnPublishTest->testId." AND tsq.is_deleted=1";
            $TotalQuestion = $this->SystemModel->getAll($UnPubtestQue);
            $_AllUnPublishTest->TotalQuestion = count($TotalQuestion);
            $AllUnPublishTestTempArray->$i = $_AllUnPublishTest;  
            $i++;
        }
        $data['AllUnPublishTest'] = $AllUnPublishTestTempArray;
       
        
        
        $DeleteTestData['select'] = 'te.*,te.id as testId, ap.*,ap.id as appy_cate_id, cat.category_name';
        $DeleteTestData['tableName'] = "test te"; 
        $DeleteTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id', 'type'=>'left');
        $DeleteTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id', 'type'=>'left');
        $DeleteTestData['condtion'] = "ap.status ='Deleted'";
        $AllDeleteTest  = $this->SystemModel->getAll($DeleteTestData); 

        $AllDeleteTestTempArray = new stdClass;
        $i=0;
        foreach ($AllDeleteTest as $_AllDeleteTest){
            $deletetestQue['join'] = array();
            $deletetestQue['tableName'] = "test_section_question tsq";
            $deletetestQue['condtion'] = "tsq.test_id=".$_AllDeleteTest->testId." AND tsq.is_deleted=1";
            $TotalQuestion = $this->SystemModel->getAll($deletetestQue);
            $_AllDeleteTest->TotalQuestion = count($TotalQuestion);
            $AllDeleteTestTempArray->$i = $_AllDeleteTest;  
            $i++;
        }
        $data['AllDeleteTest'] = $AllDeleteTestTempArray;
       
        
        $this->load->admin('test/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'category';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      
        $this->load->admin('test/add_edit', $data);
    }
    
    public function edit_add_section()
    {
        extract($this->input->post()); // convert array to variable -- php function //
         
        $data['section_id'] = $section_id;
        $data['sectionCount'] = $sectionCount;
        $data['section_name'] = $section_name;
         
        $this->load->view('test/edit_add_section', $data);
    }
    
    public function sync_images()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $request_body = file_get_contents('php://input');

        $data = json_decode($request_body);
      
        $response = array();


        $response['code'] = 200;

        foreach ($data->pdfQuestionstoParse as $i) 
        { 
          $imgs = array();

          foreach($i->imgs as $j)
          {
                $baseFromJavascript = $j;
                $base_to_php = explode(',', $baseFromJavascript);
                 
                $data = base64_decode($base_to_php[1]);
                $rnd_id = rand(1000,9999);
                $file_nm = "tst_p-".$rnd_id."-".$i->id.".png";
                $filepath = FCPATH . "uploads/question-img/".$file_nm; 
                file_put_contents($filepath,$data);
                $imgs[] = '<p><img src="'.base_url().'uploads/question-img/'.$file_nm.'"></p>';

          }
          //print_r($imgs);
          $response['pdfQuestionstoParse'][] = array('id' => $i->id ,'imgs' => $imgs);
        }
        echo json_encode($response);
        die();
    }
    public function sync_questions()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
       
        $request_body = file_get_contents('php://input');

        $data = json_decode($request_body);
        $response = array();

        $response['code'] = 200;
        $response['questions'] = $data->questions;

                foreach ($data->questions as $i) 
                { 
                        $updated_questions_array = array();

                        $insert_question = mysqli_query($dbConn,"insert into khctestquestion
                        (khcSectionId,khcQuestionType,khcAnswer,khcChoices,khcCorrectMarks,khcExplanationHtml,khcIncorrectMarks,khcLanguage,khcMainHtml,khcCreaterId,khcCreaterInstituteId,khcTestId) 
                        values 
                        ('".$i->section_id."','".$i->q_type."','".$i->answer."','".$i->choices."','".$i->correct_marks."','".$i->explanation_html."','".$i->incorrect_marks."','".$i->language."',
                        '".$i->main_html."','".$_SESSION['authId']."','".$_SESSION['instituteId']."','".$data->test_id."');
                        ");

                        $last_inserted_question_id = mysqli_insert_id($dbConn);

                        if($i->a_type != 'mcqs' && $i->a_type != 'mcqm' && $i->a_type != 'fib')
                        {
                           $response['test']['questions'][] = array('_id'=>$last_inserted_question_id,'a_type'=>'mcqs','answer'=>$i->answer,'choices'=>$i->choices,'correct_marks'=>$i->correct_marks,
                        'explanation_html'=>$i->explanation_html,'incorrect_marks'=>$i->incorrect_marks,'language'=>$i->language,'main_html'=>$i->main_html,'q_type'=>$i->q_type,'section_id'=>$i->section_id); 
                        }
                        else
                        {
                        $response['test']['questions'][] = array('_id'=>$last_inserted_question_id,'a_type'=>$i->a_type,'answer'=>$i->answer,'choices'=>$i->choices,'correct_marks'=>$i->correct_marks,
                        'explanation_html'=>$i->explanation_html,'incorrect_marks'=>$i->incorrect_marks,'language'=>$i->language,'main_html'=>$i->main_html,'q_type'=>$i->q_type,'section_id'=>$i->section_id);
                        }
                }

        $response['test']['publish_settings'] = $data->test->publish_settings;

        $response['test']['sections'] = $data->test->sections;

        $response['test']['un_q_ids'] = $data->test->un_q_ids;

        $response['test']['timing_type'] = $data->test->timing_type;
        $response['test']['total_time'] = $data->test->total_time;
        $response['test']['type'] = $data->test->type;
        $response['test']['name'] = $data->test->name;

        $response['test_id'] = $data->test_id;

        //$response['test']['questions'] = $data->questions;

                echo json_encode($response);
        die();
    }


    
    
    public function action()
    {
        
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        if(isset($id) && $id !=''){
            $modelData['tableName'] = "test";
            $modelData['data'] = array(
                'test_title' => $test_title,
                'test_type' => $test_type,
                'test_time' => $test_time,
                'exam_detail' => $exam_detail,
                'prize_pool_amount' => $prize_pool_amount,
                'join_amount' => $join_amount,
                'number_of_slot' => $number_of_slot,
                'point_system' => $point_system,
//                'status' => "Created",
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            
            $TestCashPrizeModelData['tableName'] = "test_cash_prize";
            $TestCashPrizeModelData['condtion'] = "test_id=" . $id;
            $TestCashPrizeModelCount = $this->SystemModel->tableRowCount($TestCashPrizeModelData); 
             if($TestCashPrizeModelCount > 0){
                 $TestCashPrizeModelResult = $this->SystemModel->deleteData($TestCashPrizeModelData); 
             }
            foreach ($cash_prize_rank as $key=>$_cash_prize_rank){
                if($_cash_prize_rank !=''){
                    $TestCashPrizeModelData['data'] = array(
                        'test_id' => $id,
                        'cash_prize_rank' => $_cash_prize_rank,
                        'cash_prize_amount' => $cash_prize_amount[$key],
                        'created' => date('Y-m-d H:i:s')
                    );
                    $result = $this->SystemModel->insertData($TestCashPrizeModelData);
                }
            }
            
            $inserted_test_id = $id;
            foreach ($section_id as $key=>$_section_id){
               $section_name_Final = $section_name[$key];

                $SectionData['tableName'] = "test_section";
                $SectionData['condtion'] = "test_id=" . $id." AND id=".$section_id_auto[$key];
                $SectionDataResult = $this->SystemModel->tableRowCount($SectionData); 
                
                if($SectionDataResult > 0) {  
                    $SectionDetail = $this->SystemModel->getOne($SectionData);
                    $inserted_section_id = $SectionDetail->id;
                } else {
                    $SectionData['data'] = array(
                        'test_id' => $id,
                        'section_name' => $section_name_Final,
                        'created' => date('Y-m-d H:i:s')
                    );
                    $result = $this->SystemModel->insertData($SectionData);
                    $inserted_section_id = $this->SystemModel->lastInsertId();
                }
                foreach ($question_type[$_section_id] as $key2=>$_question_type){
                    $question_type_Final = $question_type[$_section_id][$key2];
                    $question_Final = $question[$_section_id][$key2];
                    $ans_type_Final = $ans_type[$_section_id][$key2];
                    $language_Final = $language[$_section_id][$key2];
                    $marking_correct_Final = $marking_correct[$_section_id][$key2];
                    $marking_incorrect_Final = $marking_incorrect[$_section_id][$key2];
                    $answer_description_Final = $answer_description[$_section_id][$key2];
                    $choice_count_Final = $choice_count[$_section_id][$key2];
                    $radio_ans_a_Final = $radio_ans_a[$_section_id][$key2];
                    $radio_ans_b_Final = $radio_ans_b[$_section_id][$key2];
                    $radio_ans_c_Final = $radio_ans_c[$_section_id][$key2];
                    $radio_ans_d_Final = $radio_ans_d[$_section_id][$key2];
                    $radio_ans_e_Final = $radio_ans_e[$_section_id][$key2];
                    $radio_ans_f_Final = $radio_ans_f[$_section_id][$key2];
                    $chk_multi_answer_a_Final = $chk_multi_answer_a[$_section_id][$key2];
                    $chk_multi_answer_b_Final = $chk_multi_answer_b[$_section_id][$key2];
                    $chk_multi_answer_c_Final = $chk_multi_answer_c[$_section_id][$key2];
                    $chk_multi_answer_d_Final = $chk_multi_answer_d[$_section_id][$key2];
                    $chk_multi_answer_e_Final = $chk_multi_answer_e[$_section_id][$key2];
                    $chk_multi_answer_f_Final = $chk_multi_answer_f[$_section_id][$key2];
                    $new_a_fill_Final = $new_a_fill[$_section_id][$key2];
                    $radio_correct_ans_Final = $radio_correct_ans[$_section_id][$key2];
                    $correct_ans_chk_Final = $correct_ans_chk[$_section_id][$key2];
                    $correct_ans_fill_Final = $correct_ans_fill[$_section_id][$key2];


                    $SectionQuestionData['tableName'] = "test_section_question";
                    $SectionQuestionData['data'] = array(
                        'test_id' => $inserted_test_id,
                        'section_id' => $inserted_section_id,
                        'question_type' => $question_type_Final,
                        'question' => $question_Final,
                        'ans_type' => $ans_type_Final,
                        'language' => $language_Final,
                        'marking_correct' => $marking_correct_Final,
                        'marking_incorrect' => $marking_incorrect_Final,
                        'answer_description' => $answer_description_Final,
                        'choice_count' => $choice_count_Final,
                        'radio_ans_a' => $radio_ans_a_Final,
                        'radio_ans_b' => $radio_ans_b_Final,
                        'radio_ans_c' => $radio_ans_c_Final,
                        'radio_ans_d' => $radio_ans_d_Final,
                        'radio_ans_e' => $radio_ans_e_Final,
                        'radio_ans_f' => $radio_ans_f_Final,
                        'chk_multi_answer_a' => $chk_multi_answer_a_Final,
                        'chk_multi_answer_b' => $chk_multi_answer_b_Final,
                        'chk_multi_answer_c' => $chk_multi_answer_c_Final,
                        'chk_multi_answer_d' => $chk_multi_answer_d_Final,
                        'chk_multi_answer_e' => $chk_multi_answer_e_Final,
                        'chk_multi_answer_f' => $chk_multi_answer_f_Final,
                        'new_a_fill' => $new_a_fill_Final,
                        'radio_correct_ans' => $radio_correct_ans_Final,
                        'correct_ans_chk' => $correct_ans_chk_Final,
                        'correct_ans_fill' => $correct_ans_fill_Final,
                        'created' => date('Y-m-d H:i:s')
                    );
                    $result = $this->SystemModel->insertData($SectionQuestionData);

                } 
            }
            
        } else {
            $modelData['tableName'] = "test";
            $modelData['data'] = array(
                'test_title' => $test_title,
                'test_type' => $test_type,
                'test_time' => $test_time,
                'exam_detail' => $exam_detail,
                'prize_pool_amount' => $prize_pool_amount,
                'join_amount' => $join_amount,
                'number_of_slot' => $number_of_slot,
                'point_system' => $point_system,
                'status' => "Created",
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_test_id = $this->SystemModel->lastInsertId();


            $TestCashPrizeModelData['tableName'] = "test_cash_prize";
            foreach ($cash_prize_rank as $key=>$_cash_prize_rank){
                if($_cash_prize_rank !=''){
                    $TestCashPrizeModelData['data'] = array(
                        'test_id' => $inserted_test_id,
                        'cash_prize_rank' => $_cash_prize_rank,
                        'cash_prize_amount' => $cash_prize_amount[$key],
                        'created' => date('Y-m-d H:i:s')
                    );
                    $result = $this->SystemModel->insertData($TestCashPrizeModelData);
                }
            }

            foreach ($section_id as $key=>$_section_id){
               $section_name_Final = $section_name[$key];

                $SectionData['tableName'] = "test_section";
                $SectionData['data'] = array(
                    'test_id' => $inserted_test_id,
                    'section_name' => $section_name_Final,
                    'created' => date('Y-m-d H:i:s')
                );
                $result = $this->SystemModel->insertData($SectionData);
                $inserted_section_id = $this->SystemModel->lastInsertId();



                foreach ($question_type[$_section_id] as $key2=>$_question_type){
                    $question_type_Final = $question_type[$_section_id][$key2];
                    $question_Final = $question[$_section_id][$key2];
                    $ans_type_Final = $ans_type[$_section_id][$key2];
                    $language_Final = $language[$_section_id][$key2];
                    $marking_correct_Final = $marking_correct[$_section_id][$key2];
                    $marking_incorrect_Final = $marking_incorrect[$_section_id][$key2];
                    $answer_description_Final = $answer_description[$_section_id][$key2];
                    $choice_count_Final = $choice_count[$_section_id][$key2];
                    $radio_ans_a_Final = $radio_ans_a[$_section_id][$key2];
                    $radio_ans_b_Final = $radio_ans_b[$_section_id][$key2];
                    $radio_ans_c_Final = $radio_ans_c[$_section_id][$key2];
                    $radio_ans_d_Final = $radio_ans_d[$_section_id][$key2];
                    $radio_ans_e_Final = $radio_ans_e[$_section_id][$key2];
                    $radio_ans_f_Final = $radio_ans_f[$_section_id][$key2];
                    $chk_multi_answer_a_Final = $chk_multi_answer_a[$_section_id][$key2];
                    $chk_multi_answer_b_Final = $chk_multi_answer_b[$_section_id][$key2];
                    $chk_multi_answer_c_Final = $chk_multi_answer_c[$_section_id][$key2];
                    $chk_multi_answer_d_Final = $chk_multi_answer_d[$_section_id][$key2];
                    $chk_multi_answer_e_Final = $chk_multi_answer_e[$_section_id][$key2];
                    $chk_multi_answer_f_Final = $chk_multi_answer_f[$_section_id][$key2];
                    $new_a_fill_Final = $new_a_fill[$_section_id][$key2];
                    $radio_correct_ans_Final = $radio_correct_ans[$_section_id][$key2];
                    $correct_ans_chk_Final = $correct_ans_chk[$_section_id][$key2];
                    $correct_ans_fill_Final = $correct_ans_fill[$_section_id][$key2];


                    $SectionQuestionData['tableName'] = "test_section_question";
                    $SectionQuestionData['data'] = array(
                        'test_id' => $inserted_test_id,
                        'section_id' => $inserted_section_id,
                        'question_type' => $question_type_Final,
                        'question' => $question_Final,
                        'ans_type' => $ans_type_Final,
                        'language' => $language_Final,
                        'marking_correct' => $marking_correct_Final,
                        'marking_incorrect' => $marking_incorrect_Final,
                        'answer_description' => $answer_description_Final,
                        'choice_count' => $choice_count_Final,
                        'radio_ans_a' => $radio_ans_a_Final,
                        'radio_ans_b' => $radio_ans_b_Final,
                        'radio_ans_c' => $radio_ans_c_Final,
                        'radio_ans_d' => $radio_ans_d_Final,
                        'radio_ans_e' => $radio_ans_e_Final,
                        'radio_ans_f' => $radio_ans_f_Final,
                        'chk_multi_answer_a' => $chk_multi_answer_a_Final,
                        'chk_multi_answer_b' => $chk_multi_answer_b_Final,
                        'chk_multi_answer_c' => $chk_multi_answer_c_Final,
                        'chk_multi_answer_d' => $chk_multi_answer_d_Final,
                        'chk_multi_answer_e' => $chk_multi_answer_e_Final,
                        'chk_multi_answer_f' => $chk_multi_answer_f_Final,
                        'new_a_fill' => $new_a_fill_Final,
                        'radio_correct_ans' => $radio_correct_ans_Final,
                        'correct_ans_chk' => $correct_ans_chk_Final,
                        'correct_ans_fill' => $correct_ans_fill_Final,
                        'created' => date('Y-m-d H:i:s')
                    );
                    $result = $this->SystemModel->insertData($SectionQuestionData);

                } 
            }
        }


        //sned ntification
            // notification
         $getStudentData = $this->SystemModel->getStudentData();
         foreach ($getStudentData as $key => $value) {
             
       
                    $user_id = $value->id;
                    $title                      = "New Test, (".$test_title.") Published by B Competition";
                    $content                    = "Wallet Amount : 210 Rs by B Competition";
                    $type                       = "new_notification";
                    
                    $is_fcm_exist   = $this->SystemModel->getStudentInfo($value->id);
                    
                    if($is_fcm_exist<>"")
                    { 
                        $notification_id = rand(0000,9999);
                        $find_reciever_id   = $is_fcm_exist->fcm_id;
                
                        $FCMS=array();
                        array_push($FCMS,$find_reciever_id);
                       
                        if($find_reciever_id<>"")
                        {  
                            $field = array('registration_ids'  =>array($find_reciever_id),'data'=> array( "message" => $title,"title" => $title,"body" => $content,"content"=>$content,"notification_id"=>$notification_id,"type"=>$type,"id"=>$user_id));
                            
                            $fields = json_encode ($field);
                            $headers = array (
                                    'Authorization: key=AAAAj0ri4E4:APA91bHQxyhJADtIZiMSlRjUE0AmxqkTFJW7kIIaAGpKgpVqoAJPEwUtec8T9D-uvB29-outeAJJ20yTvHZwIzrDAbYH_sPKAN7rUdXkKqdO0Ap0MRibItsxCiJnw7q6vXzFtG4nWXDP',
                                    'Content-Type: application/json'
                            );
                            $url = 'https://fcm.googleapis.com/fcm/send';
                            $ch = curl_init ();
                            curl_setopt ( $ch, CURLOPT_URL, $url );
                            curl_setopt ( $ch, CURLOPT_POST, true );
                            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
                            $resulttt = curl_exec ( $ch );
                            // echo "<pre>";
                            //  print_r($resulttt); die();
                            // curl_close ( $ch );
                        }
                        $insert_noti                = array();
                        $insert_noti['student_id']    = $value->id;
                        $insert_noti['title']       = "New Test";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$test_title.") Published by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                      }
        //end



         redirect('admin/Test');
    }

    public function publish_test()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = 'category';
        $modelData['condtion'] = "is_deleted=0 AND status='Active'";
        $data['AllCategory'] = $this->SystemModel->getAll($modelData);
        
        $data['test_id'] = $test_id;
        
        $this->load->view('test/publish_test', $data);
    }
    
    
    public function publist_test_action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
 
        
        foreach ($category_id as $_category_id){
            $Today = date("Y-m-d");
            
            if(isset($cat_auto_unpublish[$_category_id])){
                $cat_auto_unpublishFinal = $cat_auto_unpublish[$_category_id];
            } else {
                $cat_auto_unpublishFinal = 0;
            }
            if(isset($cat_result_auto_publish[$_category_id])){
                $cat_result_auto_publishFinal = $cat_result_auto_publish[$_category_id];
            } else {
                $cat_result_auto_publishFinal = 0;
            }
            
            if($Today == date("Y-m-d", strtotime($cat_publish_at[$_category_id]))){
                $status = "Published & On-Going";
            } else if($Today < date("Y-m-d", strtotime($cat_publish_at[$_category_id]))) {
                $status = "Published & Up-Coming";
            }
                
            $cat_publish_atArray = explode(' ', $cat_publish_at[$_category_id]);
            if($cat_unpublish_at[$_category_id] !=''){
                $cat_unpublish_atArray = explode(' ', $cat_unpublish_at[$_category_id]);
                $unpublist_date = date("Y-m-d", strtotime($cat_unpublish_atArray[0]));
                $unpublist_time = $cat_unpublish_atArray[1];
            } else {
                $unpublist_date = '';
                $unpublist_time = '';
            }
            
            
            
                $ApplyTestCatData['tableName'] = "apply_test";
                $ApplyTestCatData['data'] = array(
                    'test_id' => $test_id,
                    'category_id' => $_category_id,
                    'publish_time' => $cat_publish_atArray[1],
//                    'number_of_attempts' => $cat_number_of_attempts[$_category_id],
                    'free_paid' => $cat_free_paid[$_category_id],
                    'publish_at' => date("Y-m-d", strtotime($cat_publish_atArray[0])),
                    'unpublish_at' => $unpublist_date,
                    'unpublish_time' => $unpublist_time,
                    'auto_unpublish' => $cat_auto_unpublishFinal,
                    'result_auto_publish' => $cat_result_auto_publishFinal,
                    'status' => $status,
                    'created' => date('Y-m-d H:i:s')
                );
                $result = $this->SystemModel->insertData($ApplyTestCatData); 
        }
        
        $modelData['tableName'] = "test";
        $modelData['data'] = array(
            'status' => 'Created',
            'updated' => date('Y-m-d H:i:s')
        );
        $modelData['condtion'] = "id=" . $test_id;
        $result = $this->SystemModel->updateData($modelData);



        //send notifiction
        foreach ($category_id as $key => $value) {
            $categoryName = $this->SystemModel->category($value);
            $categorysName[] = $categoryName->category_name;
        }
        $purchcate = implode(",", $categorysName);
        $getStudentData = $this->SystemModel->getStudentData();
        foreach ($getStudentData as $Skey => $Svalue) {
                $checkdata = $this->SystemModel->checkSub($test_id, $Svalue->id);
                $getLtest_id = $this->SystemModel->getLtest_id($test_id);
                if(!empty($checkdata)){
                        // notification
                    $user_id = $Svalue->id;
                    $title                      = "Test Publish, (".$getLtest_id->test_title.") Published in ( ".$purchcate.") by B Competition";
                    $content                    = "Wallet Amount : 210 Rs by B Competition";
                    $type                       = "new_notification";
                    
                  //  $Svalue   = $this->SystemModel->getStudentInfo($Svalue->id);
                    
                    if($Svalue<>"")
                    { 
                        $notification_id = rand(0000,9999);
                        $find_reciever_id   = $Svalue->fcm_id;
                
                        $FCMS=array();
                        array_push($FCMS,$find_reciever_id);
                       
                        if($find_reciever_id<>"")
                        {  
                            $field = array('registration_ids'  =>array($find_reciever_id),'data'=> array( "message" => $title,"title" => $title,"body" => $content,"content"=>$content,"notification_id"=>$notification_id,"type"=>$type,"id"=>$user_id));
                            
                            $fields = json_encode ($field);
                            $headers = array (
                                    'Authorization: key=AAAAj0ri4E4:APA91bHQxyhJADtIZiMSlRjUE0AmxqkTFJW7kIIaAGpKgpVqoAJPEwUtec8T9D-uvB29-outeAJJ20yTvHZwIzrDAbYH_sPKAN7rUdXkKqdO0Ap0MRibItsxCiJnw7q6vXzFtG4nWXDP',
                                    'Content-Type: application/json'
                            );
                            $url = 'https://fcm.googleapis.com/fcm/send';
                            $ch = curl_init ();
                            curl_setopt ( $ch, CURLOPT_URL, $url );
                            curl_setopt ( $ch, CURLOPT_POST, true );
                            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
                            $resulttt = curl_exec ( $ch );
                            // echo "<pre>";
                            //  print_r($resulttt); die();
                            // curl_close ( $ch );
                        }
                        $insert_noti                = array();
                        $insert_noti['student_id']    = $Svalue->id;
                        $insert_noti['title']       = "Test Publish";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$getLtest_id->test_title.") Published in ( ".$purchcate.") by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                }
        }

        //end








        redirect('admin/Test');
    }
    public function cat_test_action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
            $Today = date("Y-m-d");
            
            if(isset($edit_cat_auto_unpublish)){
                $cat_auto_unpublishFinal = $edit_cat_auto_unpublish;
            } else {
                $cat_auto_unpublishFinal = 0;
            }
            if($Today == date("Y-m-d", strtotime($edit_cat_publish_at))){
                $status = "Published & On-Going";
            } else if($Today < date("Y-m-d", strtotime($edit_cat_publish_at))) {
                $status = "Published & Up-Coming";
            }
            $ApplyTestCatData['tableName'] = "apply_test";
            
            $cat_publish_atArray = explode(' ', $edit_cat_publish_at);
            $cat_unpublish_atArray = explode(' ', $edit_cat_unpublish_at);
            
            $ApplyTestCatData['data'] = array(
                'publish_time' => $edit_cat_publish_time,
//                'number_of_attempts' => $edit_cat_number_of_attempts,
                'free_paid' => $edit_cat_free_paid,
                'publish_at' => date("Y-m-d", strtotime($cat_publish_atArray[0])),
                'publish_time' => $cat_publish_atArray[1],
                'unpublish_at' => date("Y-m-d", strtotime($cat_unpublish_atArray[0])),
                'unpublish_time' => $cat_unpublish_atArray[1],
                'auto_unpublish' => $cat_auto_unpublishFinal,
                'status' => $status,
                'created' => date('Y-m-d H:i:s')
            );
            $ApplyTestCatData['condtion'] = "id=" . $cat_test_id;
            $result = $this->SystemModel->updateData($ApplyTestCatData); 
 
        redirect('admin/Test');
    }
    public function publish_test_now()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
 
                $status = "Published & On-Going";
             
                $ApplyTestCatData['tableName'] = "apply_test";
                $ApplyTestCatData['data'] = array(
                 
                    'publish_at' => date("Y-m-d"),
                    'status' => $status,
                    'updated' => date('Y-m-d H:i:s')
                );
                $ApplyTestCatData['condtion'] = "id=" . $test_cate_id;
                $result = $this->SystemModel->updateData($ApplyTestCatData);
      
        redirect('admin/Test');
    }
    public function un_publish_test_now()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
 
                $status = "Un-Published";
             
                $ApplyTestCatData['tableName'] = "apply_test";
                $ApplyTestCatData['data'] = array(
                    'unpublish_at' => date("Y-m-d"),
                    'status' => $status,
                    'updated' => date('Y-m-d H:i:s')
                );
                $ApplyTestCatData['condtion'] = "id=" . $test_cate_id;
                $result = $this->SystemModel->updateData($ApplyTestCatData);
      
        redirect('admin/Test');
    }
    public function delete_cat_test()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
 
                $status = "Deleted";
             
                $ApplyTestCatData['tableName'] = "apply_test";
                $ApplyTestCatData['data'] = array( 
                    'status' => $status,
                    'updated' => date('Y-m-d H:i:s')
                );
                $ApplyTestCatData['condtion'] = "id=" . $test_cate_id;
                $result = $this->SystemModel->updateData($ApplyTestCatData);
      
        redirect('admin/Test');
    }
    public function created_delete_test()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
 
                $status = "Deleted";
             
                $ApplyTestCatData['tableName'] = "test";
                $ApplyTestCatData['data'] = array( 
                    'status' => $status,
                    'updated' => date('Y-m-d H:i:s')
                );
                $ApplyTestCatData['condtion'] = "id=" . $test_id;
                $result = $this->SystemModel->updateData($ApplyTestCatData);
      
        redirect('admin/Test');
    }
    
    public function edit_cat_test()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        if($test_type !='main_test'){
            $ApplyTestCatData['tableName'] = "apply_test";
            $ApplyTestCatData['condtion'] = "id=" . $test_id;
            $data['TestDetail'] = $this->SystemModel->getOne($ApplyTestCatData);
        } else {
             $data['TestDetail'] = array();
        }
        $data['test_id'] = $test_id;
        
         $this->load->view('test/edit_cat_test', $data);
    }
    
    


    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "category";
        $modelData['data'] = array(                  
                        'is_deleted' => '1',
                );
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($modelData);

//        $modelData['condtion'] = "id=" . $id;
//        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Category');
    }

    public function edit_add_question()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $section_nameArray = explode(",", $section_name);
        $section_idArray = explode(",", $section_id);
        // print_r($section_name); die();

        $data['mode'] = $mode;
        $data['question_id'] = $question_id;
        $data['section_name'] = $section_nameArray;
        $data['section_idArray'] = $section_idArray;
        $data['box_question'] = $box_question;
        $data['box_ans_type'] = $box_ans_type;
        $data['box_select_language'] = $box_select_language;
        $data['box_new_a_marking_correct'] = $box_new_a_marking_correct;
        $data['new_a_marking_incorrect'] = $new_a_marking_incorrect;
        $data['new_a_answer_description'] = $new_a_answer_description;
        $data['box_question_type'] = $box_question_type;
        $data['box_ans_type'] = $box_ans_type;
        $data['new_a_choice_count'] = $new_a_choice_count;
        $data['box_text_radio_ans_a'] = $box_text_radio_ans_a;
        $data['box_text_radio_ans_b'] = $box_text_radio_ans_b;
        $data['box_text_radio_ans_c'] = $box_text_radio_ans_c;
        $data['box_text_radio_ans_d'] = $box_text_radio_ans_d;
        $data['box_text_radio_ans_e'] = $box_text_radio_ans_e;
        $data['box_text_radio_ans_f'] = $box_text_radio_ans_f;
        $data['box_chk_multi_answer_a'] = $box_chk_multi_answer_a;
        $data['box_chk_multi_answer_b'] = $box_chk_multi_answer_b;
        $data['box_chk_multi_answer_c'] = $box_chk_multi_answer_c;
        $data['box_chk_multi_answer_d'] = $box_chk_multi_answer_d;
        $data['box_chk_multi_answer_e'] = $box_chk_multi_answer_e;
        $data['box_chk_multi_answer_f'] = $box_chk_multi_answer_f;
        $data['box_new_a_fill'] = $box_new_a_fill;
        $data['box_radio_correct_ans'] = $box_radio_correct_ans;
        $data['box_correct_ans_chk'] = explode(',', $box_correct_ans_chk);
        $data['box_correct_ans_fill'] = $box_correct_ans_fill;
        
        
        
        $this->load->view('test/edit_add_question', $data);
    }
    
    // Added on - 15-apr-2022
    // for edit question
    public function edit_question($test_id = '') {

        extract($this->input->post()); // convert array to variable -- php function //

        if ($test_id != '') {
            //$TestData['tableName'] = "test";
            $TestData['condtion'] = "te.id=" . $test_id;

            $TestData['select'] = 'te.*,ts.id as test_section_id, ts.section_name';
            $TestData['tableName'] = "test te";
            $TestData['join'][] = array('tableName' => 'test_section ts', 'condtion' => 'ts.test_id=te.id', 'type' => 'left');
            //$TestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id', 'type'=>'left');
//        $PublishUpCommingTestData['condtion'] = "ap.publish_at >'".$Today."' AND ap.status !='Un-Published'";
            //$PublishUpCommingTestData['condtion'] = "ap.status ='Published & Up-Coming'";

            $data['TestDetail'] = $this->SystemModel->getOne($TestData);

            $TestSectionmodelData['tableName'] = "test_section";
            $TestSectionmodelData['condtion'] = "test_id=" . $test_id. "  AND is_deleted=1";
            $data['TestSectionDetail'] = $this->SystemModel->getAll($TestSectionmodelData);

            $TestQuestionmodelData['tableName'] = "test_section_question";
            $TestQuestionmodelData['condtion'] = "test_id=" . $test_id .  "  AND is_deleted=1";
            $data['TestSectionQuestionDetail'] = $this->SystemModel->getAll($TestQuestionmodelData);
            
            $TestCashPrizemodelData['tableName'] = "test_cash_prize";
            $TestCashPrizemodelData['condtion'] = "test_id=" . $test_id;
            $data['TestCashAllPrize'] = $this->SystemModel->getAll($TestCashPrizemodelData);
             
        }
        // print_r($data);		die;;
        $this->load->admin('test/edit_question', $data);
    }

    public function test_subscription_index()
    {
        extract($this->input->post()); // convert array to variable -- php function //
    
         
            
        $TestSubscriptionData['select'] = 'tts.*,st.name as student_name, st.mobile_number, st.profile_pic, tst.test_title';
        $TestSubscriptionData['tableName'] = "student_test_subscription tts"; 
        $TestSubscriptionData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=tts.student_id', 'type'=>'left');
        $TestSubscriptionData['join'][] = array('tableName' => 'test tst', 'condtion' => 'tst.id=tts.test_id', 'type'=>'left');
        $data['TestSubscriptionAll']  = $this->SystemModel->getAll($TestSubscriptionData); 
        
        $this->load->admin('test/test_subscription_index', $data);
    }
    
    public function update_section() {
        extract($this->input->post()); // convert array to variable -- php function //

        if (isset($section_name) && isset($section_id)) {
            $updateData['tableName'] = "test_section";
            $updateData['data'] = array(
                'section_name' => $section_name,
                'updated' => date('Y-m-d H:i:s')
            );
            $updateData['condtion'] = "id=" . $section_id;
            $result = $this->SystemModel->updateData($updateData);
        }
    }
    
    public function delete_section() {
        extract($this->input->post()); // convert array to variable -- php function //
        if ( isset($section_id)) {
            $updateData['tableName'] = "test_section";
            $updateData['data'] = array(
                'is_deleted' => 2,
                'updated' => date('Y-m-d H:i:s')
            );
            $updateData['condtion'] = "id=" . $section_id;
            $result = $this->SystemModel->updateData($updateData);
        }
    }
    public function delete_question() {
        extract($this->input->post()); // convert array to variable -- php function //
        if ( isset($question_id)) {
            $updateData['tableName'] = "test_section_question";
            $updateData['data'] = array(
                'is_deleted' => 2,
                'updated' => date('Y-m-d H:i:s')
            );
            $updateData['condtion'] = "id=" . $question_id;
            $result = $this->SystemModel->updateData($updateData);
        }
    }
    
    public function edit_question_modal() {
        // echo "<pre>"; print_r($this->input->post()); die();
        extract($this->input->post()); // convert array to variable -- php function //
        $dataTestSectionQuestionDetail = array();
        $box_question = null;
        $box_ans_type = null;
        $box_select_language = null;
        $box_new_a_marking_correct = null;
        $new_a_marking_incorrect = null;
        $new_a_answer_description = null;
        $box_new_a_marking_correct = null;
        $new_a_marking_incorrect = null;
        $new_a_answer_description = null;
        $new_a_choice_count = null;
        $box_text_radio_ans_a = null;
        $box_text_radio_ans_b = null;
        $box_text_radio_ans_c = null;
        $box_text_radio_ans_d = null;
        $box_text_radio_ans_e = null;
        $box_text_radio_ans_f = null;
        $box_chk_multi_answer_a = null;
        $box_chk_multi_answer_b = null;
        $box_chk_multi_answer_c = null;
        $box_chk_multi_answer_d = null;
        $box_chk_multi_answer_e = null;
        $box_chk_multi_answer_f = null;
        $box_new_a_fill = null;
        $box_radio_correct_ans = null;
        $radio_correct_ans = null;
        $box_correct_ans_chk = null;
        $box_correct_ans_fill = null;
        $box_question_type = null;
        $box_ans_type = null;
        $box_question = null;
     
        if( $question_id != null ||  $question_id  !="") {
            $TestQuestionmodelData['tableName'] = "test_section_question";
            $TestQuestionmodelData['condtion'] = "id=" . $question_id .  " ";
            $dataTestSectionQuestionDetail = $this->SystemModel->getOne($TestQuestionmodelData);
            
            if(!empty( $dataTestSectionQuestionDetail)) {      	
                $box_new_a_marking_correct = $dataTestSectionQuestionDetail->marking_correct;
                $new_a_marking_incorrect = $dataTestSectionQuestionDetail->marking_incorrect;
                $new_a_answer_description = $dataTestSectionQuestionDetail->answer_description;
              
                $new_a_choice_count = $dataTestSectionQuestionDetail->choice_count;
                
                $box_text_radio_ans_a = $dataTestSectionQuestionDetail->radio_ans_a;
                $box_text_radio_ans_b = $dataTestSectionQuestionDetail->radio_ans_b;
                $box_text_radio_ans_c = $dataTestSectionQuestionDetail->radio_ans_c;
                $box_text_radio_ans_d = $dataTestSectionQuestionDetail->radio_ans_d;
                $box_text_radio_ans_e = $dataTestSectionQuestionDetail->radio_ans_e;
                $box_text_radio_ans_f = $dataTestSectionQuestionDetail->radio_ans_f;
                
                $language = $dataTestSectionQuestionDetail->language;
                $box_chk_multi_answer_a = $dataTestSectionQuestionDetail->chk_multi_answer_a;
                $box_chk_multi_answer_b = $dataTestSectionQuestionDetail->chk_multi_answer_b;
                $box_chk_multi_answer_c = $dataTestSectionQuestionDetail->chk_multi_answer_c;
                $box_chk_multi_answer_d = $dataTestSectionQuestionDetail->chk_multi_answer_d;
                $box_chk_multi_answer_e = $dataTestSectionQuestionDetail->chk_multi_answer_e;
                $box_chk_multi_answer_f = $dataTestSectionQuestionDetail->chk_multi_answer_f;
                
                $radio_correct_ans = $dataTestSectionQuestionDetail->radio_correct_ans;
                $box_radio_correct_ans = $dataTestSectionQuestionDetail->radio_correct_ans;
                $box_correct_ans_chk = $dataTestSectionQuestionDetail->correct_ans_chk;
                $box_correct_ans_fill = $dataTestSectionQuestionDetail->correct_ans_fill;
                $box_new_a_fill = $dataTestSectionQuestionDetail->new_a_fill;
                $box_ans_type = $dataTestSectionQuestionDetail->ans_type;
                $box_question_type = $dataTestSectionQuestionDetail->question_type;
                $box_question = $dataTestSectionQuestionDetail->question;
                $box_select_language = $dataTestSectionQuestionDetail->language;
            }
        }
        // if(empty($box_radio_correct_ans)){
        //     if(!empty($box_correct_ans_chk)){
        //             $box_radio_correct_ans = explode(',', $box_correct_ans_chk);
        //     }
        // }
        $section_nameArray = explode(",", $section_name);
        $section_idArray = explode(",", $section_id);
        $mode = 'Edit';
        $data['mode'] = $mode;
        $data['question_id'] = $question_id;
        $data['section_name'] = $section_nameArray;
        $data['section_idArray'] = $section_idArray;
        $data['box_question'] = $box_question;
        $data['box_ans_type'] = $box_ans_type;
        $data['box_question_type'] = $box_question_type;
         
        $data['box_select_language'] = $box_select_language;
        $data['box_new_a_marking_correct'] = $box_new_a_marking_correct;
        $data['new_a_marking_incorrect'] = $new_a_marking_incorrect;
        $data['new_a_answer_description'] = $new_a_answer_description;
       
        $data['new_a_choice_count'] = $new_a_choice_count;
        $data['box_text_radio_ans_a'] = $box_text_radio_ans_a;
        $data['box_text_radio_ans_b'] = $box_text_radio_ans_b;
        $data['box_text_radio_ans_c'] = $box_text_radio_ans_c;
        $data['box_text_radio_ans_d'] = $box_text_radio_ans_d;
        $data['box_text_radio_ans_e'] = $box_text_radio_ans_e;
        $data['box_text_radio_ans_f'] = $box_text_radio_ans_f;
        $data['box_chk_multi_answer_a'] = $box_chk_multi_answer_a;
        $data['box_chk_multi_answer_b'] = $box_chk_multi_answer_b;
        $data['box_chk_multi_answer_c'] = $box_chk_multi_answer_c;
        $data['box_chk_multi_answer_d'] = $box_chk_multi_answer_d;
        $data['box_chk_multi_answer_e'] = $box_chk_multi_answer_e;
        $data['box_chk_multi_answer_f'] = $box_chk_multi_answer_f;
        $data['box_new_a_fill'] = $box_new_a_fill;
        $data['box_radio_correct_ans'] = $box_radio_correct_ans;
        $data['box_correct_ans_chk'] = explode(',', $box_correct_ans_chk);
        $data['box_correct_ans_fill'] = $box_correct_ans_fill;
       
        $this->load->view('test/edit_question_modal', $data);
    }
    
    public function update_question_details() {
        extract($this->input->post());
      // print_r($this->input->post());
        if (isset($question_id)) {
            if ($question_id != null || $question_id != "") {
                $updateData['data'] = array(
                    'section_id' => $popup_section_id,
                    'question_type' => $question_type,
                    'question' => $question,
                    'ans_type' => $new_ans_type,
                    'language' => $language,
                    'marking_correct' => $new_a_marking_correct,
                    'marking_incorrect' => $new_a_marking_incorrect,
                    'answer_description' => $answer_description,
                    //   'radio_correct_ans' => $radio_answer,
                    'updated' => date('Y-m-d H:i:s'),
                );

                if (isset($radio_answer)) {
                    if (!empty($radio_answer)) {
                        $updateData['data']['radio_correct_ans'] = $radio_answer[0];
                    }
                }
                if (isset($chk_multi_answer)) {
                    if (!empty($chk_multi_answer)) {
                        $updateData['data']['correct_ans_chk'] = implode(',', $chk_multi_answer);
                    }
                }
                if (isset($text_radio_ans_text)) {
                    if (!empty($text_radio_ans_text)) {
                        if (isset($text_radio_ans_text[0]) && $text_radio_ans_text[0] != "") {
                            $updateData['data']['radio_ans_a'] = $text_radio_ans_text[0];
                        }
                        if (isset($text_radio_ans_text[1]) && $text_radio_ans_text[1] != "") {
                            $updateData['data']['radio_ans_b'] = $text_radio_ans_text[1];
                        }
                        if (isset($text_radio_ans_text[2]) && $text_radio_ans_text[2] != "") {
                            $updateData['data']['radio_ans_c'] = $text_radio_ans_text[2];
                        }
                        if (isset($text_radio_ans_text[3]) && $text_radio_ans_text[3] != "") {
                            $updateData['data']['radio_ans_d'] = $text_radio_ans_text[3];
                        }
                        if (isset($text_radio_ans_text[4]) && $text_radio_ans_text[4] != "") {
                            $updateData['data']['radio_ans_e'] = $text_radio_ans_text[4];
                        }
                        if (isset($text_radio_ans_text[5]) && $text_radio_ans_text[5] != "") {
                            $updateData['data']['radio_ans_f'] = $text_radio_ans_text[5];
                        }
                    }
                }
                if (isset($new_a_fill)) {
                    if (!empty($new_a_fill)) {
                        $updateData['data']['correct_ans_fill'] = $new_a_fill;
                    }
                }

                //   var_dump($updateData['data']);
              //print_r($updateData['data']);
              // die;

                $updateData['tableName'] = "test_section_question";
                $updateData['condtion'] = "id=" . $question_id;
                $result = $this->SystemModel->updateData($updateData);

                if ($question_id != null) {

                    $TestQuestionmodelData['tableName'] = "test_section_question";
                    $TestQuestionmodelData['condtion'] = "id=" . $question_id . " ";
                    $dataTestSectionQuestionDetail = $this->SystemModel->getOne($TestQuestionmodelData);
                    if (!empty($dataTestSectionQuestionDetail)) {
                        $row_question = new stdClass;
                        $row_question->question = $dataTestSectionQuestionDetail->question;
                        $row_question->question_type = $dataTestSectionQuestionDetail->question_type;
                        $row_question->ans_type = $dataTestSectionQuestionDetail->ans_type;
                        
                        $row_question->radio_ans_a = $dataTestSectionQuestionDetail->radio_ans_a;
                        $row_question->radio_ans_b = $dataTestSectionQuestionDetail->radio_ans_b;
                        $row_question->radio_ans_c = $dataTestSectionQuestionDetail->radio_ans_c;
                        $row_question->radio_ans_d = $dataTestSectionQuestionDetail->radio_ans_d;
                        $row_question->radio_ans_e = $dataTestSectionQuestionDetail->radio_ans_e;
                        $row_question->radio_ans_f = $dataTestSectionQuestionDetail->radio_ans_f;
                        
                        $row_question->radio_correct_ans = $dataTestSectionQuestionDetail->radio_correct_ans;
                        $row_question->correct_ans_chk = $dataTestSectionQuestionDetail->correct_ans_chk;
                        $row_question->correct_ans_fill = $dataTestSectionQuestionDetail->correct_ans_fill;
                        $row_question->marking_correct = $dataTestSectionQuestionDetail->marking_correct;
                        $row_question->marking_incorrect = $dataTestSectionQuestionDetail->marking_incorrect;
                        
                        $row_question->chk_multi_answer_a = $dataTestSectionQuestionDetail->chk_multi_answer_a;
                        $row_question->chk_multi_answer_b = $dataTestSectionQuestionDetail->chk_multi_answer_b;
                        $row_question->chk_multi_answer_c = $dataTestSectionQuestionDetail->chk_multi_answer_c;
                        $row_question->chk_multi_answer_d = $dataTestSectionQuestionDetail->chk_multi_answer_d;
                        $row_question->chk_multi_answer_e = $dataTestSectionQuestionDetail->chk_multi_answer_e;
                        $row_question->chk_multi_answer_f = $dataTestSectionQuestionDetail->chk_multi_answer_f;
                        
                        $this->load->view('test/updated_question_div', ['row_question' => $row_question]);
                    }
                }
            }
        }
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


      public function add_student()
    {   
        $store_id = $this->input->get('store_id');
        $stuArr = $this->SystemModel->getStudentData();
         $AllStudent = [];
       $AllNewStudent = [];
       foreach ($stuArr as $key => $value) {
           $checkData = $this->SystemModel->student_buy_student_test_subscription($value->id, $store_id);
           if(!empty($checkData)){

            $value->subid = $checkData->id; 
            $value->courseid = $store_id; 
           // echo '<pre>';print_r($value);exit;
                $AllStudent[] = $value;
           }else{
            $value->courseid = $store_id; 
            $AllNewStudent[] = $value;
           }
       }
        $data['AllStudent'] = $AllStudent;
        $data['AllNewStudent'] = $AllNewStudent;
        $data['store_id'] = $store_id;
       // echo '<pre>';print_r($data);exit;
         $this->load->admin('test/indexStudent', $data);
    }

              public function addSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');
        $this->SystemModel->deletestudent_student_test_subscription($id,$courseid);
         $getmanage_autopool_levelRow = $this->SystemModel->getmanage_test($courseid);
        $data = [
            'student_id' => $id,
            'test_id' => $courseid,
            'join_amount'=>$getmanage_autopool_levelRow->join_amount,
            'status' => 1,
            'create_date'=>date('Y-m-d')
        ];
        $this->SystemModel->insertstudent_student_test_subscription($data);
        redirect('admin/Test/add_student?store_id='.$courseid);
    }

             public function removeSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');
     
        $data = ['status' => 0];
        $this->SystemModel->update_student_buy_student_test_subscription($data, $id);
        redirect('admin/Test/add_student?store_id='.$courseid);
    }
    
    public function view_result($test_cat_id) {
        extract($this->input->post()); // convert array to variable -- php function //
         $this->test_winer_list_auto();
        
        $test_cat_idArray = explode('_', $test_cat_id);
        
        $test_id = $test_cat_idArray[0];
        $category_id = $test_cat_idArray[1];
        $apply_test_id = $test_cat_idArray[2];
         
        $TestData['tableName'] = "test";        
        $TestData['condtion'] = "id=" . $test_id;
        $TestDetail = $this->SystemModel->getOne($TestData);

                        $test_cash_prizeData['tableName'] = "test_cash_prize";        
                        $test_cash_prizeData['condtion'] = "test_id=" . $test_id;
                        $test_cash_prizeresult = $this->SystemModel->tableRowCount($test_cash_prizeData);
                        

                        $StudentAttemptTestData = $this->SystemModel->directQuery('SELECT `sat`.*, `st`.`name` as `student_name`
                                                                                    FROM `student_attempt_test` `sat`
                                                                                    LEFT JOIN `student` `st` ON `st`.`id`=`sat`.`student_id`
                                                                                    WHERE `sat`.`test_id` = '.$test_id.' AND `sat`.`category_id` = '.$category_id.'
                                                                                    ORDER BY `sat`.`get_mark` DESC, `sat`.`total_time` ASC');  

 
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
                        
            $data['test_detail'] = $TestDetail;
            $data['student_detail'] = $tempArray;
            $data['apply_test_id'] = $apply_test_id;
        $this->load->admin('test/view_result', $data);
    }
    
    
    public function publish_result_action() {
        extract($this->input->post()); // convert array to variable -- php function //
        $ApplyTestCatData['tableName'] = "apply_test";
        $ApplyTestCatData['data'] = array( 
            'result_publish' => "true",
            'updated' => date('Y-m-d H:i:s')
        );
        $ApplyTestCatData['condtion'] = "id=" . $apply_test_id;
        $result = $this->SystemModel->updateData($ApplyTestCatData);



           //sned ntification
            // notification
         $getStudentData = $this->SystemModel->getStudentapply_test_id($apply_test_id);
         foreach ($getStudentData as $key => $value) {
                    
                    $getmanage_test = $this->SystemModel->getmanage_test($apply_test_id);
                    $user_id = $value->student_id;
                    $title                      = "Test Result, (".$getmanage_test->test_title.") Published by B Competition";
                    $content                    = "Wallet Amount : 210 Rs by B Competition";
                    $type                       = "new_notification";
                    
                    $is_fcm_exist   = $this->SystemModel->getStudentInfo($value->student_id);
                    
                    //add walte
                    $studentinfo['tableName'] = "student";
                    $studentinfo['condtion']  = "id=" . $value->student_id . "";
                    $studentinfodata = $this->SystemModel->getOne($studentinfo);
                    $finalStudentAMount = $studentinfodata->wallet_amount - $value->cash_prize;
                     $stuData = ['wallet_amount'=>number_format((float)$finalStudentAMount, 2, '.', '')];
                         $this->SystemModel->updateStudWal($stuData, $value->student_id);
    
                    $student_wallet_historyData['tableName'] = "student_wallet_history";   
                    $student_wallet_historyData['data'] = array(     
                                                    'student_id'    => $value->student_id,
                                                    'wallet_amount'    => $value->cash_prize,
                                                    'transaction_number'    => 'Test Winning Price',
                                                    'old_wallet_amount' => $finalStudentAMount,
                                                    'transaction_type'    => "Credit",
                                                    'status'    => "Completed",
                                                    'created'  => date('Y-m-d h:i:s'),
                                                    'create_date'  => date('Y-m-d')
    
                    );
                    $this->SystemModel->insertData($student_wallet_historyData);
                    //end





                    if($is_fcm_exist<>"")
                    { 
                        $notification_id = rand(0000,9999);
                        $find_reciever_id   = $is_fcm_exist->fcm_id;
                
                        $FCMS=array();
                        array_push($FCMS,$find_reciever_id);
                       
                        if($find_reciever_id<>"")
                        {  
                            $field = array('registration_ids'  =>array($find_reciever_id),'data'=> array( "message" => $title,"title" => $title,"body" => $content,"content"=>$content,"notification_id"=>$notification_id,"type"=>$type,"id"=>$user_id));
                            
                            $fields = json_encode ($field);
                            $headers = array (
                                    'Authorization: key=AAAAj0ri4E4:APA91bHQxyhJADtIZiMSlRjUE0AmxqkTFJW7kIIaAGpKgpVqoAJPEwUtec8T9D-uvB29-outeAJJ20yTvHZwIzrDAbYH_sPKAN7rUdXkKqdO0Ap0MRibItsxCiJnw7q6vXzFtG4nWXDP',
                                    'Content-Type: application/json'
                            );
                            $url = 'https://fcm.googleapis.com/fcm/send';
                            $ch = curl_init ();
                            curl_setopt ( $ch, CURLOPT_URL, $url );
                            curl_setopt ( $ch, CURLOPT_POST, true );
                            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
                            $resulttt = curl_exec ( $ch );
                            // echo "<pre>";
                            //  print_r($resulttt); die();
                            // curl_close ( $ch );
                        }
                        $insert_noti                = array();
                        $insert_noti['student_id']    = $value->student_id;
                        $insert_noti['title']       = "Test Result";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$getmanage_test->test_title.") Published by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                      }
        //end







        redirect('admin/Test');
    }
    
    public function winer_list($test_cat_id) {
        extract($this->input->post()); // convert array to variable -- php function //
        $test_cat_idArray = explode('_', $test_cat_id);
        
        $test_id = $test_cat_idArray[0];
        $category_id = $test_cat_idArray[1];
        $apply_test_id = $test_cat_idArray[2];
         
        $TestData['tableName'] = "test";        
        $TestData['condtion'] = "id=" . $test_id;
        $TestDetail = $this->SystemModel->getOne($TestData);

            $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name, st.mobile_number,ct.city_name';   
            $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
            $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
            $student_attempt_test_Data['join'][] = array('tableName' => 'city ct', 'condtion' => 'ct.id=st.city_id', 'type'=>'left');
            $student_attempt_test_Data['condtion'] = "sat.test_id=" . $test_id. " AND sat.category_id=".$category_id;
            $student_attempt_test_Data['order'][0] = "sat.rank";
            $student_attempt_test_Data['order'][1] = "ASC";
            $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);
                          
            
            $data['test_detail'] = $TestDetail;
            $data['student_detail'] = $StudentAttemptTestData;
            $data['apply_test_id'] = $apply_test_id;
            
            
        $this->load->admin('test/winer_list', $data);
    }
    
    public function publish_winer_action() {
        extract($this->input->post()); // convert array to variable -- php function //
        $ApplyTestCatData['tableName'] = "apply_test";
        $ApplyTestCatData['data'] = array( 
            'winer_list_publish' => "true",
            'updated' => date('Y-m-d H:i:s')
        );
        $ApplyTestCatData['condtion'] = "id=" . $apply_test_id;
        $result = $this->SystemModel->updateData($ApplyTestCatData);


               //sned ntification
            // notification
         $getStudentData = $this->SystemModel->getStudentapply_test_id($apply_test_id);
         foreach ($getStudentData as $key => $value) {
                    
                    $getmanage_test = $this->SystemModel->getmanage_test($apply_test_id);
                    $user_id = $value->student_id;
                    $title                      = "Test Winner, (".$getmanage_test->test_title.") Published by B Competition";
                    $content                    = "Wallet Amount : 210 Rs by B Competition";
                    $type                       = "new_notification";
                    
                    $is_fcm_exist   = $this->SystemModel->getStudentInfo($value->student_id);
                    
                    if($is_fcm_exist<>"")
                    { 
                        $notification_id = rand(0000,9999);
                        $find_reciever_id   = $is_fcm_exist->fcm_id;
                
                        $FCMS=array();
                        array_push($FCMS,$find_reciever_id);
                       
                        if($find_reciever_id<>"")
                        {  
                            $field = array('registration_ids'  =>array($find_reciever_id),'data'=> array( "message" => $title,"title" => $title,"body" => $content,"content"=>$content,"notification_id"=>$notification_id,"type"=>$type,"id"=>$user_id));
                            
                            $fields = json_encode ($field);
                            $headers = array (
                                    'Authorization: key=AAAAj0ri4E4:APA91bHQxyhJADtIZiMSlRjUE0AmxqkTFJW7kIIaAGpKgpVqoAJPEwUtec8T9D-uvB29-outeAJJ20yTvHZwIzrDAbYH_sPKAN7rUdXkKqdO0Ap0MRibItsxCiJnw7q6vXzFtG4nWXDP',
                                    'Content-Type: application/json'
                            );
                            $url = 'https://fcm.googleapis.com/fcm/send';
                            $ch = curl_init ();
                            curl_setopt ( $ch, CURLOPT_URL, $url );
                            curl_setopt ( $ch, CURLOPT_POST, true );
                            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
                            $resulttt = curl_exec ( $ch );
                            // echo "<pre>";
                            //  print_r($resulttt); die();
                            // curl_close ( $ch );
                        }
                        $insert_noti                = array();
                        $insert_noti['student_id']    = $value->student_id;
                        $insert_noti['title']       = "Test Winner";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$getmanage_test->test_title.") Published by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                      }
        //end




        redirect('admin/Test');
    }
     


}
