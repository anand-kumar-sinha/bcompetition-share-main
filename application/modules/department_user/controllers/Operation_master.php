<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operation_master extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
       
                
        $departmentUserData = $this->session->userdata('departmentUserData');
        if(!isset($departmentUserData)){
             redirect('department_user/Login');
        } 
       
    }
    
    public function index() {        
         
        $modelData['tableName'] = 'operation_master';
        $modelData['condtion'] = "is_deleted=0";
//        $modelData['join'][] = array('tableName' => 'company_admin comp', 'condtion' => 'comp.id=om.deleted_by', 'type'=>'left');
//        $modelData['join'][] = array('tableName' => 'department_user du', 'condtion' => 'du.id=om.deleted_by', 'type'=>'left');
        $data['AllOperationList'] = $this->SystemModel->getAll($modelData);  
        
        $this->load->department_user('operation_master/index',$data);
    }
    
    public function add_edit($id = '') {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if($id != ''){
            $modelData['tableName'] = 'operation_master';
            $modelData['condtion'] = "id=".$id;
            $data['OperationDetail'] = $this->SystemModel->getOne($modelData);
        }

        $this->load->department_user('operation_master/add_edit', $data);
    }
    
    
    public function action() {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "operation_master";
            
        if (isset($id) && $id != '') {                
            $modelData['data'] = array(  
                        'operation_name' => $operation_name,
//                        'operation_code' => $operation_code,
                        'status' => $status,
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
            
        }else{
            
            $modelData['data'] = array(    
                        'operation_name' => $operation_name,
//                        'operation_code' => $operation_code,
                        'status' => $status,
                        'created' => date('Y-m-d H:i:s')
                );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();
            
            $operation_code = sprintf("OPE#%04d", $inserted_client_id);
            
            $modelData['data'] = array(     
                                        'operation_code'    => $operation_code,
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
        redirect('department_user/operation_master');        
    }
    
   
    public function delete($id) {
//        $this->SystemModel->checkAccess('car_brand_delete');// role access management
        
            /************** Delete Part master Detail *************/
            $departmentUserData = $this->session->userdata('departmentUserData');
            $modelData['tableName'] = "operation_master";
            $modelData['data'] = array(                  
                        'is_deleted' => '1',
                        'deleted_by' => $departmentUserData->id,
                        'user_type' => 'department_user',
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            
            $modelData1['tableName'] = "super_admin_notification";
            $modelData1['data'] = array(                  
                        'admin_id' => $departmentUserData->id,
                        'module_name' => 'operation master delete record',
                        'module_id' => $id,
                        'user_type' => 'department_user',
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
            redirect('department_user/operation_master');
        
    }   
    
      public function restore($id) {

        /************** Delete Client Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "operation_master";
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
                        'module_name' => 'operation master restore record',
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
        redirect('department_user/operation_master');

    } 
    
}


