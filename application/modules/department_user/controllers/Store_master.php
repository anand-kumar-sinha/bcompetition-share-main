<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Store_master extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
       
                
        $adminData = $this->session->userdata('adminData');
        if(!isset($adminData)){
             redirect('admin/Login');
        } 
       
    }
    
    public function index() {        
         
        $modelData['tableName'] = 'store_master';
        $data['AllStore'] = $this->SystemModel->getAll($modelData);         
        $this->load->admin('store_master/index',$data);
    }
    
    public function add_edit($id = '') {
        $data = array();
        if($id != ''){
            $modelData['tableName'] = 'store_master';
            $modelData['condtion'] = "id=".$id;
            $data['storeDetail'] = $this->SystemModel->getOne($modelData);
        }
        $this->load->admin('store_master/add_edit', $data);
    }
 
    public function view($id) {
        $data = array();
        $modelData['tableName'] = 'store_master';
        $modelData['condtion'] = "id=" . $id;
        $data['ClientDetail'] = $this->SystemModel->getOne($modelData);
       
        $this->load->admin('store_master/view', $data);
    }
    
    
    public function action() {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "store_master";
            
        if (isset($id) && $id != '') {                
            $modelData['data'] = array(                  
                        'qty' => $qty,
                        'material_description' => $material_description,
                        'unit' => $unit,
                        'rate' => $rate,
                        'amount' => $amount,
                        'remark' => $remark,
                        'updated' => date('Y-m-d H:i:s')                
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
            
        }else{
            
            $modelData['data'] = array(                  
                        'qty' => $qty,
                        'material_description' => $material_description,
                        'unit' => $unit,
                        'rate' => $rate,
                        'amount' => $amount,
                        'remark' => $remark,
                        'created' => date('Y-m-d H:i:s')
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
        redirect('admin/Store_master');        
    }
    
   
    public function delete($id) {

        /************** Delete Client Detail *************/

        $modelData['tableName'] = "store_master";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Store_master');

    }   
    
}


