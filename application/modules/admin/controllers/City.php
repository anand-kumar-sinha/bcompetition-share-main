<?php

defined('BASEPATH') or exit('No direct script access allowed');

class City extends MY_Controller
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
        
        if(isset($_GET['ct_id'])){
            $id = $_GET['ct_id'];
            $cityEditData['tableName'] = 'city';
            $cityEditData['condtion'] = "id=" . $id;
            $data['CityDetail'] = $this->SystemModel->getOne($cityEditData);
        }
        
        $modelData['select'] = 'ct.*, cnt.country_name, st.state_name';
        $modelData['tableName'] = 'city ct';
        $modelData['join'][] = array('tableName' => 'state st', 'condtion' => 'st.id=ct.state_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'country cnt', 'condtion' => 'cnt.id=ct.country_id', 'type'=>'left');
        $modelData['condtion'] = "st.is_deleted=0";
        $data['AllCity'] = $this->SystemModel->getAll($modelData);
         
//        $modelData['tableName'] = 'state st';
//        $modelData['condtion'] = "is_deleted=0 AND status='Active'";
//        $data['AllState'] = $this->SystemModel->getAll($modelData);
//        
        $CountryData['tableName'] = 'country';
        $CountryData['condtion'] = "is_deleted=0 AND status='Active'";
        $data['AllCountry'] = $this->SystemModel->getAll($CountryData);
        
        $this->load->admin('city/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'city';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->admin('city/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "city";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'city_name' => $city_name,
                'country_id' => $country_id,
                'state_id' => $state_id,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'city_name' => $city_name,
                'country_id' => $country_id,
                'state_id' => $state_id,
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
        redirect('admin/City');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "city";
        $modelData['data'] = array(                  
                        'is_deleted' => '1',
                );
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($modelData);

//        $modelData['condtion'] = "id=" . $id;
//        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/City');
    }
    
     public function get_state_list()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        
        
        $modelData['tableName'] = 'state st';
        $modelData['condtion'] = "is_deleted=0 AND status='Active' AND country_id=".$country_id;
        $AllState = $this->SystemModel->getAll($modelData);
        
        $html = '';
        $html .='<option value="">-- select--</option>';
        foreach ($AllState as $_AllState){
            $selected = '';
            if($_AllState->id == $state_id) {
                $selected = "selected";
            }
            $html .='<option value="'.$_AllState->id.'" '.$selected.'>'.$_AllState->state_name.'</option>';
        }
        echo $html;
        die();
    }
    

     
}
