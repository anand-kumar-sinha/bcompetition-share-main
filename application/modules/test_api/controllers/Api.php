<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');      
    }
    
    public function sendOtp($otp, $mobile_no)
    {
        $getOtp = $otp;
            
        $username="skwebdesigner";
      $password="shubham@12";
      $message=$getOtp." is your OTP for your Reset Password . OTP valid for 10 minutes. SK Web Designer";
      
      $sender="SKWEBB";
      
      $mobile_number= $mobile_no;
      
      $template_id=1507162029064165626;
      
      $url="http://api.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($mobile_number)."&message=".urlencode($message)."&sender=".urlencode($sender)."&type=".urlencode('3')."&template_id=".urlencode($template_id);
      
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $curl_scraped_page = curl_exec($ch);
      curl_close($ch);
      return $getOtp;
    }
      
    public function login(){
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($mobile_number) && isset($device_id) && isset($fcm_id)){
            
            $otp = rand(1000,9999);
           // $otp = 1234;
            $blankArray = array(
                    'id'=>'',
                    'name'=>'',
                    'email'=>'',
                    'date_of_birth'=>'',
                    'gender'=>'',
                    'mobile_number'=>'',
                    'address'=>'',
                    'country_id'=>'',
                    'state_id'=>'',
                    'city_id'=>'',
                    'pin_code'=>'',
                    'device_id'=>'',
                    'fcm_id'=>'',
                    'updated'=> '',
                    'is_deleted'=> '',
                    'created'=> '',
                    'auth_id'=> '',
                    'auth_token'=> '',
                    'country_name'=> '',
                    'state_name'=> '',
                    'city_name'=> '',
                    'referral_code'=> '',
                    'refer_code'=> '',
                    'profile_pic'=> '',
            );
             
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "mobile_number='" . $mobile_number."'";
            $result = $this->SystemModel->tableRowCount($modelData);

            if ($result > 0) {
                
                $CustomerOldDetail = $this->SystemModel->getOne($modelData);
                  
                $modelData['data'] = array(  
                                            'device_id'    => $device_id,
                                            'fcm_id'    => $fcm_id,
                                            'updated' => date("Y-m-d H:i:s")
                        );
                $modelData['condtion'] = "id=" . $CustomerOldDetail->id;
                $result = $this->SystemModel->updateData($modelData);
//                
//                $modelData['condtion'] = "id=" . $CustomerOldDetail->id;
//                $CustomerNewDetail = $this->SystemModel->getOne($modelData);
//                
                $modelData1['select'] = 'st.*, cou.country_name, s.state_name, ct.city_name';
                $modelData1['tableName'] = "student st";
                $modelData1['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
                $modelData1['join'][] = array('tableName' => 'state s', 'condtion' => 's.id=st.state_id', 'type'=>'left');
                $modelData1['join'][] = array('tableName' => 'city ct', 'condtion' => 'ct.id=st.city_id', 'type'=>'left');
                $modelData1['condtion'] = "st.id=" . $CustomerOldDetail->id;
                $CustomerNewDetail = $this->SystemModel->getOne($modelData1);

                $CustomerNewDetail->auth_id = $CustomerNewDetail->id;
                $CustomerNewDetail->auth_token = $CustomerNewDetail->device_id;
                $this->sendOtp($otp, $mobile_number);
                
                
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Data Available',
                    'is_register'      => true,
                    'otp'      => $otp,
                    'data'      => array($CustomerNewDetail)
                );

            } else {
                $this->sendOtp($otp, $mobile_number);
               $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Send OTP in your Mobile no',
                    'is_register'      => false,
                    'otp'      => $otp,
                    'data'      => array($blankArray)
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
    
    public function register() {
        extract($this->input->post()); // convert array to variable -- php function //

        $uploadPath = FCPATH . 'uploads/student_profile';
            //Check if the directory already exists.
          if (!is_dir($uploadPath)) {
              //Directory does not exist, so lets create it.
          mkdir($uploadPath, 0755, true);
        }

        if(isset($mobile_number) && isset($fcm_id) && isset($device_id) && isset($state_id) && isset($city_id) && isset($pin_code) && isset($name) && isset($email) && isset($date_of_birth) && isset($gender) && isset($mobile_number) && isset($address) && isset($country_id)){
        $referral_code = rand(1000,9999);
            $modelData['tableName'] = "student";        
            $modelData['condtion'] = "mobile_number='" . $mobile_number."'";
            $UserCount = $this->SystemModel->tableRowCount($modelData);
            $checkReferaInfo = 0;
            if(!empty($refer_code)){
                $checkreferdata= $this->SystemModel->checkreferdata($refer_code);
                if(empty($checkreferdata)){
                    $checkReferaInfo = 1;
                }
            }

            if($checkReferaInfo == 0){

            

            if ($UserCount == 0) {
                $profile_picUrl = base_url()."uploads/student_profile/";
                
                if (isset($profile_pic)) { 
                    if (isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] != '') {
                        $profile_pic = $this->SystemModel->imageUpload('profile_pic', $uploadPath);
                    } else {
                        $profile_pic = '';
                    }
                } else {
                    $profile_pic = '';
                }
            
//            $this->add_companyId_session($company_id); //Add company id in session
                    $modelData['tableName'] = "student";    
                    $modelData['data'] = array(    
                                                'school_name'=> $school_name, 
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
                                                'referral_code'    => $referral_code,
                                                'refer_code'    => $refer_code,
                                                'profile_pic'    => $profile_pic,
                                                'created'  => date('Y-m-d h:i:s')

                    );
                    $result = $this->SystemModel->insertData($modelData);
                    $request_id = $this->SystemModel->lastInsertId();
                     
                    $modelData1['select'] = 'st.*, cou.country_name, s.state_name, ct.city_name';
                    $modelData1['tableName'] = "student st";
                    $modelData1['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
                    $modelData1['join'][] = array('tableName' => 'state s', 'condtion' => 's.id=st.state_id', 'type'=>'left');
                    $modelData1['join'][] = array('tableName' => 'city ct', 'condtion' => 'ct.id=st.city_id', 'type'=>'left');
                    $modelData1['condtion'] = "st.id=" . $request_id;
                    $result2 = $this->SystemModel->getOne($modelData1);

                    $result2->auth_id = $result2->id;
                    $result2->auth_token = $device_id;
                    

                // Start refreal code insertData
                    $code = $refer_code;
                    $referal_code = $referral_code;
                    $student_id = $request_id;
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
                        $this->display($code, $referal_code, $student_id,$codeData->student_id,$codeData->parent_id, $level);
                    }else{
                        $insertData = [
                            'student_id' => $student_id,
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
                // end data

                    
                     /* Start : Refer User Wallet Update */  
                       
                        
                        /* Start : Refer User Wallet Update */
                    
                                        $CompanyData['tableName'] = "company_detail";   
                                        $CompanyDetails = $this->SystemModel->getOne($CompanyData);
                                         
                                        $ReferAmount = $CompanyDetails->refer_amount;
                                                
                                        $ReferStudentData['tableName'] = "student";        
                                        $ReferStudentData['condtion'] = "referral_code='".$refer_code."'";
                                        $ReferStudentCount = $this->SystemModel->tableRowCount($ReferStudentData);
                                        
                                        if($ReferStudentCount > 0){
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
                        
                                            $Refer_student_notification['tableName'] = "student_notification";   
                                            $Refer_student_notification['data'] = array(     
                                                                            'student_id'    => $ReferStudentDetail->id,
                                                                            'title'    => "Refer Amount Add",
                                                                            'notification_detail'    => "Add ".$NewReferWalletAmount." Rs  In your Refer Student ".$ReferStudentDetail->name,
                                                                            'created'  => date('Y-m-d h:i:s'),
                        
                                            );
                                            $Refer_student_notificationresult = $this->SystemModel->insertData($Refer_student_notification);
                                            
                                            
                                            
                                                $ReferStudentInertData['tableName'] = "student_refer";    
                                                $ReferStudentInertData['data'] = array(     
                                                                            'refer_student_id'    => $ReferStudentDetail->id,
                                                                            'student_id'    => $request_id,
                                                                            'amount'    => $ReferAmount,
                                                                            'created'  => date('Y-m-d h:i:s')

                                                );
                                                $result = $this->SystemModel->insertData($ReferStudentInertData);
                                           
//                                            $ReferstudentAmountData['tableName'] = "refer_student_amount";   
//                                            $ReferstudentAmountData['data'] = array(     
//                                                                            'refer_student_id'    => $ReferStudentDetail->id,
//                                                                            'student_id'    => $CustomerOldDetail->id,
//                                                                            'amount'    => $ReferAmount,
//                                                                            'created'  => date('Y-m-d h:i:s'),
//                        
//                                            );
//                                            $ReferstudentAmountDataresult = $this->SystemModel->insertData($ReferstudentAmountData);
                                            
                                        }

                                        /* End : Refer User Wallet Update */

                        
                        
                     /* End : Refer User Wallet Update */
                    
                    
                    $jsonArray = array(
                        'status'    => 1,
                        'is_register'=> '',
                        'otp'=> '',
                        'profile_pic_url'=> $profile_picUrl,
                        'message'   => 'Register Success',
                        'data'      => array($result2)
                    );
             } else {
                 $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'Mobile no already register', 
                    'data'      => array()
                );
             }


         }else{
                  $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'Refercode is not valid', 
                    'data'      => array()
                );
         }




        }  else {
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
     
    public function category_list() {

        
        extract($this->input->post()); // convert array to variable -- php function //
         
        $CategoryData['tableName'] = "category";   
        $CategoryData['condtion']  = "status='Active' AND is_deleted='0'";
        $AllCategory = $this->SystemModel->getAll($CategoryData); 
        
        if(count($AllCategory) > 0){
//            $this->add_companyId_session($company_id); //Add company id in session
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Category List',
                    'data'   => $AllCategory,
                );
                
        } else {
             $jsonArray = array(
                'status'    => 0,
                'message'   => 'No Category Available',
                'data'      => null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function country_list() {

        
        extract($this->input->post()); // convert array to variable -- php function //
         
        $StateData['tableName'] = "country";   
        $StateData['condtion']  = "status='Active' AND is_deleted='0'";
        $AllState = $this->SystemModel->getAll($StateData); 
        
        if(count($AllState) > 0){
//            $this->add_companyId_session($company_id); //Add company id in session
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Country List',
                    'data'   => $AllState,
                );
                
        } else {
             $jsonArray = array(
                'status'    => 0,
                'message'   => 'No State Available',
                'data'      => null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function state_list() {

        
    extract($this->input->post()); // convert array to variable -- php function //
     if(isset($country_id)) {  
         
        $StateData['tableName'] = "state";   
        $StateData['condtion']  = "country_id=" . $country_id." AND status='Active' AND is_deleted='0'";
        $AllState = $this->SystemModel->getAll($StateData); 
        
        if(count($AllState) > 0){
//            $this->add_companyId_session($company_id); //Add company id in session
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'State List',
                    'data'   => $AllState,
                );
                
        } else {
             $jsonArray = array(
                'status'    => 0,
                'message'   => 'No State Available',
                'data'      => null
            );
        }
     } else {
         $jsonArray = array(
                'status'    => 0,
                'image_url'   => '',
                'message'   => 'Please fill all required field',
                'data'      => Null
        );
     }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    public function city_list() {

    extract($this->input->post()); // convert array to variable -- php function //
     if(isset($state_id)) {  
         
        $CityData['tableName'] = "city";   
        $CityData['condtion']  = "state_id=" . $state_id." AND status='Active' AND is_deleted='0'";
        $AllCity = $this->SystemModel->getAll($CityData); 
        
        
        if(count($AllCity) > 0){
//            $this->add_companyId_session($company_id); //Add company id in session
                
            
              
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'City List',
                    'data'   => $AllCity,
                );
                
        } else {
             $jsonArray = array(
                'status'    => 0,
                'message'   => 'No State Available',
                'data'      => null
            );
        }
     } else {
         $jsonArray = array(
                'status'    => 0,
                'image_url'   => '',
                'message'   => 'Please fill all required field',
                'data'      => Null
        );
     }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
     
    
    public function banner_list() {

        
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($category_id)) 
        { 
            $image_base_url = base_url()."uploads/banner_image/";
            
    		$StateData['select'] = '*';
            $StateData['tableName'] = "banner_master";
            $StateData['condtion'] = "category_id=$category_id";
    		// $StateData['join'][] = array('tableName' => 'category', 'condtion' => 'banner_master.category_id=category.id', 'type'=>'left');
            $AllState = $this->SystemModel->getAll($StateData); 
            
            if(count($AllState) > 0){
    //            $this->add_companyId_session($company_id); //Add company id in session
                    
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Banner List',
                        'image_base_url'   => $image_base_url,
                        'data'   => $AllState,
                    );
                    
            } else {
                 $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No State Available',
                    'image_base_url'   => '',
                    'data'      => null
                );
            }
        } else {
             $jsonArray = array(
                    'status'    => 0,
                    'image_url'   => '',
                    'message'   => 'Please fill all required field',
                    'data'      => Null
            );
         }
     
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function language_list() {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $StateData['tableName'] = "language";   
        $AllState = $this->SystemModel->getAll($StateData); 
        
        if(count($AllState) > 0){
//            $this->add_companyId_session($company_id); //Add company id in session
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Language List',
                    'data'   => $AllState,
                );
                
        } else {
             $jsonArray = array(
                'status'    => 0,
                'message'   => 'No State Available',
                'data'      => null
            );
        }
     
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function dashboard_count() {

        
        extract($this->input->post()); // convert array to variable -- php function //
        if(isset($hotel_id)) {  
         
//            $Today = date("Y-m-d");
            
            if($today !=''){ 
                $conditon = " AND check_in_date='".$today."' AND hotel_id=".$hotel_id;
            } else {
                $conditon = " AND hotel_id=".$hotel_id;
            }
            if($today !=''){ 
                $conditon1 = " AND bd.check_in_date='".$today."' AND bd.hotel_id=".$hotel_id;
            } else {
                $conditon1 = " AND bd.hotel_id=".$hotel_id;
            }
            
            $TotalBookingData['tableName'] = 'booking_detail';
            $TotalBookingData['condtion'] = "status='Book' AND is_deleted='0' ".$conditon; 
            $TotalBooking = $this->SystemModel->tableRowCount($TotalBookingData); 
            
            /***********************************************************/
            
            $TotalCheckInData['tableName'] = 'booking_detail';
            $TotalCheckInData['condtion'] = "status='Check In' AND is_deleted='0' ".$conditon; 
            $TotalCheckIn = $this->SystemModel->tableRowCount($TotalCheckInData);  
            
            /***********************************************************/
            
            $TotalCheckOutData['tableName'] = 'booking_detail';
            $TotalCheckOutData['condtion'] = "status='Check Out' AND is_deleted='0' ".$conditon; 
            $TotalCheckOut = $this->SystemModel->tableRowCount($TotalCheckOutData);  

            /***********************************************************/
            
            $TotalCancelData['tableName'] = 'booking_detail';
            $TotalCancelData['condtion'] = "status='Cancel' AND is_deleted='0' ".$conditon; 
            $TotalCancel = $this->SystemModel->tableRowCount($TotalCancelData);  
            
            /***********************************************************/
            
            $TotalNoShowData['tableName'] = 'booking_detail';
            $TotalNoShowData['condtion'] = "status='No Show' AND is_deleted='0' ".$conditon; 
            $TotalNoShow = $this->SystemModel->tableRowCount($TotalNoShowData);  

            /***********************************************************/
            
            $TotalInHotelData['tableName'] = 'booking_detail';
            $TotalInHotelData['condtion'] = "status='In Hotel' AND is_deleted='0' ".$conditon; 
            $TotalInHotel = $this->SystemModel->tableRowCount($TotalInHotelData);
            
            /***********************************************************/
            
//            $TotalInHotelData['tableName'] = 'booking_detail';
//            $TotalInHotelData['condtion'] = "status='In Hotel'".$conditon; 
//            $TotalInHotel = $this->SystemModel->tableRowCount($TotalInHotelData);
            
            /***********************************************************/
            
            $TotalAdultData['select'] = 'SUM(br.audlt) as total_audlt';
            $TotalAdultData['tableName'] = 'booking_detail bd';
            $TotalAdultData['join'][] = array('tableName' => 'booking_rooms br', 'condtion' => 'bd.id=br.booking_id', 'type'=>'left');
            $TotalAdultData['condtion'] = '1=1  AND bd.is_deleted="0" '.$conditon1; 
            $TotalAdult = $this->SystemModel->getOne($TotalAdultData);
            
            /***********************************************************/
            
            $TotalChildData['select'] = 'SUM(br.child) as total_child';
            $TotalChildData['tableName'] = 'booking_detail bd';
            $TotalChildData['join'][] = array('tableName' => 'booking_rooms br', 'condtion' => 'bd.id=br.booking_id', 'type'=>'left');
            $TotalChildData['condtion'] = '1=1 AND bd.is_deleted="0" '.$conditon1; 
            $TotalChild = $this->SystemModel->getOne($TotalChildData);
            
            /***********************************************************/
            
//            $TotalRevenueData['select'] = 'SUM(bd.grand_total) as TotalRevenue';
//            $TotalRevenueData['tableName'] = 'booking_detail bd';
////            $TotalRevenueData['join'][] = array('tableName' => 'booking_rooms br', 'condtion' => 'bd.id=br.booking_id', 'type'=>'left');
//            $TotalRevenueData['condtion'] = '1=1 AND bd.is_deleted="0" '.$conditon; 
//            $TotalRevenue = $this->SystemModel->getOne($TotalRevenueData);
            
            $TotalRevenueData['select'] = 'SUM(bd.amount) as TotalRevenue';
            $TotalRevenueData['tableName'] = 'payments bd';
//            $TotalRevenueData['join'][] = array('tableName' => 'booking_rooms br', 'condtion' => 'bd.id=br.booking_id', 'type'=>'left');
            $TotalRevenueData['condtion'] = '1=1 AND payment_date="'.$today.'"'; 
            $TotalRevenue = $this->SystemModel->getOne($TotalRevenueData);
            
            /***********************************************************/
            
            $FirstBookingData['tableName'] = 'booking_detail bd';
            $FirstBookingData['condtion'] = '1=1 AND bd.is_deleted="0" '.$conditon;
            $FirstBookingData['order'][0] = "id";
            $FirstBookingData['order'][1] = "ASC";
            $FirstBookingData['limit']['total'] = 1;
            $FirstBookingData['limit']['start'] = 0;
            $FirstBooking = $this->SystemModel->getOne($FirstBookingData);
           
            $LastBookingData['tableName'] = 'booking_detail bd';
            $LastBookingData['condtion'] = '1=1 AND bd.is_deleted="0" '.$conditon;
            $LastBookingData['order'][0] = "id";
            $LastBookingData['order'][1] = "DESC";
            $LastBookingData['limit']['total'] = 1;
            $LastBookingData['limit']['start'] = 0;
            $LastBooking = $this->SystemModel->getOne($LastBookingData);
            
            $check_in_date_1 = $FirstBooking->check_in_date;
            
            $check_in_date_2 = $LastBooking->check_in_date;
             
            $date1_ts = strtotime($check_in_date_1);
            $date2_ts = strtotime($check_in_date_2);
            $diff = $date2_ts - $date1_ts;
            if($check_in_date_1 != $check_in_date_2) {
                $TotalDays = round($diff / 86400);
            } else {
                $TotalDays = 1;
            }
            /***********************************************************/
            
            if($TotalRevenue->TotalRevenue == null){
                $TotalRevenue = 0;
            } else {
                $TotalRevenue = $TotalRevenue->TotalRevenue;
            }
            
            if($TotalAdult->total_audlt == null){
                $total_audlt = 0;
            } else {
                $total_audlt = $TotalAdult->total_audlt;
            }
            if($TotalChild->total_child == null){
                $total_child = 0;
            } else {
                $total_child = $TotalChild->total_child;
            }
            
            /***********************************************************/
            
            
            
            $HotelRoomsData['tableName'] = 'room_information';
            $HotelRoomsData['condtion'] = 'status="Active"'; 
            $HotelRoomsList = $this->SystemModel->getAll($HotelRoomsData);
            
            $AvailableRoomsCount = 0;
            $BlockRoomsCount = 0;
            $BookedRoomsCount = 0;
            $TotalMemberInBookingRoom = 0;
            foreach ($HotelRoomsList as $_HotelRoomsList) {
                $RoomBookingData['join'] = array();
                $RoomBookingData['select'] = 'bd.*, br.total_member';
                $RoomBookingData['tableName'] = 'booking_detail bd';
                $RoomBookingData['join'][] = array('tableName' => 'booking_rooms br', 'condtion' => 'bd.id=br.booking_id', 'type'=>'left');
                $RoomBookingData['condtion'] = 'bd.is_deleted = "0" AND br.room_no_id='.$_HotelRoomsList->id.$conditon1; 
                $RoomBookingCount = $this->SystemModel->tableRowCount($RoomBookingData);
                if($RoomBookingCount == 0){
                    $AvailableRoomsCount = $AvailableRoomsCount + 1;
                } else {
                    $RoomBookingDetail = $this->SystemModel->getOne($RoomBookingData);
                    
                    $TotalMember = $RoomBookingDetail->total_member;
//                    echo $TotalMemberInBookingRoom = $TotalMemberInBookingRoom + $TotalMember;
                    if($_HotelRoomsList->family_sharing == "Family"){
                        $BlockRoomsCount = $BlockRoomsCount + 1;
                        $BookedRoomsCount = $BookedRoomsCount + 1;
                         
                    } else {
                        if($_HotelRoomsList->no_of_bad == $TotalMember){
                            $BlockRoomsCount = $BlockRoomsCount + 1;
                        } else {
                            $BookedRoomsCount = $BookedRoomsCount + 1;
                        }
                    }
                }
                
                
            }
            
            /***********************************************************/
         
            $daily_average_revenue = $TotalRevenue / $TotalDays;
            $jsonArray = array(
                'status'    => 1,
                'message'   => 'data Available',
                'total_check_in'   => $TotalCheckIn,
                'total_check_out'   => $TotalCheckOut,
                'total_booking'   => $TotalBooking,
                'total_in_hotel'   => $TotalInHotel,
                'total_adult'   => $total_audlt,
                'total_child'   => $total_child,
                'total_revenue'   => $TotalRevenue,
                'daily_average_revenue'   =>  number_format($daily_average_revenue, 2, '.', ''),
                'total_cancel'   =>  $TotalCancel,
                'no_show'   =>  $TotalNoShow,
                'available_rooms'   =>  $AvailableRoomsCount,
                'booked_rooms'   =>  $BookedRoomsCount,
                'block_rooms'   =>  $BlockRoomsCount,
                'data'   => array(),
            );

           
        } else {
            $jsonArray = array(
                   'status'    => 0, 
                   'image_url'   => '',
                   'message'   => 'Please fill all required field',
                   'data'      => Null
           );
        }
           $jsonString = json_encode($jsonArray);
           echo $jsonString;
           die;
       }
 
    public function about_us() {

        
        extract($this->input->post()); // convert array to variable -- php function //
        
            $TotalInHotelData['tableName'] = 'company_detail';
            $TotalInHotel = $this->SystemModel->getOne($TotalInHotelData);
              
            $jsonArray = array(
                'status'    => 1,
                'message'   => 'About Company',
                'data'   => $TotalInHotel,
            );

            
           $jsonString = json_encode($jsonArray);
           echo $jsonString;
           die;
       }
 
    
    function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz{}[]()!@%^&*:?|';
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 
                           0, $length_of_string);
    }
    
}

