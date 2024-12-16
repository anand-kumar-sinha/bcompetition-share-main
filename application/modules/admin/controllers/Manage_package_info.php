<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manage_package_info extends MY_Controller
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
            $storeDetail['tableName'] = 'package_info';
            $storeDetail['condtion'] = "isDelete = 0 AND id=" . $id;
            $data['PackageDetail'] = $this->SystemModel->getOne($storeDetail);
        }
        $data['package_data'] = $this->SystemModel->get_package_info();
      //  echo '<pre>';print_r($data);exit;
        $this->load->admin('manage_package_info/index', $data);
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

    $modelData['tableName'] = "package_info";
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

             if ($_FILES['package_link']['name']!= '') {
                $package_link = $this->SystemModel->imageUpload('package_link', $uploadPath);
                $path = FCPATH . 'uploads/package_link';
                unlink($path);
            } else {
                $package_link = $old_package_link;
            }

            $modelData['data'] = array(
                'package_name' => $package_name,
                'package_desc' => $package_desc,
                'package_price' => $package_price,
                'package_offer_price' => $package_offer_price,
                'package_thumbnil' => $package_thumbnil,
                'package_image' => $package_image,
                'package_link' => $package_link,
                'image_name' => $image_name,
                'book_name' => $book_name,
                'status' => $status,
                
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
                'package_link' => $package_link,
                'image_name' => $image_name,
                'book_name' => $book_name,
                'status' => 1,
                
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
                    $title                      = "Package Publish, (".$package_name.") Published by B Competition";
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
                        $insert_noti['title']       = "Package Publish";
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
        redirect('admin/manage_package_info');
    }

    public function add_student()
    {
        $store_id = $this->input->get('store_id');
        $stuArr = $this->SystemModel->getStudentData();
         $AllStudent = [];
       $AllNewStudent = [];
       foreach ($stuArr as $key => $value) {
           $checkData = $this->SystemModel->package_purchase_info_details($value->id, $store_id);
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
         $this->load->admin('admin/manage_package_info/indexStudent', $data);
    }

      public function removeSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');

        $data = ['status' => 0];
        $this->SystemModel->update_package_purchase_info($data, $id);
        redirect('admin/manage_package_info/add_student?store_id='.$courseid);
    }

        public function addSub($value='')
    {
        $courseid = $this->input->get('courseid');
        $id = $this->input->get('id');
        $this->SystemModel->deletepackage_purchase_info($id,$courseid);
        $getmanage_autopool_levelRow = $this->SystemModel->egtmanddg_package_info($courseid);
        $data = [
            'status' => 1,
            'student_id' => $id,
            'package_id' => $courseid,
            'amount'=>$getmanage_autopool_levelRow->package_offer_price
        ];
        
        $this->SystemModel->insertpackage_purchase_info($data);
        redirect('admin/manage_package_info/add_student?store_id='.$courseid);
    }

        public function delete($id)
    {
        $modelData['tableName'] = "package_info";
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
        redirect('admin/manage_package_info');
    }
}