<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Branch extends MY_Controller
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
        
        $modelData['tableName'] = 'branch';
        $modelData['condtion'] = "is_deleted=0";
        $data['AllBranch'] = $this->SystemModel->getAll($modelData);
        
        if(isset($_GET['br_id'])){
            $id = $_GET['br_id'];
            $branchEditData['tableName'] = 'branch';
            $branchEditData['condtion'] = "id=" . $id;
            $data['BranchDetail'] = $this->SystemModel->getOne($branchEditData);
        }
        
        
        $this->load->super_admin('branch/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'branch';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->super_admin('branch/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
         
        $modelData['tableName'] = "branch";
        if (isset($id) && $id != '') {
            if(isset($password) && $password !=''){
                $password = md5($password);
            } else {
                $password = $old_password;
            }
            $modelData['data'] = array(
                'branch_name' => $branch_name,
                'head_admin_name' => $head_admin_name,
                'email' => $email,
                'contact_number' => $contact_number,
                'password' => $password,
                'start_date' => date("Y-m-d", strtotime($start_date)),
                'branch_code' => $branch_code,
                'address' => $address,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'branch_name' => $branch_name,
                'head_admin_name' => $head_admin_name,
                'email' => $email,
                'contact_number' => $contact_number,
                'password' => md5($password),
                'start_date' => date("Y-m-d", strtotime($start_date)),
                'branch_code' => $branch_code,
                'address' => $address,
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
        redirect('super_admin/Branch');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "branch";
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
        redirect('super_admin/Branch');
    }

     
}
