<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Department_user extends MY_Controller
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
        $modelData['select'] = 'du.*, dm.department_name, comp.person_name,';
        $modelData['tableName'] = 'department_user du';
        $modelData['join'][] = array('tableName' => 'department_master dm', 'condtion' => 'dm.id=du.department_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'company_admin comp', 'condtion' => 'comp.id=du.deleted_by', 'type'=>'left');
        $modelData['condtion'] = "du.is_deleted=0";
        $data['AllDepartmentUser'] = $this->SystemModel->getAll($modelData);
        $this->load->admin('department_user/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'department_user';
            $modelData['condtion'] = "id=" . $id;
            $data['DepartmentUserDetail'] = $this->SystemModel->getOne($modelData);
        }

        $departmentData['tableName'] = 'department_master';
        $departmentData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllDepartment'] = $this->SystemModel->getAll($departmentData);
        $this->load->admin('department_user/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "department_user";

        if (isset($id) && $id != '') {
            if(isset($password) && !empty($password)){
                    $password = md5($password);
            } else {
                $password = $old_password;
            }
                            $modelData['data'] = array(
                                'department_id' => $department_id,
                                'user_name' => $user_name,
                                'contact_number' => $contact_number,
                                'role' => $role,
                                'password' => $password,
                                'status' => $status,
                                'updated' => date('Y-m-d H:i:s')
                            );
                            $modelData['condtion'] = "id=" . $id;
                            $result = $this->SystemModel->updateData($modelData);
                            $successMessage = "Record updated successfully";
                            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'department_id' => $department_id,
                'user_name' => $user_name,
                'contact_number' => $contact_number,
                'role' => $role,
                'password' => md5($password),
                'status' => $status,
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
        redirect('admin/department_user');
    }


    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Department user Detail *************/
        $adminData = $this->session->userdata('adminData');
        $modelData['tableName'] = "department_user";
        $modelData['data'] = array(                  
                        'is_deleted' => '1',
                        'deleted_by' => $adminData->id,
                        'user_type' => 'company_admin',
                        'updated' => date('Y-m-d H:i:s')
                );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            
            
            $modelData1['tableName'] = "super_admin_notification";
            $modelData1['data'] = array(                  
                        'admin_id' => $adminData->id,
                        'module_name' => 'department user delete record',
                        'user_type' => 'company_admin',
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
        redirect('admin/department_user');
    }
    
      public function restore($id) {

        /************** Delete Client Detail *************/
        $adminData = $this->session->userdata('adminData');
        $modelData['tableName'] = "department_user";
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
                        'admin_id' => $adminData->id,
                        'module_name' => 'department user restore record',
                        'user_type' => 'company_admin',
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
        redirect('admin/department_user');

    } 
    
}
