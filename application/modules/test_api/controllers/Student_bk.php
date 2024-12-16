<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->load->model('SystemModel');      
    }
      
    
    public function update_profile(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($student_id) && isset($mobile_number) && isset($fcm_id) && isset($device_id) && isset($state_id) && isset($city_id) && isset($pin_code) && isset($name) && isset($email) && isset($date_of_birth) && isset($gender) && isset($address) && isset($country_id)  && isset($school_name)
		){
            
            $uploadPath = FCPATH . 'uploads/student_profile';
                //Check if the directory already exists.
              if (!is_dir($uploadPath)) {
                  //Directory does not exist, so lets create it.
              mkdir($uploadPath, 0755, true);
            }

            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $student_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                if(isset($_FILES['profile_pic']['name'])){
                    if ($_FILES['profile_pic']['name'] != '') {
                        if(!empty($CustomerOldDetail->profile_pic)){
                            $path = FCPATH . 'uploads/student_profile/'.$CustomerOldDetail->profile_pic;
                            if (file_exists($path)) {   
                                unlink($path);
                            }
                        }
                        $profile_pic = $this->SystemModel->imageUpload('profile_pic', $uploadPath);

                    } else {
                         $profile_pic = $CustomerOldDetail->profile_pic;
                    }
                } else {
                    $profile_pic = $CustomerOldDetail->profile_pic;
                }

                $modelData['data'] = array(  
                                            'school_name'    => $school_name,
                                            'name'    => $name,
                                            'email'    => $email,
                                            'date_of_birth'    => date("Y-m-d", strtotime($date_of_birth)),
                                            'gender'    => $gender,
                                            'mobile_number'    => $mobile_number,
                                            'address'    => $address,
                                            'country_id'    => $country_id,
                                            'state_id'    => $state_id,
                                            'city_id'    => $city_id,
                                            'pin_code'    => $pin_code,
                                            'device_id'    => $device_id,
                                            'fcm_id'    => $fcm_id,
                                            'profile_pic'    => $profile_pic,
                                            'updated' => date("Y-m-d H:i:s")
                        );
                $modelData['condtion'] = "id=" . $student_id;
                $result = $this->SystemModel->updateData($modelData);
                
                $modelData1['select'] = 'st.*, cou.country_name, s.state_name, ct.city_name';
                $modelData1['tableName'] = "student st";
                $modelData1['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
                $modelData1['join'][] = array('tableName' => 'state s', 'condtion' => 's.id=st.state_id', 'type'=>'left');
                $modelData1['join'][] = array('tableName' => 'city ct', 'condtion' => 'ct.id=st.city_id', 'type'=>'left');
                $modelData1['condtion'] = "st.id=" . $student_id;
                $CustomerNewDetail = $this->SystemModel->getOne($modelData1);

                $CustomerNewDetail->auth_id = $CustomerNewDetail->id;
                $CustomerNewDetail->auth_token = $CustomerNewDetail->device_id;
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Update Profile sucessfully',
                    'profile_pic'   => base_url()."uploads/student_profile/".$profile_pic,
                    'data'      => array($CustomerNewDetail)
                );

            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No User Available',
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
    
    
    public function student_notification_list(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $student_notificationData['tableName'] = "student_notification";        
                $student_notificationData['condtion'] = "student_id=" . $auth_id;
                $ResultNoti = $this->SystemModel->tableRowCount($student_notificationData);

                if ($ResultNoti > 0) {
                    $StudentNotificationData = $this->SystemModel->getAll($student_notificationData);
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Notification Available',
                        'data'      => $StudentNotificationData
                    );
                } else {
                    $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Notification Available',
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
    
    
     
    public function add_wallet_amount(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($wallet_amount) && isset($transaction_number)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                $student_wallet_historyData['tableName'] = "student_wallet_history";   
                $student_wallet_historyData['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'wallet_amount'    => $wallet_amount,
                                                'transaction_number'    => $transaction_number,
                                                'transaction_type'    => "Credit",
                                                'status'    => "Completed",
                                                'created'  => date('Y-m-d h:i:s'),
                                                'create_date'  => date('Y-m-d')

                );
                $result = $this->SystemModel->insertData($student_wallet_historyData);
                $transaction_id = $this->SystemModel->lastInsertId();

                $student_notification['tableName'] = "student_notification";   
                $student_notification['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'title'    => "Add Amount in Wallet",
                                                'notification_detail'    => "Add ".$wallet_amount." Rs In your Wallet",
                                                'created'  => date('Y-m-d h:i:s'),

                );
                $result = $this->SystemModel->insertData($student_notification);
                
                $NewWalletAmount = $CustomerOldDetail->wallet_amount + $wallet_amount;
                
                $modelData['data'] = array(  
                                            'wallet_amount'    => $NewWalletAmount, 
                                            'updated' => date("Y-m-d H:i:s")
                        );
                $modelData['condtion'] = "id=" . $CustomerOldDetail->id;
                $result = $this->SystemModel->updateData($modelData);
                
                $modelData['condtion'] = "id=" . $CustomerOldDetail->id;
                $CustomerNewDetail = $this->SystemModel->getOne($modelData);
                     
                /* Start : Refer User Wallet Update */
//                $CompanyData['tableName'] = "company_detail";   
//                $CompanyDetails = $this->SystemModel->getOne($CompanyData);
//                 
//                $ReferAmount = $CompanyDetails->refer_amount;
//                        
//                $ReferStudentData['tableName'] = "student";        
//                $ReferStudentData['condtion'] = "referral_code='".$CustomerNewDetail->refer_code."'";
//                $ReferStudentCount = $this->SystemModel->tableRowCount($ReferStudentData);
//                
//                if($ReferStudentCount > 0){
//                    $ReferStudentDetail = $this->SystemModel->getOne($ReferStudentData);
//                    
//                    $NewReferWalletAmount = $ReferStudentDetail->wallet_amount + $ReferAmount;
//                    $ReferStudentData['data'] = array(  
//                                                'wallet_amount'    => $NewReferWalletAmount, 
//                                                'updated' => date("Y-m-d H:i:s")
//                            );
//                    $ReferStudentData['condtion'] = "id=" . $ReferStudentDetail->id;
//                    $ReferStudentDataresult = $this->SystemModel->updateData($ReferStudentData);
//                    
//                    $Referstudent_wallet_historyData['tableName'] = "student_wallet_history";   
//                    $Referstudent_wallet_historyData['data'] = array(     
//                                                    'student_id'    => $ReferStudentDetail->id,
//                                                    'wallet_amount'    => $ReferAmount,
//                                                    'transaction_number'    => "Refer Amount",
//                                                    'transaction_type'    => "Credit",
//                                                    'status'    => "Completed",
//                                                    'created'  => date('Y-m-d h:i:s'),
//                                                    'create_date'  => date('Y-m-d')
//
//                    );
//                    $Referstudent_wallet_historyDataresult = $this->SystemModel->insertData($Referstudent_wallet_historyData);
//
//                    $Refer_student_notification['tableName'] = "student_notification";   
//                    $Refer_student_notification['data'] = array(     
//                                                    'student_id'    => $ReferStudentDetail->id,
//                                                    'title'    => "Refer Amount Add",
//                                                    'notification_detail'    => "Add <b>".$NewReferWalletAmount." Rs</b> In your Refer Student ".$CustomerNewDetail->name,
//                                                    'created'  => date('Y-m-d h:i:s'),
//
//                    );
//                    $Refer_student_notificationresult = $this->SystemModel->insertData($Refer_student_notification);
//                    
//                    
//                    $ReferstudentAmountData['tableName'] = "refer_student_amount";   
//                    $ReferstudentAmountData['data'] = array(     
//                                                    'refer_student_id'    => $ReferStudentDetail->id,
//                                                    'student_id'    => $CustomerOldDetail->id,
//                                                    'amount'    => $ReferAmount,
//                                                    'created'  => date('Y-m-d h:i:s'),
//
//                    );
//                    $ReferstudentAmountDataresult = $this->SystemModel->insertData($ReferstudentAmountData);
//                    
//                }
                
                /* End : Refer User Wallet Update */
                
                
                
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Add Amount in Wallet sucessfully',
                    'data'      => array($CustomerNewDetail)
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
    
    
    
    public function refer_student_list(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                 
                $RefermodelData['select'] = 'sr.*, st.name';
                $RefermodelData['tableName'] = "student_refer sr";        
                $RefermodelData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sr.student_id');
                $RefermodelData['condtion'] = "sr.refer_student_id=" . $auth_id;
                $ReferralStudentList = $this->SystemModel->getAll($RefermodelData);
                if(count($ReferralStudentList) > 0) {
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Referral Student List',
                        'data'      => $ReferralStudentList
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
                    'message'   => 'No student Available',
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
    
    public function refer_student_amount(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                 
                $RefermodelData['select'] = 'sr.*, st.name, st.mobile_number';
                $RefermodelData['tableName'] = "student_refer sr";         
                $RefermodelData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sr.student_id');
                $RefermodelData['condtion'] = "sr.refer_student_id=" . $auth_id;
//                $RefermodelData['group_by'] = 'sr.student_id';
                $ReferralStudentList = $this->SystemModel->getAll($RefermodelData);
                if(count($ReferralStudentList) > 0) {
                    
                    $TotalReferAmount = 0;
                    foreach ($ReferralStudentList as $_ReferralStudentList){
                        $TotalReferAmount = $TotalReferAmount + $_ReferralStudentList->amount;
                    }
                    
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Referral Student List',
                        'total_refer_amount'      => number_format((float)$TotalReferAmount, 2, '.', ''),
                        'data'      => $ReferralStudentList
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
                    'message'   => 'No student Available',
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
    
    
    public function change_language(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($language_id)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                $modelData['data'] = array(  
                                            'language_id'    => $language_id, 
                                            'updated' => date("Y-m-d H:i:s")
                        );
                $modelData['condtion'] = "id=" . $CustomerOldDetail->id;
                $result = $this->SystemModel->updateData($modelData);
                
                $modelData['condtion'] = "id=" . $CustomerOldDetail->id;
                $CustomerNewDetail = $this->SystemModel->getOne($modelData);
                     
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Change Language sucessfully',
                    'data'      => array($CustomerNewDetail)
                );

            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No student Available',
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
    
      
    public function student_transfer_money_request(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($amount) && isset($bank_detail) && isset($date_of_birth) && isset($mobile_number)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                $student_transfer_money_Data['tableName'] = "student_transfer_money";   
                $student_transfer_money_Data['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'amount'    => $amount,
                                                'bank_detail'    => $bank_detail,
                                                'date_of_birth'    => date("Y-m-d", strtotime($date_of_birth)),
                                                'mobile_number'    => $mobile_number,
                                                'status'    => "Pending",
                                                'created'  => date('Y-m-d h:i:s'), 

                );
                $result = $this->SystemModel->insertData($student_transfer_money_Data);
                $transaction_id = $this->SystemModel->lastInsertId();

                
                $student_notification['tableName'] = "student_notification";   
                $student_notification['data'] = array(     
                                                'student_id'    => $auth_id,
                                                'title'    => "Request Transfer Amount",
                                                'notification_detail'    => "Request Transfer Amount : ".$amount." Rs",
                                                'created'  => date('Y-m-d h:i:s'),

                );
                $result = $this->SystemModel->insertData($student_notification);
                
                
                $student_transfer_money_Data['condtion'] = "id=" . $transaction_id;
                $CustomerNewDetail = $this->SystemModel->getOne($student_transfer_money_Data);
                     
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Add Request sucessfully',
                    'data'      => array($CustomerNewDetail)
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
    
    
    
    
    
    public function student_wallet_history() {
         extract($this->input->post()); // convert array to variable -- php function //

//        user_advertise_share_history
       
        if(isset($auth_id) && isset($auth_token)){
            
            $modelData['tableName'] = "student";
            $modelData['condtion']  = "id=" . $auth_id . " AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);
            if($result > 0){ 
                
                $UserDetail = $this->SystemModel->getOne($modelData);
                
				$advertiseData['select'] = 'student_wallet_history.*, student.name, student.mobile_number,';
                $advertiseData['tableName'] = 'student_wallet_history';
                $advertiseData['condtion']  = "student_id=" . $auth_id;
				$advertiseData['join'][] = array('tableName' => 'student', 'condtion' => 'student_wallet_history.student_id=student.id', 'type'=>'left');
                $AdvertisesDetails = $this->SystemModel->getAll($advertiseData);				
				
                if(count($AdvertisesDetails) > 0) {
                    $jsonArray = array(
                        'status'    => 1,
                        'total_wallet_amount'    => $UserDetail->wallet_amount,
                        'message'   => 'Data Available',
                        'data'      => $AdvertisesDetails
                    );
                } else {
                    $jsonArray = array(
                        'status'    => 0,
                        'total_wallet_amount'    => '',
                        'message'   => 'No Data Available',
                        'data'      => null
                    );
                }
            } else {
                $jsonArray = array(
                    'status'    => 0,
                        'message'   => 'No User Available',
                        'data'      => Null
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
   
    
        
      public function student_result(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token) && isset($student_id)){
             
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                
                $TestData['tableName'] = "student_attempt_test";        
                $TestData['condtion'] = "student_id=".$student_id;
                $TestDetail = $this->SystemModel->getAll($TestData);
                
                $TotalWonTestData['select'] = 'SUM(cash_prize) as total_cash_prize';   
                $TotalWonTestData['tableName'] = "student_attempt_test";        
                $TotalWonTestData['condtion'] = "student_id=".$student_id;
                $TotalWonTestDetail = $this->SystemModel->getOne($TotalWonTestData);
                
                   
                $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name,st.mobile_number,st.school_name, ct.city_name,st.wallet_amount, tst.test_title';   
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
                    $_CategoryTestDetail->percentage = number_format((float)abs($Percent), 2, '.', '');
                    $TotalPercentage = $TotalPercentage + abs($Percent);
                    $TempArray[$i]= (array)$_CategoryTestDetail;
                    $i++;
                }
                $winning_percentage =  $TotalPercentage / count($CategoryTestDetail);
                
                $data['recently_participated'] = $StudentAttemptTestData;
                $data['exam_Statics'] = $TempArray;
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Student Results',
                        'total_exam'   => count($TestDetail),
                        'total_won'   => $TotalWonTestDetail->total_cash_prize,
                        'winning_percentage'   => number_format((float)$winning_percentage, 2, '.', ''),
                        'data'      => array($data)
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
    
    
     public function student_result_view(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($auth_id) && isset($auth_token)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                $TestData['tableName'] = "test";        
                $TestData['condtion'] = "id=" . $test_id;
                $Testresult = $this->SystemModel->tableRowCount($TestData);
                if($Testresult > 0){
                    $TestDetail = $this->SystemModel->getOne($TestData);
                     
                    $student_attempt_test_Data['select'] = 'sat.*,st.name as student_name';   
                    $student_attempt_test_Data['tableName'] = "student_attempt_test sat";    
                    $student_attempt_test_Data['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=sat.student_id', 'type'=>'left');
                    $student_attempt_test_Data['condtion'] = "sat.test_id=" . $test_id." AND sat.student_id=".$student_id;
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
                        foreach ($StudentAttemptTestQAData as $_StudentAttemptTestQAData) {
                            $tempArray[$i]['question_list'][$j] = (array)$_StudentAttemptTestQAData;
                          
                            
                            $test_section_questionData['tableName'] = "test_section_question";        
                            $test_section_questionData['condtion'] = "id=" . $_StudentAttemptTestQAData->question_id;
                            $test_section_questionResult = $this->SystemModel->tableRowCount($test_section_questionData);
                            
                            if($test_section_questionResult > 0) {
                             
                                $test_section_questionDetail = $this->SystemModel->getOne($test_section_questionData);
                            
                                $tempArray[$i]['question_list'][$j]['marking_correct'] = $test_section_questionDetail->marking_correct;
                                $tempArray[$i]['question_list'][$j]['marking_incorrect'] = $test_section_questionDetail->marking_incorrect;
                             
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
                                            $tempArray[$i]['question_list'][$j]['student_ans'] = "true"; 
                                            $TotalCorrenctAns = $TotalCorrenctAns + 1;
                                        } else {
                                            $totalInCorrectMark = $totalInCorrectMark + $incorrect_marking;
                                            $tempArray[$i]['question_list'][$j]['student_ans'] = "false";
                                            $TotalWrongAns = $TotalWrongAns + 1;
                                        }
                                        $tempArray[$i]['question_list'][$j]['correct_ans'] = $correctOption;
                                        $tempArray[$i]['question_list'][$j]['ans_type'] = $test_section_questionDetail->ans_type;
                                    } else if($test_section_questionDetail->ans_type == "mcqm"){
                                        $correctOptionTemp = strtoupper($test_section_questionDetail->correct_ans_chk);
                                        $correctOption = str_replace(",","#",$correctOptionTemp);

                                        if($correctOption == $_StudentAttemptTestQAData->ans){
                                            $totalCorrectMark = $totalCorrectMark + $marking_correct;
                                            $tempArray[$i]['question_list'][$j]['student_ans'] = "true";
                                            $TotalCorrenctAns = $TotalCorrenctAns + 1;
                                        } else {
                                            $totalInCorrectMark = $totalInCorrectMark + $incorrect_marking;
                                            $tempArray[$i]['question_list'][$j]['student_ans'] = "false";
                                            $TotalWrongAns = $TotalWrongAns + 1; 
                                        }
                                        $tempArray[$i]['question_list'][$j]['correct_ans'] = $correctOption;
                                        $tempArray[$i]['question_list'][$j]['ans_type'] = $test_section_questionDetail->ans_type;
                                    } else {
                                        $correctOption = $test_section_questionDetail->correct_ans_fill;
                                        if($correctOption == $_StudentAttemptTestQAData->ans){
                                            $totalCorrectMark = $totalCorrectMark + $marking_correct;
                                             $tempArray[$i]['question_list'][$j]['student_ans'] = "true";
                                             $TotalCorrenctAns = $TotalCorrenctAns + 1;
                                        } else {
                                            $totalInCorrectMark = $totalInCorrectMark + $incorrect_marking;
                                            $tempArray[$i]['question_list'][$j]['student_ans'] = "false";
                                            $TotalWrongAns = $TotalWrongAns + 1;
                                        } 
                                        $tempArray[$i]['question_list'][$j]['correct_ans'] = $correctOption;
                                        $tempArray[$i]['question_list'][$j]['ans_type'] = $test_section_questionDetail->ans_type;
                                    }
                                } else if($_StudentAttemptTestQAData->ans == 0) {
                                    $TotalSkippedAns = $TotalSkippedAns+1;
                                } else if($_StudentAttemptTestQAData->ans == 1) {
                                    $TotalMarkForReviewAns = $TotalMarkForReviewAns + 1;
                                }
                            } else {
                                $tempArray[$i]['question_list'][$j]['student_ans'] = '';
                                $tempArray[$i]['question_list'][$j]['correct_ans'] = '';
                                $tempArray[$i]['question_list'][$j]['ans_type'] = 'mcqm';
                                $tempArray[$i]['question_list'][$j]['marking_correct'] = '';
                                $tempArray[$i]['question_list'][$j]['marking_incorrect'] = '';
                            }
                            $j++;
                        }
                        
                            
                        $tempArray[$i]['totalCorrectMark'] = $totalCorrectMark;
                        $tempArray[$i]['totalInCorrectMark'] = $totalInCorrectMark;
//                        $tempArray[$i]['TotalGetMark'] = $totalCorrectMark - $totalInCorrectMark;
//                        $tempArray[$i]['TotalCorrenctAns'] = $TotalCorrenctAns;
//                        $tempArray[$i]['TotalWrongAns'] = $TotalWrongAns;
//                        $tempArray[$i]['TotalSkippedAns'] = $TotalSkippedAns;
//                        $tempArray[$i]['TotalMarkForReviewAns'] = TotalMarkForReviewAns;
//                        $tempArray[$i]['totalMark'] = $totalMark;
                        $i++;
                    }
                    
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Student Result',
                        'data'      => $tempArray
                    );
                } else {
                    $jsonArray = array(
                        'status'    => 1,
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
    


    /*
    Date: 03-07-2022
    Comment: get store category list using course id
    */
    public function store_category_list(){
        extract($this->input->post()); // con
        if(isset($course_id) && isset($auth_id) && isset($auth_token)){
       
            $store_category_list['tableName'] = "store_category";        
            $store_category_list['condtion'] = "store_id=" . $course_id. " AND is_deleted = 0";
            $ResultNoti = $this->SystemModel->tableRowCount($store_category_list);

            if ($ResultNoti > 0) {
                $StoreCategoryList = $this->SystemModel->getAll($store_category_list);
                foreach ($StoreCategoryList as $Pkey => $Pvalue) {
                        $modelData['tableName'] = "store";        
                        $modelData['condtion'] = "id=" . $Pvalue->store_id;
                        $StoreData = $this->SystemModel->getOne($modelData);
                        $StoreCategoryList[$Pkey]->store_name = $StoreData->course_title;
                }
                $jsonArray = $StoreCategoryList;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Store Category Data Available.',
                        'data'      => $jsonArray
                    );
            } else {

                   $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No store category Available',
                        'data'      => null
                    );
                }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please pass the courseid',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }


    public function store_content_list(){
        extract($this->input->post()); // con
        if(isset($course_id) && isset($category_id) && isset($auth_id) && isset($auth_token) && isset($content_type)){
       

            if($content_type == "pdf"){
                $store_category_list['tableName'] = "store_course_content_detail";        
                $store_category_list['condtion'] = "store_id=" . $course_id. " AND category_id = ".$category_id. " AND course_content_file_type = 'PDF'";
                $ResultStoreContent = $this->SystemModel->getAll($store_category_list);
            }else if($content_type == "video"){
                $store_category_list['tableName'] = "store_course_content_detail";        
                $store_category_list['condtion'] = "store_id=" . $course_id. " AND category_id = ".$category_id. " AND course_content_file_type != 'PDF'";
                $ResultStoreContent = $this->SystemModel->getAll($store_category_list);
            }else{
                $store_category_list_live['tableName'] = "store_course_content_liveclass_detail";        
                $store_category_list_live['condtion'] = "store_id=" . $course_id. " AND category_id = ".$category_id;
                $ResultStoreContent = $this->SystemModel->getAll($store_category_list_live);
            }
            $resultArr = $ResultStoreContent;
           
             if (count($resultArr) > 0) {
                //$StoreCategoryList = $this->SystemModel->getAll($store_category_list);
                foreach ($resultArr as $Pkey => $Pvalue) {
                     if($Pvalue->check_status == 1){
                        $url = $Pvalue->course_content_video_link;
                
                        $file_headers = @get_headers($url);
                        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                             $resultArr[$Pkey]->contenttype = 'pdf'; 
                        }
                        else {
                            if (in_array("Content-Type: application/pdf", get_headers($url))) {
                            $resultArr[$Pkey]->contenttype = 'pdf';    
                            }else{
                                $resultArr[$Pkey]->contenttype = 'video';
                            }
                        }
                        
                        
                        $resultArr[$Pkey]->liveClassName = null;
                        $resultArr[$Pkey]->liveClassStartDate = null;
                        $resultArr[$Pkey]->liveClassStartTime = null;
                        $resultArr[$Pkey]->liveClassMethod = null;
                        $resultArr[$Pkey]->liveClassUrl = null;
                    }else{
                        $resultArr[$Pkey]->contenttype = 'liveclass';
                        $resultArr[$Pkey]->course_content_file_type = null;
                        $resultArr[$Pkey]->course_content_title = null;
                        $resultArr[$Pkey]->course_content_detail = null;
                        $resultArr[$Pkey]->course_content_pdf_file = null;
                        $resultArr[$Pkey]->course_content_video_link = null;
                        $resultArr[$Pkey]->course_content_status = null;
                        $methodArr = ['1'=>'Youtube','2'=>'Google meet','3'=>'Zoom'];
                        $getMtod = $methodArr[$Pvalue->liveClassMethod];
                        $resultArr[$Pkey]->liveClassMethod = $getMtod;
                    }
                        $modelData['tableName'] = "store";        
                        $modelData['condtion'] = "id=" . $Pvalue->store_id;
                        $StoreData = $this->SystemModel->getOne($modelData);
                        $modelDataCategory['tableName'] = "store_category";        
                        $modelDataCategory['condtion'] = "id=" . $Pvalue->category_id;
                        $StoreCategoryData = $this->SystemModel->getOne($modelDataCategory);
                        $resultArr[$Pkey]->store_name = $StoreData->course_title;
                        $resultArr[$Pkey]->store_category_id = $Pvalue->category_id;
                        $resultArr[$Pkey]->store_category_name = $StoreCategoryData->category_name;
                        unset($resultArr[$Pkey]->category_id);
                }
                $jsonArray = $resultArr;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Store content Data Available.',
                        'data'      => $jsonArray
                    );
            } else {

                   $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No store cotent Available',
                        'data'      => null
                    );
                }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }


     public function store_content_list_test(){
        extract($this->input->post()); // con
        if(isset($course_id) && isset($category_id) && isset($auth_id) && isset($auth_token)){
       
            $store_category_list['tableName'] = "store_course_content_detail";        
            $store_category_list['condtion'] = "store_id=" . $course_id. " AND category_id = ".$category_id;
            $ResultStoreContent = $this->SystemModel->getAll($store_category_list);

            $store_category_list_live['tableName'] = "store_course_content_liveclass_detail";        
            $store_category_list_live['condtion'] = "store_id=" . $course_id. " AND category_id = ".$category_id;
            $ResultStoreContentLive = $this->SystemModel->getAll($store_category_list_live);
            if(!empty($ResultStoreContent) && !empty($ResultStoreContentLive)){
                $resultArr = array_merge($ResultStoreContent, $ResultStoreContentLive);
            }else if(!empty($ResultStoreContent)){
                $resultArr = $ResultStoreContent;    
            }else{
                $resultArr = $ResultStoreContentLive;
            }

            
            if (count($resultArr) > 0) {
                //$StoreCategoryList = $this->SystemModel->getAll($store_category_list);
                foreach ($resultArr as $Pkey => $Pvalue) {
                    if($Pvalue->check_status == 1){
                        $url = $Pvalue->course_content_video_link;
                
                        $file_headers = @get_headers($url);
                        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                             $resultArr[$Pkey]->contenttype = 'pdf'; 
                        }
                        else {
                            if (in_array("Content-Type: application/pdf", get_headers($url))) {
                            $resultArr[$Pkey]->contenttype = 'pdf';    
                            }else{
                                $resultArr[$Pkey]->contenttype = 'video';
                            }
                        }
                        
                        
                        $resultArr[$Pkey]->liveClassName = null;
                        $resultArr[$Pkey]->liveClassStartDate = null;
                        $resultArr[$Pkey]->liveClassStartTime = null;
                        $resultArr[$Pkey]->liveClassMethod = null;
                        $resultArr[$Pkey]->liveClassUrl = null;
                    }else{
                        $resultArr[$Pkey]->contenttype = 'liveclass';
                        $resultArr[$Pkey]->course_content_file_type = null;
                        $resultArr[$Pkey]->course_content_title = null;
                        $resultArr[$Pkey]->course_content_detail = null;
                        $resultArr[$Pkey]->course_content_pdf_file = null;
                        $resultArr[$Pkey]->course_content_video_link = null;
                        $resultArr[$Pkey]->course_content_status = null;
                        $methodArr = ['1'=>'Youtube','2'=>'Google meet','3'=>'Zoom'];
                        $getMtod = $methodArr[$Pvalue->liveClassMethod];
                        $resultArr[$Pkey]->liveClassMethod = $getMtod;
                    }
                        $modelData['tableName'] = "store";        
                        $modelData['condtion'] = "id=" . $Pvalue->store_id;
                        $StoreData = $this->SystemModel->getOne($modelData);
                        $modelDataCategory['tableName'] = "store_category";        
                        $modelDataCategory['condtion'] = "id=" . $Pvalue->category_id;
                        $StoreCategoryData = $this->SystemModel->getOne($modelDataCategory);
                        $resultArr[$Pkey]->store_name = $StoreData->course_title;
                        $resultArr[$Pkey]->store_category_id = $Pvalue->category_id;
                        $resultArr[$Pkey]->store_category_name = $StoreCategoryData->category_name;
                        unset($resultArr[$Pkey]->category_id);
                }
                $jsonArray = $resultArr;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Store content Data Available.',
                        'data'      => $jsonArray
                    );
            } else {

                   $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No store cotent Available',
                        'data'      => null
                    );
                }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }


    //subsription api
     public function save_subscription_data(){
        extract($this->input->post()); // con
        if(isset($auth_id) && isset($auth_token) && isset($course_id) && isset($amount) && isset($transaction_id)){
         $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
             $student_subscription_historyData['tableName'] = "student_subscription_details"; 
            $student_subscription_historyData['data'] = [
                                                    'student_id' => $auth_id,
                                                    'course_id' => $course_id,
                                                    'transaction_id' => $transaction_id,
                                                    'amount' => $amount,
                                                ];
            $result = $this->SystemModel->insertData($student_subscription_historyData);
            $transaction_id = $this->SystemModel->lastInsertId();
            $jsonArray = array(
                'status'    => 1,
                'message'   => 'Subscription Add sucessfully',
                'data'      => "Success"
            );

         } else {

           $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Student Available',
                'data'      => null
            );
        }
        }else {
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
    //end


    //course deatils api
         public function store_details(){
        extract($this->input->post()); // con
        if(isset($category_id) && isset($auth_id) && isset($auth_token)){
       
            $store_list['tableName'] = "store";        
            $store_list['condtion'] = "isDelete = 0 AND course_category_id=" . $category_id;
             $result = $this->SystemModel->tableRowCount($store_list);
          
           
            
            if ($result > 0) {
                $StoreList = $this->SystemModel->getAll($store_list);
                foreach ($StoreList as $Pkey => $Pvalue) {
                    $student_sub['tableName'] = "student_subscription_details";        
                    $student_sub['condtion'] = "student_id=" . $auth_id. " AND course_id = ".$Pvalue->id ;
                    $StudentSub = $this->SystemModel->tableRowCount($student_sub);
                    $isSubscription = 0;
                    if($StudentSub > 0){
                        $isSubscription = 1;
                    }
                    $StoreList[$Pkey]->course_image = base_url('uploads/store_image/'. $Pvalue->course_image);
                    $StoreList[$Pkey]->is_subscribed= $isSubscription;
                }
                $jsonArray = $StoreList;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Store Details Data Available.',
                        'data'      => $jsonArray
                    );
            } else {

                   $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No store cotent Available',
                        'data'      => null
                    );
                }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end



    //get subcription data
    public function get_subscription_list(){
        extract($this->input->post()); // con
        if(isset($category_id) && isset($auth_id) && isset($auth_token)){
       
            $subscription_list['tableName'] = "student_subscription_details";        
            $subscription_list['condtion'] = "student_id=" . $auth_id. " AND course_id = ".$category_id;
            $ResultNoti = $this->SystemModel->tableRowCount($subscription_list);

            if ($ResultNoti > 0) {
                $SubscriptionList = $this->SystemModel->getAll($subscription_list);
                 foreach ($SubscriptionList as $Pkey => $Pvalue) {

                     $store_list['tableName'] = "store";        
                     $store_list['condtion'] = "isDelete = 0 AND id = ".$Pvalue->course_id;
                     $StoreList = $this->SystemModel->getAll($store_list);
                      foreach ($StoreList as $Pkey => $Pvalue) {
                        $StoreList[$Pkey]->course_image = base_url('uploads/store_image/'. $Pvalue->course_image);
                    }
                    //$jsonArray = $StoreList;

                        // $modelData['tableName'] = "student";        
                        // $modelData['condtion'] = "id=" . $Pvalue->student_id;
                        // $StudentData = $this->SystemModel->getOne($modelData);
                        // $categorymodelData['tableName'] = "category";        
                        // $categorymodelData['condtion'] = "id=" . $Pvalue->course_id;
                        // $CategoryData = $this->SystemModel->getOne($categorymodelData);
                        // $SubscriptionList[$Pkey]->student_name = $StudentData->name;
                        // $SubscriptionList[$Pkey]->category_name = $CategoryData->category_name;
                }
                $jsonArray = $StoreList;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Subscription Data Available.',
                        'data'      => $jsonArray
                    );
            } else {

                   $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No subscription Available',
                        'data'      => null
                    );
                }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end

    //join meeting api
     public function joinmeetingapi(){
        extract($this->input->post()); // con
        if(isset($meeting_id) && isset($auth_id) && isset($auth_token) && isset($content_type)){
       
        $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
             $student_subscription_historyData['tableName'] = "join_meeting_details"; 
            $student_subscription_historyData['data'] = [
                                                    'store_id' => $auth_id,
                                                    'meeting_id' => $meeting_id,
                                                    'content_type' => $content_type,
                                                    
                                                ];
            $result = $this->SystemModel->insertData($student_subscription_historyData);
            $transaction_id = $this->SystemModel->lastInsertId();
            $jsonArray = array(
                'status'    => 1,
                'message'   => 'Data Add sucessfully',
                'data'      => "Success"
            );

         } else {

           $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Student Available',
                'data'      => null
            );
        }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end api

    //add live class message
         public function addLiveClassChat(){
        extract($this->input->post()); // con
        if(isset($liveclass_chat_id ) && isset($auth_id) && isset($auth_token) && isset($message)){
       
        $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
             $student_subscription_historyData['tableName'] = "live_class_chat"; 
            $student_subscription_historyData['data'] = [
                                                    'store_id' => $auth_id,
                                                    'liveclass_chat_id' => $liveclass_chat_id ,
                                                    'message' => $message,
                                                    'auth_id' => $auth_id
                                                ];
            $result = $this->SystemModel->insertData($student_subscription_historyData);
            $transaction_id = $this->SystemModel->lastInsertId();
            $jsonArray = array(
                'status'    => 1,
                'message'   => 'Data Add sucessfully',
                'data'      => "Success"
            );

         } else {

           $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Student Available',
                'data'      => null
            );
        }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end api

    //get live class
     public function getLiveClassChat(){
       //  print_r($this->input->get());exit;
        extract($this->input->post()); // con
        if(isset($liveclass_chat_id ) && isset($auth_id) && isset($auth_token)){
       
            $chat_list['tableName'] = "live_class_chat";        
            $chat_list['condtion'] = "store_id=" . $auth_id. " AND liveclass_chat_id =" .$liveclass_chat_id;
            $chat_list['condtion'] .= "ORDER BY id";
           // $ResultNoti = $this->SystemModel->tableRowCount($chat_list);

           $ChatList =  $this->SystemModel->directQuery('SELECT *
                                        FROM `live_class_chat` `sat`
                                        WHERE `sat`.`store_id` = '.$auth_id.' AND `sat`.`liveclass_chat_id` = '.$liveclass_chat_id.'
                                        ');

            if (!empty($ChatList)) {
               // $ChatList = $this->SystemModel->getOne($chat_list);
              //  $ChatList = $ChatList[0];
              // echo '<pre>';print_r($ChatList);exit;
                foreach ($ChatList as $key => $ChatList) {
                        $modelData['tableName'] = "student";        
                        $modelData['condtion'] = "id=" . $auth_id;
                        $StoreData = $this->SystemModel->getOne($modelData);
                        // $ChatLists = new stdClass();
                        // $ChatLists->liveClassChatId = $ChatList['liveclass_chat_id'];
                        // $ChatLists->liveClassStudentId = $auth_id;
                        // $ChatLists->liveClassStudentName =  $StoreData->name;
                        // $ChatLists->liveClassStudentMobile =  $StoreData->mobile_number;
                        // $ChatLists->liveClassMessageType = "text";
                        // $ChatLists->liveClassMessage = $ChatList['message'];
                        $ChatLists[] = [
                            'liveClassChatId' => $ChatList['liveclass_chat_id'],
                            'liveClassStudentId' => $auth_id,
                            'liveClassStudentName' => $StoreData->name,
                            'liveClassStudentMobile' => $StoreData->mobile_number,
                            'liveClassMessageType' => "text",
                            'liveClassMessage' => $ChatList['message'],
                        ];
                    }
                  
                
                // foreach ($ChatList as $Pkey => $Pvalue) {
                //         $modelData['tableName'] = "student";        
                //         $modelData['condtion'] = "id=" . $auth_id;
                //         $StoreData = $this->SystemModel->getOne($modelData);
                //         $ChatList[$Pkey]->store_name = $StoreData->course_title;
                // }
                $jsonArray = $ChatLists;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Live Class Chat Data Available.',
                        'data'      => $jsonArray
                    );
            } else {

                   $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Live Class Chat Data Available',
                        'data'      => null
                    );
                }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please pass the courseid',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end

    /*end funcation*/

    public function referearnlevel()
    {
        $code = 'BD19';
        $referal_code = 'BD22';
        $student_id = 12;
        //$this->display($code, $referal_code, $student_id);
        $codeData = $this->SystemModel->getTestData($code);
        if(!empty($codeData)){
            $levelId = $codeData->level1;
            $levelupdtaa = explode(',', $levelId);
            $grouparr = array($student_id);
            $megearr = array_merge($levelupdtaa, $grouparr);
            $implodata = implode(",", $megearr);
            $updatedata = [
                'level1' => $implodata
            ];
            $this->SystemModel->update_test_code($updatedata, $codeData->id);
            $level = 1;
            $this->display($code, $referal_code, $student_id,$codeData->group_id,$codeData->parent_id, $level);
        }else{
            $insertData = [
                'group_id' => $student_id,
                'parent_id' => 0,
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
        echo 'success';exit;
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
                
                $this->display($code, $referal_code, $student_id,$codeData->group_id,$codeData->parent_id, $level);
            }
            
        }else{
            $codeData = $this->SystemModel->getTestData($code);
            $insertData = [
                'group_id' => $student_id,
                'parent_id' => $codeData->group_id,
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

        //add live class message
         public function myreferal(){
        extract($this->input->post()); // con
        if(isset($auth_id) && isset($auth_token)){
       
        $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
         
            $result = $this->SystemModel->getStudentReferal($auth_id);
           // echo '<pre>';print_r($result);exit;
            // $referldata = ['member'=>'member_level','testactive'=>'test_active_level','testsubmit'=>'test_submit_level','courseactive'=>'course_level1','adpackageactive'=>'adpackageactive'];
          $memberreferldata = ['member'=>'member_level'];
          $referldata = ['course'=> 'course_level'];
          $testactivedata = ['test_active_level'=> 'test_active_level'];
          $testsubmitdata = ['test_submit_level'=> 'test_submit_level'];
          $packagedata = ['package_level'=> 'package_level'];
          $autoPoolData = ['adpackageactive'=> 'adpackageactive'];
          



//package data
           //test active
           foreach ($autoPoolData as $Pkey => $Pvalue) {
                //level1
                $level1 = explode(",",$result->level1);
                $level1TotalAmount = 0;
                $levelcount = count($level1);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'1';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount1 = $levelamount->$levelid;
                    $totalAutoPackage1 = 0;
                    $totalAutoPackageAmount1 = 0;
                 if(!empty($level1)){
                    foreach ($level1 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_buy_autopool_packages($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalAutoPackage1 = $totalAutoPackage1 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                         $amount = $Svalue->amount;
                                        $totalAutoPackageAmount1 = $totalAutoPackageAmount1 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
               //  echo $totalTestActiveAmount1;
                 //end
                  //level2
                $level2 = explode(",",$result->level2);
                $level1TotalAmount = 0;
                $levelcount = count($level2);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'2';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount2 = $levelamount->$levelid;
                    $totalAutoPackage2 = 0;
                    $totalAutoPackageAmount2 = 0;
                 if(!empty($level2)){
                    foreach ($level2 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_buy_autopool_packages($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalAutoPackage2 = $totalAutoPackage2 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                           $amount = $Svalue->amount;
                                        $totalAutoPackageAmount2 = $totalAutoPackageAmount2 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                
                 //end
                  //level3
                $level3 = explode(",",$result->level3);
                $level1TotalAmount = 0;
                $levelcount = count($level3);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'3';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount3 = $levelamount->$levelid;
                    $totalAutoPackage3 = 0;
                    $totalAutoPackageAmount3 = 0;
                 if(!empty($level3)){
                    foreach ($level3 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_buy_autopool_packages($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalAutoPackage3 = $totalAutoPackage3 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                          $amount = $Svalue->amount;
                                        $totalAutoPackageAmount3 = $totalAutoPackageAmount3 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level4
                $level4 = explode(",",$result->level4);
                $level1TotalAmount = 0;
                $levelcount = count($level4);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'4';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount4 = $levelamount->$levelid;
                    $totalAutoPackage4 = 0;
                    $totalAutoPackageAmount4 = 0;
                 if(!empty($level4)){
                    foreach ($level4 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_buy_autopool_packages($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalAutoPackage4 = $totalAutoPackage4 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                           $amount = $Svalue->amount;
                                        $totalAutoPackageAmount4 = $totalAutoPackageAmount4 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level5
                $level5 = explode(",",$result->level5);
                $level1TotalAmount = 0;
                $levelcount = count($level5);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'5';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount5 = $levelamount->$levelid;
                    $totalAutoPackage5 = 0;
                    $totalAutoPackageAmount5 = 0;
                 if(!empty($level5)){
                    foreach ($level5 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_buy_autopool_packages($Lvalue);
                       
                            if(!empty($subdata)){
                                    $totalAutoPackage5 = $totalAutoPackage5 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                          $amount = $Svalue->amount;
                                        $totalAutoPackageAmount5 = $totalAutoPackageAmount5 + $amount;

                                    }
                                }

                            }else{
                                $totalStudentCount5 = 0;
                                 $totalStudentCourseAmount5 = 0;
                            }
                        }
                    }
                 }
                 //end
                
                 $totalAutoPackageAmount1 = $totalAutoPackageAmount1 * $levelamount1 / 100;
                 $totalAutoPackageAmount1 = number_format((float)$totalAutoPackageAmount1, 2, '.', ''); 
                 $totalAutoPackageAmount2 = $totalAutoPackageAmount2 * $levelamount2 / 100;
                 $totalAutoPackageAmount2 = number_format((float)$totalAutoPackageAmount2, 2, '.', ''); 
                 $totalAutoPackageAmount3 = $totalAutoPackageAmount3 * $levelamount3 / 100;
                 $totalAutoPackageAmount3 = number_format((float)$totalAutoPackageAmount3, 2, '.', ''); 
                 $totalAutoPackageAmount4 = $totalAutoPackageAmount4 * $levelamount4 / 100;
                 $totalAutoPackageAmount4 = number_format((float)$totalAutoPackageAmount4, 2, '.', ''); 
                 $totalAutoPackageAmount5 = $totalAutoPackageAmount5 * $levelamount5 / 100;
                 $totalAutoPackageAmount5 = number_format((float)$totalAutoPackageAmount5, 2, '.', ''); 
                 $totalautopackageamount = 0;
                 $testSubmitArr = ['1'=>$totalAutoPackageAmount1,'2'=>$totalAutoPackageAmount2,'3'=>$totalAutoPackageAmount3,'4'=>$totalAutoPackageAmount4,'5'=>$totalAutoPackageAmount5];
               
                 foreach ($testSubmitArr as $key => $value) {
                     $totalautopackageamount = $totalautopackageamount + $value;
                 }
                $autopoolpackagedata = [
                    "level1" => $totalAutoPackage1,
                    "level2" => $totalAutoPackage2,
                    "level3" => $totalAutoPackage3,
                    "level4" => $totalAutoPackage4,
                    "level5" => $totalAutoPackage5,
                    "totalincomelevel1" => $totalAutoPackageAmount1,
                    "totalincomelevel2" => $totalAutoPackageAmount2,
                    "totalincomelevel3" => $totalAutoPackageAmount3,
                    "totalincomelevel4" => $totalAutoPackageAmount4,
                    "totalincomelevel5" => $totalAutoPackageAmount5,
                ];
                  
            }
          //end
          //end














          //package data
           //test active
           foreach ($packagedata as $Pkey => $Pvalue) {
                //level1
                $level1 = explode(",",$result->level1);
                $level1TotalAmount = 0;
                $levelcount = count($level1);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'1';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount1 = $levelamount->$levelid;
                    $totalPackage1 = 0;
                    $totalPackageAmount1 = 0;
                 if(!empty($level1)){
                    foreach ($level1 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->package_purchase_info($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalPackage1 = $totalPackage1 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                         $amount = $Svalue->amount;
                                        $totalPackageAmount1 = $totalPackageAmount1 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
               //  echo $totalTestActiveAmount1;
                 //end
                  //level2
                $level2 = explode(",",$result->level2);
                $level1TotalAmount = 0;
                $levelcount = count($level2);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'2';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount2 = $levelamount->$levelid;
                    $totalPackage2 = 0;
                    $totalPackageAmount2 = 0;
                 if(!empty($level2)){
                    foreach ($level2 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->package_purchase_info($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalPackage2 = $totalPackage2 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                           $amount = $Svalue->amount;
                                        $totalPackageAmount2 = $totalPackageAmount2 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                
                 //end
                  //level3
                $level3 = explode(",",$result->level3);
                $level1TotalAmount = 0;
                $levelcount = count($level3);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'3';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount3 = $levelamount->$levelid;
                    $totalPackage3 = 0;
                    $totalPackageAmount3 = 0;
                 if(!empty($level3)){
                    foreach ($level3 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->package_purchase_info($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalPackage3 = $totalPackage3 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                          $amount = $Svalue->amount;
                                        $totalPackageAmount3 = $totalPackageAmount3 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level4
                $level4 = explode(",",$result->level4);
                $level1TotalAmount = 0;
                $levelcount = count($level4);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'4';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount4 = $levelamount->$levelid;
                    $totalPackage4 = 0;
                    $totalPackageAmount4 = 0;
                 if(!empty($level4)){
                    foreach ($level4 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->package_purchase_info($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalPackage4 = $totalPackage4 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                           $amount = $Svalue->amount;
                                        $totalPackageAmount4 = $totalPackageAmount4 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level5
                $level5 = explode(",",$result->level5);
                $level1TotalAmount = 0;
                $levelcount = count($level5);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'5';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount5 = $levelamount->$levelid;
                    $totalPackage5 = 0;
                    $totalPackageAmount5 = 0;
                 if(!empty($level5)){
                    foreach ($level5 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->package_purchase_info($Lvalue);
                       
                            if(!empty($subdata)){
                                    $totalPackage5 = $totalPackage5 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                          $amount = $Svalue->amount;
                                        $totalPackageAmount5 = $totalPackageAmount5 + $amount;

                                    }
                                }

                            }else{
                                $totalStudentCount5 = 0;
                                 $totalStudentCourseAmount5 = 0;
                            }
                        }
                    }
                 }
                 //end
                
                 $totalPackageAmount1 = $totalPackageAmount1 * $levelamount1 / 100;
                 $totalPackageAmount1 = number_format((float)$totalPackageAmount1, 2, '.', ''); 
                 $totalPackageAmount2 = $totalPackageAmount2 * $levelamount2 / 100;
                 $totalPackageAmount2 = number_format((float)$totalPackageAmount2, 2, '.', ''); 
                 $totalPackageAmount3 = $totalPackageAmount3 * $levelamount3 / 100;
                 $totalPackageAmount3 = number_format((float)$totalPackageAmount3, 2, '.', ''); 
                 $totalPackageAmount4 = $totalPackageAmount4 * $levelamount4 / 100;
                 $totalPackageAmount4 = number_format((float)$totalPackageAmount4, 2, '.', ''); 
                 $totalPackageAmount5 = $totalPackageAmount5 * $levelamount5 / 100;
                 $totalPackageAmount5 = number_format((float)$totalPackageAmount5, 2, '.', ''); 
                 $totalpackageamount = 0;
                 $testSubmitArr = ['1'=>$totalPackageAmount1,'2'=>$totalPackageAmount2,'3'=>$totalPackageAmount3,'4'=>$totalPackageAmount4,'5'=>$totalPackageAmount5];
               
                 foreach ($testSubmitArr as $key => $value) {
                     $totalpackageamount = $totalpackageamount + $value;
                 }
                $testpackagedata = [
                    "level1" => $totalPackage1,
                    "level2" => $totalPackage2,
                    "level3" => $totalPackage3,
                    "level4" => $totalPackage4,
                    "level5" => $totalPackage5,
                    "totalincomelevel1" => $totalPackageAmount1,
                    "totalincomelevel2" => $totalPackageAmount2,
                    "totalincomelevel3" => $totalPackageAmount3,
                    "totalincomelevel4" => $totalPackageAmount4,
                    "totalincomelevel5" => $totalPackageAmount5,
                ];
                  
            }
          //end
          //end


          //test submit
           //test active
           foreach ($testactivedata as $Pkey => $Pvalue) {
                //level1
                $level1 = explode(",",$result->level1);
                $level1TotalAmount = 0;
                $levelcount = count($level1);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'1';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount1 = $levelamount->$levelid;
                    $totaltestsubmit1 = 0;
                    $totalTestSubmitAmount1 = 0;
                 if(!empty($level1)){
                    foreach ($level1 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_attempt_test($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestsubmit1 = $totaltestsubmit1 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                         $amount = $this->SystemModel->getstoreinfo($Svalue->category_id);
                                        $totalTestSubmitAmount1 = $totalTestSubmitAmount1 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
               //  echo $totalTestActiveAmount1;
                 //end
                  //level2
                $level2 = explode(",",$result->level2);
                $level1TotalAmount = 0;
                $levelcount = count($level2);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'2';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount2 = $levelamount->$levelid;
                    $totaltestsubmit2 = 0;
                    $totalTestSubmitAmount2 = 0;
                 if(!empty($level2)){
                    foreach ($level2 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_attempt_test($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestsubmit2 = $totaltestsubmit2 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                           $amount = $this->SystemModel->getstoreinfo($Svalue->category_id);
                                        $totalTestSubmitAmount2 = $totalTestSubmitAmount2 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                  //level3
                $level3 = explode(",",$result->level3);
                $level1TotalAmount = 0;
                $levelcount = count($level3);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'3';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount3 = $levelamount->$levelid;
                    $totaltestsubmit3 = 0;
                    $totalTestSubmitAmount3 = 0;
                 if(!empty($level3)){
                    foreach ($level3 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_attempt_test($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestsubmit3 = $totaltestsubmit3 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                          $amount = $this->SystemModel->getstoreinfo($Svalue->category_id);
                                        $totalTestSubmitAmount3 = $totalTestSubmitAmount3 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level4
                $level4 = explode(",",$result->level4);
                $level1TotalAmount = 0;
                $levelcount = count($level4);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'4';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount4 = $levelamount->$levelid;
                    $totaltestsubmit4 = 0;
                    $totalTestSubmitAmount4 = 0;
                 if(!empty($level4)){
                    foreach ($level4 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_attempt_test($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestsubmit4 = $totaltestsubmit4 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                           $amount = $this->SystemModel->getstoreinfo($Svalue->category_id);
                                        $totalTestSubmitAmount4 = $totalTestSubmitAmount4 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level5
                $level5 = explode(",",$result->level5);
                $level1TotalAmount = 0;
                $levelcount = count($level5);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'5';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount5 = $levelamount->$levelid;
                    $totaltestsubmit5 = 0;
                    $totalTestSubmitAmount5 = 0;
                 if(!empty($level5)){
                    foreach ($level5 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_attempt_test($Lvalue);
                       
                            if(!empty($subdata)){
                                    $totaltestsubmit5 = $totaltestsubmit5 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                          $amount = $this->SystemModel->getstoreinfo($Svalue->category_id);
                                        $totalTestSubmitAmount5 = $totalTestSubmitAmount5 + $amount->course_price;

                                    }
                                }

                            }else{
                                $totalStudentCount5 = 0;
                                 $totalStudentCourseAmount5 = 0;
                            }
                        }
                    }
                 }
                 //end

                 $totalTestSubmitAmount1 = $totalTestSubmitAmount1 * $levelamount1 / 100;
                 $totalTestSubmitAmount1 = number_format((float)$totalTestSubmitAmount1, 2, '.', ''); 
                 $totalTestSubmitAmount2 = $totalTestSubmitAmount2 * $levelamount2 / 100;
                 $totalTestSubmitAmount2 = number_format((float)$totalTestSubmitAmount2, 2, '.', ''); 
                 $totalTestSubmitAmount3 = $totalTestSubmitAmount3 * $levelamount3 / 100;
                 $totalTestSubmitAmount3 = number_format((float)$totalTestSubmitAmount3, 2, '.', ''); 
                 $totalTestSubmitAmount4 = $totalTestSubmitAmount4 * $levelamount4 / 100;
                 $totalTestSubmitAmount4 = number_format((float)$totalTestSubmitAmount4, 2, '.', ''); 
                 $totalTestSubmitAmount5 = $totalTestSubmitAmount5 * $levelamount5 / 100;
                 $totalTestSubmitAmount5 = number_format((float)$totalTestSubmitAmount5, 2, '.', ''); 
                 $totaltestsubmitamount = 0;
                 $testSubmitArr = ['1'=>$totalTestSubmitAmount1,'2'=>$totalTestSubmitAmount2,'3'=>$totalTestSubmitAmount3,'4'=>$totalTestSubmitAmount4,'5'=>$totalTestSubmitAmount5];
                 foreach ($testSubmitArr as $key => $value) {
                     $totaltestsubmitamount = $totaltestsubmitamount + $value;
                 }
                $testsubmitdata = [
                    "level1" => $totaltestsubmit1,
                    "level2" => $totaltestsubmit2,
                    "level3" => $totaltestsubmit3,
                    "level4" => $totaltestsubmit4,
                    "level5" => $totaltestsubmit5,
                    "totalincomelevel1" => $totalTestSubmitAmount1,
                    "totalincomelevel2" => $totalTestSubmitAmount2,
                    "totalincomelevel3" => $totalTestSubmitAmount3,
                    "totalincomelevel4" => $totalTestSubmitAmount4,
                    "totalincomelevel5" => $totalTestSubmitAmount5,
                ];
                  
            }
          //end
          //end


          //test active
           foreach ($testactivedata as $Pkey => $Pvalue) {
                //level1
                $level1 = explode(",",$result->level1);
                $level1TotalAmount = 0;
                $levelcount = count($level1);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'1';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount1 = $levelamount->$levelid;
                    $totaltestactive1 = 0;
                    $totalTestActiveAmount1 = 0;
                 if(!empty($level1)){
                    foreach ($level1 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_test_subscription($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestactive1 = $totaltestactive1 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $Svalue->join_amount;
                                        $totalTestActiveAmount1 = $totalTestActiveAmount1 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
               //  echo $totalTestActiveAmount1;
                 //end
                  //level2
                $level2 = explode(",",$result->level2);
                $level1TotalAmount = 0;
                $levelcount = count($level2);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'2';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount2 = $levelamount->$levelid;
                    $totaltestactive2 = 0;
                    $totalTestActiveAmount2 = 0;
                 if(!empty($level2)){
                    foreach ($level2 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_test_subscription($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestactive2 = $totaltestactive2 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $Svalue->join_amount;
                                        $totalTestActiveAmount2 = $totalTestActiveAmount2 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                  //level3
                $level3 = explode(",",$result->level3);
                $level1TotalAmount = 0;
                $levelcount = count($level3);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'3';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount3 = $levelamount->$levelid;
                    $totaltestactive3 = 0;
                    $totalTestActiveAmount3 = 0;
                 if(!empty($level3)){
                    foreach ($level3 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_test_subscription($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestactive3 = $totaltestactive3 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $Svalue->join_amount;
                                        $totalTestActiveAmount3 = $totalTestActiveAmount3 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level4
                $level4 = explode(",",$result->level4);
                $level1TotalAmount = 0;
                $levelcount = count($level4);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'4';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount4 = $levelamount->$levelid;
                    $totaltestactive4 = 0;
                    $totalTestActiveAmount4 = 0;
                 if(!empty($level4)){
                    foreach ($level4 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_test_subscription($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totaltestactive4 = $totaltestactive4 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $Svalue->join_amount;
                                        $totalTestActiveAmount4 = $totalTestActiveAmount4 + $amount;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level5
                $level5 = explode(",",$result->level5);
                $level1TotalAmount = 0;
                $levelcount = count($level5);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'5';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount5 = $levelamount->$levelid;
                    $totaltestactive5 = 0;
                    $totalTestActiveAmount5 = 0;
                 if(!empty($level5)){
                    foreach ($level5 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_test_subscription($Lvalue);
                       
                            if(!empty($subdata)){
                                    $totaltestactive5 = $totaltestactive5 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $Svalue->join_amount;
                                        $totalTestActiveAmount5 = $totalTestActiveAmount5 + $amount;

                                    }
                                }

                            }else{
                                $totalStudentCount5 = 0;
                                 $totalStudentCourseAmount5 = 0;
                            }
                        }
                    }
                 }
                 //end

                 $totalTestActiveAmount1 = $totalTestActiveAmount1 * $levelamount1 / 100;
                 $totalTestActiveAmount1 = number_format((float)$totalTestActiveAmount1, 2, '.', ''); 
                 $totalTestActiveAmount2 = $totalTestActiveAmount2 * $levelamount2 / 100;
                 $totalTestActiveAmount2 = number_format((float)$totalTestActiveAmount2, 2, '.', ''); 
                 $totalTestActiveAmount3 = $totalTestActiveAmount3 * $levelamount3 / 100;
                 $totalTestActiveAmount3 = number_format((float)$totalTestActiveAmount3, 2, '.', ''); 
                 $totalTestActiveAmount4 = $totalTestActiveAmount4 * $levelamount4 / 100;
                 $totalTestActiveAmount4 = number_format((float)$totalTestActiveAmount4, 2, '.', ''); 
                 $totalTestActiveAmount5 = $totalTestActiveAmount5 * $levelamount5 / 100;
                 $totalTestActiveAmount5 = number_format((float)$totalTestActiveAmount5, 2, '.', ''); 
                 $totaltestactiveamount = 0;
                 $testSubmitArr = ['1'=>$totalTestActiveAmount1,'2'=>$totalTestActiveAmount2,'3'=>$totalTestActiveAmount3,'4'=>$totalTestActiveAmount4,'5'=>$totalTestActiveAmount5];
                 foreach ($testSubmitArr as $key => $value) {
                     $totaltestactiveamount = $totaltestactiveamount + $value;
                 }

                $testactivedata = [
                    "level1" => $totaltestactive1,
                    "level2" => $totaltestactive2,
                    "level3" => $totaltestactive3,
                    "level4" => $totaltestactive4,
                    "level5" => $totaltestactive5,
                    "totalincomelevel1" => $totalTestActiveAmount2,
                    "totalincomelevel2" => $totalTestActiveAmount2,
                    "totalincomelevel3" => $totalTestActiveAmount3,
                    "totalincomelevel4" => $totalTestActiveAmount4,
                    "totalincomelevel5" => $totalTestActiveAmount5,
                ];
                  
            }
          //end


            foreach ($referldata as $Pkey => $Pvalue) {
                //level1
                $level1 = explode(",",$result->level1);
                $level1TotalAmount = 0;
                $levelcount = count($level1);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'1';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount1 = $levelamount->$levelid;
                    $totalStudentCount1 = 0;
                    $totalStudentCourseAmount1 = 0;
                 if(!empty($level1)){
                    foreach ($level1 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_subscription_details($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalStudentCount1 = $totalStudentCount1 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $this->SystemModel->getstoreinfo($Svalue->course_id);
                                        $totalStudentCourseAmount1 = $totalStudentCourseAmount1 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                  //level2
                $level2 = explode(",",$result->level2);
                $level1TotalAmount = 0;
                $levelcount = count($level2);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'2';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount2 = $levelamount->$levelid;
                    $totalStudentCount2 = 0;
                    $totalStudentCourseAmount2 = 0;
                 if(!empty($level2)){
                    foreach ($level2 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_subscription_details($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalStudentCount2 = $totalStudentCount2 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $this->SystemModel->getstoreinfo($Svalue->course_id);
                                        $totalStudentCourseAmount2 = $totalStudentCourseAmount2 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                  //level3
                $level3 = explode(",",$result->level3);
                $level1TotalAmount = 0;
                $levelcount = count($level3);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'3';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount3 = $levelamount->$levelid;
                    $totalStudentCount3 = 0;
                    $totalStudentCourseAmount3 = 0;
                 if(!empty($level3)){
                    foreach ($level3 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_subscription_details($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalStudentCount3 = $totalStudentCount3 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $this->SystemModel->getstoreinfo($Svalue->course_id);
                                        $totalStudentCourseAmount3 = $totalStudentCourseAmount3 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level4
                $level4 = explode(",",$result->level4);
                $level1TotalAmount = 0;
                $levelcount = count($level4);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'4';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount4 = $levelamount->$levelid;
                    $totalStudentCount4 = 0;
                    $totalStudentCourseAmount4 = 0;
                 if(!empty($level4)){
                    foreach ($level4 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_subscription_details($Lvalue);
                          
                            if(!empty($subdata)){
                                    $totalStudentCount4 = $totalStudentCount4 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $this->SystemModel->getstoreinfo($Svalue->course_id);
                                        $totalStudentCourseAmount4 = $totalStudentCourseAmount4 + $amount->course_price;

                                    }
                                }

                            }
                        }
                    }
                 }
                 //end
                   //level5
                $level5 = explode(",",$result->level5);
                $level1TotalAmount = 0;
                $levelcount = count($level5);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'5';
                $levelamount = $this->SystemModel->getLevel($levelid);
                 $levelamount5 = $levelamount->$levelid;
                    $totalStudentCount5 = 0;
                    $totalStudentCourseAmount5 = 0;
                 if(!empty($level5)){
                    foreach ($level5 as $Lkey => $Lvalue) {
                        if($Lvalue != 0){
                            $subdata = $this->SystemModel->student_subscription_details($Lvalue);
                       
                            if(!empty($subdata)){
                                    $totalStudentCount5 = $totalStudentCount5 + count($subdata);
                                foreach ($subdata as $Skey => $Svalue) {
                                    if(!empty($Svalue)){
                                          
                                        $amount = $this->SystemModel->getstoreinfo($Svalue->course_id);
                                        $totalStudentCourseAmount5 = $totalStudentCourseAmount5 + $amount->course_price;

                                    }
                                }

                            }else{
                                $totalStudentCount5 = 0;
                                 $totalStudentCourseAmount5 = 0;
                            }
                        }
                    }
                 }
                 //end
                 $totalStudentCourseAmount1 = $totalStudentCourseAmount1 * $levelamount1 / 100;
                 $totalStudentCourseAmount1 = number_format((float)$totalStudentCourseAmount1, 2, '.', ''); 
                 $totalStudentCourseAmount2 = $totalStudentCourseAmount2 * $levelamount2 / 100;
                 $totalStudentCourseAmount2 = number_format((float)$totalStudentCourseAmount2, 2, '.', ''); 
                 $totalStudentCourseAmount3 = $totalStudentCourseAmount3 * $levelamount3 / 100;
                 $totalStudentCourseAmount3 = number_format((float)$totalStudentCourseAmount3, 2, '.', ''); 
                 $totalStudentCourseAmount4 = $totalStudentCourseAmount4 * $levelamount4 / 100;
                 $totalStudentCourseAmount4 = number_format((float)$totalStudentCourseAmount4, 2, '.', ''); 
                 $totalStudentCourseAmount5 = $totalStudentCourseAmount5 * $levelamount5 / 100;
                 $totalStudentCourseAmount5 = number_format((float)$totalStudentCourseAmount5, 2, '.', ''); 
                 $totalstudentcourseamount = 0;
                 $testSubmitArr = ['1'=>$totalStudentCourseAmount1,'2'=>$totalStudentCourseAmount2,'3'=>$totalStudentCourseAmount3,'4'=>$totalStudentCourseAmount4,'5'=>$totalStudentCourseAmount5];
                 foreach ($testSubmitArr as $key => $value) {
                     $totalstudentcourseamount = $totalstudentcourseamount + $value;
                 }

                $course = [
                    "level1" => $totalStudentCount1,
                    "level2" => $totalStudentCount2,
                    "level3" => $totalStudentCount3,
                    "level4" => $totalStudentCount4,
                    "level5" => $totalStudentCount5,
                    "totalincomelevel1" => $totalStudentCourseAmount1,
                    "totalincomelevel2" => $totalStudentCourseAmount2,
                    "totalincomelevel3" => $totalStudentCourseAmount3,
                    "totalincomelevel4" => $totalStudentCourseAmount4,
                    "totalincomelevel5" => $totalStudentCourseAmount5,
                ];
                  
            }
           

            foreach ($memberreferldata as $Pkey => $Pvalue) {




                $level1 = explode(",",$result->level1);
                $level1TotalAmount = 0;
                $levelcount = count($level1);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'1';
                $levelamount = $this->SystemModel->getLevel($levelid);

                $levelamount1 = $levelamount->$levelid;
                //$studentAmount = $this->SystemModel->getStudnetLevel($Cvalue);
                $level1TotalAmount = $level1TotalAmount +  $levelcount* $levelamount1;
$level1count = $levelcount;
$level1TotalAmounts = number_format((float)$level1TotalAmount, 2, '.', ''); 
                 $level2 = explode(",",$result->level2);
                $level2TotalAmount = 0;
                $levelcount = count($level2);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'2';
                $levelamount = $this->SystemModel->getLevel($levelid);
                $levelamount2 = $levelamount->$levelid;
                //$studentAmount = $this->SystemModel->getStudnetLevel($Cvalue);
                $level2TotalAmount = $level2TotalAmount +  $levelcount* $levelamount2;
$level2count = $levelcount;
$level2TotalAmounts = number_format((float)$level2TotalAmount, 2, '.', ''); 
                 $level3 = explode(",",$result->level3);
                $level3TotalAmount = 0;
                $levelcount = count($level3);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'3';
                $levelamount = $this->SystemModel->getLevel($levelid);
                $levelamount3 = $levelamount->$levelid;
                //$studentAmount = $this->SystemModel->getStudnetLevel($Cvalue);
                $level3TotalAmount = $level3TotalAmount +  $levelcount* $levelamount3;
$level3count = $levelcount;
$level3TotalAmounts = number_format((float)$level3TotalAmount, 2, '.', '');
                 $level4 = explode(",",$result->level4);
                $level4TotalAmount = 0;
                $levelcount = count($level4);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'4';
                $levelamount = $this->SystemModel->getLevel($levelid);
                $levelamount4 = $levelamount->$levelid;
                //$studentAmount = $this->SystemModel->getStudnetLevel($Cvalue);
                $level4TotalAmount = $level4TotalAmount +  $levelcount* $levelamount4;
$level4count = $levelcount;
$level4TotalAmounts= number_format((float)$level4TotalAmount, 2, '.', '');
                 $level5 = explode(",",$result->level5);
                $level5TotalAmount = 0;
                $levelcount = count($level5);
                $levelcount = $levelcount -1;
                $levelid = $Pvalue.'5';
                $levelamount = $this->SystemModel->getLevel($levelid);
                $levelamount5 = $levelamount->$levelid;
                //$studentAmount = $this->SystemModel->getStudnetLevel($Cvalue);
                $level5TotalAmount = $level5TotalAmount +  $levelcount* $levelamount5;
$level5count = $levelcount;
$level5TotalAmounts = number_format((float)$level5TotalAmount, 2, '.', '');    
                $totalmemberamount = 0;
                 $testSubmitArr = ['1'=>$level1TotalAmounts,'2'=>$level2TotalAmounts,'3'=>$level3TotalAmounts,'4'=>$level4TotalAmounts,'5'=>$level5TotalAmounts];
                 foreach ($testSubmitArr as $key => $value) {
                     $totalmemberamount = $totalmemberamount + $value;
                 }           
                $member = [
                    "level1" => $level1count,
                    "level2" => $level2count,
                    "level3" => $level3count,
                    "level4" => $level4count,
                    "level5" => $level5count,
                    "totalincomelevel1" => $level1TotalAmounts,
                    "totalincomelevel2" => $level2TotalAmounts,
                    "totalincomelevel3" => $level3TotalAmounts,
                    "totalincomelevel4" => $level4TotalAmounts,
                    "totalincomelevel5" => $level5TotalAmounts,
                ];
            }
            $incomelevel1 = $member['totalincomelevel1'] + $course['totalincomelevel1'] + $testactivedata['totalincomelevel1'] + $testsubmitdata['totalincomelevel4'] + $testpackagedata['totalincomelevel1'] + $autopoolpackagedata['totalincomelevel1'];
            $incomelevel2 = $member['totalincomelevel2'] + $course['totalincomelevel2'] + $testactivedata['totalincomelevel2'] + $testsubmitdata['totalincomelevel2'] + $testpackagedata['totalincomelevel2'] + $autopoolpackagedata['totalincomelevel2'];
            $incomelevel3 = $member['totalincomelevel3'] + $course['totalincomelevel3'] + $testactivedata['totalincomelevel3'] + $testsubmitdata['totalincomelevel3'] + $testpackagedata['totalincomelevel3'] + $autopoolpackagedata['totalincomelevel3'];
            $incomelevel4 = $member['totalincomelevel4'] + $course['totalincomelevel4'] + $testactivedata['totalincomelevel4'] + $testsubmitdata['totalincomelevel4'] + $testpackagedata['totalincomelevel4'] + $autopoolpackagedata['totalincomelevel4'];
            $incomelevel5 = $member['totalincomelevel5'] + $course['totalincomelevel5'] + $testactivedata['totalincomelevel5'] + $testsubmitdata['totalincomelevel5'] + $testpackagedata['totalincomelevel5'] + $autopoolpackagedata['totalincomelevel5'];
             $ChatLists = [
                            
                            // 'member' => $member,
                            // 'course' =>$course,
                            // 'testactivedata' => $testactivedata,
                            // 'testsubmitdata' => $testsubmitdata,
                           "memberlevel1"=> $member['level1'],
                           "courselevel1"=> $course['level1'],
                           "testactivelevel1"=> $testactivedata['level1'],
                           "testsubmitlevel1"=> $testsubmitdata['level1'],
                           "packagelevel1"=> $testpackagedata['level1'],
                           "adpackagelevel1"=> $autopoolpackagedata['level1'],
                           "incomelevel1"=> number_format((float)$incomelevel1, 2, '.', ''),
                            "memberlevel2"=> $member['level2'],
                           "courselevel2"=> $course['level2'],
                           "testactivelevel2"=> $testactivedata['level2'],
                           "testsubmitlevel2"=> $testsubmitdata['level2'],
                           "packagelevel2"=> $testpackagedata['level2'],
                           "adpackagelevel2"=> $autopoolpackagedata['level2'],
                           "incomelevel2"=> number_format((float)$incomelevel2, 2, '.', ''),
                            "memberlevel3"=> $member['level3'],
                           "courselevel3"=> $course['level3'],
                           "testactivelevel3"=> $testactivedata['level3'],
                           "testsubmitlevel3"=> $testsubmitdata['level3'],
                           "packagelevel3"=> $testpackagedata['level3'],
                           "adpackagelevel3"=> $autopoolpackagedata['level3'],
                           "incomelevel3"=> number_format((float)$incomelevel3, 2, '.', ''),
                            "memberlevel4"=> $member['level4'],
                           "courselevel4"=> $course['level4'],
                           "testactivelevel4"=> $testactivedata['level4'],
                           "testsubmitlevel4"=> $testsubmitdata['level4'],
                           "packagelevel4"=> $testpackagedata['level4'],
                           "adpackagelevel4"=> $autopoolpackagedata['level4'],
                           "incomelevel4"=> number_format((float)$incomelevel4, 2, '.', ''),
                            "memberlevel5"=> $member['level5'],
                           "courselevel5"=> $course['level5'],
                           "testactivelevel5"=> $testactivedata['level5'],
                           "testsubmitlevel5"=> $testsubmitdata['level5'],
                           "packagelevel5"=> $testpackagedata['level5'],
                           "adpackagelevel5"=> $autopoolpackagedata['level5'],
                           "incomelevel5"=> number_format((float)$incomelevel5, 2, '.', ''),
                        ];
                         $jsonArray = $ChatLists;

            $totalIncomeamount = $totalmemberamount + $totalstudentcourseamount + $totaltestactiveamount + $totaltestsubmitamount + $totalpackageamount + $totalautopackageamount;
          //  echo '<pre>';print_r($testpackagedata);exit;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Live Class Chat Data Available.',
                        'totalmemberamount' => $member['level1'] + $member['level2'] + $member['level3'] + $member['level4'] + $member['level5'],
                        'totalcourseamount' => $course['level1'] + $course['level2'] + $course['level3'] + $course['level4'] + $course['level5'],
                        'totaltestactiveamount' => $testactivedata['level1'] + $testactivedata['level2'] + $testactivedata['level3'] + $testactivedata['level4'] + $testactivedata['level5'],
                        'totaltestsubmitamount' => $testsubmitdata['level1'] + $testsubmitdata['level2'] + $testsubmitdata['level3'] + $testsubmitdata['level4'] + $testsubmitdata['level5'],
                        'totalpackageamount' => $testpackagedata['level1'] + $testpackagedata['level2'] + $testpackagedata['level3'] + $testpackagedata['level4'] + $testpackagedata['level5'],
                        'totaladpackageamount' => $autopoolpackagedata['level1'] + $autopoolpackagedata['level2'] + $autopoolpackagedata['level3'] + $autopoolpackagedata['level4'] + $autopoolpackagedata['level5'],
                        'totalIncomeamount'=> number_format((float)$totalIncomeamount, 2, '.', ''),
                        'data'      => $jsonArray
                    );
            
                $totalIn = number_format((float)$totalIncomeamount, 2, '.', '');
                $incomeInfo = $this->SystemModel->getStudenIncome($auth_id);
                // if(empty($incomeInfo) && $totalIn > $incomeInfo->wallet_amount){
                if(!empty($incomeInfo->wallet_amount)){
                    if($totalIn > $incomeInfo->old_wallet_amount){
                    $finalIncome = $totalIn - $incomeInfo->old_wallet_amount;
                     $StuInfo = $this->SystemModel->getStudentInfo($auth_id);
                     $stuWal = $StuInfo->wallet_amount;
                     // $totalStuWal = $totalIncomeamount + $stuWal;
                     $totalStuWal = $totalIncomeamount;
                     $stuData = ['wallet_amount'=>number_format((float)$totalStuWal, 2, '.', '')];
                     $this->SystemModel->updateStudWal($stuData, $auth_id);
                     $walhisto = [
                        'student_id' => $auth_id,
                        'wallet_amount' => number_format((float)$finalIncome, 2, '.', ''),
                        'old_wallet_amount' => number_format((float)$totalIncomeamount, 2, '.', ''),
                        'transaction_number' => "Reward Amount",
                        'transaction_type' => "Credit",
                        'status' => "Completed",
                     ];
                     $this->SystemModel->imsertStuRewa($walhisto);
                    }
                } else{
                     $StuInfo = $this->SystemModel->getStudentInfo($auth_id);
                     $stuWal = $StuInfo->wallet_amount;
                     $totalStuWal = $totalIncomeamount + $stuWal;
                     $stuData = ['wallet_amount'=>number_format((float)$totalStuWal, 2, '.', '')];
                     $this->SystemModel->updateStudWal($stuData, $auth_id);
                     $walhisto = [
                        'student_id' => $auth_id,
                        'wallet_amount' => number_format((float)$totalIncomeamount, 2, '.', ''),
                        'old_wallet_amount' => number_format((float)$totalIncomeamount, 2, '.', ''),
                        'transaction_number' => "Reward Amount",
                        'transaction_type' => "Credit",
                        'status' => "Completed",
                     ];
                     $this->SystemModel->imsertStuRewa($walhisto);
                }
                

         } else {

           $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Student Available',
                'data'      => null
            );
        }
            
        }else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please Fill all require field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end api

    public function saveAutoPoolPackage()
    {
         extract($this->input->post()); // convert array to variable -- php function //
      
        if(isset($auth_id) && isset($auth_token)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);
            $getAutoPoolData = $this->SystemModel->getAutoPoolData($auth_id, $package_id);
            if ($result > 0) {
                if(empty($getAutoPoolData)){
                    $data = [
                        'student_id' => $auth_id,
                        'package_id' => $package_id,
                        'transaction_id' => $transaction_id,
                        'amount' => $amount
                    ]; 
                    $this->SystemModel->savePackagePoolData($data);
                }
                
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Auto Pool Package Save sucessfully',
                        
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

    public function packageDetails()
    {
        extract($this->input->post());
        if(isset($auth_id) && isset($auth_token)){
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);
            $getAutoPoolData = $this->SystemModel->getAutoPoolDatass($auth_id, $package_id);
            if ($result > 0) {
                $student_complete_group_levels = $this->SystemModel->student_complete_group_levels($auth_id, $package_id);
                $getmanage_autopool_levelRow = $this->SystemModel->getmanage_autopool_levelRow($package_id);
                echo '<pre>';print_r($student_complete_group_levels);exit;
                if(!empty($student_complete_group_levels)){
                    $level1Satus = "Pending";
                    $level1Direct = $getmanage_autopool_levelRow->level1_group_member;
                    if(!empty($student_complete_group_levels->student_first_group_member_amount) || $student_complete_group_levels->student_first_group_member_amount != 0){
                        $level1Satus = "Pending";
                        if($level1Direct == $student_complete_group_levels->level1_student){
                            $level1Direct = 0;
                             $level1Satus = "Completed";
                        }else{
                            $level1Direct = $level1Direct - $student_complete_group_levels->level1_student;
                        }
                        
                    }
                    $level2Satus = "Pending";
                    $level2Direct = $getmanage_autopool_levelRow->level2_group_member;
                    if(!empty($student_complete_group_levels->student_second_group_member_amount) || $student_complete_group_levels->student_second_group_member_amount != 0){
                        $level2Satus = "Completed";
                         if($level2Direct == $student_complete_group_levels->level2_student){
                            $level2Direct = 0;
                        }else{
                            $level2Direct = $level2Direct - $student_complete_group_levels->level2_student;
                        }
                    }
                    $level3Satus = "Pending";
                    $level3Direct = $getmanage_autopool_levelRow->level3_group_member;
                    if(!empty($student_complete_group_levels->student_third_group_member_amount) || $student_complete_group_levels->student_third_group_member_amount != 0){
                        $level3Satus = "Completed";
                         if($level3Direct == $student_complete_group_levels->level3_student){
                            $level3Direct = 0;
                        }else{
                            $level3Direct = $level3Direct - $student_complete_group_levels->level3_student;
                        }  
                    }
                    $level4Satus = "Pending";
                    $level4Direct = $getmanage_autopool_levelRow->level4_group_member;
                    if(!empty($student_complete_group_levels->student_fourth_group_member_amount) || $student_complete_group_levels->student_fourth_group_member_amount != 0){
                        $level4Satus = "Completed";
                         if($level4Direct == $student_complete_group_levels->level4_student){
                            $level4Direct = 0;
                        }else{
                            $level4Direct = $level4Direct - $student_complete_group_levels->level4_student;
                        } 
                    }
                    $level5Satus = "Pending";
                    $level5Direct = $getmanage_autopool_levelRow->level5_group_member;
                    if(!empty($student_complete_group_levels->student_fifth_group_member_amount) || $student_complete_group_levels->student_fifth_group_member_amount != 0){
                        $level5Satus = "Completed";
                         if($level5Direct == $student_complete_group_levels->level5_student){
                            $level5Direct = 0;
                        }else{
                            $level5Direct = $level5Direct - $student_complete_group_levels->level5_student;
                        } 
                    }
                    $direstStudent = count($getAutoPoolData) - 1;
                    $packageInfo = [
                        'student_id' => $auth_id,
                        'level1_after_id_income' => $level1Direct,
                        'level1_status' => $level1Satus,
                        'level1_amount' => $student_complete_group_levels->student_first_group_member_amount,
                        'level2_after_id_income' => $level2Direct,
                        'level2_status' => $level2Satus,
                        'level2_amount' => $student_complete_group_levels->student_second_group_member_amount,
                        'level3_after_id_income' => $level3Direct,
                        'level3_status' => $level3Satus,
                        'level3_amount' => $student_complete_group_levels->student_third_group_member_amount,
                        'level4_after_id_income' => $level4Direct,
                        'level4_status' => $level4Satus,
                        'level4_amount' => $student_complete_group_levels->student_fourth_group_member_amount,
                        'level5_after_id_income' => $level5Direct,
                        'level5_status' => $level5Satus,
                        'level5_amount' => $student_complete_group_levels->student_fifth_group_member_amount,
                        'total_income' => $student_complete_group_levels->student_first_group_member_amount + $student_complete_group_levels->student_second_group_member_amount + $student_complete_group_levels->student_third_group_member_amount + $student_complete_group_levels->student_fourth_group_member_amount + $student_complete_group_levels->student_fifth_group_member_amount,
                        'direct_total' => $direstStudent
                    ];
                    //$jsonArray = $packageInfo;
                    $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'Package Data Available',
                            'data'      => $packageInfo
                        );
                }else{
                    $student_complete_group_levels = $this->SystemModel->student_complete_group_levels($auth_id, $package_id);
                    $getmanage_autopool_levelRow = $this->SystemModel->getmanage_autopool_levelRow($package_id);
                     $packageInfo = [
                        'student_id' => $auth_id,
                        'level1_after_id_income' => $getmanage_autopool_levelRow->level1_group_member,
                        'level1_status' => "Pending",
                        'level1_amount' => 0,
                        'level2_after_id_income' => $getmanage_autopool_levelRow->level2_group_member,
                        'level2_status' => "Pending",
                        'level2_amount' => 0,
                        'level3_after_id_income' => $getmanage_autopool_levelRow->level3_group_member,
                        'level3_status' => "Pending",
                        'level3_amount' => 0,
                        'level4_after_id_income' => $getmanage_autopool_levelRow->level4_group_member,
                        'level4_status' => "Pending",
                        'level4_amount' => 0,
                        'level5_after_id_income' => $getmanage_autopool_levelRow->level5_group_member,
                        'level5_status' => "Pending",
                        'level5_amount' =>0,
                        'total_income' => 0,
                        'direct_total' => 0
                    ];
                    //$jsonArray = $packageInfo;
                    $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'Package Data Available',
                            'data'      => $packageInfo
                        );

                //      $jsonArray = array(
                //     'status'    => 0,
                //     'message'   => 'No Studentsss Package Available',
                //     'data'      => null
                // );
                }
            }else{
                  $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Student Package Available',
                    'data'      => null
                );
            }
        }else{
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

    public function getStudentWisePackageDetails($value='')
    {
        // extract($this->input->post());
        $auth_id = 1;
         if(isset($auth_id)){
            $getPoolResutl = $this->SystemModel->getPoolResutl($auth_id);
           // echo '<pre>';print_r($getPoolResutl);exit;
            if(!empty($getPoolResutl)){
                foreach ($getPoolResutl as $key => $value) {
                    $studentInfo = $this->SystemModel->getStudentInfo($value->student_id);
                    $getPoolResutl[$key]->student_id = $studentInfo->name;
                    $packageinf= $this->SystemModel->getmanage_autopool_levelRow($value->package_id);
                    $getPoolResutl[$key]->package_id = $packageinf->package_name;
                    $totalEarn = $value->student_first_group_member_amount + $value->student_second_group_member_amount + $value->student_third_group_member_amount + $value->student_fourth_group_member_amount + $value->student_fifth_group_member_amount;
                    $getPoolResutl[$key]->total_earn = $totalEarn;    
                }
                 $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Package Data Available',
                        'data' => $getPoolResutl
                    );
            }else{
                 $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Package Data Available',
                    'data'      => null
                );
            }
         }else {
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

    public function getPoolPackageInfo()
    {
         extract($this->input->post());
         if(isset($auth_id) && isset($auth_token)){
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);
                if ($result > 0) {
                     $package_list['tableName'] = "manage_autopool_level";        
                    $package_list['condtion'] = "isDelete = 1" ;
                     $packgeList = $this->SystemModel->getAll($package_list);
                     //echo '<pre>';print_r($packgeList);exit;
                     foreach ($packgeList as $key => $value) {
                        if(!empty($value->package_thumbnil)){

                         $packgeList[$key]->package_thumbnil = "https://digisysindiatech.com/testbook/uploads/package_image/".$value->package_thumbnil;
                        }
                        if(!empty($value->package_image)){

                         $packgeList[$key]->package_image = "https://digisysindiatech.com/testbook/uploads/package_image/".$value->package_image;
                        }
                        $checkPurch = $this->SystemModel->check_student_buy_autopool_package($auth_id, $value->id);
                        if(!empty($checkPurch)){
                            $is_purchasable = "Yes";
                        }else{
                            $is_purchasable = "No";
                        }
                         $packgeList[$key]->is_purchasable = $is_purchasable;
                     }
                      //$jsonArray = $packgeList;
                        $jsonArray = array(
                            'status'    => 1,
                            'message'   => 'Package Data Available',
                            'data'      => $packgeList
                        );
                }else{
                      $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Package Data Available',
                    'data'      => null
                );
                }
         }else{
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

    public function getAutoPoolAllPackInfo($value='')
    {
         extract($this->input->post()); // convert array to variable -- php function //
       
        if(isset($auth_id)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $package_list['tableName'] = "manage_autopool_level";        
                $package_list['condtion'] = "isDelete = 1" ;
                 $packgeList = $this->SystemModel->getAll($package_list);
                 //echo '<pre>';print_r($packgeList);exit;
                 foreach ($packgeList as $key => $value) {
                    if(!empty($value->package_thumbnil)){

                     $packgeList[$key]->package_thumbnil = "https://digisysindiatech.com/testbook/uploads/package_image/".$value->package_thumbnil;
                    }
                    if(!empty($value->package_image)){

                     $packgeList[$key]->package_image = "https://digisysindiatech.com/testbook/uploads/package_image/".$value->package_image;
                    }
                 }
               //  echo '<pre>';print_r($packgeList);exit;
                if (!empty($packgeList)) {
                   
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Auto Pool Package Available',
                        'data'      => $packgeList
                    );
                } else {
                    $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Auto Pool Package Available',
                        'data'      => null
                    );
                }

            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Auto Pool Package Available',
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


    public function getStudentPurchaseAutoPoolPackage($value='')
    {
         extract($this->input->post()); // convert array to variable -- php function //
      // $auth_id = 1;
        if(isset($auth_id)){
            
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "id=" . $auth_id;
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $package_list['tableName'] = "student_buy_autopool_package";        
                $package_list['condtion'] = "student_id = ".$auth_id ;
                 $packgeList = $this->SystemModel->getAll($package_list);
               //  echo '<pre>';print_r($packgeList);exit;
                 foreach ($packgeList as $key => $value) {
                    $getmanage_autopool_levelRow = $this->SystemModel->getmanage_autopool_levelRow($value->package_id);
                    $packgeList[$key]->package_name = $getmanage_autopool_levelRow->package_name;
                    if(!empty($getmanage_autopool_levelRow->package_thumbnil)){

                     $packgeList[$key]->package_thumbnil = "https://digisysindiatech.com/testbook/uploads/package_image/".$getmanage_autopool_levelRow->package_thumbnil;
                    }
                    if(!empty($getmanage_autopool_levelRow->package_image)){

                     $packgeList[$key]->package_image = "https://digisysindiatech.com/testbook/uploads/package_image/".$getmanage_autopool_levelRow->package_image;
                    }
                    $packgeList[$key]->package_price = $getmanage_autopool_levelRow->package_price;
                    $packgeList[$key]->package_offer_price = $getmanage_autopool_levelRow->package_offer_price;
                 }
               //  echo '<pre>';print_r($packgeList);exit;
                if (!empty($packgeList)) {
                   
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Auto Pool Package Available',
                        'data'      => $packgeList
                    );
                } else {
                    $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Auto Pool Package Available',
                        'data'      => null
                    );
                }

            } else {

               $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Auto Pool Package Available',
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


     //add live class message
         public function getPackageInfo(){
        extract($this->input->post()); // con
       
        if(isset($auth_id) && isset($auth_token)){
          $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
                       $package_list['tableName'] = "package_info";        
                        $package_list['condtion'] = "isDelete = 0" ;
                       $PackageList = $this->SystemModel->getAll($package_list);
                       if(!empty($PackageList)){

                       
                      foreach ($PackageList as $key => $value) {

                          
                        $StoreCategoryData = $this->SystemModel->getPurchaseInfo($auth_id, $value->id);

                        if(!empty($StoreCategoryData)){
                            $checkStatus = "Yes";
                        }else{
                            $checkStatus = "No";
                        }
                        $PackageList[$key]->is_purchasable = $checkStatus;
                          $PackageList[$key]->package_thumbnil = "https://digisysindiatech.com/testbook/uploads/package_image/".$value->package_thumbnil;
                          $imageArr = explode(",",$value->package_image);
                            foreach ($imageArr as $Ikey => $Ivalue) {
                                  $imageArrs[] = [
                                    'imagename' => $value->image_name,
                                    'image'   => "https://digisysindiatech.com/testbook/uploads/package_image/".$Ivalue                                         
                                  ];

                                  //['image'] = "https://digisysindiatech.com/testbook/uploads/package_image/".$Ivalue;
                              }  

                          $PackageList[$key]->package_image =  $imageArrs;
                          $linkArr = explode(",",$value->package_link);
                            foreach ($linkArr as $Ikey => $Ivalue) {
                                  //$linkArrs[]['link'] = $Ivalue;
                                   $linkArrs[] = [
                                    'bookname' => $value->book_name,
                                    'link'   => "https://digisysindiatech.com/testbook/uploads/package_image/".$Ivalue                                         
                                  ];
                              }  
                          $PackageList[$key]->package_link = $linkArrs;
                      }
                      
                            $jsonArray = $PackageList;
                                $jsonArray = array(
                                        'status'    => 1,
                                        'message'   => 'Package Data Available.',
                                        'data'      => $jsonArray
                                    );

                        }else{
                              $jsonArray = array(
                                        'status'    => 0,
                                        'message'   => 'No subscription Available',
                                        'data'      => []
                                    );
                                
                            
                    
                        }

         }else {

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
                   'data'      => Null
            );
        }



        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    //end api

      //subsription api
     public function save_package_data(){
        extract($this->input->post()); // con
        if(isset($auth_id) && isset($auth_token) && isset($package_id) && isset($amount) && isset($transaction_id)){
         $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
             $student_subscription_historyData['tableName'] = "package_purchase_info"; 
            $student_subscription_historyData['data'] = [
                                                    'student_id' => $auth_id,
                                                    'package_id' => $package_id,
                                                    'transaction_id' => $transaction_id,
                                                    'amount' => $amount,
                                                ];
            $result = $this->SystemModel->insertData($student_subscription_historyData);
            $transaction_id = $this->SystemModel->lastInsertId();

            $this->studentAutoPoolLevelComplete($auth_id, $package_id);

            $jsonArray = array(
                'status'    => 1,
                'message'   => 'Package Add sucessfully',
                'data'      => "Success"
            );

         } else {

           $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Student Available',
                'data'      => null
            );
        }
        }else {
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
    //end

    public function getSinglePackageInfo($value='')
    {
           extract($this->input->post()); // con
        if(isset($auth_id) && isset($auth_token) && isset($package_id)){
          $modelData['tableName'] = "student";        
        $modelData['condtion'] = "id=" . $auth_id." AND device_id='".$auth_token."' AND is_deleted=0";
        $result = $this->SystemModel->tableRowCount($modelData);
         if ($result > 0) {
                       $package_list['tableName'] = "package_info";        
                       $PackageList = $this->SystemModel->get_package_infos($package_id);
                       if(!empty($PackageList)){

                       
                      foreach ($PackageList as $key => $value) {

                          
                        $StoreCategoryData = $this->SystemModel->getPurchaseInfo($auth_id, $value->id);

                        if(!empty($StoreCategoryData)){
                            $checkStatus = "Yes";
                        }else{
                            $checkStatus = "No";
                        }
                        $PackageList[$key]->is_purchasable = $checkStatus;
                          $PackageList[$key]->package_thumbnil = "https://digisysindiatech.com/testbook/uploads/package_image/".$value->package_thumbnil;
                          $imageArr = explode(",",$value->package_image);
                            foreach ($imageArr as $Ikey => $Ivalue) {
                                  $imageArrs[] = [
                                    'imagename' => "test",
                                    'image'   => "https://digisysindiatech.com/testbook/uploads/package_image/".$Ivalue                                         
                                  ];

                                  //['image'] = "https://digisysindiatech.com/testbook/uploads/package_image/".$Ivalue;
                              }  

                          $PackageList[$key]->package_image =  $imageArrs;
                          $linkArr = explode(",",$value->package_link);
                            foreach ($linkArr as $Ikey => $Ivalue) {
                                  //$linkArrs[]['link'] = $Ivalue;
                                   $linkArrs[] = [
                                    'bookname' => "test",
                                    'link'   => "https://digisysindiatech.com/testbook/uploads/package_image/".$Ivalue                                         
                                  ];
                              }  
                          $PackageList[$key]->package_link = $linkArrs;
                      }
                      
                            $jsonArray = $PackageList;
                                $jsonArray = array(
                                        'status'    => 1,
                                        'message'   => 'Package Data Available.',
                                        'data'      => $jsonArray
                                    );

                        }else{
                              $jsonArray = array(
                                        'status'    => 0,
                                        'message'   => 'No subscription Available',
                                        'data'      => []
                                    );
                                
                            
                    
                        }

         }else {

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
                   'data'      => Null
            );
        }



        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }


    public function studentAutoPoolLevelComplete($auth_id, $packageId)
    //public function studentAutoPoolLevelComplete()
    {
       
         // extract($this->input->post()); // con
          $studentId = $auth_id;
        $getStudentData = $this->SystemModel->getAutoPoolData($studentId, $packageId);
        if(!empty($getStudentData)){
            $studentIds = $getStudentData->id;
            $getData = $this->SystemModel->getIdWiseData($studentIds, $packageId);
             $student_group_level = $this->SystemModel->student_group_level($packageId);
            $student_complete_group_level = $this->SystemModel->student_complete_group_levels($studentId, $packageId);
         
          
          //add first level cont
           
            if(count($getData) >= $student_group_level->level1_group_member){
                $totalRefer = $student_group_level->level1_group_member_amount;
              }else{
                $totalRefer = 0;
            }
            $directcount= 0;
            if(!empty($getData)){
                $directcount= count($getData) -1;
            }
          if(empty($student_complete_group_level) && empty($student_complete_group_level->level1_group_member_amount)){
            
             $studentData = [
                'student_id' => $studentId,
                'package_id' => $packageId,
                'student_first_group_member_amount' => $totalRefer,
                'level1_student' => $directcount
            ];
            $this->SystemModel->insert_student_complete_group_level($studentData);
          }else{
             $studentData = [
                'student_first_group_member_amount' => $totalRefer,
                'level1_student' => $directcount
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end first lvel count


          //second level
          $getData = $this->SystemModel->getIdWiseLevelData($studentIds, $packageId);
           if(count($getData) >= $student_group_level->level2_group_member){
            $totalRefer = $student_group_level->level2_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->level2_group_member_amount)){
             $studentData = [
                'student_second_group_member_amount' => $totalRefer,
                'level2_student' => $directcount
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end second level



           //add third level cont
          if(count($getData) >= $student_group_level->level3_group_member){
            $totalRefer = $student_group_level->level3_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->level3_group_member_amount)){
             $studentData = [
                'student_third_group_member_amount' => $totalRefer,
                'level3_student' => $directcount
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end third lvel count

          //add four level cont
          if(count($getData) >= $student_group_level->level4_group_member){
            $totalRefer = $student_group_level->level4_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->level4_group_member_amount)){
             $studentData = [
                'student_fourth_group_member_amount' => $totalRefer,
                'level4_student' => $directcount
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end four lvel count

          //add five level cont
          if(count($getData) >= $student_group_level->level5_group_member){
            $totalRefer = $student_group_level->level5_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->level5_group_member_amount)){
             $studentData = [
                'student_fifth_group_member_amount' => $totalRefer,
                'level5_student' => $directcount
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end five lvel count



        }
    }

    public function checkReferLevelStudent($value='')
    {
        $getStudentData = $this->SystemModel->getStudentData();
        $studentData = [];
        foreach ($getStudentData as $key => $value) {
          $getData = $this->SystemModel->countAllStudent($value->id);
            $student_group_level = $this->SystemModel->student_group_level();
            $student_complete_group_level = $this->SystemModel->student_complete_group_level($value->id);
         
          
          //add first level cont
            if(count($getData) >= $student_group_level->student_first_group_member){
                $totalRefer = $student_group_level->student_first_group_member_amount;
              }else{
                $totalRefer = 0;
            }
          if(empty($student_complete_group_level) && empty($student_complete_group_level->student_first_group_member_amount)){
             $studentData = [
                'student_id' => $value->id,
                'student_first_group_member_amount' => $totalRefer,
            ];
            $this->SystemModel->insert_student_complete_group_level($studentData);
          }
          //end first lvel count


          //add second level cont
          if(count($getData) >= $student_group_level->student_second_group_member){
            $totalRefer = $student_group_level->student_second_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->student_second_group_member_amount)){
             $studentData = [
                'student_id' => $value->id,
                'student_second_group_member_amount' => $totalRefer,
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end second lvel count


          //add third level cont
          if(count($getData) >= $student_group_level->student_third_group_member){
            $totalRefer = $student_group_level->student_third_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->student_third_group_member_amount)){
             $studentData = [
                'student_id' => $value->id,
                'student_third_group_member_amount' => $totalRefer,
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end third lvel count

          //add four level cont
          if(count($getData) >= $student_group_level->student_fourth_group_member){
            $totalRefer = $student_group_level->student_fourth_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->student_fourth_group_member_amount)){
             $studentData = [
                'student_id' => $value->id,
                'student_fourth_group_member_amount' => $totalRefer,
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end four lvel count

          //add five level cont
          if(count($getData) >= $student_group_level->student_fifth_group_member){
            $totalRefer = $student_group_level->student_fifth_group_member_amount;
          }else{
            $totalRefer = 0;
          }
           if(!empty($student_complete_group_level) && empty($student_complete_group_level->student_fifth_group_member_amount)){
             $studentData = [
                'student_id' => $value->id,
                'student_fifth_group_member_amount' => $totalRefer,
            ];
            $this->SystemModel->updateStudentLevel($studentData, $student_complete_group_level->id);
          }
          //end five lvel count
         
            // $studentData[] = [
            //     'student_id' => $value->id,
            //     'total_refer_count' => count($getData),
            //     'level' => $totalRefer
            // ];
            //add data

            //edn
         
        }
        
    }

    public function getCompleteReferLevelStudent($value='')
    {
        $allStudentLevelData = $this->SystemModel->allStudentLevelData();
        if(!empty($allStudentLevelData)){
                 foreach ($allStudentLevelData as $Skey => $Svalue) {
                    $studentName = $this->SystemModel->getStudentInfo($Svalue->student_id);
                    $totalAmount = $Svalue->student_first_group_member_amount + $Svalue->student_second_group_member_amount + $Svalue->student_third_group_member_amount + $Svalue->student_fourth_group_member_amount + $Svalue->student_fifth_group_member_amount;
                    $levelData[] = [
                        'student_id' => $Svalue->student_id,
                        'student_name' => $studentName->name,
                        'student_first_group_member_amount' => $Svalue->student_first_group_member_amount,
                        'student_second_group_member_amount' => $Svalue->student_second_group_member_amount,
                        'student_third_group_member_amount' => $Svalue->student_third_group_member_amount,
                        'student_fourth_group_member_amount' => $Svalue->student_fourth_group_member_amount,
                        'student_fifth_group_member_amount' => $Svalue->student_fifth_group_member_amount,
                        'total_amount' => $totalAmount
                    ];
                }
                $jsonArray = $levelData;
                $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Student Level Data Available.',
                        'data'      => $jsonArray
                    );
        }else{
             $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Student Level Available',
                'data'      => null
            );
        }
       
         $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
       
    }



    public function checkftp()
    {
        $host = 'ftp.digisysindiatech.com';
$username = 'u408078379.testbook';
$password = 'Testbook@123';
$port = 22;
 
// Connect to the server
$connection = @ssh2_connect($host);
 
if ($connection !== false) {
$login = @ssh2_auth_password($connection, $username, $password);
if ($login === true) {
    echo '<pre>';
    print_r("success");
    echo '</pre>';exit;
// /* For Upload */
// $sftp = @ssh2_sftp($connection);
// if ($sftp !== false) {
 
// }
// $content = file_get_content('path/to/file.csv');
// $remoteFile = 'remotepath/to/file.csv';
// $stream = @fopen("ssh2.sftp://" . (int) $sftp . $remoteFile, 'w');
// $fileUploaded = @fwrite($stream, $data_to_send);
// if ($fileUploaded === false) {
// //Error file nut upload
// } else {
// //Success
// }
 
// /* For Get */
// //search file
// $ftpOutFiles = ftp_nlist($connection, "/out/searchtext");
// $localFilePath = '/var/www/html/test/test.csv';
// if (ftp_get($connection, $localFilePath, $ftpOutFiles[0], FTP_BINARY)) {
// //code
// }
 
// @fclose($stream);
}
}
    }



}

