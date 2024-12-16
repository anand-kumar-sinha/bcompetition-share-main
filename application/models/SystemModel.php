<?php

class SystemModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getAll($modelData) {

        if (isset($modelData['select'])){   //----  Select Fields   ----//
            $this->db->select($modelData['select']);            
        }else {
            $this->db->select('*');            
        }
        $this->db->from($modelData['tableName']); //----  Table Name   ----//
        
        if (isset($modelData['join'])){ //----  Multiple Joins   ----//
            foreach($modelData['join'] as $_join){
                $this->db->join($_join['tableName'], $_join['condtion'], isset($_join['type'])?$_join['type']:'');            
            }
        }
        if (isset($modelData['condtion'])){ //----  Condtions (Make one String in multiple condtion) (Like# id=1 AND status=active OR...)  ----//
            $this->db->where($modelData['condtion']);
        }
        if (isset($modelData['like'])){ //----  Condtions (Make one String in multiple condtion) (Like# id=1 AND status=active OR...)  ----//
            $this->db->like($modelData['like']['column'], $modelData['like']['match']);
        }
        if (isset($modelData['group_by'])){
            $this->db->group_by($modelData['group_by']);
        }
        if (isset($modelData['order'])){ //----  Sql Order   ----//
            $this->db->order_by($modelData['order'][0],$modelData['order'][1]);
        }
        if (isset($modelData['limit'])){    //----  Sql Limit   ----//
            $this->db->limit($modelData['limit']['total'],$modelData['limit']['start']);
        }
        $query = $this->db->get();
        return($query->result());
    }

    public function getOne($modelData) {
        
        $queryData = $this->getAll($modelData);
        return $queryData[0];
                
    }
    public function insertData($modelData) {
    
        $this->db->insert($modelData['tableName'], $modelData['data']); 
        return ($this->db->affected_rows() > 0) ? true : false; 
    }
    
    public function updateData($modelData) {
        if (isset($modelData['condtion'])){
            $this->db->where($modelData['condtion']);
        }
        $this->db->update($modelData['tableName'], $modelData['data']);
        return ($this->db->affected_rows() > 0) ? true : false; 
    }
    
    public function deleteData($modelData) {
        if (isset($modelData['condtion'])){
            $this->db->where($modelData['condtion']);
        }
        $this->db->delete($modelData['tableName']);
        return ($this->db->affected_rows() > 0) ? true : false; 
    }
    
    public function lastInsertId() {
        return $this->db->insert_id();    
    }
    
    public function tableRowCount($modelData) {
        /*$this->db->select('*');
        $this->db->from($modelData['tableName']);
        
        if (isset($modelData['condtion'])){
            $this->db->where($modelData['condtion']);
        }
        if (isset($modelData['like'])){ //----  Condtions (Make one String in multiple condtion) (Like# id=1 AND status=active OR...)  ----//
            $this->db->like($modelData['like']['column'], $modelData['like']['match']);
        }
        $query = $this->db->get();
        return $query->num_rows();*/
        
        unset($modelData['limit']);
        $queryData = $this->getAll($modelData);
        return count($queryData);
        
    }
    
    public function getLastQuery() {
        return $this->db->last_query();
    }
    
    public function imageUpload($imageName,$uploadPath) {
        
        $_FILES['imageArray']['name'] = $_FILES[$imageName]['name'];
        $_FILES['imageArray']['type'] = $_FILES[$imageName]['type'];
        $_FILES['imageArray']['tmp_name'] = $_FILES[$imageName]['tmp_name'];
        $_FILES['imageArray']['error'] = $_FILES[$imageName]['error'];
        $_FILES['imageArray']['size'] = $_FILES[$imageName]['size'];

        //$uploadPath = 'uploads/products/images/';
        $config['upload_path'] = $uploadPath;
        //$config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|txt|csv';
        $config['allowed_types'] = '*';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('imageArray')){
            $imageArray = $this->upload->data();
            $file_ext = pathinfo($_FILES[$imageName]['name'],PATHINFO_EXTENSION);
            return $image = $imageArray['file_name'];
        }else{
            $errors = $this->upload->display_errors();
            $this->session->set_flashdata('error',$errors);            
            return $errors;
        }
        
    }


        public function imageUploads($imageName,$uploadPath) {
        
        $_FILES['imageArray']['name'] = "FB_IMG_1648011226122.jpg";
        

        //$uploadPath = 'uploads/products/images/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|txt|csv';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imageArray = $this->upload->data();
        print_r($imageArray);exit;
        $file_ext = pathinfo($imageName,PATHINFO_EXTENSION);
        return $image = $imageName;
        // if($this->upload->do_upload('imageArray')){
        //     $imageArray = $this->upload->data();
        //     $file_ext = pathinfo($_FILES[$imageName]['name'],PATHINFO_EXTENSION);
        //     return $image = $imageArray['file_name'].'.'.$file_ext;
        // }else{
        //     $errors = $this->upload->display_errors();
        //     $this->session->set_flashdata('error',$errors);            
        //     return $errors;
        // }
        
    }
    
    
    public function imageUploadMultiple($imageName,$uploadPath,$uploadedImages=array()) {
        
        $filesCount = count($_FILES[$imageName]['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['productImages']['name'] = $_FILES[$imageName]['name'][$i];
            $_FILES['productImages']['type'] = $_FILES[$imageName]['type'][$i];
            $_FILES['productImages']['tmp_name'] = $_FILES[$imageName]['tmp_name'][$i];
            $_FILES['productImages']['error'] = $_FILES[$imageName]['error'][$i];
            $_FILES['productImages']['size'] = $_FILES[$imageName]['size'][$i];

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|txt|csv';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('productImages')){
                $fileData = $this->upload->data();
                $uploadedImages[] = $fileData['file_name'];                
            }else{
                $errors = $this->upload->display_errors();
                $this->session->set_flashdata('error',$errors);            
                return $errors;
            }
        }
        
        return $uploadedImages;
    }
    
    public function checkAccess($page) {
        $roleData=$this->session->roleData;
        if($roleData->$page!=1){
            $this->session->set_flashdata('error', "You don't have access of this page. Admin notice your activity. Please don't try again.");
            redirect('users/dashboard');
        }
    }
    
    public function changeDateFormate($date) {
        $date = str_replace('/', '-', $date);        
        return date('Y-m-d',strtotime($date));        
    }
    
    
    public function directQuery($sql) {
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getBookingUdateData($id)
    {
        $this->db->where('id', $id);
      
        return $this->db->get('store_course_content_detail')->row();
    }

        public function student_buy_autopool_package($id)
    {
        $this->db->where('student_id', $id);
      
        return $this->db->get('student_buy_autopool_package')->row();
    }

            public function getStudentLastData($id)
    {
        $this->db->where('package_id', $id);
            $this->db->order_by("id", "desc");
        return $this->db->get('student_buy_autopool_package')->row();
    }

            public function check_student_buy_autopool_package($id, $package_id)
    {
        $this->db->where('student_id', $id);
      $this->db->where('package_id', $package_id);
        $this->db->where('status', '1');
        return $this->db->get('student_buy_autopool_package')->row();
    }

        public function getStudentInfo($id)
    {
        $this->db->where('id', $id);
      
        return $this->db->get('student')->row();
    }
    
            public function checknumberExistornot($id)
    {
        $this->db->where('mobile_number', $id);
      
        return $this->db->get('student')->row();
    }

            public function getStudenIncome($id)
    {
        $this->db->where('student_id', $id);
      $this->db->where('transaction_number', "Reward Amount");
      $this->db->order_by("id", "desc");
        return $this->db->get('student_wallet_history')->row();
    }
    
        public function insert_data($code)
    {
         $this->db->insert('refere_earn_level', $code);
        return $this->db->insert_id();
    }

            public function insert_noti($code)
    {
         $this->db->insert('student_notification', $code);
        return $this->db->insert_id();
    }

            public function savePackagePoolData($code)
    {
         $this->db->insert('student_buy_autopool_package', $code);
        return $this->db->insert_id();
    }
        public function getTestData($code)
    {
        $this->db->where('referal_code', $code);
        return $this->db->get('refere_earn_level')->row();
    }

            public function checkreferdata($code)
    {
        $this->db->where('referral_code', $code);
        return $this->db->get('student')->row();
    }

            public function getmanage_autopool_levelRow($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('manage_autopool_level')->row();
    }


            public function getmanage_test($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('test')->row();
    }

                public function getmanage_manage_autopool_levelaa($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('manage_autopool_level')->row();
    }


            public function egtmanddg_package_info($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('package_info')->row();
    }

                public function get_store_course_content_liveclass_detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('store_course_content_liveclass_detail')->row();
    }

                public function egtmanddg_pmanage_autopool_level($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('manage_autopool_level')->row();
    }

    public function getlogin_master()
    {
        $this->db->where('id', 1);
        return $this->db->get('login_master')->row();
    }

            public function getTestParentData($code)
    {
        $this->db->where('student_id', $code);
        return $this->db->get('refere_earn_level')->row();
    }

                public function getPurchaseInfo($id, $pack)
    {
        $this->db->where('student_id', $id);
        $this->db->where('package_id', $pack);
        $this->db->where('status', '1');
        return $this->db->get('package_purchase_info')->row();
    }

                    public function getPurchaseInfostudent_buy_autopool_package($id, $pack)
    {
        $this->db->where('student_id', $id);
        $this->db->where('package_id', $pack);
        $this->db->where('status', '1');
        return $this->db->get('student_buy_autopool_package')->row();
    }


               public function refer_earn_level_price()
    {
        $this->db->where('id', 1);
        return $this->db->get('refer_earn_level_price')->row();
    } 

    public function student_group_level($packageId)
    {
        $this->db->where('id', $packageId);
        return $this->db->get('manage_autopool_level')->row();
    } 

    public function student_complete_group_level($id)
    {
        $this->db->where('student_id', $id);
        return $this->db->get('student_complete_group_level')->row();
    }

        public function category($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('category')->row();
    } 

            public function checkpursub($student_id, $store_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->where('course_id', $store_id);
        return $this->db->get('student_subscription_details')->row();
    } 

        public function student_complete_group_levels($id, $package_id)
    {
        $this->db->where('student_id', $id);
         $this->db->where('package_id', $package_id);
        return $this->db->get('student_complete_group_level')->row();
    } 

    public function get_package_info()
    {
        $this->db->where('isDelete', 0);
        //return $this->db->get('package_info')->row();
        $result = $this->db->get('package_info');
        return $result->result();
    } 

    public function get_manage_autopool_level()
    {
        $this->db->where('isDelete', 1);
        //return $this->db->get('package_info')->row();
        $result = $this->db->get('manage_autopool_level');
        return $result->result();
    } 

    public function get_join_meeting_details($meeting_id)
    {
        $this->db->where('meeting_id', $meeting_id);
        $result = $this->db->get('join_meeting_details');
        return $result->result_array();
    } 
        public function get_join_meeting_details_chat($meeting_id)
    {
        $this->db->where('liveclass_chat_id', $meeting_id);
         $this->db->order_by("id", "desc");
        $result = $this->db->get('live_class_chat');
        return $result->result_array();
    } 

    public function get_join_meeting_details_chat_api($meeting_id, $auth_id)
    {
        $this->db->where('liveclass_chat_id', $meeting_id);
        $this->db->where('auth_id', $auth_id);
         $this->db->order_by("id", "desc");
        $result = $this->db->get('live_class_chat');
        return $result->result_array();
    } 

        public function getRequrestData($auth_id)
    {
        
        $this->db->where('student_id', $auth_id);
        $this->db->where('status', "Pending");
        $result = $this->db->get('student_transfer_money');
        return $result->result();
    } 

    public function allStudentLevelData()
    {
        $result = $this->db->get('student_complete_group_level');
        return $result->result();
    } 

    public function  getStudentReferal($auth_id)
    {
        $this->db->where('student_id', $auth_id);
        return $this->db->get('refere_earn_level')->row();
    } 

        public function getLevel($levelid)
    {
        $this->db->where('id',1);
        return $this->db->get('refer_earn_level_price')->row();
    } 

           public function getstoreinfo($levelid)
    {
        $this->db->where('id',$levelid);
        return $this->db->get('store')->row();
    }

    public function getStudentSubData($id, $store_id)
    {
        $this->db->where('course_id',$store_id);
        $this->db->where('student_id',$id);
        $this->db->where('status',1);
        return $this->db->get('student_subscription_details')->row();

    }

    public function package_purchase_info_details($id, $store_id)
    {
        $this->db->where('package_id',$store_id);
        $this->db->where('student_id',$id);
         $this->db->where('status',1);
        return $this->db->get('package_purchase_info')->row();

    } 

        public function student_buy_autopool_package_info_details($id, $store_id)
    {
        $this->db->where('package_id',$store_id);
        $this->db->where('student_id',$id);
         $this->db->where('status',1);
        return $this->db->get('student_buy_autopool_package')->row();

    } 

            public function student_buy_student_test_subscription($id, $store_id)
    {
        $this->db->where('test_id',$store_id);
        $this->db->where('student_id',$id);
          $this->db->where('status',1);
        return $this->db->get('student_test_subscription')->row();

    } 


            public function getLeve1Status($auth_id, $package_id)
    {
        $this->db->where('student_id',$auth_id);
        $this->db->where('package_id',$package_id);
         $this->db->where('auto_pool_status',1);
        return $this->db->get('student_wallet_history')->row();

    } 
                public function getLtest_id($auth_id)
    {
        $this->db->where('id',$auth_id);
         
        return $this->db->get('test')->row();

    } 

                public function getLeve2Status($auth_id, $package_id)
    {
        $this->db->where('student_id',$auth_id);
        $this->db->where('package_id',$package_id);
         $this->db->where('auto_pool_status',2);
        return $this->db->get('student_wallet_history')->row();

    } 

                    public function getLeve3Status($auth_id, $package_id)
    {
        $this->db->where('student_id',$auth_id);
          $this->db->where('package_id',$package_id);
         $this->db->where('auto_pool_status',3);
        return $this->db->get('student_wallet_history')->row();

    } 

                    public function getLeve4Status($auth_id, $package_id)
    {
        $this->db->where('student_id',$auth_id);
          $this->db->where('package_id',$package_id);
         $this->db->where('auto_pool_status',4);
        return $this->db->get('student_wallet_history')->row();

    } 

                    public function getLeve5Status($auth_id, $package_id)
    {
        $this->db->where('student_id',$auth_id);
          $this->db->where('package_id',$package_id);
         $this->db->where('auto_pool_status',5);
        return $this->db->get('student_wallet_history')->row();

    } 

                public function getLeve1StatusInfo($auth_id)
    {
        $this->db->where('id',$auth_id);
      return $this->db->get('student')->row();

    } 
    
    public function getstudent_wallet_history_info($auth_id,$transaction_number)
    {
        $this->db->where('student_id',$auth_id);
        $this->db->where('transaction_number',$transaction_number);
        return $this->db->get('student_wallet_history')->row();

    } 

        public function getAutoPoolData($student_id, $package_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('package_id',$package_id);

        return $this->db->get('student_buy_autopool_package')->row();
    } 

            public function getAutoPoolDatass($student_id, $package_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('package_id',$package_id);

        return $this->db->get('student_buy_autopool_package')->result();
    } 

    

    public function student_subscription_details($levelid)
    {
        $this->db->where('student_id',$levelid);
        $result = $this->db->get('student_subscription_details');
        return $result->result();
        
    } 

        public function getStudentData()
    {
        //$this->db->where('student_id',$levelid);
        $result = $this->db->get('student');
        return $result->result();
        
    } 

            public function getStudentapply_test_id($test_id)
    {
        $this->db->where('test_id',$test_id);
        $result = $this->db->get('student_attempt_test');
        return $result->result();
        
    } 

            public function countAllStudent($id)
    {
        $this->db->where('is_deleted',0);
        $this->db->limit(99999, $id);
        $result = $this->db->get('student');
        return $result->result();
//         $q = $this->db->query('SELECT id FROM student WHERE id = ?',array(2));
// return array_shift($q->result_array());
        
    }

                public function getIdWiseData_bk($id, $packageId)
    {
        $this->db->where('package_id',$packageId);
        $this->db->limit(99999, $id);
        $result = $this->db->get('student_buy_autopool_package');
     
        return $result->result();
    }

                    public function getIdWiseData($id, $packageId)
    {
        $this->db->where('package_id',$packageId);
        $this->db->where('id >' , $id);
        $result = $this->db->get('student_buy_autopool_package');
     
        return $result->result();
    }



                public function getIdWiseLevelData($id, $packageId)
    {
        $this->db->where('package_id',$packageId);
        $this->db->limit(99999, $id);
        $result = $this->db->get('student_buy_autopool_package');
        return $result->result();
    } 

        public function get_package_infos($levelid)
    {
        $this->db->where('id',$levelid);
        $result = $this->db->get('package_info');
        return $result->result();
        
    } 

            public function getPoolResutl($studentid)
    {
        $this->db->where('student_id',$studentid);
        $result = $this->db->get('student_complete_group_level');
        return $result->result();
        
    } 

                public function getstudent_refer($studentid)
    {
        $this->db->where('refer_student_id',$studentid);
        $result = $this->db->get('student_refer');
        return $result->result();
        
    } 

                    public function getstudent_refer_info_table($studentid)
    {
        $this->db->where('parent_id',$studentid);
        $result = $this->db->get('refere_earn_level');
        return $result->result();
        
    } 

               public function student_test_subscription($levelid)
    {
        $this->db->where('student_id',$levelid);
        $result = $this->db->get('student_test_subscription');
        return $result->result();
        
    } 

      public function student_attempt_test($levelid)
    {
        $this->db->where('student_id',$levelid);
        $result = $this->db->get('student_attempt_test');
        return $result->result();
        
    } 

          public function package_purchase_info($levelid)
    {
        $this->db->where('student_id',$levelid);
        $result = $this->db->get('package_purchase_info');
        return $result->result();
        
    } 

              public function student_buy_autopool_packages($levelid)
    {
        $this->db->where('student_id',$levelid);
        $result = $this->db->get('student_buy_autopool_package');
        return $result->result();
        
    } 

            public function getStudnetLevel($Cvalue)
    {
        $this->db->where('id',$Cvalue);
        return $this->db->get('refer_earn_level_price')->row();
    } 

                public function checkSub($test, $auth_id)
    {
        
        $this->db->where('test_id',$test);
        $this->db->where('student_id',$auth_id);
        return $this->db->get('student_test_subscription')->row();
    } 
   

    public function update_test_code($data, $id){
         $this->db->where('id',$id);
        $this->db->update('refere_earn_level',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

     public function update_refer($data){
         $this->db->where('id',1);
        $this->db->update('refer_earn_level_price',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

         public function update_student_group($data){
         $this->db->where('id',1);
        $this->db->update('student_group_level',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }


         public function updateStrem($data, $id){
         $this->db->where('id',$id);
        $this->db->update('store_course_content_liveclass_detail',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

      public function update_stu_sub($data, $id){
         $this->db->where('id',$id);
        $this->db->update('student_subscription_details',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

          public function update_package_purchase_info($data, $id){
         $this->db->where('id',$id);
        $this->db->update('package_purchase_info',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

              public function update_student_buy_autopool_package($data, $id){
         $this->db->where('id',$id);
        $this->db->update('student_buy_autopool_package',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

                  public function update_student_buy_student_test_subscription($data, $id){
         $this->db->where('id',$id);
        $this->db->update('student_test_subscription',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

          public function updateStudWal($data, $id){
         $this->db->where('id',$id);
        $this->db->update('student',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

              public function updateProfule($data){
         $this->db->where('id',1);
        $this->db->update('login_master',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function insertStuSub($data)
    {
          $this->db->insert('student_subscription_details', $data);
        return $this->db->insert_id();
    }

    public function insert_student_complete_group_level($data)
    {
          $this->db->insert('student_complete_group_level', $data);
        return $this->db->insert_id();
    }

              public function updateStudentLevel($data, $id){
         $this->db->where('id',$id);
        $this->db->update('student_complete_group_level',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

        public function insertpackage_purchase_info($data)
    {
          $this->db->insert('package_purchase_info', $data);
        return $this->db->insert_id();
    }

            public function insertstudent_buy_autopool_package($data)
    {
          $this->db->insert('student_buy_autopool_package', $data);
        return $this->db->insert_id();
    }


                public function insertstudent_student_test_subscription($data)
    {
          $this->db->insert('student_test_subscription', $data);
        return $this->db->insert_id();
    }





        public function imsertStuRewa($data)
    {
          $this->db->insert('student_wallet_history', $data);
        return $this->db->insert_id();
    }

    public function deleteSub($id,$course)
    {
         $this->db->where('student_id',$id);
          $this->db->where('course_id',$course);
        $this->db->delete('student_subscription_details');
    }

        public function delete_student_transfer_money($id)
    {
        
          $this->db->where('id',$id);
        $this->db->delete('student_transfer_money');
    }

        public function deletepackage_purchase_info($id,$course)
    {
         $this->db->where('student_id',$id);
          $this->db->where('package_id',$course);
        $this->db->delete('package_purchase_info');
    }

            public function deletestudent_buy_autopool_package($id,$course)
    {
         $this->db->where('student_id',$id);
          $this->db->where('package_id',$course);
        $this->db->delete('student_buy_autopool_package');
    }

                public function deletestudent_student_test_subscription($id,$course)
    {
         $this->db->where('student_id',$id);
          $this->db->where('test_id',$course);
        $this->db->delete('student_test_subscription');
    }

}
?>
