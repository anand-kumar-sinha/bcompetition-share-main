<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
        $this->load->library('excel');
        $adminData = $this->session->userdata('adminData');
        if(!isset($adminData)){
             redirect('admin/Login');
        } 
       
    }
    
    public function index() {        
         
        $modelData['tableName'] = 'users';
        $data['Allusers'] = $this->SystemModel->getAll($modelData);         
        $this->load->admin('users/index',$data);
    }
    
    public function add_edit($id = '') {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'users';
            $modelData['condtion'] = "id=" . $id;
            $data['UserDetail'] = $this->SystemModel->getOne($modelData);
        }
        
        $this->load->admin('users/add_edit', $data);
    }
 
    public function view($id) {
//        $this->SystemModel->checkAccess('car_brand_view');// role access management
        $modelData['tableName'] = 'users';
        $modelData['condtion'] = "id=" . $id;
        $data['StudentDetail'] = $this->SystemModel->getOne($modelData);
        $this->load->admin('users/view', $data);
    }
    
    
    
    public function action() {
//        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "users";
        $updated = date('Y-m-d h:i:s');
        $created = date('Y-m-d h:i:s');
        
        
        $birth_date = date('Y-m-d',strtotime($birth_date));
        
        $password = md5($password);
            
            
        if (isset($id) && $id != '') {    

            $modelData['data'] = array(     
                                            'name'    => $name,
                                            'email'    => $email,
                                            'contact'    => $contact,
                                            'updated'  => $updated
         
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        }else{

            $modelData['data'] = array(     
                                            'name'    => $name,
                                            'email'    => $email,
                                            'contact'    => $contact,
                                            'username'    => $username,
                                            'password'    => $password,
                                            'created'  => $created
            );
            $result = $this->SystemModel->insertData($modelData);
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
            
        } 
            
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Users');        
    }
    
    public function delete($id) {
//        $this->SystemModel->checkAccess('car_brand_delete');// role access management
            $modelData['tableName'] = "users";
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->deleteData($modelData);
            $successMessage = "Record deleted successfully";
            $errorMessage = "No record deleted";

            if ($result) {
                $this->session->set_flashdata('success', $successMessage);
            } else {
                $this->session->set_flashdata('error', $errorMessage);
            }
            redirect('admin/Users');
        
    }   
    
}

