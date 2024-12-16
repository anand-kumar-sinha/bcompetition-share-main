<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Store extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');

	$adminData = $this->session->userdata('adminData');
        if (!isset($adminData)) 
	{
            redirect('admin/Login');
        }
    }

    public function index()
    {
        $modelData['select'] = 'store.*, category.category_name';
        $modelData['tableName'] = 'store';
         $modelData['condtion'] = "isDelete=0";
	    $modelData['join'][] = array('tableName' => 'category', 'condtion' => 'store.course_category_id=category.id', 'type'=>'left');
        $data['AllStoreDetail'] = $this->SystemModel->getAll($modelData);

        if(isset($_GET['c_id'])){
            $id = $_GET['c_id'];
            $storeDetail['tableName'] = 'store';
            $storeDetail['condtion'] = "id=" . $id;
            $data['StoreDetail'] = $this->SystemModel->getOne($storeDetail);
        }

	    $categoryModelData['tableName'] = 'category';
        $categoryModelData['condtion'] = "is_deleted=0";
        $data['AllCategory'] = $this->SystemModel->getAll($categoryModelData);
        
        $this->load->admin('store/index', $data);
    }

    public function action()
    {
        extract($this->input->post());
     
        $uploadPath = FCPATH . 'uploads/store_image';
              if (!is_dir($uploadPath)) {
              mkdir($uploadPath, 0755, true);
          }
        if($course_category_id) {
                $course_category_id	 = $course_category_id	;
        } else {
                $course_category_id = NULL;
        }

	$modelData['tableName'] = "store";
        if (isset($id) && $id != '') {
            if ($_FILES['course_image']['name']!= '') {
                $course_image = $this->SystemModel->imageUpload('course_image', $uploadPath);
                $path = FCPATH . 'uploads/store_image';
                unlink($path);
            } else {
                $course_image = $old_course_image;
            }

            $modelData['data'] = array(
                'course_category_id' => $course_category_id,
                'course_title' => $course_title,
                'course_description' => $course_description,
                'course_price' => $course_price,
                'course_offer_price' => $course_offer_price,
                'course_validity' => $course_validity,
                'course_image' => $course_image,
                'course_status' => $course_status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            if (isset($_FILES['course_image']['name']) && $_FILES['course_image']['name'] != '') {
                $course_image = $this->SystemModel->imageUpload('course_image', $uploadPath);
            } else {
                $course_image = '';
            }

            $modelData['data'] = array(
		        'course_category_id' => $course_category_id,
                'course_title' => $course_title,
                'course_description' => $course_description,
                'course_price' => $course_price,
                'course_offer_price' => $course_offer_price,
                'course_validity' => $course_validity,
                'course_image' => $course_image,
                'course_status' => $course_status,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

          
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }
       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }


           //sned ntification
            // notification
         $getStudentData = $this->SystemModel->getStudentData();
         $categoryname = $this->SystemModel->category($course_category_id);
         foreach ($getStudentData as $key => $value) {
             
       
                    $user_id = $value->id;
                    $title                      = "Course Publish, (".$course_title.") Published in (".$categoryname->category_name.") by B Competition";
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
                        $insert_noti['title']       = "Course Publish";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$course_title.") Published in (".$categoryname->category_name.") by B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                      }
        //end





        redirect('admin/Store');
    }
    public function add_edit($id = '')
    {
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'store';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
        $this->load->admin('store/add_edit', $data);
    }

        public function addLiveClassSession()
    {
        $data = array();
         $getArr = $this->input->get();
        $s_id = $getArr['s_id'];
        $livaclassdata = $this->SystemModel->get_store_course_content_liveclass_detail($s_id);
         $get_manage_autopool_level = $this->SystemModel->get_join_meeting_details($s_id);
          $get_join_meeting_details_chat = $this->SystemModel->get_join_meeting_details_chat($s_id);
        $pids = array();
        foreach ($get_manage_autopool_level as $h) {
            $pids[] = $h['store_id'];
        }
        $uniquePids = array_unique($pids);
        $data['get_join_meeting_details_chat'] = $get_join_meeting_details_chat;
        $data['livaclassdata'] = $livaclassdata;
        $data['uniquePids'] = $uniquePids;
        $this->load->admin('store/addLiveClassSession', $data);
    }

    public function endstrem()
    {
        $postArr = $this->input->post();
        $data = [
            'end_live_class' => date("Y-m-d h:i:sa"),
            'check_status' => 3
        ];
        $this->SystemModel->updateStrem($data, $postArr['data_id']);
        echo 'sucess';exit;
    }

    public function delete($id)
    {
        $modelData['tableName'] = "store";
        $modelData['data'] = array(
                'isDelete' => '1',
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
        redirect('admin/Store');
    }



    /*
    Date: 02-07-2022
    Comment: get store id and ccategory wise data
    */
    public function all_content_index()
    {
        $data['c_id'] = $this->input->get('c_id');
        $data['store_id'] = $this->input->get('store_id');
	    $modelData['select'] = 'store_course_content_detail.*, store.course_title';
        $modelData['tableName'] = 'store_course_content_detail';
        $modelData['join'][] = array('tableName' => 'store', 'condtion' => 'store_course_content_detail.store_id=store.id', 'type'=>'left');
        $modelData['condtion'] = "store_course_content_detail.isDelete = 0 AND category_id=".$data['c_id']." AND store_id=".$data['store_id'];
        $data['AllCourceContent'] = $this->SystemModel->getAll($modelData);

        if(isset($_GET['s_id'])){
            $id = $_GET['s_id'];
            $storecontentDetail['tableName'] = 'store_course_content_detail';
            $storecontentDetail['condtion'] = "id=" . $id;
            $data['StoreContentDetail'] = $this->SystemModel->getOne($storecontentDetail);
        }

	    $storeModelData['tableName'] = 'store';
        //$storeModelData['condtion'] = "is_deleted=0";
        $data['AllStore'] = $this->SystemModel->getAll($storeModelData);
        
	//$data['AllStore'] = $this->db->select("*")->from("")
        
        $this->load->admin('store/all_content_index', $data);
    }

    /*end funcation*/

    public function all_content_index_action()
    {
        extract($this->input->post());
        
	$store_id = $this->input->get('store_id');
        $modelData['tableName'] = "store_course_content_detail";

        if($course_content_file_type == "PDF"){
           $config['upload_path']          = './uploads/store_image/all_content_pdf';
            $config['allowed_types']        = '*';
            $config['encrypt_name']         = true;
            $config['max_width']            = 6024;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

             // if ($_FILES['course_content_pdf_file']['name'] != '') {
             //        $fileData = $this->upload->data();
             //        $course_content_pdf_file = $fileData['file_name'];

             //        $course_content_pdf_file = "https://digisysindiatech.com/testbook/uploads/store_image/all_content_pdf/".$course_content_pdf_file;
             //    }else{
             //         if (isset($id) && $id != '') {
             //             $course_content_pdf_file =$this->SystemModel->getBookingUdateData($id);
             //              $course_content_pdf_file =  $course_content_pdf_file->course_content_pdf_file;
             //        }
             //    }
            if (!$this->upload->do_upload('course_content_pdf_file')) {
                    if (isset($id) && $id != '') {
                         $course_content_pdf_file =$this->SystemModel->getBookingUdateData($id);
                          $course_content_pdf_file =  $course_content_pdf_file->course_content_pdf_file;
                    }
                  
                $error = array('error' => $this->upload->display_errors());
            } else {
                if ($_FILES['course_content_pdf_file']['name'] != '') {
                    $fileData = $this->upload->data();
                    $course_content_pdf_file = $fileData['file_name'];

                    $course_content_pdf_file = "https://digisysindiatech.com/testbook/uploads/store_image/all_content_pdf/".$course_content_pdf_file;
                }else{

                }
            }
            }

        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'store_id' => $store_id,
                'category_id' => $c_id,
                'course_content_file_type' => $course_content_file_type,
                'course_content_title' => $course_content_title,
                'course_content_detail' => $course_content_detail,
                'course_content_pdf_file' => $course_content_pdf_file,
                'course_content_video_link' => $course_content_video_link,
                'course_content_status' => $course_content_status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'store_id' => $store_id,
                'category_id' => $c_id,
                'course_content_file_type' => $course_content_file_type,
                'course_content_title' => $course_content_title,
                'course_content_detail' => $course_content_detail,
                'course_content_pdf_file' => $course_content_pdf_file,
                'course_content_video_link' => $course_content_video_link,
                'course_content_status' => $course_content_status,
                'created' => date('Y-m-d H:i:s')
            );
        //    echo '<pre>';print_r($modelData);exit;
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

          
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }



           //sned ntification
            // notification
         $getStudentData = $this->SystemModel->getStudentData();
         foreach ($getStudentData as $key => $value) {
               $checkpursub =  $this->SystemModel->checkpursub($value->id, $store_id);
               $getstoreinfo =  $this->SystemModel->getstoreinfo($store_id);
                if(!empty($checkpursub)){

                
                    $user_id = $value->id;
                    $title                      = "Content Publish, (".$course_content_title.") Published by (".$getstoreinfo->course_title.") B Competition";
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
                        $insert_noti['title']       = "Content Publish";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$course_content_title.") Published by (".$getstoreinfo->course_title.") B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                }
                      }
        //end


       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Store');
    }

    public function all_content_index_add_edit($id = '')
    {
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'store_course_content_detail';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
        $this->load->admin('store/all_content_index_add_edit', $data);
    }

    public function all_content_index_delete($id)
    {
        $modelData['tableName'] = "store_course_content_detail";
         $modelData['data'] = array(
                'isDelete' => '1',
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
        redirect('admin/Store/all_content_index');
    }

    /*
    Date: 02-07-2022
    Comment: Add course wise course category
    */

    public function all_live_class_index()
    {   
        $getArr = $this->input->get();
        $data['store_id'] = $getArr['store_id'];
        $data['c_id'] = $getArr['c_id'];

        $modelData['tableName'] = 'store_course_content_liveclass_detail';
        $modelData['condtion'] = "category_id=".$data['c_id']." AND store_id=".$data['store_id'];
        //$modelData['condtion'] = "store_id=".$store_id;
        $data['AllLiveClass'] = $this->SystemModel->getAll($modelData);

         if(isset($_GET['s_id'])){
            $id = $_GET['s_id'];
            $storecontentDetail['tableName'] = 'store_course_content_liveclass_detail';
            $storecontentDetail['condtion'] = "id=" . $id;
            $data['CourseContentDetail'] = $this->SystemModel->getOne($storecontentDetail);
        }


        $this->load->admin('store/all_live_class_index', $data);
    }


    public function all_liveclass_index_action()
    {
        extract($this->input->post());
    $store_id = $this->input->get('store_id');
        $modelData['tableName'] = "store_course_content_liveclass_detail";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'store_id' => $store_id,
                'category_id' => $c_id,
                'liveClassName' => $course_content_title,
                'liveClassStartDate' => $liveClassStartDate,
                'liveClassStartTime' => $liveClassStartTime,
                'liveClassMethod' => $liveClassMethod,
                'liveClassUrl' => $liveClassUrl,
                'status' => $course_content_status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'store_id' => $store_id,
                'category_id' => $c_id,
                'liveClassName' => $course_content_title,
                'liveClassStartDate' => $liveClassStartDate,
                'liveClassStartTime' => $liveClassStartTime,
                'status' => $course_content_status,
                'created' => date('Y-m-d H:i:s')
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
               $checkpursub =  $this->SystemModel->checkpursub($value->id, $store_id);
               $getstoreinfo =  $this->SystemModel->getstoreinfo($store_id);
                if(!empty($checkpursub)){

                
                    $user_id = $value->id;
                    $title                      = "Live Class, (".$course_content_title.") Published by (".$getstoreinfo->course_title.") B Competition";
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
                        $insert_noti['title']       = "Live Class";
                        $insert_noti['created']       = date('Y-m-d H:i:s');
                        $insert_noti['notification_detail']     = "(".$course_content_title.") Published by (".$getstoreinfo->course_title.") B Competition";
                        $this->SystemModel->insert_noti($insert_noti);
                    }
                }
                      }
        //end





       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Store/all_live_class_index?store_id='.$store_id.'&c_id='.$c_id);
    }


    /*
    Date: 02-07-2022
    Comment: Add course wise course category
    */
    public function add_store_category()
    {
        $store_id = $this->input->get('store_id');
        $modelData['tableName'] = 'store_category';
        $modelData['condtion'] = "is_deleted=0 AND store_id=".$store_id;
        //$modelData['condtion'] = "store_id=".$store_id;
        $data['AllCategory'] = $this->SystemModel->getAll($modelData);

        if(isset($_GET['c_id'])){
            $id = $_GET['c_id'];
            $categoryEditData['tableName'] = 'store_category';
            $categoryEditData['condtion'] = "id=" . $id;
            $data['CategoryDetail'] = $this->SystemModel->getOne($categoryEditData);
           // $store_id = $data['CategoryDetail']->store_id;
        }

        $data['store_id'] = $store_id;
        $this->load->admin('store/storecategory/index', $data);
    }

    public function actionAddStoreCategory($value='')
    {
         extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "store_category";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'store_id' => $store_id,
                'category_name' => $category_name,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'store_id' => $store_id,
                'category_name' => $category_name,
                'status' => $status,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

          
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Store/add_store_category?store_id='.$store_id);
    }


    public function delete_store_category($value='')
    {   
        
        $s_id = $this->input->get('s_id');
        $c_id = $this->input->get('c_id');
         $modelData['tableName'] = "store_category";
        $modelData['data'] = array(                  
                        'is_deleted' => '1',
                );
        $modelData['condtion'] = "id=" . $c_id;

        $result = $this->SystemModel->updateData($modelData);
        
        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Store/add_store_category?store_id='.$s_id);
    }


    public function add_student($value='')
    {
        $store_id = $this->input->get('store_id');
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

       $stuArr = $this->SystemModel->getStudentData();
       $AllStudent = [];
       $AllNewStudent = [];
       foreach ($stuArr as $key => $value) {
           $checkData = $this->SystemModel->getStudentSubData($value->id, $store_id);
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
       // echo '<pre>';print_r($data);exit;
        $this->load->admin('store/storecategory/indexStudent', $data);
    }
    //end

    public function removeSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');

        $data = ['status' => 0];
        $this->SystemModel->update_stu_sub($data, $id);
        redirect('admin/store/add_student?store_id='.$courseid);
    }

        public function addSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $coursIdData = $this->SystemModel->getstoreinfo($courseid);
        $id = $this->input->get('id');
        $this->SystemModel->deleteSub($id,$courseid);
        $data = [
            'status' => 1,
            'student_id' => $id,
            'course_id' => $courseid,
            'amount'=>$coursIdData->course_offer_price
        ];
        $this->SystemModel->insertStuSub($data);
        redirect('admin/store/add_student?store_id='.$courseid);
    }

    

}
