<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Quality extends MY_Controller
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
        
        $modelData['select'] = 'q.*, b.bom_number, pm.part_name,pm.part_code, bpd.rm_form, bpd.rm_size,bpd.id as bom_detail_id ';
        $modelData['tableName'] = 'quality q';
        $modelData['join'][] = array('tableName' => 'bom_part_detail bpd', 'condtion' => 'q.bom_detail_id=bpd.id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'bom b', 'condtion' => 'b.id= bpd.bom_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
        $data['AllQualityList'] = $this->SystemModel->getAll($modelData);
        // echo '<pre>AllQualityList--';
        // print_r($data); die;
        $this->load->department_user('quality/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'quality';
            $modelData['condtion'] = "id=" . $id;
            $data['QualityDetail'] = $this->SystemModel->getOne($modelData);
        }

        $BomOperationData['select'] = 'b.*, pm.part_name,pm.part_code, bpd.rm_form, bpd.rm_size,bpd.id as bom_detail_id ';
        $BomOperationData['tableName'] = 'bom b';
        $BomOperationData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
        $BomOperationData['join'][] = array('tableName' => 'bom_part_detail bpd', 'condtion' => 'b.id=bpd.bom_id', "type" => "left");
        $data['AllBom'] = $this->SystemModel->getAll($BomOperationData);
        
        $this->load->department_user('quality/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "quality";

        $quality_date = date("Y-m-d", strtotime($quality_date));

        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'quality_date' => date("Y-m-d",strtotime($quality_date)),
                'qc_inspector' => $qc_inspector,
                'bom_detail_id' => $bom_detail_id,
                'total_inspected_qty' => $total_inspected_qty,
                'rejected_qty' => $rejected_qty,
                'rework_qty' => $rework_qty,
                'problem_statement' => $problem_statement,
                'remark' => $remark,
                'final_ok_qty' => $final_ok_qty,
                'job_card_number' => $job_card_number,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'quality_date' => date("Y-m-d",strtotime($quality_date)),
                'qc_inspector' => $qc_inspector,
                'bom_detail_id' => $bom_detail_id,
                'total_inspected_qty' => $total_inspected_qty,
                'rejected_qty' => $rejected_qty,
                'rework_qty' => $rework_qty,
                'problem_statement' => $problem_statement,
                'remark' => $remark,
                'final_ok_qty' => $final_ok_qty,
                'job_card_number' => $job_card_number,
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
        redirect('department_user/quality');
    }

    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "quality";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/quality');
    }

    public function getJobCardNo()
    {
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = 'job_card';
        $modelData['condtion'] = "bom_detail_id=" . $bom_detail_id;
        $JobCardNoData = $this->SystemModel->getAll($modelData);

        $html = '';
        $html .= '<option value="">--select--</option>';
        foreach ($JobCardNoData as $_JobCardNoData) {
            if ($job_card_number != '0' && $job_card_number != 0 && $job_card_number == $_JobCardNoData->id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $html .= '<option value="' . $_JobCardNoData->id . '" ' . $selected . '>' . $_JobCardNoData->job_card_number . '</option>';
        }
        echo $html;
    }
}
