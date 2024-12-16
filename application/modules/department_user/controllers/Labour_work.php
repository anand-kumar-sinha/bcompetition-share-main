<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Labour_work extends MY_Controller
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
        $modelData['select'] = 'lw.*, cm.customer_name,cm.contact, pm.part_name, pm1.part_code';
        $modelData['tableName'] = 'labour_work lw';
        $modelData['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=lw.customer_id', 'type' => 'left');
        $modelData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=lw.part_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'part_master pm1', 'condtion' => 'pm1.id=lw.part_code_id', "type" => "left");
        $data['AllLabourWorkList'] = $this->SystemModel->getAll($modelData);
        $this->load->department_user('labour_work/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'labour_work';
            $modelData['condtion'] = "id=" . $id;
            $data['LabourWorkDetail'] = $this->SystemModel->getOne($modelData);
        }

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $partData['tableName'] = 'part_master';
        $partData['condtion'] = "status='Active'";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        $machineData['tableName'] = 'machine_master';
        $machineData['condtion'] = "status='Active'";
        $data['AllMachine'] = $this->SystemModel->getAll($machineData);

        $this->load->department_user('labour_work/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "labour_work";

        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'customer_id' => $customer_id,
                'sheet_size' => $sheet_size,
                'part_id' => $part_id,
                'part_code_id' => $part_code_id,
                'strip_size' => $strip_size,
                'material_grade' => $material_grade,
                'gross_weight' => $gross_weight,
                'net_weight' => $net_weight,
                'quantity' => $quantity,
                'operator' => $operator,
                'machine_id' => $machine_id,
                'scrap_size' => $scrap_size,
                'batch_no' => $batch_no,
                'job_card_type' => $job_card_type,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'customer_id' => $customer_id,
                'sheet_size' => $sheet_size,
                'part_id' => $part_id,
                'part_code_id' => $part_code_id,
                'strip_size' => $strip_size,
                'material_grade' => $material_grade,
                'gross_weight' => $gross_weight,
                'net_weight' => $net_weight,
                'quantity' => $quantity,
                'operator' => $operator,
                'machine_id' => $machine_id,
                'scrap_size' => $scrap_size,
                'batch_no' => $batch_no,
                'job_card_type' => $job_card_type,
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
        redirect('department_user/labour_work');
    }


    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "labour_work";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/labour_work');
    }
}
