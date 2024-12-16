<?php

defined('BASEPATH') or exit('No direct script access allowed');

class State extends MY_Controller
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
        
        if(isset($_GET['st_id'])){
            $id = $_GET['st_id'];
            $stateEditData['tableName'] = 'state';
            $stateEditData['condtion'] = "id=" . $id;
            $data['StateDetail'] = $this->SystemModel->getOne($stateEditData);
        }
        
        $modelData['select'] = 'st.*, ct.country_name';
        $modelData['tableName'] = 'state st';
        $modelData['join'][] = array('tableName' => 'country ct', 'condtion' => 'ct.id=st.country_id', 'type'=>'left');
        $modelData['condtion'] = "st.is_deleted=0";
        $data['AllState'] = $this->SystemModel->getAll($modelData);
        
        
        
        $CountryData['tableName'] = 'country';
        $CountryData['condtion'] = "is_deleted=0 AND status='Active'";
        $data['AllCountry'] = $this->SystemModel->getAll($CountryData);
        
        $this->load->admin('state/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'state';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->admin('state/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "state";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'state_name' => $state_name,
                'country_id' => $country_id,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'state_name' => $state_name,
                'country_id' => $country_id,
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
        redirect('admin/State');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "state";
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
        redirect('admin/State');
    }

     
}
