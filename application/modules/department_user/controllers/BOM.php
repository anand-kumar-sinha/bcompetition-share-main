<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BOM extends MY_Controller
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
        
        $modelData['select'] = 'Bom.*, cust.customer_name, cust.contact, pm.part_name, pm.part_code,mgm.material_grade_name';
        $modelData['tableName'] = 'bom Bom';
        $modelData['join'][] = array('tableName' => 'customer_master cust', 'condtion' => 'cust.id=Bom.customer_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'part_master pm', 'condtion' => 'pm.id=Bom.part_id', "type" => "left");
        $modelData['join'][] = array('tableName' => 'material_grade_master mgm', 'condtion' => 'mgm.id=Bom.material_grade_id', "type" => "left");
        $modelData['condtion'] = "Bom.is_deleted=0";
        $AllBOMList = $this->SystemModel->getAll($modelData);
        
        $arr = new stdClass;
        $i=0;
       
        foreach ($AllBOMList as $_AllBOMList) {
            $arr->$i = $_AllBOMList;           
            $BomPartData['join'] = array();
            $BomPartData['select'] = 'bpd.rm_form, bpd.rm_size, bpd.rm_rate, bpd.rm_cost';
            $BomPartData['tableName'] = 'bom_part_detail bpd';
            $BomPartData['condtion'] = "bpd.bom_id=".$_AllBOMList->id;   
            $arr->$i->bom_part_data = $this->SystemModel->getAll($BomPartData);
            
            $BomOperationData['join'] = array();
            $BomOperationData['select'] = 'bod.*, om.operation_name,om.operation_code,mm.machine_name, mm.machine_code ';
            $BomOperationData['tableName'] = 'bom_operation_detail bod';
            $BomOperationData['join'][] = array('tableName' => 'operation_master om', 'condtion' => 'om.id=bod.operation_id', "type" => "left");
            $BomOperationData['join'][] = array('tableName' => 'machine_master mm', 'condtion' => 'mm.id=bod.machine_id', "type" => "left");
            $BomOperationData['condtion'] = "bod.bom_id=" . $_AllBOMList->id;
            $arr->$i->BOMOperationDetailNew = $this->SystemModel->getAll($BomOperationData);
            
            $i++;
        }    
         
        $data['AllBOMList'] = $arr;  
        
        
        $this->load->department_user('bom/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'bom';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);

            $modelData['tableName'] = 'bom_part_detail';
            $modelData['condtion'] = "bom_id=" . $id;
            $BOMPartDetail = $this->SystemModel->getAll($modelData);
            $data['BOMDetail']->BOMPartDetail = $BOMPartDetail;

            $modelData['tableName'] = 'bom_operation_detail';
            $modelData['condtion'] = "bom_id=" . $id;
            $BOMOperationDetail = $this->SystemModel->getAll($modelData);

            foreach ($BOMOperationDetail as $_BOMOperationDetail) {

                $modelData['tableName'] = 'bom_operation_inspection_detail';
                $modelData['condtion'] = "bom_operation_detail_id=" . $_BOMOperationDetail->id;
                $BOMOperationInspectionDetail = $this->SystemModel->getAll($modelData);
                $_BOMOperationDetail->BOMOperationInspectionDetail = $BOMOperationInspectionDetail;
            }
            $data['BOMDetail']->BOMOperationDetail = $BOMOperationDetail;

            $BomOperationData['select'] = 'bod.*, om.operation_name,om.operation_code,mm.machine_name, mm.machine_code ';
            $BomOperationData['tableName'] = 'bom_operation_detail bod';
            $BomOperationData['join'][] = array('tableName' => 'operation_master om', 'condtion' => 'om.id=bod.operation_id', "type" => "left");
            $BomOperationData['join'][] = array('tableName' => 'machine_master mm', 'condtion' => 'mm.id=bod.machine_id', "type" => "left");
            $BomOperationData['condtion'] = "bod.bom_id=" . $id;
            $BOMOperationDetailNew = $this->SystemModel->getAll($BomOperationData);
            
            $arr = new stdClass;
            $i=0;

            foreach ($BOMOperationDetailNew as $_BOMOperationDetailNew) {
                $arr->$i = $_BOMOperationDetailNew;           
                $BomOperationInspectionData['join'] = array();
                $BomOperationInspectionData['tableName'] = 'bom_operation_inspection_detail boid';
                $BomOperationInspectionData['condtion'] = "boid.bom_operation_detail_id=" . $_BOMOperationDetailNew->id;
                $arr->$i->BOMOperationInspection = $this->SystemModel->getAll($BomOperationInspectionData);
                $i++;
            }
            $data['BOMOperationDetailNew'] = $arr;
        }
      

        $customerData['tableName'] = 'customer_master';
        $customerData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllCustomer'] = $this->SystemModel->getAll($customerData);

        $partMasterData['tableName'] = 'part_master';
        $partMasterData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllPartMaster'] = $this->SystemModel->getAll($partMasterData);

        $partData['tableName'] = 'inward_BOP_material_master';
        $partData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllPart'] = $this->SystemModel->getAll($partData);

        
        
        $machineData['tableName'] = 'material_grade_master';
        $machineData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllMaterialGrade'] = $this->SystemModel->getAll($machineData);

        $operationData['tableName'] = 'operation_master';
        $operationData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllOperation'] = $this->SystemModel->getAll($operationData);

        $allMachineData['tableName'] = 'machine_master';
        $allMachineData['condtion'] = "status='Active' AND is_deleted=0";
        $data['AllMachine'] = $this->SystemModel->getAll($allMachineData);

        $this->load->department_user('bom/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $modelData['tableName'] = "bom";
        if (isset($id) && $id != '') {

            $modelData['data'] = array(
                'customer_id' => $customer_id,
                'part_cost' => $part_cost,
                'part_id' => $part_id,
                'material_grade_id' => $material_grade_id,
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);

            $modelData['tableName'] = "bom_part_detail";
            $modelData['condtion'] = "bom_id=" . $id;
            $deletePartDetailResult = $this->SystemModel->deleteData($modelData);

            $inserted_client_id = $id;

            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            $modelData['data'] = array(
                'customer_id' => $customer_id,
                'part_cost' => $part_cost,
                'part_id' => $part_id,
                'material_grade_id' => $material_grade_id,
                'status' => $status,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

            $bom_number = sprintf("BOM#%04d", $inserted_client_id);

            $modelData['data'] = array(
                'bom_number'    => $bom_number,
            );
            $modelData['condtion'] = "id=" . $inserted_client_id;
            $result = $this->SystemModel->updateData($modelData);

            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

        if ($rm_form && $rm_size && $part_stripe_coil_name && $part_gross_weight && $rm_rate && $rm_cost && $scarp_weight && $scarp_rate && $scarp_cost && $scarp_part_id) {
            $partDetail['tableName'] = "bom_part_detail";
            for ($i = 0; $i < count($rm_form); $i++) {
                $partDetail['data'] = array(
                    'bom_id' => $inserted_client_id,
                    'rm_form' => $rm_form[$i],
                    'rm_size' => $rm_size[$i],
                    'part_stripe_coil_name' => $part_stripe_coil_name[$i],
                    'part_gross_weight' => $part_gross_weight[$i],
                    'rm_rate' => $rm_rate[$i],
                    'rm_cost' => $rm_cost[$i],
                    'scarp_weight' => $scarp_weight[$i],
                    'scarp_rate' => $scarp_rate[$i],
                    'scarp_cost' => $scarp_cost[$i],
                    'scarp_part_id' => $scarp_part_id[$i],
                    'created' => date('Y-m-d H:i:s')
                );
                $partDetailResult = $this->SystemModel->insertData($partDetail);
            }
        }

        if ($spm_name && $operation_id && $machine_id && $spm_name[0] != '' && $operation_id[0] != '' && $machine_id[0] != '') {
            foreach ($spm_name as $key => $_spm_name) {
                $i = 0;
                $operationDetail['tableName'] = "bom_operation_detail";
                $operationDetail['data'] = array(
                    'bom_id' => $inserted_client_id,
                    'operation_id' => $operation_id[$key],
                    'machine_id' => $machine_id[$key],
                    'spm_name' => $_spm_name,
                    'created' => date('Y-m-d H:i:s')
                );
                $operationDetailResult = $this->SystemModel->insertData($operationDetail);
                $inserted_bom_operation_detail_id = $this->SystemModel->lastInsertId();

                foreach ($inspection_para[$key] as $_inspection_para) {

                    $operationInspection['tableName'] = "bom_operation_inspection_detail";
                    $operationInspection['data'] = array(
                        'bom_operation_detail_id' => $inserted_bom_operation_detail_id,
                        'inspection_para' => $_inspection_para,
                        'specification' => $specification[$key][$i],
                        'inspection_method' => $inspection_method[$key][$i],
                        'operation_cost' => $operation_cost[$key][$i],
                        'created' => date('Y-m-d H:i:s')
                    );
                    $operationInspectionResult = $this->SystemModel->insertData($operationInspection);
                    $i++;
                }
            }
        }

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/BOM');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "bom";
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
                        'module_name' => 'Bom',
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
        redirect('department_user/BOM');
    }

    
    /*Start : Operation Detail Data popup*/

    public function edit_operation_detail()
    {
        extract($this->input->post()); // convert array to variable -- php function //

        $BomOperationData['select'] = 'bod.*, om.operation_name,om.operation_code,mm.machine_name, mm.machine_code ';
        $BomOperationData['tableName'] = 'bom_operation_detail bod';
        $BomOperationData['join'][] = array('tableName' => 'operation_master om', 'condtion' => 'om.id=bod.operation_id', "type" => "left");
        $BomOperationData['join'][] = array('tableName' => 'machine_master mm', 'condtion' => 'mm.id=bod.machine_id', "type" => "left");
        $BomOperationData['condtion'] = "bod.id=" . $operation_id;
        $data['BOMOperationDetail'] = $this->SystemModel->getOne($BomOperationData);

        $modelData['tableName'] = 'bom_operation_inspection_detail';
        $modelData['condtion'] = "bom_operation_detail_id=" . $operation_id;
        $data['BOMOperationInspectionDetail'] = $this->SystemModel->getAll($modelData);

        $operationData['tableName'] = 'operation_master';
        $operationData['condtion'] = "status='Active'";
        $data['AllOperation'] = $this->SystemModel->getAll($operationData);

        $allMachineData['tableName'] = 'machine_master';
        $allMachineData['condtion'] = "status='Active'";
        $data['AllMachine'] = $this->SystemModel->getAll($allMachineData);


        $this->load->view('bom/edit_operation_detail', $data);
    }

    public function opration_detail_action()
    {
        extract($this->input->post()); // convert array to variable -- php function //
        $BomOperationData['tableName'] = 'bom_operation_detail';
        $BomOperationData['data'] = array(
            'operation_id' => $operation_id,
            'machine_id' => $machine_id,
            'spm_name' => $spm_name,
            'updated' => date('Y-m-d H:i:s')
        );
        $BomOperationData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->updateData($BomOperationData);

        $modelInspectionData['tableName'] = "bom_operation_inspection_detail";
        $modelInspectionData['condtion'] = "bom_operation_detail_id=" . $id;
        $result = $this->SystemModel->deleteData($modelInspectionData);

        foreach ($inspection_para as $key => $_inspection_para) {

            $operationInspection['tableName'] = "bom_operation_inspection_detail";
            $operationInspection['data'] = array(
                'bom_operation_detail_id' => $id,
                'inspection_para' => $_inspection_para,
                'specification' => $specification[$key],
                'inspection_method' => $inspection_method[$key],
                'operation_cost' => $operation_cost[$key],
                'created' => date('Y-m-d H:i:s')
            );
            $operationInspectionResult = $this->SystemModel->insertData($operationInspection);
        }

        redirect('department_user/BOM/add_edit/' . $bom_id);
    }

    public function operationBOMdelete($id, $bom_id)
    {
        $modelData['tableName'] = "bom_operation_detail";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $modelInspectionData['tableName'] = "bom_operation_inspection_detail";
        $modelInspectionData['condtion'] = "bom_operation_detail_id=" . $id;
        $result = $this->SystemModel->deleteData($modelInspectionData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('department_user/BOM/add_edit/' . $bom_id);
    }

     public function get_customer_part_and_code()
    {
        extract($this->input->post()); // convert array to variable -- php function //
      
        $partMasterData['tableName'] = 'part_master';
        $partMasterData['condtion'] = "status='Active' AND customer_id=".$customer_id;
        $AllPartMaster = $this->SystemModel->getAll($partMasterData);
        
        $html='';
        $html .='<option value=""> -Select-</option>';
        foreach ($AllPartMaster as $_AllPartMaster) {
            $selected = "";
            if ($_AllPartMaster->id == $part_id) {
                $selected = "selected";
            }
                $html .='<option value="'.$_AllPartMaster->id.'" '.$selected.'>'.$_AllPartMaster->part_name . ' / ' . $_AllPartMaster->part_code.'</option>"';
        }
        echo $html;
        die();
    }
    
    /*End : Operation Detail Data popup*/
}
