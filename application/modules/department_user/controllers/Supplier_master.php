<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_master extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
       
                
        $departmentUserData = $this->session->userdata('departmentUserData');
        if(!isset($departmentUserData)){
             redirect('department_user/Login');
        } 
       
    }
    
    public function index() {        
         
        $modelData['select'] = 'cm.*';
        $modelData['tableName'] = 'supplier_master cm';
        $modelData['condtion'] = "cm.is_deleted=0";
//        $modelData['join'][] = array('tableName' => 'company_admin comp', 'condtion' => 'comp.id=cm.deleted_by', 'type'=>'left');
//        $modelData['join'][] = array('tableName' => 'department_user du', 'condtion' => 'du.id=cm.deleted_by', 'type'=>'left');
        $data['AllSupplier'] = $this->SystemModel->getAll($modelData);         
        $this->load->department_user('supplier_master/index',$data);
    }
    
    public function add_edit($id = '') {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if($id != ''){
            $modelData['tableName'] = 'supplier_master';
            $modelData['condtion'] = "id=".$id;
            $data['AllSupplier'] = $this->SystemModel->getOne($modelData);
        }
        $this->load->department_user('supplier_master/add_edit', $data);
    }
 
    public function view($id) {
//        $this->SystemModel->checkAccess('car_brand_view');// role access management
        $data = array();
        $modelData['tableName'] = 'supplier_master';
        $modelData['condtion'] = "id=" . $id;
        $data['ClientDetail'] = $this->SystemModel->getOne($modelData);
       
        $this->load->department_user('supplier_master/view', $data);
    }
    
    
    public function action() {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "supplier_master";
        $departmentUserData = $this->session->userdata('departmentUserData');
        if (isset($id) && $id != '') {                
            $modelData['data'] = array(                  
                        'supplier_name' => $supplier_name,
//                        'supplier_code' => $supplier_code,
                        'contact' => $contact,
                        'address' => $address,
                        'gst' => $gst,
                        'pan_number' => $pan_number,
                        'email' => $email,
                        'proprietor_partnership' => $proprietor_partnership,
                        'status' => $status,
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
            
        }else{
            
            $modelData['data'] = array(                  
                        'supplier_name' => $supplier_name,
//                        'supplier_code' => $supplier_code,
                        'contact' => $contact,
                        'address' => $address,
                        'gst' => $gst,
                        'pan_number' => $pan_number,
                        'email' => $email,
                        'proprietor_partnership' => $proprietor_partnership,
                        'status' => $status,
                        'created_by' => $departmentUserData->id  ,
                        'created' => date('Y-m-d H:i:s')
                );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();
            
            $supplier_code = sprintf("SUP#%04d", $inserted_client_id);
            
            $modelData['data'] = array(     
                                        'supplier_code'    => $supplier_code,
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
        redirect('department_user/Supplier_master');        
    }
    
   
    public function delete($id) {
//        $this->SystemModel->checkAccess('car_brand_delete');// role access management
        
            /************** Delete Client Detail *************/
            $departmentUserData = $this->session->userdata('departmentUserData');
            $modelData['tableName'] = "supplier_master";
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
                        'module_name' => 'supplier master delete record',
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
            redirect('department_user/Supplier_master');
        
    }  
    
    public function restore($id) {

        /************** Delete Client Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "supplier_master";
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
                        'module_name' => 'supplier master restore record',
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
        redirect('department_user/Supplier_master');

    } 
    
}


