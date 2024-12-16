<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Machine_master extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');

        $departmentUserData = $this->session->userdata('departmentUserData');
        if (!isset($departmentUserData)) {
            redirect('department_user/Login');
        }
    }

    public function index()
    {
//        $modelData['select'] = 'mm.*, comp.person_name, du.user_name';
        $modelData['tableName'] = 'machine_master mm';
//        $modelData['join'][] = array('tableName' => 'company_admin comp', 'condtion' => 'comp.id=mm.deleted_by', 'type'=>'left');
//        $modelData['join'][] = array('tableName' => 'department_user du', 'condtion' => 'du.id=mm.deleted_by', 'type'=>'left');
        $modelData['condtion'] = "mm.is_deleted=0";
        $data['AllMachine'] = $this->SystemModel->getAll($modelData);
        $this->load->department_user('machine_master/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'machine_master';
            $modelData['condtion'] = "id=" . $id;
            $data['MachineDetail'] = $this->SystemModel->getOne($modelData);
        }
        $this->load->department_user('machine_master/add_edit', $data);
    }


    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "machine_master";

        $uploadPath = FCPATH . 'uploads/machine_image/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
 
        if (isset($id) && $id != '') {

            if ($_FILES['check_sheet']['name'] != '') {
                $check_sheet = $this->SystemModel->imageUpload('check_sheet', $uploadPath);
                $path = FCPATH . 'uploads/machine_image/';
                unlink($path);
            } else {
                $check_sheet = $old_check_sheet;
            }
            $modelData['data'] = array(
                'machine_name' => $machine_name,
//                'machine_code' => $machine_code,
                'company_name'  => $company_name,
                'capacity'       => $capacity,
                'check_sheet'     => $check_sheet,
                'year'     => $year,
                'status'      => $status,
                'updated'      => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else { 
            $check_sheet = '';
            if (isset($_FILES['check_sheet']['name']) && $_FILES['check_sheet']['name'] != '') {
                $check_sheet = $this->SystemModel->imageUpload('check_sheet', $uploadPath);
            }
            $modelData['data'] = array(
                'machine_name' => $machine_name,
//                'machine_code' => $machine_code,
                'company_name'  => $company_name,
                'capacity'       => $capacity,
                'year'     => $year,
                'check_sheet'     => $check_sheet,
                'status'      => $status,
                'created'      => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();
            
            $machine_code = sprintf("MAC#%04d", $inserted_client_id);
            
            $modelData['data'] = array(     
                                        'machine_code'    => $machine_code,
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
        redirect('department_user/machine_master/');
    }

    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Client Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "machine_master";
        $modelData['data'] = array(                  
                        'is_deleted' => '1',
                        'deleted_by' => $departmentUserData->id,
                        'user_type' => 'department_user',
                        'updated' => date('Y-m-d H:i:s')
                );
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($modelData);
        
        
        $modelData1['tableName'] = "super_admin_notification";
        $modelData1['data'] = array(                  
                    'admin_id' => $departmentUserData->id,
                    'module_name' => 'machine master delete record',
                    'module_id' => $id,
                    'user_type' => 'department_user',
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
        redirect('department_user/machine_master');
    }
    
    public function restore($id) {

        /************** Delete Client Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "machine_master";
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
                        'module_name' => 'machine master restore record',
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
        redirect('department_user/machine_master');

    } 
}
