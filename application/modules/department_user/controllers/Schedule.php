<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends MY_Controller
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
        $modelData['tableName'] = 'schedule';
        $AllScheduleList = $this->SystemModel->getAll($modelData);
        
         
        $arr = new stdClass;
        $i=0;
       
        foreach ($AllScheduleList as $_AllScheduleList) {
            $arr->$i = $_AllScheduleList;           
            $ScheduleDetailData['join'] = array();
            $ScheduleDetailData['select'] = 'dd.*, cm.customer_name,cm.contact, pm.part_name, pm1.part_code';
            $ScheduleDetailData['tableName'] = 'schedule_detail dd';
            $ScheduleDetailData['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=dd.customer_id', "type" => "left");
            $ScheduleDetailData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=dd.part_name_id', "type" => "left");
            $ScheduleDetailData['join'][] = array('tableName' => 'part_master pm1', 'condtion' => 'pm1.id=dd.part_code_id', "type" => "left");
            $ScheduleDetailData['condtion'] = "dd.schedule_id=".$_AllScheduleList->id;   
            $arr->$i->schedule_detail = $this->SystemModel->getAll($ScheduleDetailData);
            
            $i++;
        } 
          $data['AllScheduleList'] = $arr;  
        
        $this->load->department_user('schedule/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelscheduleData['tableName'] = 'schedule';
            $modelscheduleData['condtion'] = "id=" . $id;
            $data['scheduleData'] = $this->SystemModel->getOne($modelscheduleData);

            $modelscheduleDetail['select'] = 'dd.*, pm.part_name,pm.part_code,cm.customer_name';
            $modelscheduleDetail['tableName'] = 'schedule_detail dd';
            $modelscheduleDetail['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=dd.part_name_id', "type" => "left");
            $modelscheduleDetail['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=dd.customer_id', "type" => "left");
            $modelscheduleDetail['condtion'] = "schedule_id=" . $id;
            $scheduleDetail = $this->SystemModel->getAll($modelscheduleDetail);
            $data['scheduleData']->scheduleDetail = $scheduleDetail;
        }

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $partData['tableName'] = 'part_master';
        $partData['condtion'] = "status='Active'";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        $this->load->department_user('schedule/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "schedule";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'schedule_date' => date("Y-m-d", strtotime($schedule_date)),
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);

            $inserted_client_id = $id;

            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'schedule_date' => date("Y-m-d", strtotime($schedule_date)),
                'status' => $status,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

            $schedule_number = sprintf("Schedule#%04d", $inserted_client_id);

            $modelData['data'] = array(
                'schedule_number'    => $schedule_number,
            );
            $modelData['condtion'] = "id=" . $inserted_client_id;
            $result = $this->SystemModel->updateData($modelData);

            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

        if ($customer_id && $schedule && $schedule[0] != '') {
            $partDetail['tableName'] = "schedule_detail";
            for ($i = 0; $i < count($customer_id); $i++) {
                $partDetail['data'] = array(
                    'schedule_id' => $inserted_client_id,
                    'customer_id' => $customer_id[$i],
                    'part_name_id' => $part_name_id[$i],
                    'part_code_id' => $part_code_id[$i],
                    'schedule' => $schedule[$i],
                    'month' => $month[$i],
                    'schedule_no' => $schedule_no[$i],
                    'created' => date('Y-m-d H:i:s')
                );
                $partDetailResult = $this->SystemModel->insertData($partDetail);
            }
        }

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/schedule');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete schedule Detail *************/

        $modelData['tableName'] = "schedule";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/schedule');
    }


    /*Start : schedule Detail Data popup*/

    public function edit_sub_schedule_detail()
    {
        extract($this->input->post()); // convert array to variable -- php function //

        $modelscheduleData['tableName'] = 'schedule_detail';
        $modelscheduleData['condtion'] = "id=" . $schedule_detail_id;
        $data['scheduleDetailData'] = $this->SystemModel->getOne($modelscheduleData);

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $partData['tableName'] = 'part_master';
        $partData['condtion'] = "status='Active'";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        $this->load->view('schedule/edit_sub_schedule_detail', $data);
    }

    public function schedule_sub_detail_action()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        $scheduleDetailData['tableName'] = 'schedule_detail';
        for ($i = 0; $i < count($customer_id); $i++) {
            $scheduleDetailData['data'] = array(
                'schedule_id' => $schedule_id,
                'customer_id' => $customer_id[$i],
                'part_name_id' => $part_name_id[$i],
                'part_code_id' => $part_code_id[$i],
                'schedule' => $schedule[$i],
                'month' => $month[$i],
                'schedule_no' => $schedule_no[$i],
                'updated' => date('Y-m-d H:i:s')
            );
            $scheduleDetailData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($scheduleDetailData);
        }
        redirect('department_user/schedule/add_edit/' . $schedule_id);
    }

    public function scheduleSubdelete($id, $schedule_id)
    {
        $modelData['tableName'] = "schedule_detail";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/schedule/add_edit/' . $schedule_id);
    }

    /*End : schedule Detail Data popup*/
}
