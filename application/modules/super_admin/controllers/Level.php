<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Level extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');


        $superAdminData = $this->session->userdata('superAdminData');
        if (!isset($superAdminData)) {
            redirect('super_admin/Login');
        }
    }

    public function index()
    {
        
        $modelData['tableName'] = 'level';
        $modelData['condtion'] = "is_deleted=0";
        $data['AllLevel'] = $this->SystemModel->getAll($modelData);
        
        if(isset($_GET['l_id'])){
            $id = $_GET['l_id'];
            $levelEditData['tableName'] = 'level';
            $levelEditData['condtion'] = "id=" . $id;
            $data['LevelDetail'] = $this->SystemModel->getOne($levelEditData);
        }
        
        
        $this->load->super_admin('level/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'level';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->super_admin('level/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "level";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'level_name' => $level_name,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'level_name' => $level_name,
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
        redirect('super_admin/Level');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "level";
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
        redirect('super_admin/Level');
    }

     
}
