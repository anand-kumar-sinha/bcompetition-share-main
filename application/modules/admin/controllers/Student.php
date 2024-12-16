<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Student extends MY_Controller
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
        $adminData = $this->session->userdata('adminData');
        
        $modelData['select'] = 'st.*, cou.country_name, sta.state_name, cit.city_name';
        $modelData['tableName'] = 'student st';
        $modelData['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'state sta', 'condtion' => 'sta.id=st.state_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'city cit', 'condtion' => 'cit.id=st.city_id', 'type'=>'left');
        $modelData['condtion'] = "st.is_deleted=0";
        $AllStudent = $this->SystemModel->getAll($modelData);
         
        
        $tempArray = new stdClass;
        $i=0;

        foreach ($AllStudent as $_AllStudent){
            $OldInwardPalletData['select'] = 'SUM(amount) as total_earn_amount';
            $OldInwardPalletData['tableName'] = "student_refer";
            $OldInwardPalletData['condtion'] = "refer_student_id=".$_AllStudent->id;
            $TotalEarnDetail = $this->SystemModel->getOne($OldInwardPalletData); 
            $_AllStudent->total_earn = $TotalEarnDetail->total_earn_amount;
            $tempArray->$i = $_AllStudent;
            
            $student_test_subscriptionData['join'] = array();
            $student_test_subscriptionData['select'] = 'sts.*, tst.test_title';
            $student_test_subscriptionData['tableName'] = "student_test_subscription sts";
            $student_test_subscriptionData['join'][] = array('tableName' => 'test tst', 'condtion' => 'tst.id=sts.test_id', 'type'=>'left');
            $student_test_subscriptionData['condtion'] = "student_id=".$_AllStudent->id;
            $tempArray->$i->student_test_subscribe = $this->SystemModel->getAll($student_test_subscriptionData); 
            
            $i++;
        }

        $data['AllStudent'] = $tempArray;
        
        if(isset($_GET['c_id'])){
            $id = $_GET['c_id'];
            $studentEditData['tableName'] = 'student';
            $studentEditData['condtion'] = "id=" . $id;
            $data['StudentDetail'] = $this->SystemModel->getOne($studentEditData);
        }
        
        $CountryData['tableName'] = 'country';
        $CountryData['condtion'] = "is_deleted=0 AND status='Active'";
        $data['AllCountry'] = $this->SystemModel->getAll($CountryData);
        
        $this->load->admin('student/index', $data);
    }

    public function checkrefercodeinfo()
    {
        $postarr = $this->input->post();
        $checkreferdata= $this->SystemModel->checkreferdata($postarr['mobile_number']);
             
         $checkReferaInfo = 0;
             if(empty($checkreferdata)){
                    $checkReferaInfo = 1;
                }
                echo $checkReferaInfo;exit;
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'student';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->admin('student/add_edit', $data);
    }
 

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "student";
         $checkReferaInfo = 0;
        if(!empty($referral_code)){
             $checkreferdata= $this->SystemModel->checkreferdata($referral_code);
             
       
             if(empty($checkreferdata)){
                    $checkReferaInfo = 1;
                }
        }


   

        
            $referral_code = rand(1000,9999);
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'school_name' => $school_name,
                'name' => $name,
                'email' => $email, 
                'date_of_birth' => date("Y-m-d", strtotime($date_of_birth)),
                'gender' => $gender,
                'mobile_number' => $mobile_number,
                'address' => $address,
                'country_id' => $country_id,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'pin_code' => $pin_code,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);

            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {
        	$checknumberExistornot = $this->SystemModel->checknumberExistornot($mobile_number);
        if(empty($checknumberExistornot)){
        
             $referral_code = rand(1000,9999);
            $modelData['data'] = array(
                'school_name' => $school_name,
                'referral_code'    => $referral_code,
                'name' => $name,
                'email' => $email, 
                'date_of_birth' => date("Y-m-d", strtotime($date_of_birth)),
                'gender' => $gender,
                'mobile_number' => $mobile_number,
                'address' => $address,
                'country_id' => $country_id,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'referral_code'    => $referral_code,
                'refer_code'    => $refer_code,
                'pin_code' => $pin_code,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

          

           
            $ReferStudentData['tableName'] = "student";        
            $ReferStudentData['condtion'] = "referral_code='".$refer_code."'";
            $ReferStudentDetail = $this->SystemModel->getOne($ReferStudentData);
            if(!empty($ReferStudentDetail)){

           
            $ReferStudentInertData['tableName'] = "student_refer";    
             $CompanyData['tableName'] = "company_detail";   
                                        $CompanyDetails = $this->SystemModel->getOne($CompanyData);
                                         
                                        $ReferAmount = $CompanyDetails->refer_amount;
            $ReferStudentInertData['data'] = array(     
                                        'refer_student_id'    => $ReferStudentDetail->id,
                                        'student_id'    => $inserted_client_id,
                                        'amount'    => $ReferAmount,
                                        'created'  => date('Y-m-d h:i:s')

            );
            $result = $this->SystemModel->insertData($ReferStudentInertData);


             $ReferStudentDetail = $this->SystemModel->getOne($ReferStudentData);
                                            
            $NewReferWalletAmount = $ReferStudentDetail->wallet_amount + $ReferAmount;
            $ReferStudentData['data'] = array(  
                                        'wallet_amount'    => $NewReferWalletAmount, 
                                        'updated' => date("Y-m-d H:i:s")
                    );
            $ReferStudentData['condtion'] = "id=" . $ReferStudentDetail->id;
            $ReferStudentDataresult = $this->SystemModel->updateData($ReferStudentData);
            
            $Referstudent_wallet_historyData['tableName'] = "student_wallet_history";   
            $Referstudent_wallet_historyData['data'] = array(     
                                            'student_id'    => $ReferStudentDetail->id,
                                            'wallet_amount'    => $ReferAmount,
                                            'old_wallet_amount' => 0.00,
                                            'transaction_number'    => "Refer Amount",
                                            'transaction_type'    => "Credit",
                                            'status'    => "Completed",
                                            'created'  => date('Y-m-d h:i:s'),
                                            'create_date'  => date('Y-m-d')

            );
            $Referstudent_wallet_historyDataresult = $this->SystemModel->insertData($Referstudent_wallet_historyData);


 }


            //save data into database
                $code = $refer_code;
                 $codeData = $this->SystemModel->getTestData($code);
            if(!empty($codeData)){
                        $levelId = $codeData->level1;
                        $levelupdtaa = explode(',', $levelId);
                        $grouparr = array($inserted_client_id);
                        $megearr = array_merge($levelupdtaa, $grouparr);
                        $implodata = implode(",", $megearr);
                        $updatedata = [
                            'level1' => $implodata
                        ];
                        $this->SystemModel->update_test_code($updatedata, $codeData->id);
                        $level = 1;
                        $this->display($code, $referral_code, $inserted_client_id,$codeData->student_id,$codeData->parent_id, $level);
                    }else{
                        $insertData = [
                            'student_id' => $inserted_client_id,
                            'parent_id' => 0,
                            'code' => $code,
                            'referal_code' => $referral_code,
                            'level1' => 0,
                            'level2' => 0,
                            'level3' => 0,
                            'level4' => 0,
                            'level5' => 0,
                        ];
                        $this->SystemModel->insert_data($insertData);
                    }
                // end data





            //end
                     

          
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
            
            }
        }
        
        







       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Student');
    }


      public function display($code, $referal_code, $student_id,$parent_id, $mainparent, $level)
    {  
        if(!empty($this->SystemModel->getTestParentData($mainparent))){
            $codeData = $this->SystemModel->getTestParentData($mainparent);
            if($level < 5){
                $level = $level + 1;
                $checklevel = 'level'.$level;
                $levelId = $codeData->$checklevel;
                $levelupdtaa = explode(',', $levelId);
                $grouparr = array($student_id);
                $megearr = array_merge($levelupdtaa, $grouparr);
                $implodata = implode(",", $megearr);
                $updatedata = [
                    'level'.$level => $implodata
                ];
                
                $this->SystemModel->update_test_code($updatedata, $codeData->id);
                
                $this->display($code, $referal_code, $student_id,$codeData->student_id,$codeData->parent_id, $level);
            }
            
        }else{
            $codeData = $this->SystemModel->getTestData($code);
            $insertData = [
                'student_id' => $student_id,
                'parent_id' => $codeData->student_id,
                'code' => $code,
                'referal_code' => $referal_code,
                'level1' => 0,
                'level2' => 0,
                'level3' => 0,
                'level4' => 0,
                'level5' => 0,
            ];
            $this->SystemModel->insert_data($insertData);
        }
    }


    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "student";
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
        redirect('admin/Student');
    }
    
    public function get_state_list()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $StateData['tableName'] = 'state';
        $StateData['condtion'] = "is_deleted=0 AND status='Active' AND country_id=".$country_id;
        $AllState = $this->SystemModel->getAll($StateData);
        
        $html = '';
        $html .= '<option value="">- Select State -</option>';
        foreach ($AllState as $_AllState){
            $selected = "";
            if($state_id == $_AllState->id){
               $selected = "selected";
            }
            $html .= '<option value="'.$_AllState->id.'" '.$selected.'>'.$_AllState->state_name.'</option>';
        }
        
        echo $html;
        die();
    }
    
    public function get_city_list()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $CityData['tableName'] = 'city';
        $CityData['condtion'] = "is_deleted=0 AND status='Active' AND state_id=".$state_id;
        $AllCity = $this->SystemModel->getAll($CityData);
        
        $html = '';
        $html .= '<option value="">- Select City -</option>';
        foreach ($AllCity as $_AllCity){
            $selected = "";
            if($city_id == $_AllCity->id){
               $selected = "selected";
            }
            $html .= '<option value="'.$_AllCity->id.'" '.$selected.'>'.$_AllCity->city_name.'</option>';
        }
        
        echo $html;
        die();
    }
    public function unique_student()
    {
        extract($this->input->post()); // convert array to variable -- php function //
       
        $StateData['tableName'] = 'student';
        $StateData['condtion'] = "mobile_number='".$mobile_number."'";
        $AllState = $this->SystemModel->tableRowCount($StateData);
       
        echo $AllState;
        die();
    }
    
    public function transfer_request_index()
    {
        $adminData = $this->session->userdata('adminData');
        
        $modelData['select'] = 'stm.*,st.name,st.wallet_amount, cou.country_name, sta.state_name, cit.city_name';
        $modelData['tableName'] = 'student_transfer_money stm';
        $modelData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=stm.student_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'state sta', 'condtion' => 'sta.id=st.state_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'city cit', 'condtion' => 'cit.id=st.city_id', 'type'=>'left');
        $modelData['condtion'] = "stm.status='Pending'";
        $data['AllStudent'] = $this->SystemModel->getAll($modelData);
         
        $this->load->admin('student/transfer_request_index', $data);
    }

        public function transfer_history_request_index()
    {
        $adminData = $this->session->userdata('adminData');
        
        $modelData['select'] = 'stm.*,st.name,st.wallet_amount, cou.country_name, sta.state_name, cit.city_name';
        $modelData['tableName'] = 'student_transfer_money stm';
        $modelData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=stm.student_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'state sta', 'condtion' => 'sta.id=st.state_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'city cit', 'condtion' => 'cit.id=st.city_id', 'type'=>'left');
        $modelData['condtion'] = "stm.status='Completed'";
        $data['AllStudent'] = $this->SystemModel->getAll($modelData);
         
        $this->load->admin('student/transfer_history_request_index', $data);
    }


    public function delete_transfer_requrest($id='')
    {
        extract($this->input->post());
        $this->SystemModel->delete_student_transfer_money($id);
        redirect('admin/Student/transfer_request_index');
    }

    public function approve_transfer_request($id='')
    {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $student_transfer_moneyData['tableName'] = 'student_transfer_money';
        $student_transfer_moneyData['condtion'] = "id=".$id;
        $StudentTransferMoneyDetail = $this->SystemModel->getOne($student_transfer_moneyData);
        
        
        $student_transfer_moneyData['data'] = array(
            'status' => "Completed",
            'updated' => date('Y-m-d H:i:s')
        );
        $student_transfer_moneyData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($student_transfer_moneyData);
        
        
        $studentData['tableName'] = "student";
        $studentData['condtion'] = "id=" . $StudentTransferMoneyDetail->student_id;
        $StudentDetail = $this->SystemModel->getOne($studentData);
       
        $OldWalletAmount = $StudentDetail->wallet_amount;
        $NewWalletAmount = $OldWalletAmount - $StudentTransferMoneyDetail->amount;;
        
        $studentData['data'] = array(
            'wallet_amount' => $NewWalletAmount,
            'updated' => date('Y-m-d H:i:s')
        );
        $studentData['condtion'] = "id=" . $StudentTransferMoneyDetail->student_id;
        $result = $this->SystemModel->updateData($studentData);
        
        $student_wallet_historyData['tableName'] = "student_wallet_history";   
        $student_wallet_historyData['data'] = array(     
                                        'student_id'    => $StudentDetail->id,
                                        'wallet_amount'    => $StudentTransferMoneyDetail->amount,
                                        'transaction_number'    => 'Transfer Amount',
                                        'old_wallet_amount' => $NewWalletAmount,
                                        'transaction_type'    => "Debit",
                                        'status'    => "Completed",
                                        'created'  => date('Y-m-d h:i:s'),
                                        'create_date'  => date('Y-m-d')

        );
       
        $result = $this->SystemModel->insertData($student_wallet_historyData);
        $transaction_id = $this->SystemModel->lastInsertId();

           //sned ntification
            // notification
       
             
       
                    $user_id = $StudentDetail->id;
                    $title                      = "Transfer Amount, Transfer Amount : ".$StudentTransferMoneyDetail->amount."";
                    $content                    = "Wallet Amount : 210 Rs by B Competition";
                    $type                       = "new_notification";
                    
                    $is_fcm_exist   = $this->SystemModel->getStudentInfo($StudentDetail->id);
                    
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
                        $insert_noti['student_id']    = $StudentDetail->id;
                        $insert_noti['title']       = "Transfer Amount";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "Transfer Amount : ".$StudentTransferMoneyDetail->amount."";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                      
        //end

        
       redirect('admin/Student/transfer_request_index');
          
    }
    
    public function wallet_history_index($student_id)
    {
        
        $modelData['tableName'] = 'student_wallet_history stm';
        $modelData['condtion'] = "student_id=".$student_id;
        $data['AllStudentWallet'] = $this->SystemModel->getAll($modelData);
        $data['student_id'] = $student_id;
         
        $this->load->admin('student/wallet_history_index', $data);
    }
    public function rewards_earn_index($student_id)
    {
        
        $modelData['select'] = 'sr.*,st.name';
        $modelData['tableName'] = 'student_refer sr';
        $modelData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sr.student_id', 'type'=>'left');
        $modelData['condtion'] = "sr.refer_student_id=".$student_id;
    $data['AllStudentRewardsEarn'] = $this->SystemModel->getAll($modelData);
         
        $this->load->admin('student/rewards_earn_index', $data);
    }
    
    
     public function student_result_view($student_id =''){
        extract($this->input->post()); // convert array to variable -- php function //
        
        $studentEditData['select'] = 'st.*,cou.country_name, sta.state_name, cit.city_name';
        $studentEditData['tableName'] = 'student st';
        $studentEditData['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
        $studentEditData['join'][] = array('tableName' => 'state sta', 'condtion' => 'sta.id=st.state_id', 'type'=>'left');
        $studentEditData['join'][] = array('tableName' => 'city cit', 'condtion' => 'cit.id=st.city_id', 'type'=>'left');
        $studentEditData['condtion'] = "st.id=" . $student_id;
        $data['StudentDetail'] = $this->SystemModel->getOne($studentEditData);

                $TestData['tableName'] = "student_attempt_test";        
                $TestData['condtion'] = "student_id=".$student_id;
                $TestDetail = $this->SystemModel->getAll($TestData);
                
                $TotalWonTestData['select'] = 'SUM(cash_prize) as total_cash_prize';   
                $TotalWonTestData['tableName'] = "student_attempt_test";        
                $TotalWonTestData['condtion'] = "student_id=".$student_id;
                $TotalWonTestDetail = $this->SystemModel->getOne($TotalWonTestData);
                
                   
                $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name,st.mobile_number, ct.city_name,st.wallet_amount, tst.test_title';   
                $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
                $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
                $student_attempt_test_Data['join'][] = array('tableName' => 'city ct', 'condtion' => 'ct.id=st.city_id', 'type'=>'left');
                $student_attempt_test_Data['join'][] = array('tableName' => 'test tst', 'condtion' => 'tst.id=sat.test_id', 'type'=>'left');
                $student_attempt_test_Data['condtion'] = "sat.student_id=" . $student_id;
                $student_attempt_test_Data['order'][0] = "sat.created";
                $student_attempt_test_Data['order'][1] = "DESC";
                $StudentAttemptTestData = $this->SystemModel->getAll($student_attempt_test_Data);
     
                
                
                $CategoryTestData['select'] = 'SUM(sat.cash_prize) as total_cash_prize, cat.category_name, SUM(sat.total_mark) as TotalMarks,  SUM(sat.get_mark) as TotalGetMark';   
                $CategoryTestData['tableName'] = "student_attempt_test sat";        
                $CategoryTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=sat.category_id', 'type'=>'left');
                $CategoryTestData['condtion'] = "sat.student_id=".$student_id;
                $CategoryTestData['group_by'] = "sat.category_id";
                $CategoryTestDetail = $this->SystemModel->getAll($CategoryTestData);
              
                $TempArray = array();
                $i = 0;
                $TotalPercentage = 0;
                foreach ($CategoryTestDetail as $_CategoryTestDetail){
                    $Percent = $_CategoryTestDetail->TotalGetMark * 100 / $_CategoryTestDetail->TotalMarks;
                    $_CategoryTestDetail->percentage = abs($Percent);
                    $TotalPercentage = $TotalPercentage + abs($Percent);
                    $TempArray[$i]= (array)$_CategoryTestDetail;
                    $i++;
                }
                if($TotalPercentage !=0 && count($CategoryTestDetail)!=0){
                    $winning_percentage =  $TotalPercentage / count($CategoryTestDetail);
                } else {
                    $winning_percentage = 0;
                }
               
                $data['RecentlyParticipated'] = $StudentAttemptTestData;
                $data['ExamStatics'] = $TempArray;
                $data['total_exam'] = count($TestDetail);
                $data['total_won'] = $TotalWonTestDetail->total_cash_prize;
                $data['winning_percentage'] = $winning_percentage;
                
        $this->load->admin('student/student_result_view', $data);
    }

    public function addStudentWallet()
    {
        $postArr = $this->input->post();



          $studentinfo['tableName'] = "student";
                $studentinfo['condtion']  = "id=" . $postArr['student_id'] . "";
                $studentinfodata = $this->SystemModel->getOne($studentinfo);
                $finalStudentAMount = $studentinfodata->wallet_amount +  $postArr['wallet_amont'];
                 $stuData = ['wallet_amount'=>number_format((float)$finalStudentAMount, 2, '.', '')];
               //      $this->SystemModel->updateStudWal($stuData, $postArr['student_id']);


         $student_wallet_historyData['tableName'] = "student_wallet_history";   
         $student_wallet_historyData['data'] = array(     
                'student_id'    => $postArr['student_id'],
                'wallet_amount'    => $postArr['wallet_amont'],
                'old_wallet_amount' => $finalStudentAMount,
                'transaction_number'    => 'Admin Add Wallet',
                'transaction_type'    => "Credit",
                'status'    => "Completed",
                'created'  => date('Y-m-d h:i:s'),
                'create_date'  => date('Y-m-d')

        );
       
        $result = $this->SystemModel->insertData($student_wallet_historyData);

         $studentData['tableName'] = "student";
        $studentData['condtion'] = "id=" . $postArr['student_id'];
        $StudentDetail = $this->SystemModel->getOne($studentData);
       
        $OldWalletAmount = $StudentDetail->wallet_amount;
        $NewWalletAmount = $OldWalletAmount + $postArr['wallet_amont'];
        
        $studentData['data'] = array(
            'wallet_amount' => $NewWalletAmount,
            'updated' => date('Y-m-d H:i:s')
        );
        $studentData['condtion'] = "id=" . $postArr['student_id'];
        $result = $this->SystemModel->updateData($studentData);






        // notification
                    $user_id = $postArr['student_id'];
                    $title                      = "Wallet Top Up, Wallet Amount : ".$postArr['wallet_amont']." Rs by B Competition";
                    $content                    = "Wallet Amount : 210 Rs by B Competition";
                    $type                       = "new_notification";
                    
                    $is_fcm_exist   = $this->SystemModel->getStudentInfo($postArr['student_id']);
                    
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
                        $insert_noti['student_id']    = $postArr['student_id'];
                        $insert_noti['title']       = "Wallet Top Up";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "Wallet Amount : ".$postArr['wallet_amont']." Rs by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }











        redirect('admin/Student/wallet_history_index/'.$postArr['student_id']);
    }

    public function student_refer_level()
    {
         $data['earn_data'] = $this->SystemModel->student_group_level();

        $this->load->admin('refer_earn_level/student_refer_level', $data);
    }

     public function actionSaveGroup($value='')
    {
        $postArr = $this->input->post();
        $updateData = [
            'student_first_group_member' => $postArr['student_first_group_member'],
            'student_second_group_member' => $postArr['student_second_group_member'],
            'student_third_group_member' => $postArr['student_third_group_member'],
            'student_fourth_group_member' => $postArr['student_fourth_group_member'],
            'student_fifth_group_member' => $postArr['student_fifth_group_member'],
             'student_first_group_member_amount' => $postArr['student_first_group_member_amount'],
              'student_second_group_member_amount' => $postArr['student_second_group_member_amount'],
               'student_third_group_member_amount' => $postArr['student_third_group_member_amount'],
                'student_fourth_group_member_amount' => $postArr['student_fourth_group_member_amount'],
                 'student_fifth_group_member_amount' => $postArr['student_fifth_group_member_amount'],
           
         
        ];
        
         $result = $this->SystemModel->update_student_group($updateData);
         $successMessage = "Record added successfully";
          $this->session->set_flashdata('success', $successMessage);
          redirect('admin/Student/student_refer_level');
    }

}
