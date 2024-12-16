<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manage_autopool_package extends MY_Controller
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
         if(isset($_GET['c_id'])){
            $id = $_GET['c_id'];
            $storeDetail['tableName'] = 'manage_autopool_level';
            $storeDetail['condtion'] = "isDelete = 1 AND id=" . $id;
            $data['PackageDetail'] = $this->SystemModel->getOne($storeDetail);
        }
        $data['package_data'] = $this->SystemModel->get_manage_autopool_level();
      //  echo '<pre>';print_r($data);exit;
        $this->load->admin('manage_autopool_package/index', $data);
    }
         public function removeSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');

        $data = ['status' => 0];
        $this->SystemModel->update_student_buy_autopool_package($data, $id);
        redirect('admin/manage_autopool_package/add_student?store_id='.$courseid);
    }

            public function addSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');
        $this->SystemModel->deletestudent_buy_autopool_package($id,$courseid);
         $getmanage_autopool_levelRow = $this->SystemModel->getmanage_manage_autopool_levelaa($courseid);
          $getStudentLastData = $this->SystemModel->getStudentLastData($courseid);

                 if(empty($getStudentLastData)){
            $totalCOunts = 1;
        }else{
            $totalCOunts = $getStudentLastData->new_seq + 1;
        }
        $data = [
            'status' => 1,
            'student_id' => $id,
            'package_id' => $courseid,
            'amount'=>$getmanage_autopool_levelRow->package_offer_price,
             'new_seq' => $totalCOunts
        ];
        $this->SystemModel->insertstudent_buy_autopool_package($data);






        //call
         $this->studentAutoPoolLevelComplete($id, $courseid);
        //end












        redirect('admin/manage_autopool_package/add_student?store_id='.$courseid);
    }


     public function studentAutoPoolLevelComplete($auth_id, $packageId)
    //public function studentAutoPoolLevelComplete()
    {
       
         // extract($this->input->post()); // con
        // $auth_id = 1;
        // $packageId = 1;
          $studentId = $auth_id;
        $getStudentData = $this->SystemModel->getAutoPoolData($studentId, $packageId);

        if(!empty($getStudentData)){
            $studentIds = $getStudentData->id;
            $getData = $this->SystemModel->getIdWiseData($studentIds, $packageId);

             $student_group_level = $this->SystemModel->student_group_level($packageId);
            $student_complete_group_level = $this->SystemModel->student_complete_group_levels($studentId, $packageId);
         
          
          //add first level cont
           
            if(count($getData) >= $student_group_level->level1_group_member){
                $egtmanddg_package_info = $this->SystemModel->egtmanddg_pmanage_autopool_level($packageId);
                $total1per = $student_group_level->level1_group_member_amount; 
                $totalRefer = $total1per;
              }else{
                $totalRefer = 0;
            }
            $directcount= 0;
            if(!empty($getData)){
                $directcount= count($getData);
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
            // $totalRefer = $student_group_level->level2_group_member_amount;
               $egtmanddg_package_info = $this->SystemModel->egtmanddg_pmanage_autopool_level($packageId);
                $total2per = $student_group_level->level2_group_member_amount; 
                $totalRefer = $total2per;
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
            $egtmanddg_package_info = $this->SystemModel->egtmanddg_pmanage_autopool_level($packageId);
                $total3per = $student_group_level->level3_group_member_amount; 
                $totalRefer = $total3per;
            //$totalRefer = $student_group_level->level3_group_member_amount;
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
             $egtmanddg_package_info = $this->SystemModel->egtmanddg_pmanage_autopool_level($packageId);
                $total4per = $student_group_level->level4_group_member_amount; 
                $totalRefer = $total4per;
            //$totalRefer = $student_group_level->level4_group_member_amount;
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
             $egtmanddg_package_info = $this->SystemModel->egtmanddg_pmanage_autopool_level($packageId);
                $total5per = $student_group_level->level5_group_member_amount; 
                $totalRefer = $total5per;
           // $totalRefer = $student_group_level->level5_group_member_amount;
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


     public function add_student()
    {
        $store_id = $this->input->get('store_id');
        $stuArr = $this->SystemModel->getStudentData();
         $AllStudent = [];
       $AllNewStudent = [];
       foreach ($stuArr as $key => $value) {
           $checkData = $this->SystemModel->student_buy_autopool_package_info_details($value->id, $store_id);
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
         $this->load->admin('admin/manage_autopool_package/indexStudent', $data);
    }

      public function action()
    {
        extract($this->input->post());
     
        $uploadPath = FCPATH . 'uploads/package_image';
              if (!is_dir($uploadPath)) {
              mkdir($uploadPath, 0755, true);
          }
        if($course_category_id) {
                $course_category_id  = $course_category_id  ;
        } else {
                $course_category_id = NULL;
        }

    $modelData['tableName'] = "manage_autopool_level";
        if (isset($id) && $id != '') {
            if ($_FILES['package_thumbnil']['name']!= '') {
                $package_thumbnil = $this->SystemModel->imageUpload('package_thumbnil', $uploadPath);
                $path = FCPATH . 'uploads/package_image';
                unlink($path);
            } else {
                $package_thumbnil = $old_thum_image;
            }

             if ($_FILES['package_image']['name']!= '') {
                $package_image = $this->SystemModel->imageUpload('package_image', $uploadPath);
                $path = FCPATH . 'uploads/package_image';
                unlink($path);
            } else {
                $package_image = $old_package_image;
            }


            $modelData['data'] = array(
                'package_name' => $package_name,
                'package_desc' => $package_desc,
                'package_price' => $package_price,
                'package_offer_price' => $package_offer_price,
                'package_thumbnil' => $package_thumbnil,
                'package_image' => $package_image,
                'level1_group_member' => $level1_group_member,
                'level1_group_member_amount' => $level1_group_member_amount,
                'level2_group_member' => $level2_group_member,
                'level2_group_member_amount' => $level2_group_member_amount,
                'level3_group_member' => $level3_group_member,
                'level3_group_member_amount' => $level3_group_member_amount,
                'level4_group_member' => $level4_group_member,
                'level4_group_member_amount' => $level4_group_member_amount,
                'level5_group_member' => $level5_group_member,
                'level5_group_member_amount' => $level5_group_member_amount,
                'status' => $status
                
            );

            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            if (isset($_FILES['package_thumbnil']['name']) && $_FILES['package_thumbnil']['name'] != '') {
                $package_thumbnil = $this->SystemModel->imageUpload('package_thumbnil', $uploadPath);
            } else {
                $package_thumbnil = '';
            }

             if (isset($_FILES['package_image']['name']) && $_FILES['package_image']['name'] != '') {
                $package_image = $this->SystemModel->imageUpload('package_image', $uploadPath);
            } else {
                $package_image = '';
            }

               if (isset($_FILES['package_link']['name']) && $_FILES['package_link']['name'] != '') {
                $package_link = $this->SystemModel->imageUpload('package_link', $uploadPath);
            } else {
                $package_link = '';
            }

            $modelData['data'] = array(
                'package_name' => $package_name,
                'package_desc' => $package_desc,
                'package_price' => $package_price,
                'package_offer_price' => $package_offer_price,
                'package_thumbnil' => $package_thumbnil,
                'package_image' => $package_image,
                'level1_group_member' => $level1_group_member,
                'level1_group_member_amount' => $level1_group_member_amount,
                'level2_group_member' => $level2_group_member,
                'level2_group_member_amount' => $level2_group_member_amount,
                'level3_group_member' => $level3_group_member,
                'level3_group_member_amount' => $level3_group_member_amount,
                'level4_group_member' => $level4_group_member,
                'level4_group_member_amount' => $level4_group_member_amount,
                'level5_group_member' => $level5_group_member,
                'level5_group_member_amount' => $level5_group_member_amount,
                
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

          
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }




           //sned ntification
            // notification
         $getStudentData = $this->SystemModel->getStudentData();
         foreach ($getStudentData as $key => $value) {
             
       
                    $user_id = $value->id;
                    $title                      = "Auto Pool Publish, (".$package_name.") Published by B Competition";
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
                        $insert_noti['title']       = "Auto Pool Publish";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$package_name.") Published by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                      }
        //end

       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Manage_autopool_package');
    }

         public function delete($id)
    {
        $modelData['tableName'] = "manage_autopool_level";
        $modelData['data'] = array(
                'isDelete' => '0',
            );
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($modelData);
        //$result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Manage_autopool_package');
    }
}