<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Job_card extends MY_Controller
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

        $modelData['select'] = 'jc.*, cm.customer_name,cm.contact,b.bom_number, pm.part_name,pm.part_code, bpd.rm_form, bpd.rm_size, ind.batch_no';
        $modelData['tableName'] = 'job_card jc';
        $modelData['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=jc.customer_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'bom_part_detail bpd', 'condtion' => 'jc.bom_detail_id=bpd.id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'bom b', 'condtion' => 'b.id = bpd.bom_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'inward_details ind', 'condtion' => 'ind.id=jc.inward_batch_no_id', "type" => "left");

        $data['AllJobCardList'] = $this->SystemModel->getAll($modelData);

        $this->load->department_user('job_card/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'job_card';
            $modelData['condtion'] = "id=" . $id;
            $data['JobCardDetail'] = $this->SystemModel->getOne($modelData);
        }

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $BomOperationData['select'] = 'b.*, pm.part_name,pm.part_code, bpd.rm_form, bpd.rm_size,bpd.id as bom_detail_id ';
        $BomOperationData['tableName'] = 'bom b';
        $BomOperationData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
        $BomOperationData['join'][] = array('tableName' => 'bom_part_detail bpd', 'condtion' => 'b.id=bpd.bom_id', "type" => "left");
        $data['AllBom'] = $this->SystemModel->getAll($BomOperationData);

        // echo '<pre>data';
        // print_r($data); die;

        $this->load->department_user('job_card/add_edit', $data);
    }

    public function getBomPartOperation()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        $data['jobcardoperationData'] = array();
        if ($job_card_id != '') {
            $jobcardoperationData['tableName'] = 'job_card_operation_detail';
            $jobcardoperationData['condtion'] = "job_card_id=" . $job_card_id;
            $data['jobcardoperationData'] = $this->SystemModel->getAll($jobcardoperationData);
        }
        // echo '<pre>'.$bom_detail_id;
        $data['BOMOperationDetail'] = array();
        if ($bom_detail_id) {
            $modelData['tableName'] = 'bom_part_detail';
            $modelData['condtion'] = "id=" . $bom_detail_id;
            $JobCardDetail = $this->SystemModel->getOne($modelData);
            // echo '<pre>'.$bom_detail_id;
            // print_r($JobCardDetail); die;

            if ($JobCardDetail) {
                $BomOperationData['select'] = 'bod.*, om.operation_name,om.operation_code,mm.machine_name, mm.machine_code ';
                $BomOperationData['tableName'] = 'bom_operation_detail bod';
                $BomOperationData['join'][] = array('tableName' => 'operation_master om', 'condtion' => 'om.id=bod.operation_id', "type" => "left");
                $BomOperationData['join'][] = array('tableName' => 'machine_master mm', 'condtion' => 'mm.id=bod.machine_id', "type" => "left");
                $BomOperationData['condtion'] = "bod.bom_id=" . $JobCardDetail->bom_id;
                $data['BOMOperationDetail'] = $this->SystemModel->getAll($BomOperationData);
            }
        }

        $employeeData['select'] = 'dm.*, du.user_name, du.id as department_user_id';
        $employeeData['tableName'] = 'department_master dm';
        $employeeData['join'][] = array('tableName' => 'department_user du', 'condtion' => 'dm.id=du.department_id', "type" => "left");
        $employeeData['condtion'] = "dm.department_name= 'Job Card'";
        $data['AllEmployee'] = $this->SystemModel->getAll($employeeData);

        $this->load->view('job_card/bom_operation_detail', $data);
    }

    public function getInwardBatchNo()
    {
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = 'inward_details';
        $modelData['condtion'] = "bom_part_detail_id=" . $bom_detail_id;
        $ImwardDetail = $this->SystemModel->getAll($modelData);

        $html = '';
        $html .= '<option value="">--select--</option>';
        foreach ($ImwardDetail as $_ImwardDetail) {
            if ($_ImwardDetail->batch_no != '') {
                if ($inward_batch_no_id != '0' && $inward_batch_no_id != 0 && $inward_batch_no_id == $_ImwardDetail->id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $_ImwardDetail->id . '" ' . $selected . '>' . $_ImwardDetail->batch_no . '</option>';
            }
        }
        echo $html;
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        $modelData['tableName'] = "job_card";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'job_card_date' => date("Y-m-d", strtotime($job_card_date)),
                'customer_id' => $customer_id,
                'bom_detail_id' => $bom_detail_id,
                'inward_batch_no_id' => $inward_batch_no_id,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);

            $modelOperationData['tableName'] = "job_card_operation_detail";
            $modelOperationData['condtion'] = "job_card_id=" . $id;
            $deletePartDetailResult = $this->SystemModel->deleteData($modelOperationData);

            $inserted_client_id = $id;

            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'job_card_date' => date("Y-m-d", strtotime($job_card_date)),
                'customer_id' => $customer_id,
                'bom_detail_id' => $bom_detail_id,
                'inward_batch_no_id' => $inward_batch_no_id,
                'status' => $status,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

            $job_card_number = sprintf("JOBCARD#%04d", $inserted_client_id);

            $modelData['data'] = array(
                'job_card_number'    => $job_card_number,
            );
            $modelData['condtion'] = "id=" . $inserted_client_id;
            $result = $this->SystemModel->updateData($modelData);

            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

        if ($operation_id) {
            $jobcardoperationData['tableName'] = "job_card_operation_detail";
            for ($i = 0; $i < count($operation_id); $i++) {
                $jobcardoperationData['data'] = array(
                    'job_card_id' => $inserted_client_id,
                    'operation_id' => $operation_id[$i],
                    'employee_id' => $employee_id[$i],
                    'shift' => $shift[$i],
                    'tool_change_time' => $tool_change_time[$i],
                    'planned_qty' => $planned_qty[$i],
                    'start_time' => $start_time[$i],
                    'stop_time' => $stop_time[$i],
                    'qty_produced' => $qty_produced[$i],
                    'remark' => $remark[$i],
                    'lost_hrs' => $lost_hrs[$i],
                    'created' => date('Y-m-d H:i:s')
                );
                $jobcardoperationDataResult = $this->SystemModel->insertData($jobcardoperationData);
            }
        }
        // die;

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/job_card');
    }

    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "job_card";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $jobcardoperationData['tableName'] = "job_card_operation_detail";
        $jobcardoperationData['condtion'] = "job_card_id=" . $id;
        $operationResult = $this->SystemModel->deleteData($jobcardoperationData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/job_card');
    }
}
