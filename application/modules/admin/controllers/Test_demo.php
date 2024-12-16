<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test_demo extends MY_Controller
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
            $CreateTestQue['condtion'] = "tsq.test_id=".$_AllCreatedTest->id;
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
            $DeletedTestQue['condtion'] = "tsq.test_id=".$_AllDeletedTest->id;
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
            $PubOnGoingQue['condtion'] = "tsq.test_id=".$_AllPublishOnGoingTest->testId;
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
            $PubupcomingQue['condtion'] = "tsq.test_id=".$_AllPublishUpCommingTest->testId;
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
            $UnPubtestQue['condtion'] = "tsq.test_id=".$_AllUnPublishTest->testId;
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
            $deletetestQue['condtion'] = "tsq.test_id=".$_AllDeleteTest->testId;
            $TotalQuestion = $this->SystemModel->getAll($deletetestQue);
            $_AllDeleteTest->TotalQuestion = count($TotalQuestion);
            $AllDeleteTestTempArray->$i = $_AllDeleteTest;  
            $i++;
        }
        $data['AllDeleteTest'] = $AllDeleteTestTempArray;
       
        
        $this->load->admin('test_demo/index', $data);
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
      
        $this->load->admin('test_demo/add_edit', $data);
    }
    
    public function edit_add_section()
    {
        extract($this->input->post()); // convert array to variable -- php function //
         
        $data['section_id'] = $section_id;
        $data['sectionCount'] = $sectionCount;
        $data['section_name'] = $section_name;
         
        $this->load->view('test_demo/edit_add_section', $data);
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
         redirect('admin/Test_demo');
    }

    public function publish_test()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = 'category';
        $modelData['condtion'] = "is_deleted=0 AND status='Active'";
        $data['AllCategory'] = $this->SystemModel->getAll($modelData);
        
        $data['test_id'] = $test_id;
        
        $this->load->view('test_demo/publish_test', $data);
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

        redirect('admin/Test_demo');
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
 
        redirect('admin/Test_demo');
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
      
        redirect('admin/Test_demo');
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
      
        redirect('admin/Test_demo');
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
      
        redirect('admin/Test_demo');
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
      
        redirect('admin/Test_demo');
    }
    
    public function edit_cat_test()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
      
        $ApplyTestCatData['tableName'] = "apply_test";
        $ApplyTestCatData['condtion'] = "id=" . $test_id;
        $data['TestDetail'] = $this->SystemModel->getOne($ApplyTestCatData);
        
         $this->load->view('test_demo/edit_cat_test', $data);
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
        
        
        
        $this->load->view('test_demo/edit_add_question', $data);
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
            $TestSectionmodelData['condtion'] = "test_id=" . $test_id;
            $data['TestSectionDetail'] = $this->SystemModel->getAll($TestSectionmodelData);

            $TestSectionmodelData['tableName'] = "test_section_question";
            $TestSectionmodelData['condtion'] = "test_id=" . $test_id;
            $data['TestSectionQuestionDetail'] = $this->SystemModel->getAll($TestSectionmodelData);
        }
        //print_r($data);		die;;
        $this->load->admin('test_demo/edit_question', $data);
    }

    public function test_subscription_index()
    {
        extract($this->input->post()); // convert array to variable -- php function //
    
         
            
        $TestSubscriptionData['select'] = 'tts.*,st.name as student_name, st.mobile_number, st.profile_pic, tst.test_title';
        $TestSubscriptionData['tableName'] = "student_test_subscription tts"; 
        $TestSubscriptionData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=tts.student_id', 'type'=>'left');
        $TestSubscriptionData['join'][] = array('tableName' => 'test tst', 'condtion' => 'tst.id=tts.test_id', 'type'=>'left');
        $data['TestSubscriptionAll']  = $this->SystemModel->getAll($TestSubscriptionData); 
        
        $this->load->admin('test_demo/test_subscription_index', $data);
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
    
    
    
    
    public function test_winer_list_auto(){
        extract($this->input->post()); // convert array to variable -- php function //
        $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name';   
        $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
        $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
//                    $student_attempt_test_Data['condtion'] = "sat.test_id=" . $test_id. " AND sat.category_id=".$category_id;
        $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);

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


                $TotalCorrenctAns = 0;
                $TotalWrongAns = 0;
                $TotalSkippedAns = 0;
                $TotalMarkForReviewAns = 0;

                if($_StudentAttemptTestQAData->ans !=0 || $_StudentAttemptTestQAData->ans !=1){
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
                                                                                    ORDER BY `sat`.`total_mark` DESC, `sat`.`total_time` ASC');  

 
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
                                        $_StudentAttemptTestData['cash_prize'] = 0;
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
                            $Update_student_attempt_testData['condtion'] = "id=" . $_tempArray['id'];
                            $result213 = $this->SystemModel->updateData($Update_student_attempt_testData);
                        }
                        
            $data['test_detail'] = $TestDetail;
            $data['student_detail'] = $tempArray;
            $data['apply_test_id'] = $apply_test_id;
        $this->load->admin('test_demo/view_result', $data);
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
        redirect('admin/Test_demo');
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
            
            
        $this->load->admin('test_demo/winer_list', $data);
    }
    
    public function publish_winer_action() {
        extract($this->input->post()); // convert array to variable -- php function //
        $ApplyTestCatData['tableName'] = "apply_test";
        $ApplyTestCatData['data'] = array( 
            'result_publish' => "true",
            'updated' => date('Y-m-d H:i:s')
        );
        $ApplyTestCatData['condtion'] = "id=" . $apply_test_id;
        $result = $this->SystemModel->updateData($ApplyTestCatData);
        redirect('admin/Test_demo');
    }
     

}
