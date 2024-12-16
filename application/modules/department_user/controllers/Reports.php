<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
       
                
        $adminData = $this->session->userdata('adminData');
        if(!isset($adminData)){
             redirect('admin/Login');
        } 
       
    }
    
    public function index() {        
         
        $categoryData['tableName'] = 'category_master';        
        $data['AllCategory'] = $this->SystemModel->getAll($categoryData);
        
        $modelData['tableName'] = 'client_master';
        $data['AllClients'] = $this->SystemModel->getAll($modelData);         
        
        $modelData['tableName'] = 'vendor_master';        
        $AllVendors = $this->SystemModel->getAll($modelData);
        
        $i = 0;
        foreach ($AllVendors as $_AllVendors){
            $data['AllVendors'][$i]=$_AllVendors;
            $data['AllVendors'][$i]->category_name = '';
            
            if(!empty($_AllVendors->category_id)){
                $CategoryData['select'] = 'category_name';
                $CategoryData['tableName'] = 'category_master';
                $CategoryData['condtion'] = "id IN(".$_AllVendors->category_id.")";
                $AllCategoryData = $this->SystemModel->getAll($CategoryData);
                $CategoryArray = '';
                $comma = '';
                foreach ($AllCategoryData as $_AllCategoryData){
                    $CategoryArray .= $comma.$_AllCategoryData->category_name;
                    $comma = ', ';
                }
                $data['AllVendors'][$i]=$_AllVendors;
                $data['AllVendors'][$i]->category_name=$CategoryArray;
            }
         $i++;   
        }
       
        $this->load->admin('reports/index',$data);
    }
    
    public function get_vendor_list()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = 'vendor_master';
        if($category_id[0] == 'all'){
            $AllVendors = $this->SystemModel->getAll($modelData);
            $i = 0;
            foreach ($AllVendors as $_AllVendors){
                $data['AllVendors'][$i]=$_AllVendors;
                $data['AllVendors'][$i]->category_name = '';

                if(!empty($_AllVendors->category_id)){
                    $CategoryData['select'] = 'category_name';
                    $CategoryData['tableName'] = 'category_master';
                    $CategoryData['condtion'] = "id IN(".$_AllVendors->category_id.")";
                    $AllCategoryData = $this->SystemModel->getAll($CategoryData);
                    $CategoryArray = '';
                    $comma = '';
                    foreach ($AllCategoryData as $_AllCategoryData){
                        $CategoryArray .= $comma.$_AllCategoryData->category_name;
                        $comma = ', ';
                    }
                    $data['AllVendors'][$i]=$_AllVendors;
                    $data['AllVendors'][$i]->category_name=$CategoryArray;
                }
             $i++;   
            }
        } else {
            $category_id = implode(',',$category_id);
            $modelData['condtion'] = 'category_id="'.$category_id.'"';
            $AllVendors = $this->SystemModel->getAll($modelData);
            if(!empty($AllVendors)){
                
                $i = 0;
                foreach ($AllVendors as $_AllVendors){
                    $data['AllVendors'][$i]=$_AllVendors;
                    $data['AllVendors'][$i]->category_name = '';

                    if(!empty($_AllVendors->category_id)){
                        $CategoryData['select'] = 'category_name';
                        $CategoryData['tableName'] = 'category_master';
                        $CategoryData['condtion'] = "id IN(".$_AllVendors->category_id.")";
                        $AllCategoryData = $this->SystemModel->getAll($CategoryData);
                        $CategoryArray = '';
                        $comma = '';
                        foreach ($AllCategoryData as $_AllCategoryData){
                            $CategoryArray .= $comma.$_AllCategoryData->category_name;
                            $comma = ', ';
                        }
                        $data['AllVendors'][$i]=$_AllVendors;
                        $data['AllVendors'][$i]->category_name=$CategoryArray;
                    }
                 $i++;   
                }
            } else {
                $data['AllVendors']= array();
            }
        }
       
       
       
        $this->load->view('reports/get_vendor_list',$data);
    }

    public function view($id) {
//        $this->SystemModel->checkAccess('car_brand_view');// role access management
        $data = array();
        $modelData['tableName'] = 'client_master';
        $modelData['condtion'] = "id=" . $id;
        $data['ClientDetail'] = $this->SystemModel->getOne($modelData);
        
        /// Client Contact Number ///
            
        $ClientContactData['tableName'] = 'client_contact_number';
        $ClientContactData['condtion'] = "client_id=" . $id;
        $data['AllClientContact'] = $this->SystemModel->getAll($ClientContactData);

         /// Client Address ///
        $ClientAddressData['tableName'] = 'client_address';
        $ClientAddressData['condtion'] = "client_id=" . $id;
        $data['AllClientAddress'] = $this->SystemModel->getAll($ClientAddressData);


        /// Client E-mail ///
        $ClientEmailData['tableName'] = 'client_email';
        $ClientEmailData['condtion'] = "client_id=" . $id;
        $data['AllClientEmail'] = $this->SystemModel->getAll($ClientEmailData);
            
        $this->load->admin('reports/view', $data);
    }
    
}


