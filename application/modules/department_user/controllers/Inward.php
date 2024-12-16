<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inward extends MY_Controller
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
        $modelData['select'] = 'inw.*, sm.supplier_name, sm.contact';
        $modelData['tableName'] = 'inward inw';
        $modelData['join'][] = array('tableName' => 'supplier_master sm', 'condtion' => 'sm.id=inw.supplier_id', "type" => "left");
        //        $modelData['join'][] = array('tableName' => 'inward_details ide', 'condtion' => 'ide.inward_id=inw.id', "type" => "left");
        $AllInwardList = $this->SystemModel->getAll($modelData);

        $arr = new stdClass;
        $i = 0;

        foreach ($AllInwardList as $_AllInwardList) {
            $arr->$i = $_AllInwardList;
            $InwardDetailData['join'] = array();
            $InwardDetailData['select'] = 'inwardD.*, bpdd.rm_form, bpdd.rm_size, bpdd.rm_rate, bpdd.rm_cost, b.bom_number, pm.part_name, pm.part_code';
            $InwardDetailData['tableName'] = 'inward_details inwardD';
            $InwardDetailData['join'][] = array('tableName' => 'bom_part_detail bpdd', 'condtion' => 'bpdd.id = inwardD.bom_part_detail_id', "type" => "left");
            $InwardDetailData['join'][] = array('tableName' => 'bom b', 'condtion' => 'b.id=bpdd.bom_id', "type" => "left");
            $InwardDetailData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
            $InwardDetailData['condtion'] = "inward_id=" . $_AllInwardList->id;
            $arr->$i->inward_details = $this->SystemModel->getAll($InwardDetailData);
            $i++;
        }

        $data['AllInwardList'] = $arr;

        $this->load->department_user('inward/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'inward';
            $modelData['condtion'] = "id=" . $id;
            $data['InwardDetail'] = $this->SystemModel->getOne($modelData);

            $inverdData['select'] = 'inwardD.*, bpdd.rm_form, bpdd.rm_size, bpdd.rm_rate, bpdd.rm_cost, b.bom_number, pm.part_name, pm.part_code';
            $inverdData['tableName'] = 'inward_details inwardD';
            $inverdData['join'][] = array('tableName' => 'bom_part_detail bpdd', 'condtion' => 'bpdd.id = inwardD.bom_part_detail_id', "type" => "left");
            $inverdData['join'][] = array('tableName' => 'bom b', 'condtion' => 'b.id=bpdd.bom_id', "type" => "left");
            $inverdData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
            $inverdData['condtion'] = "inward_id=" . $id;
            $data['AllInwardSubDetail'] = $this->SystemModel->getAll($inverdData);
        }

        $partData['tableName'] = 'part_master';
        $partData['condtion'] = "status='Active'";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        $supplierData['tableName'] = 'supplier_master';
        $supplierData['condtion'] = "status='Active'";
        $data['AllSupplier'] = $this->SystemModel->getAll($supplierData);

        $BomOperationData['select'] = 'b.*, pm.part_name,pm.part_code, bpd.rm_form, bpd.rm_size, bpd.id as bom_part_detail_id ';
        $BomOperationData['tableName'] = 'bom b';
        $BomOperationData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
        $BomOperationData['join'][] = array('tableName' => 'bom_part_detail bpd', 'condtion' => 'b.id=bpd.bom_id', "type" => "left");
        $data['AllBom'] = $this->SystemModel->getAll($BomOperationData);

        // echo '<pre>data---';
        // print_r($data['AllBom']); die;

        $this->load->department_user('inward/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //
        // echo '<pre>post';
        // print_r($_POST); die;
        $modelData['tableName'] = "inward";
        $inward_date = date("Y-m-d", strtotime($inward_date));

        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'gate_entry_no' => $gate_entry_no,
                'inward_date' => $inward_date,
                'vehicle_no' => $vehicle_no,
                'supplier_id' => $supplier_id,
                'supplier_invoice_no' => $supplier_invoice_no,
                'group' => $group,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);
            $inserted_client_id = $id;

            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'gate_entry_no' => $gate_entry_no,
                'inward_date' => $inward_date,
                'vehicle_no' => $vehicle_no,
                'supplier_id' => $supplier_id,
                'supplier_invoice_no' => $supplier_invoice_no,
                'group' => $group,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

        if ($group == 'Store') {
            if ($store_bom_part_detail_id && $store_qty && $store_unit && $store_rate && $store_amount && $store_remark) {
                $partDetail['tableName'] = "inward_details";
                for ($i = 0; $i < count($store_bom_part_detail_id); $i++) {

                    $partDetail['data'] = array(
                        'inward_id' => $inserted_client_id,
                        'bom_part_detail_id' => $store_bom_part_detail_id[$i],
                        'qty' => $store_qty[$i],
                        'unit' => $store_unit[$i],
                        'rate' => $store_rate[$i],
                        'amount' => $store_amount[$i],
                        'remark' => $store_remark[$i],
                        'created' => date('Y-m-d H:i:s')
                    );
                    $partDetailResult = $this->SystemModel->insertData($partDetail);
                }
            }
        } else if ($group == 'Mother Sheet') {
            if ($mother_sheet_bom_part_detail_id && $mother_sheet_qty && $mother_sheet_unit && $mother_sheet_rate && $mother_sheet_amount && $mother_sheet_billing_party_invoice_no && $mother_sheet_billing_date && $mother_sheet_batch_no && $mother_sheet_remark) {
                $partDetail['tableName'] = "inward_details";
                for ($i = 0; $i < count($mother_sheet_bom_part_detail_id); $i++) {

                    $mother_sheet_billing_date = date("Y-m-d", strtotime($mother_sheet_billing_date[$i]));
                    $partDetail['data'] = array(
                        'inward_id' => $inserted_client_id,
                        'bom_part_detail_id' => $mother_sheet_bom_part_detail_id[$i],
                        'qty' => $mother_sheet_qty[$i],
                        'unit' => $mother_sheet_unit[$i],
                        'rate' => $mother_sheet_rate[$i],
                        'amount' => $mother_sheet_amount[$i],
                        'billing_party_invoice_no' => $mother_sheet_billing_party_invoice_no[$i],
                        'billing_date' => $mother_sheet_billing_date,
                        'batch_no' => $mother_sheet_batch_no[$i],
                        'remark' => $mother_sheet_remark[$i],
                        'created' => date('Y-m-d H:i:s')
                    );
                    $partDetailResult = $this->SystemModel->insertData($partDetail);
                }
            }
        } else {
            if ($bom_part_detail_id && $qty && $unit && $rate && $amount && $billing_party_invoice_no && $billing_date && $ref_part_no && $qty_of_pcs && $qty_of_pcs && $batch_no && $remark) {
                $partDetail['tableName'] = "inward_details";
                for ($i = 0; $i < count($bom_part_detail_id); $i++) {

                    $billing_date = date("Y-m-d", strtotime($billing_date[$i]));
                    $partDetail['data'] = array(
                        'inward_id' => $inserted_client_id,
                        'bom_part_detail_id' => $bom_part_detail_id[$i],
                        'qty' => $qty[$i],
                        'unit' => $unit[$i],
                        'rate' => $rate[$i],
                        'amount' => $amount[$i],
                        'billing_party_invoice_no' => $billing_party_invoice_no[$i],
                        'billing_date' => $billing_date,
                        'ref_part_no' => $ref_part_no[$i],
                        'qty_of_pcs' => $qty_of_pcs[$i],
                        'batch_no' => $batch_no[$i],
                        'rm_rate_per_pices' => $rm_rate_per_pices[$i],
                        'remark' => $remark[$i],
                        'created' => date('Y-m-d H:i:s')
                    );
                    $partDetailResult = $this->SystemModel->insertData($partDetail);
                }
            }
        }

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/inward');
    }


    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/
        $departmentUserData = $this->session->userdata('departmentUserData');
        $modelData['tableName'] = "inward";
        $modelData['data'] = array(                  
                        'is_deleted' => '1',
                        'deleted_by' => $departmentUserData->id,
                        'updated' => date('Y-m-d H:i:s')
                );
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($modelData);
        
        $modelData1['tableName'] = "super_admin_notification";
        $modelData1['data'] = array(                  
                    'admin_id' => $departmentUserData->id,
                    'module_name' => 'Inward delete record',
                    'module_id' => $id,
                    'created' => date('Y-m-d H:i:s')
            );
        $result1 = $this->SystemModel->insertData($modelData1);

//        $modelData['condtion'] = "id=" . $id;
//        $result = $this->SystemModel->deleteData($modelData);


//        $inwardDetailData['tableName'] = "inward_details";
//        $inwardDetailData['condtion'] = "inward_id=" . $id;
//        $deleteinwardDetailResult = $this->SystemModel->deleteData($inwardDetailData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/inward');
    }


    /*Start : Inward Sub Detail Data popup*/

    public function edit_inward_sub_detail()
    {
        extract($this->input->post()); // convert array to variable -- php function //

        $inverdData['tableName'] = 'inward_details';
        $inverdData['condtion'] = "id=" . $inward_sub_id;
        $data['InwardSubDetail'] = $this->SystemModel->getOne($inverdData);

        $modelData['tableName'] = 'inward';
        $modelData['condtion'] = "id=" . $data['InwardSubDetail']->inward_id;
        $data['InwardDetail'] = $this->SystemModel->getOne($modelData);

        $BomOperationData['select'] = 'b.*, pm.part_name,pm.part_code, bpd.rm_form, bpd.rm_size, bpd.id as bom_part_detail_id ';
        $BomOperationData['tableName'] = 'bom b';
        $BomOperationData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=b.part_id', "type" => "left");
        $BomOperationData['join'][] = array('tableName' => 'bom_part_detail bpd', 'condtion' => 'b.id=bpd.bom_id', "type" => "left");
        $data['AllBom'] = $this->SystemModel->getAll($BomOperationData);

        $this->load->view('inward/edit_inward_sub_detail', $data);
    }

    public function inward_sub_detail_action()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        $modelData['tableName'] = "inward_details";

        $billing_date = date("Y-m-d", strtotime($billing_date));
        $modelData['data'] = array(
            'bom_part_detail_id' => $bom_part_detail_id,
            'qty' => $qty,
            'unit' => $unit,
            'rate' => $rate,
            'amount' => $amount,
            'billing_party_invoice_no' => $billing_party_invoice_no,
            'billing_date' => $billing_date,
            'ref_part_no' => $ref_part_no,
            'qty_of_pcs' => $qty_of_pcs,
            'batch_no' => $batch_no,
            'rm_rate_per_pices' => $rm_rate_per_pices,
            'remark' => $remark,
            'created' => date('Y-m-d H:i:s')
        );
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($modelData);

        redirect('department_user/inward/add_edit/' . $inward_id);
    }

    public function InwardSubdelete($id, $inward_id)
    {
        $modelData['tableName'] = "inward_details";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/inward/add_edit/' . $inward_id);
    }

    /*End : Operation Detail Data popup*/
}
