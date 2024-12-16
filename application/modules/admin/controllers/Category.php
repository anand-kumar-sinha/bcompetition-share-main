<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
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
        
        $modelData['tableName'] = 'category';
        $modelData['condtion'] = "is_deleted=0";
        $data['AllCategory'] = $this->SystemModel->getAll($modelData);
        
        if(isset($_GET['c_id'])){
            $id = $_GET['c_id'];
            $categoryEditData['tableName'] = 'category';
            $categoryEditData['condtion'] = "id=" . $id;
            $data['CategoryDetail'] = $this->SystemModel->getOne($categoryEditData);
        }
        
        
        $this->load->admin('category/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'category';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->admin('category/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "category";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'category_name' => $category_name,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'category_name' => $category_name,
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
        redirect('admin/Category');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "category";
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
        redirect('admin/Category');
    }

     
}
