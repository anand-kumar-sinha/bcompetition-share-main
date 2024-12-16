<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dispatch extends MY_Controller
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
//        $modelData['select'] = 'dis.*, cm.customer_name, cm.';
        $modelData['tableName'] = 'dispatch dis';
//        $modelData['join'][] = array('tableName' => 'dispatch_detail dd', 'condtion' => 'dis.id=dd.dispatch_id', "type" => "left");
//        $modelData['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=dd.customer_id', "type" => "left");
        $AlldispatchList = $this->SystemModel->getAll($modelData);
        
         $arr = new stdClass;
        $i=0;
       
        foreach ($AlldispatchList as $_AlldispatchList) {
            $arr->$i = $_AlldispatchList;           
            $DispatchDetailData['join'] = array();
            $DispatchDetailData['select'] = 'dd.*, cm.customer_name,cm.contact, pm.part_name, pm1.part_code';
            $DispatchDetailData['tableName'] = 'dispatch_detail dd';
            $DispatchDetailData['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=dd.customer_id', "type" => "left");
            $DispatchDetailData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=dd.po_part_id', "type" => "left");
            $DispatchDetailData['join'][] = array('tableName' => 'part_master pm1', 'condtion' => 'pm1.id=dd.part_id', "type" => "left");
            $DispatchDetailData['condtion'] = "dd.dispatch_id=".$_AlldispatchList->id;   
            $arr->$i->dispatch_detail = $this->SystemModel->getAll($DispatchDetailData);
            
            $i++;
        } 
        
        $data['AlldispatchList'] = $arr;  
        
        $this->load->department_user('dispatch/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelDispatchData['tableName'] = 'dispatch';
            $modelDispatchData['condtion'] = "id=" . $id;
            $data['DispatchData'] = $this->SystemModel->getOne($modelDispatchData);

            $modelDispatchDetail['select'] = 'dd.*, pm.part_name,pm.part_code,cm.customer_name';
            $modelDispatchDetail['tableName'] = 'dispatch_detail dd';
            $modelDispatchDetail['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=dd.part_id', "type" => "left");
            $modelDispatchDetail['join'][] = array('tableName' => 'customer_master cm', 'condtion' => 'cm.id=dd.customer_id', "type" => "left");
            $modelDispatchDetail['condtion'] = "dispatch_id=" . $id;
            $DispatchDetail = $this->SystemModel->getAll($modelDispatchDetail);
            $data['DispatchData']->DispatchDetail = $DispatchDetail;
        }

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $partData['tableName'] = 'part_master';
        $partData['condtion'] = "status='Active'";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        $modelData['tableName'] = 'job_card';
        $data['AllJobCardList'] = $this->SystemModel->getAll($modelData);

        $this->load->department_user('dispatch/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        
        $modelData['tableName'] = "dispatch";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'dispatch_date' => date("Y-m-d", strtotime($dispatch_date)),
                'ship_to' => $ship_to,
                'vehicle_number' => $vehicle_number,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);

            $inserted_client_id = $id;

            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'dispatch_date' => date("Y-m-d", strtotime($dispatch_date)),
                'ship_to' => $ship_to,
                'vehicle_number' => $vehicle_number,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

            $challan_number = sprintf("Dispatch#%04d", $inserted_client_id);

            $modelData['data'] = array(
                'challan_number'    => $challan_number,
            );
            $modelData['condtion'] = "id=" . $inserted_client_id;
            $result = $this->SystemModel->updateData($modelData);

            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

        if ($customer_id) {
            $partDetail['tableName'] = "dispatch_detail";
            for ($i = 0; $i < count($customer_id); $i++) {
                $partDetail['data'] = array(
                    'dispatch_id' => $inserted_client_id,
                    'customer_id' => $customer_id[$i],
                    'po_part_id' => $po_part_id[$i],
                    'part_id' => $part_id[$i],
                    'qty' => $qty[$i],
                    'unit' => $unit[$i],
                    'authorizes_person' => $authorizes_person[$i],
                    'job_card_id' => $job_card_id[$i],
                    'batch_no' => $batch_no[$i],
                    'status' => $status[$i],
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
        redirect('department_user/dispatch');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Dispatch Detail *************/

        $modelData['tableName'] = "dispatch";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/dispatch');
    }


    /*Start : Dispatch Detail Data popup*/

    public function edit_sub_dispatch_detail()
    {
        extract($this->input->post()); // convert array to variable -- php function //

        $modelDispatchData['tableName'] = 'dispatch_detail';
        $modelDispatchData['condtion'] = "id=" . $dispatch_detail_id;
        $data['DispatchDetailData'] = $this->SystemModel->getOne($modelDispatchData);

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active'";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $partData['tableName'] = 'part_master';
        $partData['condtion'] = "status='Active'";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        $modelData['tableName'] = 'job_card';
        $data['AllJobCardList'] = $this->SystemModel->getAll($modelData);


        $this->load->view('dispatch/edit_sub_dispatch_detail', $data);
    }

    public function dispatch_sub_detail_action()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        $DispatchDetailData['tableName'] = 'dispatch_detail';
        for ($i = 0; $i < count($customer_id); $i++) {
            $DispatchDetailData['data'] = array(
                'dispatch_id' => $dispatch_id,
                'customer_id' => $customer_id[$i],
                'po_part_id' => $po_part_id[$i],
                'part_id' => $part_id[$i],
                'qty' => $qty[$i],
                'unit' => $unit[$i],
                'authorizes_person' => $authorizes_person[$i],
                'job_card_id' => $job_card_id[$i],
                'batch_no' => $batch_no[$i],
                'status' => $status[$i],
                'updated' => date('Y-m-d H:i:s')
            );
            $DispatchDetailData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($DispatchDetailData);
        }
        redirect('department_user/dispatch/add_edit/' . $dispatch_id);
    }

    public function dispatchSubdelete($id, $dispatch_id)
    {
        $modelData['tableName'] = "dispatch_detail";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/dispatch/add_edit/' . $dispatch_id);
    }

    /*End : Dispatch Detail Data popup*/
}
