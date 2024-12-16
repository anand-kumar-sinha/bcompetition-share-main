<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Part_master extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
       
                
        $departmentUserData = $this->session->userdata('departmentUserData');
        if(!isset($departmentUserData)){
             redirect('department_user/Login');
        } 
       
    }
    
    public function index() {        
         
//        $modelData['tableName'] = 'part_master';
//        $data['AllPartList'] = $this->SystemModel->getAll($modelData);  
        

        $modelData['select'] = 'pa.*, cm.customer_name, cm.contact';
        $modelData['tableName'] = 'part_master pa';
        $modelData['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=pa.customer_id', 'type'=>'left');
//        $modelData['join'][] = array('tableName' => 'company_admin comp', 'condtion' => 'comp.id=pa.deleted_by', 'type'=>'left');
//        $modelData['join'][] = array('tableName' => 'department_user du', 'condtion' => 'du.id=pa.deleted_by', 'type'=>'left');
        $modelData['condtion'] = "pa.is_deleted=0";
        $data['AllPartList'] = $this->SystemModel->getAll($modelData); 

        $this->load->department_user('part_master/index',$data);
    }
    
    public function add_edit($id = '') {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if($id != ''){
            $modelData['tableName'] = 'part_master';
            $modelData['condtion'] = "id=".$id;
            $data['PartDetail'] = $this->SystemModel->getOne($modelData);
        }

        $AllCustomerData['tableName'] = 'customer_master';
        $AllCustomerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($AllCustomerData);

        $this->load->department_user('part_master/add_edit', $data);
    }
    
    
    public function action() {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "part_master";
            
        if (isset($id) && $id != '') {                
            $modelData['data'] = array(                  
                        'customer_id' => $customer_id,
                        'part_name' => $part_name,
//                        'part_code' => $part_code,
                        'status' => $status,
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
            
        }else{
            
            $modelData['data'] = array(   
                        'customer_id' => $customer_id, 
                        'part_name' => $part_name,
//                        'part_code' => $part_code,
                        'status' => $status,
                        'created' => date('Y-m-d H:i:s')
                );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();
            
            $part_code = sprintf("PART#%04d", $inserted_client_id);
            
            $modelData['data'] = array(     
                                        'part_code'    => $part_code,
            );
            $modelData['condtion'] = "id=" . $inserted_client_id;
            $result = $this->SystemModel->updateData($modelData);
            
            
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        } 
        
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/part_master');        
    }
    
   
    public function delete($id) {
//        $this->SystemModel->checkAccess('car_brand_delete');// role access management
        
            /************** Delete Part master Detail *************/
            $departmentUserData = $this->session->userdata('departmentUserData');
            $modelData['tableName'] = "part_master";
            $modelData['data'] = array(                  
                        'is_deleted' => '1',
                        'user_type' => 'department_user',
                        'deleted_by' => $departmentUserData->id,
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            
            
            $modelData1['tableName'] = "super_admin_notification";
            $modelData1['data'] = array(                  
                        'admin_id' => $departmentUserData->id,
                        'module_name' => 'part master delete record',
                        'user_type' => 'department_user',
                        'module_id' => $id,
                        'created' => date('Y-m-d H:i:s')
                );
            $result1 = $this->SystemModel->insertData($modelData1);
            
            
//            $modelData['condtion'] = "id=" . $id;
//            $result = $this->SystemModel->deleteData($modelData);
            
            $successMessage = "Record deleted successfully";
            $errorMessage = "No record deleted";

            if ($result) {
                $this->session->set_flashdata('success', $successMessage);
            } else {
                $this->session->set_flashdata('error', $errorMessage);
            }
            redirect('department_user/part_master');
        
    }   
    
     public function restore($id) {

        /************** Delete Client Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "customer_master";
        $modelData['data'] = array(                  
                        'is_deleted' => '0',
                        'deleted_by' => '0',
                        'user_type' => '',
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
        
            $modelData1['tableName'] = "super_admin_notification";
            $modelData1['data'] = array(                  
                        'admin_id' => $departmentUserData->id,
                        'module_name' => 'part master restore record',
                        'user_type' => 'department_user',
                        'module_id' => $id,
                        'created' => date('Y-m-d H:i:s')
                );
            $result1 = $this->SystemModel->insertData($modelData1);
            
//        $modelData['condtion'] = "id=" . $id;
//        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/part_master');

    } 
    
}


