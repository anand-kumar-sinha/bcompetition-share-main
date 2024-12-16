<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_master extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
       
                
        $departmentUserData = $this->session->userdata('departmentUserData');
        if(!isset($departmentUserData)){
             redirect('department_user/Login');
        } 
       
    }
    
    public function index() {        
         
//        $modelData['select'] = 'cm.*, comp.person_name, du.user_name';
        $modelData['tableName'] = 'customer_master cm';
//        $modelData['join'][] = array('tableName' => 'company_admin comp', 'condtion' => 'comp.id=cm.deleted_by', 'type'=>'left');
//        $modelData['join'][] = array('tableName' => 'department_user du', 'condtion' => 'du.id=cm.deleted_by', 'type'=>'left');
        $modelData['condtion'] = "cm.is_deleted=0";
        $data['AllCustomer'] = $this->SystemModel->getAll($modelData); 
     
        $this->load->department_user('customer_master/index',$data);
    }
    
    public function add_edit($id = '') {
        $data = array();
        if($id != ''){
            $modelData['tableName'] = 'customer_master';
            $modelData['condtion'] = "id=".$id;
            $data['customerDetail'] = $this->SystemModel->getOne($modelData);
        }
        $this->load->department_user('customer_master/add_edit', $data);
    }
 
    public function view($id) {
        $data = array();
        $modelData['tableName'] = 'customer_master';
        $modelData['condtion'] = "id=" . $id;
        $data['ClientDetail'] = $this->SystemModel->getOne($modelData);
       
        $this->load->department_user('customer_master/view', $data);
    }
    
    
    public function action() {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "customer_master";
            
        if (isset($id) && $id != '') {                
            $modelData['data'] = array(                  
                        'customer_name' => $customer_name,
//                        'customer_code' => $customer_code,
                        'contact' => $contact,
                        'address' => $address,
                        'pan_number' => $pan_number,
                        'gst' => $gst,
                        'email' => $email,
                        'email' => $email,
                        'proprietor_partnership' => $proprietor_partnership,
                        'updated' => date('Y-m-d H:i:s')                
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
            
        }else{
            
            $modelData['data'] = array(                  
                        'customer_name' => $customer_name,
                        // 'customer_code' => $customer_code,
                        'contact' => $contact,
                        'address' => $address,
                        'pan_number' => $pan_number,
                        'gst' => $gst,
                        'email' => $email,
                        'status' => $status,
                        'proprietor_partnership' => $proprietor_partnership,
                        'created' => date('Y-m-d H:i:s')
                );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();
            
            $customer_code = sprintf("CUS#%04d", $inserted_client_id);
            
            $modelData['data'] = array(     
                                        'customer_code'    => $customer_code,
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
        redirect('department_user/Customer_master');        
    }
    
   
    public function delete($id) {

        /************** Delete Client Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "customer_master";
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
                        'module_name' => 'customer master delete record',
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
        redirect('department_user/Customer_master');

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
                        'module_name' => 'customer master restore record',
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
        redirect('department_user/Customer_master');

    } 
    
}


